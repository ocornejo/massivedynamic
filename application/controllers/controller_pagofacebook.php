<?php

class Controller_pagofacebook extends CI_Controller {
    
    public function pagarconpost()
	{
        echo "cantidad es".$_POST['cantidad'];
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
          if (!$sesion){
            throw new Exception('Aplicación no instalada', $NOT_INSTALLED);
            echo "primer";
            }


          // Obtenemos los permisos del usuario
          $permissions = $facebook->api('/'.$sesion.'/permissions');
          if (!isset ($permissions['data'][0])){
              echo "segundo";
            throw new Exception('Facebook ha devuelto un array mal formado', $MALFORMED_ARRAY);
            
          }
          if (!isset ($permissions['data'][0]['publish_stream'])){
              echo "tercero";
              throw new Exception('No tengo permiso publish_stream', $NO_PUBLISH_STREAM);
          }
           
          
          $num=0;
          echo"wena";
          echo "cantidad=".$_POST['cantidad'];
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
        public function prueba()
	{
           
             $config = array(
    'appId' => '120286514779426',
    'secret' => 'ca0251952252aecbc49a6a833ff78563',
  );
             $this->load->library('facebook');
              $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
  if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
        $ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'http://massivedynamic.inf.utfsm.cl/',
                                      'message' => 'He comprado en Massive Dynamic los siguientes'.$_POST['cantidad'].'programas; prueba ya el sistema de Pago Social de Massive Dynamics, un universo en software, revisa sus ofertas'
                                 ));
        echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'publish_stream'
                       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
      // Give the user a logout link 
      echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
    } else {

      // No user, so print a link for the user to login
      // To post to a user's wall, we need publish_stream permission
      // We'll use the current URL as the redirect_uri, so we don't
      // need to specify it here.
      $login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_stream' ) );
      echo 'Please <a href="' . $login_url . '">login.</a>';

    } 
             
        
}
}

    ?>