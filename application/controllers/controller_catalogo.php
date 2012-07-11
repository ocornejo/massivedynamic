<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_Catalogo extends CI_Controller {


    function Controller_Catalago(){
        parent::__construct();
        
        $this->load->library('cart');
    }
    
    public function index() {
        $this->load->library('pagination');
        $this->load->model('model_catalogo');
        
        $config['base_url'] = site_url('controller_catalogo/index/');
        $config['total_rows'] = $this->model_catalogo->get_productos_cantidad();
        $config['per_page'] = '3';
        $config['num_links'] = '2'; //Número de enlaces antes y después de la página actual
        $config['first_link'] = '&lt;&lt;'; //Texto del enlace que nos lleva a la página
        $config['last_link'] = '&gt;&gt;'; //Texto del enlace que nos lleva a la última página
        
        $this->pagination->initialize($config);
        $data["resultado"] = $this->model_catalogo->get_productos($config['per_page'],$this->uri->segment(3));
        
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
            //redirect('controller_producto/producto/');
            echo json_encode(array('retorno'=>0));// If javascript is not enabled, reload the page with new data  
        }else{  
            echo json_encode(array('retorno'=>1)); // If javascript is enabled, return true, so the cart gets updated   
        }
        $this->load->view('view_carrito');
    }  
    
        
    }
    public function updateCart(){
//
        $this->load->library('cart');
        if($_POST){  
  
        $data = $_POST; //for the sake of this example we are going to use the $_POST variable directly  
  
        }
        $this->cart->update($data);
        redirect($this->input->post('url'));
        
    }
    public function emptyCart(){
        $this->load->library('cart');
        $this->cart->destroy(); // Destroy all cart data  
          // Refresh te page  
        
    }
    public function showCart(){
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('cart');
        $this->load->view('view_carrito');
        //redirect('controller_producto/producto/'+);
    }
    
    
}


?>