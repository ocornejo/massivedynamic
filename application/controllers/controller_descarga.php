<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
        
     require_once('pageheader.class.php');

// instanciamos un objeto de la clase
$header = new PageHeader();

// Prevenir la cach�
$header->addDefaults();

//forzar la descarga de un archivo
$header->forceDownload( base_url()."programas/".$codigo.".md" );
//el navegador har� que salga la ventana de di�logo para descargar el archivo
//en vez de mostrarlo como si fuese un contenido, en la propia p�gina
/*
    $this->load->helper('download');
    $ruta=base_url()."programas/".$codigo.".md";
    echo $ruta;
    $datos = file_get_contents($ruta); //Leer el contenido del archivo 
    $nombre = $codigo.'md';
    force_download($nombre, $datos);
  */
 
    }
}
?>
