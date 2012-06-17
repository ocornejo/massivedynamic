<?php

class Controller_pagofacebook extends CI_Controller {
    
    public function cargar(){
        $this->load->view('view_facebook');
    }
    
    public function pagarconpost()
	{
        echo "hello";  
        echo "*-*";  
        
        $this->load->library('facebook', $fb_config);
	 
        echo "a"; 
        
        $params = array(  
        'access_token' => 'AAABtZAmL8FSIBAHCLDj7ZAhxNlYuxjp4ZCdBYr18hCZChTAEMd7xLUauX2ZCDHZBrblSFgqcZCpRLDlluKOxrAfALd7Q65pNW9lRVZAPZAyYCKgZDZD',  
        'message' => 'Probando post con php, ignore este mensaje'); 
        echo "b";
        $res = $fb->api('/ID_USUARIO/feed', 'POST', $params);  
        echo "c";
        if(!$res)  
            echo 'Ha ocurrido un error indeterminado';  
        elseif($res->error)  
            echo "Ha ocurrido un error: {$res->error}";  
        else  
            echo "Su compra se ha realizado, gracias por preferir massivedynamycs";  

	}
        public function nocomprado()
	{
        $this->load->view('view_nocomprado');
	}
}

    ?>