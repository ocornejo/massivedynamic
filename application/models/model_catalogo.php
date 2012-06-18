<?php
class Model_Catalogo extends CI_Model{
    
    function get_productos(){
        $DB2 = $this->load->database('default2', TRUE); 
        $resultado = $DB2->query('SELECT * FROM Productos');
        return $resultado;
    }
    
    function get_producto($id){
        $DB2 = $this->load->database('default2', TRUE); 
        $query = $DB2->query('SELECT * FROM Productos WHERE Codigo='.$id);
        return $query;
    }
    
    function validate_add_cart_item(){  
        
    $this->load->library("cart");    
        
    $DB2 = $this->load->database('default2', TRUE); 
    $id = $this->input->post('product_id'); // Assign posted product_id to $id
    
    $cty = $this->input->post('cantidad'); // Assign posted quantity to $cty  
  
    $DB2->where('Codigo', $id); // Select where id matches the posted id  
    $query = $DB2->get('Productos', 1); // Select the products where a match is found and limit the query by 1  
  
    // Check if a row has matched our product id  
    if($query->num_rows > 0){  
          
    // We have a match!  
        foreach ($query->result() as $row)  
        {  
            // Create an array with product information
            
            $data = array(  
                    'id'      => $id,
                    'qty'     => $cty,
                    'price'   => $row->Precio,  
                    'name'    => $row->Nombre  
            );  
            // Add the data to the cart using the insert function that is available because we loaded the cart library  
            $this->cart->insert($data);   
  
            return TRUE; // Finally return TRUE  
        }  
  
    }else{  
        // Nothing found! Return FALSE!  
        return FALSE;  
    }  
  }
  
  function validate_update_cart(){  
  $this->load->library("cart");
    // Get the total number of items in cart  
    $total = $this->cart->total_items();  
  
    // Retrieve the posted information  
    $item = $this->input->post('rowid');  
    $qty = $this->input->post('qty');  
  
    // Cycle true all items and update them  
    for($i=0;$i < $total;$i++)  
    {  
        // Create an array with the products rowid's and quantities.  
        $data = array(  
              'rowid' => $item[$i], 
              'qty'   => $qty[$i]  
           );  
  
           // Update the cart with the new information  
        $this->cart->update($data);  
    }  
  
}  
}

?>
