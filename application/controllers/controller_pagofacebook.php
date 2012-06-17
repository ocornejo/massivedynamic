<?php

class Controller_pagofacebook extends CI_Controller {
    
    public function cargar(){
        $this->load->view('view_facebook');
    }
    
    public function pagarconpost()
	{
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

          echo  "Estamos identificados en Facebook<br/>";
          echo  "Usuario: ".$sesion."<br/>";

          // Obtenemos los permisos del usuario
          $permissions = $facebook->api('/'.$sesion.'/permissions');
          if (!isset ($permissions['data'][0]))
            throw new Exception('Facebook ha devuelto un array mal formado', $MALFORMED_ARRAY);

          if (!isset ($permissions['data'][0]['publish_stream']))
            throw new Exception('No tengo permiso publish_stream', $NO_PUBLISH_STREAM);

          $mensaje='He comprado software con pago social en Massive Dynamic, un universo en software, reviza sus ofertas en http://massivedynamic.inf.utfsm.cl/';
          $facebook->api('/me/feed', 'post', array ('message' => $mensaje));

        } catch (Exception $e)
        {
          switch ($e->getCode())
            {
            case $NOT_INSTALLED: 
              $login_url = $facebook->getLoginUrl();
              header ('Location: '.$login_url);
              die ();
              break;
            case $NO_PUBLISH_STREAM:
              $login_url = $facebook->getLoginUrl(array ('scope'=>'publish_stream'));
              header ('Location: '.$login_url);
              die ();
              break;

            case $MALFORMED_ARRAY:
              echo  $e->getMessage();
              break;

            default:
              echo  "Ocurrió un error no identificado";
            }
	}
        }
        public function nocomprado()
	{
        $this->load->view('view_nocomprado');
	}
}

    ?>