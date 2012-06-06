<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pp extends CI_Controller {

    public function ppp(){
        $this->load->view("view_compra");
        echo "HOLA";
    }
    public function index() {

    }

}

?>