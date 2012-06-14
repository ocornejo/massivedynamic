<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_Catalogo extends CI_Controller {


    function Controller_Catalago(){
        parent::__construct();
        $this->load->model('model_catalogo');
        $this->load->library('cart');
    }
    
    public function index() {

        $this->load->model('model_catalogo');
        $data["resultado"] = $this->model_catalogo->get_productos();
        $this->load->library('session');
        
        if ($this->session->userdata('Username') != null) {
            $data["log"] = $this->session->userdata('Username');
        } else {
            $data["log"] = null;
        }
        /* note - you don't need to have the extension when it's a php file */
        $this->load->view('view_catalogo', $data);
    }
    
    public function addToCart(){
        $this->load->model('model_catalogo');
        
        if($this->model_catalogo->validate_add_cart_item() == TRUE){  
       
        // Check if user has javascript enabled  
        if($this->input->post('ajax') != '1'){  
            redirect('controller_catalogo'); // If javascript is not enabled, reload the page with new data  
        }else{  
            echo 'true'; // If javascript is enabled, return true, so the cart gets updated  
        }  
        

        
    }  

        
    }
    public function updateCart(){
        
    }
    public function emptyCart(){
        
    }
    public function showCart(){
        
    }
    
    public function view(){
        echo "<div id='wrap'>";

            echo "<div class='cart_list'>";
                echo "<h3>Your shopping cart</h3>";
                echo "<div id='cart_content'>";
                    
                    if (!$this->cart->contents()):
                        echo 'You don\'t have any items yet.';
                    else:
                        

                    echo form_open('cart/updateCart'); 
                        echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                            echo "<thead>";
                              echo "<tr>";
                                    echo "<td>Item Description</td>";
                                    echo "<td>Qty</td>";
                                    echo " <td>Item Price</td>";
                                    echo "<td>Sub-Total</td>";
                              echo "  </tr>";
                          echo "  </thead>";
                         echo "   <tbody>";
                                $i = 1; 
                                foreach ($this->cart->contents() as $items): 

                                    echo form_hidden('rowid[]', $items['rowid']); 
                                            echo "<tr"; if ($i & 1) {
                                        echo 'class="alt"';
                     } echo ">";
                                        echo "<td>";
                         echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); 
                                        echo "</td>";

                                        echo "<td>";
                                        echo $items['name'];
                                        echo "</td>";

                                        echo "<td>&euro;";
                                        echo $this->cart->format_number($items['price']);
                                        echo "</td>";
                                        echo "<td>&euro;";
                                        echo $this->cart->format_number($items['subtotal']);
                                        echo "</td>";
                                    echo "</tr>";

                        $i++;
                        endforeach;

                               echo " <tr>";
                                  echo "  <td</td>";
                                    echo "<td></td>";
                                    echo "<td><strong>Total</strong></td>";
                                    echo "<td>&euro;";
                                    echo $this->cart->format_number($this->cart->total());
                                    echo "</td>";
                               echo " </tr>";
                           echo " </tbody>";
                       echo " </table>";

                        echo "<p>";
                       echo form_submit('', 'Update your Cart');
                            echo anchor('cart/emptyCart', 'Empty Cart', 'class="empty"');
                            echo "</p>";
                        echo "<p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>";
                      
                         echo form_close();
                        endif;


               echo " </div>";
           echo " </div>";
        echo "</div>";

    }

}


?>