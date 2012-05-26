

<?php
//Hecho en base a http://es.paperblog.com/paypal-nvp-api-con-codeigniter-278257/
//variables en https://cms.paypal.com/us/cgi-bin/?&cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_SetExpressCheckout


define('PAYPAL_URL', 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=');
 
class Controller_Paypal extends Controller {
 
    function Controller_Paypal()
    {
        parent::Controller();
    }
 
    function pagar($nombre, $valor) {
    $this->paypal_api_lib->add_nvp('RETURNURL', site_url("controller_compra/comprado"));//va cuando se realiza la compra bien
    $this->paypal_api_lib->add_nvp('CANCELURL', site_url("controller_compra/nocomprado"));//va cuando no se realiza la compra bien
    $this->paypal_api_lib->add_nvp('NOSHIPPING', '0');//paypal muestra la dirección de shipping 
    $this->paypal_api_lib->add_nvp('ALLOWNOTE', '1');
    $this->paypal_api_lib->add_nvp('SOLUTIONTYPE', 'Sole'); // esto es lo que no obliga a que se tenga que tener cuenta Paypal
    $this->paypal_api_lib->add_nvp('LANDINGPAGE', 'Billing');
    $this->paypal_api_lib->add_nvp('AMT', '69.00');// El costo total de la operación al comprador
    $this->paypal_api_lib->add_nvp('NOSHIPPING', '2');//si no se pasa la dirección de shipping paypal la obtiene de la cuenta del comprador
    $this->paypal_api_lib->add_nvp('HDRIMG', 'http://1.bp.blogspot.com/-op-S2WhOqrU/TZp2DjdpVqI/AAAAAAAAAPQ/ErYyWi2ODlY/s320/MassiveDynamic.png');
    $this->paypal_api_lib->add_nvp('CURRENCYCODE', 'USD');//MONEDA, NO SALE PESO CHILENO 
    $this->paypal_api_lib->add_nvp('L_NAME0', $nombre);//Nombre del elemento comprado
    $this->paypal_api_lib->add_nvp('L_AMT0', $valor);
    
    $this->load->library('session');
    $sesion = array('paypalAmount'=>'69.00');
    $this->session->set_userdata($sesion);
 
    if($this->paypal_api_lib->send_api_call('SetExpressCheckout')){
      if (strtoupper($this->paypal_api_lib->nvp_data["ACK"]) =="SUCCESS") {
                    $token = urldecode($this->paypal_api_lib->nvp_data["TOKEN"]);
                    $payPalURL = PAYPAL_URL.$token;
                    header("Location: ".$payPalURL);
          exit();
      }
    }
    paypal_errors(); 
  }
    
  function ok() {
    $this->load->library('session');
 
    $this->paypal_api_lib->add_nvp('TOKEN', $_REQUEST['token']);
    $this->paypal_api_lib->add_nvp('PAYERID', $_REQUEST['PayerID']);
    $this->paypal_api_lib->add_nvp('PAYMENTACTION', 'Sale');
    $this->paypal_api_lib->add_nvp('AMT', $this->session->userdata('paypalAmount'));
    $this->paypal_api_lib->add_nvp('CURRENCYCODE', 'USD');
    $this->paypal_api_lib->add_nvp('IPADDRESS', $_SERVER['SERVER_NAME']);
 
    if($this->paypal_api_lib->send_api_call('DoExpressCheckoutPayment')) {
      var_dump($this->paypal_api_lib->nvp_data);
    } else {
      paypal_errors();
    }
  }
 
}
?>
