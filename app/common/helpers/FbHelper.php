<?php
//use \Phalcon\DI\Injectable;
use Phalcon\Mvc\User\Plugin;

use Easyanuncios\Models\Tipos;
use Easyanuncios\Models\Anuncios;
use Easyanuncios\Models\Clientes;
use Easyanuncios\Models\Campagnas;
use Easyanuncios\Models\Difusiones;
use Easyanuncios\Models\Plataformas;
use Easyanuncios\Models\Publicaciones;

use \Slug\Slugifier;

use FacebookAds\Api;

use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;

use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Values\CampaignObjectiveValues;
use FacebookAds\Object\Values\CampaignStatusValues;
use FacebookAds\Object\Values\CampaignBuyingTypeValues;

use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Values\AdSetStatusValues;
use FacebookAds\Object\Values\AdSetBidStrategyValues;
use FacebookAds\Object\Values\AdSetOptimizationGoalValues;
use FacebookAds\Object\Values\AdSetDestinationTypeValues;
use FacebookAds\Object\Values\AdSetBillingEventValues;

use FacebookAds\Object\AdCreativeLinkData;
use FacebookAds\Object\Fields\AdCreativeLinkDataFields;
use FacebookAds\Object\Values\AdCreativeLinkDataAttachmentStyleValues;

use FacebookAds\Object\AdCreativeObjectStorySpec;
use FacebookAds\Object\Fields\AdCreativeObjectStorySpecFields;

use FacebookAds\Object\AdCreativeLinkDataCallToAction;
use FacebookAds\Object\Fields\AdCreativeLinkDataCallToActionFields;
use FacebookAds\Object\Values\AdCreativeLinkDataCallToActionTypeValues;
use FacebookAds\Object\AdCreativeLinkDataCallToActionValue;
use FacebookAds\Object\Fields\AdCreativeLinkDataCallToActionValueFields;

use FacebookAds\Object\Targeting;
use FacebookAds\Object\Fields\TargetingFields;
use FacebookAds\Object\Values\AdCreativeCallToActionTypeValues;

use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Fields\AdCreativeFields;


use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdFields;

use FacebookAds\Object\AdPreview;
use FacebookAds\Object\Values\AdPreviewAdFormatValues;

use FacebookAds\Http\Exception\AuthorizationException;

use FacebookAds\Logger\CurlLogger;


class FbHelper extends Plugin
{
	// La inicial Mayúscula permite que la variable sea accedida externamente

	private $cfg, $clave = "facebook";
	private $plataforma;
	private $api, $cuenta;


	public function __construct()
	{
		//parent::__construct();
		//$this->claveCfg= "facebook";
		$this->cfg = $this->config->{$this->clave};
		Api::init($this->cfg->app_id, $this->cfg->app_secret, $this->cfg->access_token);
		$this->api = Api::instance();
		$this->api->setLogger(new CurlLogger());
		$this->cuenta = (new AdAccount($this->cfg->ad_account_id))->getSelf();
		//var_dump( $fb );
		//exit();

		$this->plataforma = Plataformas::findFirstByClave($this->clave);
	}

	public function getApi(){
		return $this->api;
	}

	public function imagen(int $id)
	{
		$anuncio = Anuncios::findFirstById($id);
		//var_dump($anuncio->toArray());

		if ( $anuncio ) {
			$ruta = FILES_PATH . "/imagenes/{$anuncio->imagen}";
			return (object)[
				"id" => $id,
				"tipo" => mime_content_type ($ruta),
				"contenido" => file_get_contents( $ruta ),
			];
		}
		else{
			return false;
		}
	}

	public function obtenerCampaña(int $idCliente)
	{
		$cliente = Clientes::findFirstById($idCliente);

		$publicaciones = $cliente->getPublicaciones([
			"plataforma = :plataforma:",
			"bind" => [
				"plataforma" => $this->plataforma->id
			]
		]);

		//var_dump($cliente->publicaciones->toArray());

		//var_dump($publicaciones->count());
		if ($publicaciones->count()) {
			$publicacion = $publicaciones[0];
		}else{
			try {
				$campos = [
					CampaignFields::ACCOUNT_ID,
					CampaignFields::BUDGET_REBALANCE_FLAG,
					CampaignFields::BUYING_TYPE,
					CampaignFields::CAN_CREATE_BRAND_LIFT_STUDY,
					CampaignFields::CAN_USE_SPEND_CAP,
					CampaignFields::CONFIGURED_STATUS,
					CampaignFields::CREATED_TIME,
					CampaignFields::EFFECTIVE_STATUS,
					CampaignFields::ID,
					CampaignFields::NAME,
					CampaignFields::OBJECTIVE,
					CampaignFields::PACING_TYPE,
					CampaignFields::SOURCE_CAMPAIGN_ID,
					CampaignFields::START_TIME,
					CampaignFields::STATUS,
					CampaignFields::STOP_TIME,
					CampaignFields::UPDATED_TIME,
				];
				$params = [
					CampaignFields::OBJECTIVE => CampaignObjectiveValues::LINK_CLICKS,
					CampaignFields::STATUS => CampaignStatusValues::PAUSED,
					CampaignFields::BUYING_TYPE => CampaignBuyingTypeValues::AUCTION,
					CampaignFields::NAME => $cliente->nombreCompleto,
				];

				$campaña = $this->cuenta->createCampaign(
					$campos,
					$params
				);

				$datosCampaña = array_filter(
					$campaña->getData(),
					function($val){ return $val !== null; }
				);

				$publicacion = new Publicaciones();
				$publicacion->cliente = $cliente->id;
				$publicacion->plataforma = $this->plataforma->id;
				$publicacion->codigo = $campaña->id;
				$publicacion->atributos = $datosCampaña;
				//var_dump($datosCampaña);
				//var_dump(json_encode($datosCampaña));
				if ( $publicacion->save() ) {
					$publicacion->refresh();
				}
				//$publicacion->save();
				//$publicacion->refresh();

				// echo json_encode($campaña);
				// var_dump($campaña);

			} catch(Exception $e) {
				var_dump( $e );
			}
		}

		//return $cliente->Publicaciones->findFirstByPlataforma($this->plataforma->id);
		return $publicacion;
	}

	public function publicarAnuncio( $idCampaña )
	{
		$atributos = new stdClass();
		$campaña = Campagnas::findFirstById( $idCampaña );
		$anuncio = $campaña->Anuncio;
		$cliente = $anuncio->Cliente;
		$tipo = $anuncio->Tipo;
		//$campañas = $anuncio->Campagnas;
		$publicacion = $this->obtenerCampaña( $cliente->id );

		$nombre = "{$anuncio->titulo} {$campaña->inicio}";

		//var_dump( $campaña->inicio );
		/**
		 * El 90% del monto total se usa para la difusion de los anuncios
		 * Se divide en partes iguales entre las plataformas seleccionadas
		 */
		// TODO: verificar minimos de cada plataforma
		$presupuesto = floor(($campaña->monto * 90) / $tipo->Plataformas->count());

		//var_dump($presupuesto);
		try {
			$objetivo = new Targeting();
			$objetivo->setData([
				TargetingFields::GEO_LOCATIONS => [
					'countries' => ['PE'],
				]
			]);

			$inicio = date(DATE_ISO8601,strtotime($campaña->inicio));
			$fin = date(DATE_ISO8601,strtotime("{$campaña->inicio} + {$campaña->tiempo} days"));

			$campos = [];
			$params = [
				AdSetFields::STATUS  => AdSetStatusValues::PAUSED,
				//AdSetFields::TARGETING  => ['geo_locations' => ['countries' => ['PE']]],
				AdSetFields::TARGETING  => $objetivo,
				AdSetFields::START_TIME => $inicio,
				AdSetFields::END_TIME => $fin,
				//AdSetFields::LIFETIME_BUDGET => floor($presupuesto),
				AdSetFields::BILLING_EVENT => AdSetBillingEventValues::LINK_CLICKS,
				AdSetFields::DAILY_BUDGET => floor($presupuesto / $campaña->tiempo),
				//AdSetFields::BID_AMOUNT => floor($presupuesto / $campaña->tiempo),
				AdSetFields::CAMPAIGN_ID => $publicacion->codigo,
				AdSetFields::BID_STRATEGY => AdSetBidStrategyValues::LOWEST_COST_WITHOUT_CAP,
				AdSetFields::OPTIMIZATION_GOAL => AdSetOptimizationGoalValues::LINK_CLICKS,
				AdSetFields::DESTINATION_TYPE => AdSetDestinationTypeValues::UNDEFINED,
				// AdSetFields::PROMOTED_OBJECT => [
				// 	"object_store_url" => $anuncio->enlace
				// ],
				AdSetFields::NAME => $nombre,
			];

			$adSet = $this->cuenta->createAdSet(
				$campos,
				$params
			);
			$atributos->adSet = $adSet->id;
		} catch(Exception $e) {
			// var_dump( $params );
			// var_dump( $e );
			return (object)[
				"error" => $e
			];
		}


		try {
			$imagen = $this->webHelper->url([
				"for"			=> "systemControllerAction",
				"controller"	=> "anuncios",
				'action'		=> 'imagen',
				'params'		=> $anuncio->id,
			], $this->config->dominioCDN);

			$llamada = new AdCreativeLinkDataCallToAction();
			$llamada->setData([
				AdCreativeLinkDataCallToActionFields::TYPE => AdCreativeLinkDataCallToActionTypeValues::GET_OFFER_VIEW,
			]);

			$enlace = new AdCreativeLinkData();
			$enlace->setData([
				AdCreativeLinkDataFields::NAME => $anuncio->titulo,
				AdCreativeLinkDataFields::LINK => $anuncio->enlace,
				AdCreativeLinkDataFields::MESSAGE => $anuncio->descripcion,
				AdCreativeLinkDataFields::PICTURE => $imagen,
				AdCreativeLinkDataFields::CALL_TO_ACTION => $llamada,
				AdCreativeLinkDataFields::ATTACHMENT_STYLE => AdCreativeLinkDataAttachmentStyleValues::LINK,
			]);

			$objeto = new AdCreativeObjectStorySpec();
			$objeto->setData([
				AdCreativeObjectStorySpecFields::PAGE_ID => $this->cfg->page_id,
				AdCreativeObjectStorySpecFields::LINK_DATA => $enlace,
			]);

			$campos = [];
			$params = [
				//AdCreativeFields::BODY => $anuncio->descripcion,
				//AdCreativeFields::IMAGE_URL => $imagen,
				AdCreativeFields::NAME => $nombre,
				AdCreativeFields::TITLE => $anuncio->titulo,
				AdCreativeFields::OBJECT_STORY_SPEC  => $objeto,
				//AdCreativeFields::CALL_TO_ACTION_TYPE => AdCreativeCallToActionTypeValues::CONTACT_US,

			];

			$adCreative = $this->cuenta->createAdCreative(
				$campos,
				$params
			);
			$atributos->adCreative = $adCreative->id;
		} catch(AuthorizationException $e) {
			return (object)[
				"error" => $e
			];
		} catch(Exception $e) {
			//var_dump( $e );
			return (object)[
				"error" => $e
			];
		}


		try {
			$campos = [];
			$params = [
				AdFields::STATUS => "PAUSED",
				AdFields::ADSET => $adSet,
				AdFields::ADSET_ID => $adSet->id,
				AdFields::NAME => $nombre,
				AdFields::CREATIVE => $adCreative,
				/*AdFields::CREATIVE => [
					"creative_id" => $adCreative->id
				],*/
			];

			$ad = $this->cuenta->createAd(
				$campos,
				$params
			);
			$atributos->ad = $ad->id;
		} catch(Exception $e) {
			//var_dump( $e );
			return (object)[
				"error" => $e
			];
		}
		$atributos->campagna = $campaña->toArray();
		//return $atributos;

		$difusion = new Difusiones();
		$difusion->publicacion = $publicacion->id;
		$difusion->codigo = $ad->id;
		$difusion->anuncio = $campaña->anuncio->id;
		$difusion->atributos = $atributos;

		if ($difusion->create()) {
			$difusion->refresh();
			return $difusion;
			# code...
		}
		else{
			return (object) [
				"error" => true,
				"mensajes" => $difusion->getMessages()
			];
		}

	}


	public function __get($propiedad)
	{
		$nombre = ucfirst($propiedad);
		try {
			switch ($nombre) {
				default:
					$metodo = "get$nombre";
					if (method_exists( $this, $metodo )) {
						return $this->{$metodo}();
					}
					elseif ( property_exists( $this, $nombre )) {
						return $this->{$nombre};
					}
					else{
						return parent::__get($propiedad);
					}
				break;
			}

		} catch (Exception $e) {
			var_dump($e->getMessage());
			//throw $th;
		}
	}

	public function obtenerCampañas()
	{
		$campos = [
				CampaignFields::NAME,
				CampaignFields::CONFIGURED_STATUS,
				CampaignFields::BUYING_TYPE,
				CampaignFields::OBJECTIVE,
				CampaignFields::EFFECTIVE_STATUS,
				CampaignFields::START_TIME,
				CampaignFields::STATUS,
			];
		$params = [];

		$campañas = $this->cuenta->getCampaigns(
				$campos,
				$params
			)->getResponse()->getContent();

		//print_r($campañas["data"]);
		$campaña = $campañas["data"];
		//print_r($campañas["data"]);
		return $campañas["data"];
	}

	public function obtenerConjuntos(string $campañaId, bool $arreglo = false)
	{
		$campos = [
			AdSetFields::ID,
			AdSetFields::NAME,
			AdSetFields::BILLING_EVENT,
			AdSetFields::BID_STRATEGY,
			AdSetFields::CAMPAIGN_ID,
			AdSetFields::ACCOUNT_ID,
			AdSetFields::CREATED_TIME,
			AdSetFields::DAILY_BUDGET,
			AdSetFields::DESTINATION_TYPE,
			AdSetFields::END_TIME,
			AdSetFields::LIFETIME_BUDGET,
			AdSetFields::OPTIMIZATION_GOAL,
			AdSetFields::OPTIMIZATION_SUB_EVENT ,
			AdSetFields::START_TIME,
			AdSetFields::STATUS,
			AdSetFields::TARGETING,
			AdSetFields::UPDATED_TIME,
			AdSetFields::USE_NEW_APP_CLICK,
		];

		$campaña = new Campaign($campañaId);
		$sets = $campaña->getAdSets($campos);

		if ( $arreglo ) {
			return array_map( function( $obj ){
				return $this->limpiarArreglo($obj->getData());
			}, $sets->getObjects() );
		}
		else{
			return $sets->getObjects();
		}
	}

	public function obtenerConjunto(string $id, bool $arreglo = false)
	{
		$campos = [
			AdSetFields::ID,
			AdSetFields::NAME,
			AdSetFields::BILLING_EVENT,
			AdSetFields::BID_STRATEGY,
			AdSetFields::CAMPAIGN_ID,
			AdSetFields::ACCOUNT_ID,
			AdSetFields::CREATED_TIME,
			AdSetFields::DAILY_BUDGET,
			AdSetFields::DESTINATION_TYPE,
			AdSetFields::END_TIME,
			AdSetFields::LIFETIME_BUDGET,
			AdSetFields::OPTIMIZATION_GOAL,
			AdSetFields::OPTIMIZATION_SUB_EVENT ,
			AdSetFields::START_TIME,
			AdSetFields::STATUS,
			AdSetFields::TARGETING,
			AdSetFields::UPDATED_TIME,
			AdSetFields::USE_NEW_APP_CLICK,
		];

		$adSet = ( new AdSet( $id ))->getSelf( $campos );
		// $adSet = $adSet->getSelf( $campos );

		if ( $arreglo ) {
			return $this->limpiarArreglo($adSet->getData());
			//return $adSet->exportData();
		}
		else{
			return $adSet;
		}


	}

	public function obtenerAnuncios(string $conjuntoId, bool $arreglo = false)
	{
		$conjunto = new Adset($conjuntoId);

		$campos = [
			AdCreativeFields::ACCOUNT_ID,
			AdCreativeFields::EFFECTIVE_AUTHORIZATION_CATEGORY,
			AdCreativeFields::EFFECTIVE_INSTAGRAM_STORY_ID,
			AdCreativeFields::EFFECTIVE_OBJECT_STORY_ID,
			AdCreativeFields::ENABLE_DIRECT_INSTALL,
			AdCreativeFields::ID,
			AdCreativeFields::IMAGE_CROPS,
			AdCreativeFields::IMAGE_HASH,
			AdCreativeFields::IMAGE_URL,
			# AdCreativeFields::LINK_DEEP_LINK_URL,
			# AdCreativeFields::LINK_OG_ID,
			# AdCreativeFields::LINK_URL,
			AdCreativeFields::NAME,
			AdCreativeFields::OBJECT_ID,
			AdCreativeFields::OBJECT_STORE_URL,
			AdCreativeFields::OBJECT_STORY_ID,
			AdCreativeFields::OBJECT_STORY_SPEC,
			AdCreativeFields::OBJECT_TYPE,
			AdCreativeFields::OBJECT_URL,
			AdCreativeFields::STATUS,
			AdCreativeFields::TEMPLATE_URL,
			AdCreativeFields::TEMPLATE_URL_SPEC,
			AdCreativeFields::THUMBNAIL_URL,
			AdCreativeFields::TITLE,
			AdCreativeFields::URL_TAGS,
			AdCreativeFields::USE_PAGE_ACTOR_OVERRIDE,
		];

		// $campos = AdCreativeFields::getInstance()->getValues();

		$creatives = $conjunto->getAdCreatives( $campos );
		$creative = $creatives->current();
		//var_dump($this->limpiarArreglo($creative->getData()));


		$campos = AdFields::getInstance()->getValues();

		$anuncios = $conjunto->getAds($campos);

		return $anuncios;

		//var_dump($this->limpiarArreglo( $anuncios->current()->getData() ));

		//return $this->limpiarArreglo($anuncios->current()->getData());
	}

	public function obtenerArte(string $anuncioId, bool $arreglo = false){
		$anuncio = new Ad();
		$anuncio->setId($anuncioId);
	}

	public function obtenerAnuncio(string $anuncioId, bool $arreglo = false)
	{
		//$anuncio = new Ad();
		//$anuncio->setId($anuncioId);
		//$campos = AdFields::getInstance()->getValues();
		$campos = [
			AdFields::ACCOUNT_ID,
			AdFields::AD_REVIEW_FEEDBACK,
			AdFields::ADLABELS,
			AdFields::ADSET,
			AdFields::ADSET_ID,
			AdFields::BID_AMOUNT,
			AdFields::BID_INFO,
			AdFields::BID_TYPE,
			AdFields::CAMPAIGN,
			AdFields::CAMPAIGN_ID,
			AdFields::CONFIGURED_STATUS,
			AdFields::CONVERSION_SPECS,
			AdFields::CREATED_TIME,
			AdFields::CREATIVE,
			AdFields::DEMOLINK_HASH,
			AdFields::DISPLAY_SEQUENCE,
			AdFields::EFFECTIVE_STATUS,
			AdFields::ENGAGEMENT_AUDIENCE,
			AdFields::FAILED_DELIVERY_CHECKS,
			AdFields::ID,
			//AdFields::IS_AUTOBID,
			AdFields::ISSUES_INFO,
			AdFields::LAST_UPDATED_BY_APP_ID,
			AdFields::NAME,
			AdFields::PREVIEW_SHAREABLE_LINK,
			AdFields::PRIORITY,
			AdFields::RECOMMENDATIONS,
			AdFields::SOURCE_AD,
			AdFields::SOURCE_AD_ID,
			AdFields::STATUS,
			AdFields::TARGETING,
			AdFields::TRACKING_AND_CONVERSION_WITH_DEFAULTS,
			AdFields::TRACKING_SPECS,
			AdFields::UPDATED_TIME,
			//AdFields::ADSET_SPEC,
			//AdFields::AUDIENCE_ID,
			//AdFields::DATE_FORMAT,
			//AdFields::DRAFT_ADGROUP_ID,
			//AdFields::EXECUTION_OPTIONS,
			//AdFields::INCLUDE_DEMOLINK_HASHES,
			//AdFields::FILENAME,
		];

		$anuncio = ( new Ad( $anuncioId ))->getSelf( $campos );
		//$anuncio->getSelf($campos);

		if ( $arreglo ) {
			return $this->limpiarArreglo($anuncio->getData());

		}
		else{
			return $anuncio;
		}
	}

	public function obtenerPrevio(string $anuncioId, bool $arreglo = false){

		$anuncio = new Ad($anuncioId);

		$params = [
			'ad_format' => AdPreviewAdFormatValues::MOBILE_FEED_STANDARD,
		];

		$previo = $anuncio->getPreviews([], $params);

		//var_dump( $previos->getObjects() );
		return $previo->current();
	}

	protected function limpiarArreglo(array $arreglo = [])
	{
		return array_filter(
			$arreglo,
			function($val){ return $val !== null; }
		);
	}
}
