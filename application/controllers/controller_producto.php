<?php
class Controller_producto extends CI_Controller{
    
    function producto($id){
        $this->load->helper('url');
        $this->load->library('cart');
        $this->load->model('model_catalogo');
        $data['producto'] = $this->model_catalogo->get_producto($id);
        $data['cart_items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        $this->load->view('ficha_producto', $data);
        
    }
}
?>
