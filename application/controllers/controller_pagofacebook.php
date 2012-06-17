<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_pagofacebook extends CI_Controller {
    
    public function cargar(){
        $this->load->view('view_facebook');
    }
    
    public function pagarconpost()
	{
	$fb = new Facebook(array(  
            'appId'  => '120286514779426',  
            'secret' => 'ca0251952252aecbc49a6a833ff78563',  
            'cookie' => true));  
        $this->load->library('facebook', $fb_config);
        $params = array(  
        'access_token' => 'AAABtZAmL8FSIBAHCLDj7ZAhxNlYuxjp4ZCdBYr18hCZChTAEMd7xLUauX2ZCDHZBrblSFgqcZCpRLDlluKOxrAfALd7Q65pNW9lRVZAPZAyYCKgZDZD&expires_in=5184000&code=AQANkxbtIfTg7o9p_fDoPcYZuATcN5wftNhQkHjHOU0vV84o05-OcBu41hJr7GGNJChGQnKtA-K2ioPdKH_WHM-MIlJjGD3a59OLxTM6W0Xqyy4TTiBiVRbh_UF5Css5dIuQf5eiZeLkrnmpxTVLU9h1lyT2VOYmNqlc',  
        'message' => 'Probando post con php, ignore este mensaje');  
        $res = $fb->api('/ID_USUARIO/feed', 'POST', $params);  
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