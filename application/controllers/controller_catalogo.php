<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
               
       $this->load->model('seleccionarusuarios'); // whatever you call it

    $data["resultado"]=  $this->modelcatalogo->get_productos();
    $this->load->library('session');
    if($this->session->userdata('Username')!=null){
            $data["log"]=$this->session->userdata('Username');
        }
        else{
            $data["log"]=null;
           
        }
    /* note - you don't need to have the extension when it's a php file */
    $this->load->view('view_catalogo',$data);
                
                
        
	}
}


    
   

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
    ?>