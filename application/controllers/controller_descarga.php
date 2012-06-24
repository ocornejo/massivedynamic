<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
    
    $datos = "Gracias por comprar ".$codigo;
    $nombre = $codigo.'txt'; 
    force_download($nombre,$datos);
    $data["mensaje"]=$ruta;
    $this->load->view('view_comprado',$data); 
    }
}
?>
