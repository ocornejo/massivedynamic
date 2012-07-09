<?php

class Controller_descarga extends CI_Controller {

    function bajar($codigo) {
        $this->load->model('model_producto');
        $this->load->library('session');

        // open the current directory
        $dhandle = opendir('/opt/programas/');
        $dir= "/opt/programas/";
// define an array to hold the files
        $files = array();
        $fname= $codigo+".md";
        if ($dhandle) {
            // loop through all of the files
            while (false !== ($fname = readdir($dhandle))) {
                // if the file is not this file, and does not start with a '.' or '..',
                // then store it for later display
                if (($fname != '.') && ($fname != '..') &&
                        ($fname != basename($_SERVER['PHP_SELF']))) {
                    // store the filename
                    $files[] = (is_dir("./$fname")) ? "(Dir) {$fname}" : $fname;
                }
            }
            // close the directory
            closedir($dhandle);
        }

        echo "<select name=\"file\">\n";
// Now loop through the files, echoing out a new select option for each one
        foreach ($files as $fname) {
            echo "<option>{$fname}</option>\n";
        }
        echo "</select>\n";

        $comprado = $this->model_producto->get_compra($this->session->userdata('idUsuarios'), $codigo);
        if ($comprado) {
            $this->load->helper('download');
            //$path = base_url() . "programas/" . $codigo . ".md";
            $path = $dir.$fname;
            echo "HOLA"+$path;
            $name = $codigo . 'md';

            if (ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'Off');
            }


            $this->load->helper('file');


            $mime = get_mime_by_extension($path);

            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="' . basename($name) . '"');  // Add the file name
            header('Content-Transfer-Encoding: binary');
            header('Connection: close');
            readfile($path); // push it out
        } else {
            $this->load->view('view_descargado');
        }
    }

}

?>
