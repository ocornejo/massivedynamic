<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
    $this->load->helper('download');
    $ruta=base_url()."programas/".$codigo.".md";
    echo $ruta;
    $datos = file_get_contents($ruta); //Leer el contenido del archivo 
    $nombre = $codigo.'md';
    echo "hola";
    $logrado=force_download($nombre, $datos);
    echo "chao";
    echo $logrado;
    }
}
?>
