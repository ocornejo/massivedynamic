<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_Catalogo extends CI_Controller {


    function Controller_Catalago(){
        parent::__construct();
        
        $this->load->library('cart');
    }
    
    public function index() {

        $this->load->model('model_catalogo');
        $data["resultado"] = $this->model_catalogo->get_productos();
        $this->load->library('session');
        
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
       
        // Check if user has javascript enabled  
        if($this->input->post('ajax') != '1'){  
            redirect('controller_producto/producto'); // If javascript is not enabled, reload the page with new data  
        }else{  
            echo json_encode(array('retorno'=>1)); // If javascript is enabled, return true, so the cart gets updated 
            
        }  
        
    }  
    
        
    }
    public function updateCart(){
        $this->load->model('model_catalogo');
        $this->model_catalogo->validate_update_cart();
        echo "true2";
        redirect('ficha_producto');
    }
    public function emptyCart(){
        $this->load->library('cart');
        $this->cart->destroy(); // Destroy all cart data  
          // Refresh te page  
        
    }
    public function showCart(){
        $this->load->view('ficha_producto');  
    }
    
    
}


?>