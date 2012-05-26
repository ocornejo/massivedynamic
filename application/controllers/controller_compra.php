<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_compra extends CI_Controller {
	public function comprado()
	{
		//hacer insert a la tabla compras
   
    $this->load->view('view_comprado');
                
                
        
	}
        public function nocomprado()
	{
	
   
    $this->load->view('view_nocomprado');
                
                
        
	}
}


    
   

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
    ?>