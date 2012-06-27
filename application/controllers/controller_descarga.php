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
    header('Pragma: public');     // required
    header('Expires: 0');         // no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
    header('Cache-Control: private',false);
    header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
    header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: '.filesize($path)); // provide file size
    header('Connection: close');
    readfile($path); // push it out
    exit();
    
    }}
    
}
?>
