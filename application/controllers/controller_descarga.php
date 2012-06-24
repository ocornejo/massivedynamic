<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
    $ruta=base_url()."/programas/".$codigo.".txt";
    $Datos = file_get_contents($ruta); //Leer el contenido del archivo 
    $nombre = 'MyPhoto.jpg'; 
    force_download($nombre,$Datos); 
    $this->load->view('view_catalogo',$data); 
    }
}
?>
