<?php
class Controller_descarga extends CI_Controller {
    
    function bajar($codigo)
    {
    $this->load->model('model_producto');
    $comprado=$this->model_producto->get_compra($this->session->userdata('idUsuarios'),$id);
    if($comprado){
    $this->load->helper('download');
    $path=base_url()."programas/".$codigo.".md";
    $name = $codigo.'md';
   
    if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

    
    $this->load->helper('file');

   
    $mime = get_mime_by_extension($path);

    // Build the headers to push out the file properly.
    header('Pragma: public');     // required
    header('Expires: 0');         // no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private',false);
    header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
    header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
    header('Content-Transfer-Encoding: binary');
    header('Connection: close');
    readfile($path); // push it out
    $this->load->view('view_descargado');
    exit();}
    else{
        $this->load->view('view_descargado');
    }
    
    }
    
}
?>
