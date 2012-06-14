<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_Catalogo extends CI_Controller {


    function Controller_Catalago(){
        parent::__construct();
        $this->load->model('model_catalogo');
    }
    
    public function index() {

        $this->load->model('model_catalogo');
        $data["resultado"] = $this->model_catalogo->get_productos();
        $this->load->library('session');
        $data["content"]='ficha_producto';
        if ($this->session->userdata('Username') != null) {
            $data["log"] = $this->session->userdata('Username');
        } else {
            $data["log"] = null;
        }
        /* note - you don't need to have the extension when it's a php file */
        $this->load->view('view_catalogo', $data);
    }
    
    public function addToCart(){
        $this->load->model('model_catalogo');
        
        if($this->model_catalogo->validate_add_cart_item() == TRUE){  
            echo "ALO CONH";
        // Check if user has javascript enabled  
//        if($this->input->post('ajax') != '1'){  
//            redirect('cart'); // If javascript is not enabled, reload the page with new data  
//        }else{  
//            echo 'true'; // If javascript is enabled, return true, so the cart gets updated  
//        }  
        
    }  

        
    }
    public function emptyCart(){
        
    }
    public function showCart(){
        
    }

}


?>