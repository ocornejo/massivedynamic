<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
    $ruta=base_url()."/programas/".$codigo.".txt";
    $datos = file_get_contents($ruta); //Leer el contenido del archivo 
    $nombre = $codigo.'txt'; 
    force_download($nombre,$datos);
    $data[mensaje]=$ruta;
    $this->load->view('view_comprado',$data); 
    }
}
?>
