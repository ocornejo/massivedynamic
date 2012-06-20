<?php
class Controller_producto extends CI_Controller{
    
    function producto($id){
        $this->load->helper('url');
        $this->load->library('cart');
        $this->load->model('model_catalogo');
        $this->load->model('model_producto');
        $this->load->library('session');
        $data['compra'] ="null";
        $comprado=$this->model_producto->get_compra($this->session->userdata('idUsuario'),$id);
        if($comprado){
            $data['compra'] ="comprado";
            }
        else{
            $data['compra'] = "nocomprado";
            }
        $data['producto'] = $this->model_catalogo->get_producto($id);
        $data['cart_items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        $this->load->view('ficha_producto', $data);
        
    }
}
?>
