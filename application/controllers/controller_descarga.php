<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
    $this->load->helper('download');
    $path=base_url()."programas/".$codigo.".md";
    //$datos = file_get_contents($ruta); //Leer el contenido del archivo 
    $name = $codigo.'md';
    //$logrado=force_download($nombre, $datos);
    //echo $logrado;
    
     // make sure it's a file before doing anything!
  if(!is_file($path))
  {
    // required for IE
    if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

    // get the file mime type using the file extension
    $this->load->helper('file');

    /**
     * This uses a pre-built list of mime types compiled by Codeigniter found at
     * /system/application/config/mimes.php 
     * Codeigniter says this is prone to errors and should not be dependant upon
     * However it has worked for me so far. 
     * You can also add more mime types as needed.
     */
    $mime = get_mime_by_extension($path);

    // Build the headers to push out the file properly.
    
    readfile($path); // push it out
    exit();
    
    }}
    
}
?>
