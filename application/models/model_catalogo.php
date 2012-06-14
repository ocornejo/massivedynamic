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
        
    $DB2 = $this->load->database('default2', TRUE); 
    $id = $this->input->post('product_id'); // Assign posted product_id to $id
    
    //$cty = $this->input->post('quantity'); // Assign posted quantity to $cty  
  
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
}

?>
