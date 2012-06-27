<?php
class Controller_producto extends CI_Controller{
    
    function producto($id){
        $this->load->helper('url');
        $this->load->library('cart');
        $this->load->model('model_catalogo');
        $this->load->model('model_producto');
        $this->load->library('session');
        $data['compra'] ="no";
        $comprado=$this->model_producto->get_compra($this->session->userdata('idUsuarios'),$id);
        if($comprado){
            $data['compra'] ="si";
            }
        else{
            $data['compra'] = "no";
            }
        $data['producto'] = $this->model_catalogo->get_producto($id);
        $data['cart_items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        $this->load->view('ficha_producto', $data);
        
    }
    function productoscomprados(){
        $this->load->helper('url');
        $this->load->model('model_catalogo');
        $this->load->model('model_producto');
        $this->load->library('session');
        $data['compra'] ="no";
        $comprados=$this->model_producto->get_compras($this->session->userdata('idUsuarios'));
        
        foreach($comprados->result() as $producto){
        $caracteristica=$this->model_catalogo->get_producto($producto->idProducto);
            foreach($caracteristica->result() as $row){
            $data["link"][]="<a href='".site_url("controller_descarga/bajar/")."/".$row->Codigo."'>".$row->Nombre."</a>";
        }
        
        }
        $this->load->view('view_misdescargas', $data);
        
    }
}
?>
