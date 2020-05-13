<?php

namespace Easyanuncios\Modules\System\Controllers;

use Phalcon\Image\Factory;
use Easyanuncios\Models\Anuncios;
use Easyanuncios\Models\Facturas;
use Easyanuncios\Models\Campagnas;

class CampagnasController extends ControllerBase
{

	public function pagarAction(int $id){

		$factura = Facturas::generar($id);

		$web = $this->webHelper;
		$pago = $this->paypalHelper->cobrar($factura, "system/campagnas/pago/$id/");
		//var_dump($pago);
		//exit();
		$this->response->redirect($pago->getApprovalLink());
	}

	public function pagoAction(int $id){
		$request = $this->request;
		if ($request->get("estado") == "pagado") {
			//$pago = $this->paypalHelper->getPago($request->get("paymentId"));

			$pago = $this->paypalHelper->completar($request->get("paymentId"), $request->get("PayerID"));
			//var_dump($pago);
			//var_dump($pago->getState());
			//var_dump($pago->getTransactions());
			if( $pago->getState() == "approved" ){
				$transacciones = $pago->getTransactions();
				$transaccion = $transacciones[0];
				$factura = Facturas::findFirstByCodigo($transaccion->getInvoiceNumber());

				$factura->estado = Facturas::PAGADO;
				$factura->pago =$pago->getId();

				$factura->Campagna->estado = Campagnas::PAGADA;
				$factura->save();
				//$this->view->factura = $factura;

				$this->flashsession->success(
					"Pago procesado exitosamente"
				);

			}

			//exit();
		}else{
			$this->flashsession->warning(
				"Pago no completado"
			);
		}

		$this->response->redirect([
			"for"			=> "adminControllerAction",
			"controller"	=> "resumen",
			'action'		=> "ver",
			"params"		=> $factura->Campagna->Anuncio->id
		]);
	}
}
