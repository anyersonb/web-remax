<?php
namespace Easyanuncios\Modules\Cli\Tasks;

use Colors\Color;

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\Business;
use FacebookAds\Object\ProductCatalog;
use FacebookAds\Object\ProductFeed;
use FacebookAds\Object\ProductSet;
use FacebookAds\Object\ExternalEventSource;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdPreview;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\CampaignFields;

class PruebaTask extends \Phalcon\Cli\Task
{
	public function mainAction()
	{
		$metodos = get_class_methods($this);
		$metodos = array_filter( $metodos, function( $nombre ){
			return substr($nombre, -6 ) == "Action";
		});

		print "Acciones Disponibles:" . PHP_EOL;
		foreach ($metodos as $metodo) {
			echo  "- " . ucfirst( str_replace( "Action", "", $metodo)) . PHP_EOL;
		}
	}

	/* https://github.com/facebook/facebook-php-business-sdk */

	public function facebookAction( array $args )
	{
		$color = new Color();
		$fb = $this->di->get("config")->facebook;

		# TODO: Conseguir token con acceso a marketing

		try {
			Api::init($fb->app_id, $fb->app_secret, $fb->access_token);
			$api = Api::instance();
			//$api->setLogger(new CurlLogger());

			$campos = array(
				AdAccountFields::ID,
				AdAccountFields::NAME,
				AdAccountFields::MIN_DAILY_BUDGET,
			);
			$negocio = new Business($fb->business_id);
			$cuenta = (new AdAccount($fb->ad_account_id))->getSelf($campos);
			//var_dump($cuenta);

			//$adaccount = $cuenta->{get($required_fields)};
			//var_dump($cuenta->exportAllData());
			print $color("Cuenta: " . $cuenta->{AdAccountFields::ID} )->yellow . PHP_EOL;
			$campos = array(
				CampaignFields::NAME,
				CampaignFields::CONFIGURED_STATUS,
				CampaignFields::BUYING_TYPE,
				CampaignFields::OBJECTIVE,
				CampaignFields::EFFECTIVE_STATUS,
				CampaignFields::START_TIME,
				CampaignFields::STATUS,
			);
			$params = array(
				CampaignFields::EFFECTIVE_STATUS => array('ACTIVE'),
			);

			$campañas = $cuenta->getCampaigns(
					[],
					$params
				)->getResponse()->getContent();

			//print_r($campañas["data"]);
			$campaña = $campañas["data"][0];
			print_r($campaña);



		}
		catch (\Throwable $th) {
			print $color($th->getMessage())->bg_red . PHP_EOL;
		}

		// $account->{AdAccountFields::NAME} = 'Interactive';
		// echo $account->{AdAccountFields::NAME};

		// $texto = print_r( $config->facebook, true );
		// echo $color($texto)->dark_gray . PHP_EOL;

	}

	public function configAction( array $args )
	{
		print_r($this->config->facebook);
	}

	public function slugAction( array $args )
	{
		$slugifier = new \Slug\Slugifier;
		$slugifier->setTransliterate(true);
		$slugifier->setLowercase(false);
		$slugifier->setDelimiter("");

		echo lcFirst($slugifier->slugify(ucwords($args[0])));
		//print_r($args);

	}
}
