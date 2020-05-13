<?php

use Phalcon\Mvc\User\Plugin;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentCard;
use PayPal\Api\PaymentExecution;

use PayPal\Api\FlowConfig;
use PayPal\Api\Presentation;
use PayPal\Api\InputFields;
use PayPal\Api\WebProfile;

class PaypalHelper extends Plugin
{
	protected $payer;
	protected $contexto;

	public function __construct() {
		$config = $this->config->paypal;

		$this->payer = new Payer();
		$this->payer->setPaymentMethod("paypal");

		$this->contexto = new ApiContext(
			new OAuthTokenCredential(
				$config->clientId,
				$config->secret
			)
		);

		$this->contexto->setConfig(
			array(
				'mode' => $config->testMode?"sandbox":"live",
				'log.LogEnabled' => true,
				'log.FileName' => $this->config->application->logDir . 'PayPal.log',
				'log.LogLevel' => 'INFO', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
				'cache.enabled' => false,
				'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
				// 'http.CURLOPT_CONNECTTIMEOUT' => 30
				// 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
				//'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
			)
		);
	}

	public function comprar(array $datosCompra)
	{
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item1 = new Item();
		$item1->setName('Ground Coffee 40 oz')
			->setCurrency('USD')
			->setQuantity(1)
			->setSku("123123") // Similar to `item_number` in Classic API
			->setPrice(150);
		$item2 = new Item();
		$item2->setName('Granola bars')
			->setCurrency('USD')
			->setQuantity(5)
			->setSku("321321") // Similar to `item_number` in Classic API
			->setPrice(20);

		$itemList = new ItemList();
		$itemList->setItems(array($item1, $item2));

		$details = new Details();
		$details->setShipping(1)
			->setTax(1)
			->setSubtotal($datosCompra["total"]);

		$amount = new Amount();
		$amount->setCurrency("USD")
			->setDetails($details)
			->setTotal($datosCompra["total"]+2);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setDescription("Anuncio")
			->setItemList($itemList)
			->setInvoiceNumber(uniqid());

		$web = $this->webHelper;
		$redirectUrls = new RedirectUrls();
		$nodo = "admin/facturacion/";

		$redirectUrls->setReturnUrl($web->url("$nodo?estado=pagado"))
			->setCancelUrl($web->url("$nodo?estado=cancela"));

		$payment = new Payment();
		$payment->setIntent("order")
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setExperienceProfileId($this->perfil()->id)
			->setTransactions(array($transaction));

		try {
			$payment->create($this->contexto());
		} catch (Exception $ex) {
			var_dump($ex);
		}

		return $payment;
	}

	public function cobrar($factura, $retorno = null)
	{
		$campagna = $factura->Campagna;
		$monto = 0;
		//$precioDiario = number_format($campagna->monto / ( $campagna->tiempo * $campagna->Plataformas->count() ), 2);
		//var_dump($campagna->countPlataformas());
		//exit;
		$precioUnitario = number_format($campagna->monto / $campagna->Plataformas->count(),2);

		$items = [];

		//echo $precioDiario . PHP_EOL;
		//echo $precioUnitario . PHP_EOL;

		foreach ($campagna->Plataformas as $plataforma) {
			$item = new Item();
			//$item->setName("Publicacion diaria en $plataforma->titulo")
			$item->setName("Publicacion en $plataforma->titulo por $campagna->tiempo días")
				->setCurrency('USD')
				//->setQuantity($campagna->tiempo)
				->setQuantity(1)
				->setPrice($precioUnitario);

			$items[] = $item;
			//$monto +=  number_format($precioDiario * $campagna->tiempo,2);
			$monto += $precioUnitario;
			//echo $monto . PHP_EOL;
		}

		//echo $campagna->monto . PHP_EOL;
		//exit();

		$itemList = new ItemList();
		$itemList->setItems($items);

		$details = new Details();
		//$details->setSubtotal($monto);

		$amount = new Amount();
		$amount->setCurrency("USD")
			//->setDetails($details)
			//->setTotal($monto);
			->setTotal($campagna->monto);

		$codigo = $factura->codigo;

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setDescription("Campaña para {$campagna->Anuncio->titulo} desde $campagna->inicio")
			//->setItemList($itemList)
			->setSoftDescriptor("EasyAnuncios")
			->setInvoiceNumber($codigo);

//$this->contexto
		$payment = new Payment();
		$payment->setIntent("sale")
			->setPayer($this->payer)
			->setRedirectUrls($this->urls($codigo, $retorno))
			->setExperienceProfileId($this->perfil()->id)
			->setTransactions([$transaction]);

		try {
			$payment->create($this->contexto);
		} catch (Exception $ex) {
			return (object)[
				"error" => $ex
			];
		}

		return $payment;
	}

	public function urls($codigo, $retorno = null)
	{
		$redirectUrls = new RedirectUrls();
		//$url = "admin/facturacion/"; //$codigo/";
		if ( $retorno ) {
			$url = $retorno;
		}
		else{
			$url = "admin/crear/pago/"; //$codigo/";
		}


		$web = $this->webHelper;
		$redirectUrls->setReturnUrl($web->url("$url?estado=pagado"))
			->setCancelUrl($web->url("$url?estado=anulado"));

		return $redirectUrls;
	}

	public function completar($paymentId, $payer)
	{
		$payment = Payment::get($paymentId, $this->contexto);
		$execution = new PaymentExecution();
		$execution->setPayerId($payer);

		try {
			$result = $payment->execute($execution, $this->contexto);
			try {
				$payment = Payment::get($paymentId, $this->contexto);
			} catch (Exception $ex) {
				return (object)[
					"error" => $ex
				];
			}
		} catch (Exception $ex) {
			return (object)[
				"error" => $ex
			];
		}
		return $payment;
	}

	function getPago($id){
		return Payment::get($id, $this->contexto);
	}

	protected function perfil()
	{
		$flowConfig = new FlowConfig();
		$flowConfig->setLandingPageType("Billing");
		//$flowConfig->setBankTxnPendingUrl("http://www.proyecto.desarrollo/system/util/echo/BankTxnPendingUrl");
		$flowConfig->setReturnUriHttpMethod("POST");

		$presentation = new Presentation();
		$presentation
			//->setLogoImage($this->webHelper->url("img/marca.png"))
			->setBrandName("EasyAnuncios")
			->setLocaleCode("PE")
			->setReturnUrlLabel("Volver")
			->setNoteToSellerLabel("Gracias!");

		$inputFields = new InputFields();

		$inputFields->setNoShipping(1)
			->setAddressOverride(0);

		$webProfile = new WebProfile();
		$webProfile->setName("EasyAnuncios" . uniqid())
			->setFlowConfig($flowConfig)
			->setPresentation($presentation)
			->setInputFields($inputFields)
			->setTemporary(true);

		return $webProfile->create($this->contexto);
	}

	public function perfiles()
	{
		$list = WebProfile::get_list($this->contexto());
		return $list;
	}
}
