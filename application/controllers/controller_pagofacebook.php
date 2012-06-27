<?php

class Controller_pagofacebook extends CI_Controller {
    
    public function cargar(){
        $this->load->view('view_facebook');
    }
    
    public function pagarconpost()
	{
        $this->load->library('session');
        // cargamos la libreria
        $this->load->library('facebook');
        // la apikey 
        $api_key = '120286514779426'; 
        // el appsecret 
        $api_sec = 'ca0251952252aecbc49a6a833ff78563';
        

        // Definimos códigos de error
        $NOT_INSTALLED= 1;
        $NO_PUBLISH_STREAM=2;
        $MALFORMED_ARRAY=90;

        $facebook = new Facebook(array (  
                           'appId'  => $api_key,
                           'secret' => $api_sec,
                           'cookie' => true ,
                         ));

        try
        {

          $sesion = $facebook->getUser();
          if (!$sesion)
            throw new Exception('Aplicación no instalada', $NOT_INSTALLED);


          // Obtenemos los permisos del usuario
          $permissions = $facebook->api('/'.$sesion.'/permissions');
          if (!isset ($permissions['data'][0]))
            throw new Exception('Facebook ha devuelto un array mal formado', $MALFORMED_ARRAY);

          if (!isset ($permissions['data'][0]['publish_stream']))
            throw new Exception('No tengo permiso publish_stream', $NO_PUBLISH_STREAM);
          
          $num=0;
          echo "-";
          $nombres=" ";
          while(isset ($_POST['nombre'.$num])){
              echo $num;
              $nombres=$nombres.$_POST['nombre'.$num]."; ";
              $num=$num+1;
          }
          echo "chori";
          if($num>=0){
          $mensaje='He comprado en Massive Dynamic los siguientes programas:'.$nombres.'prueba ya el sistema de Pago Social de Massive Dynamics, un universo en software, revisa sus ofertas en http://massivedynamic.inf.utfsm.cl/';
          $facebook->api('/me/feed', 'post', array ('message' => $mensaje));
          
          $this->load->model('model_compra');
          
          $num=0;
          $data["link"]=array();
          echo "hola";
          while(isset($_POST['codigo'.$num])){
          echo $num;
          $this->model_compra->IngresarCompra($this->session->userdata('idUsuarios'),$_POST['codigo'.$num],1);
          $data["link"][]="<a href='".site_url("controller_descarga/bajar/")."/".$_POST['codigo'.$num]."'>Descargar ".$_POST['nombre'.$num]."</a>";
          $num=$num+1;       
          }
          echo "chao";
          
          $this->load->view('view_comprado',$data);
          $this->load->library('cart');
           $this->cart->destroy();
          }
        } catch (Exception $e)
        {
          switch ($e->getCode())
            {
            case $NOT_INSTALLED: 
              $login_url = $facebook->getLoginUrl();
              header ('Location: '.$login_url);
              $this->load->view('view_nocomprado');
              die ();
              break;
            case $NO_PUBLISH_STREAM:
              $login_url = $facebook->getLoginUrl(array ('scope'=>'publish_stream'));
              header ('Location: '.$login_url);
               $this->load->view('view_nocomprado');
              die ();
              break;

            case $MALFORMED_ARRAY:
              echo  $e->getMessage();
             $this->load->view('view_nocomprado');
              break;

            default:
              echo  "Ocurrió un error no identificado";
              $this->load->view('view_nocomprado');
            }
	}
        }
        public function nocomprado()
	{
        $this->load->view('view_nocomprado');
	}
}

    ?>