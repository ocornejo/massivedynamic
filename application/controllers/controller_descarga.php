<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
    $this->load->helper('download');
    $ruta=base_url()."programas/".$codigo.".md";
    $datos = file_get_contents($ruta); //Leer el contenido del archivo 
    $nombre = $codigo.'md';
    force_download($nombre, $datos);
    }
}
?>
