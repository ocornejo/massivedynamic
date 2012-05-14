<?php
class Model_Catalogo extends CI_Model{
function get_productos()
{ $DB2 = $this->load->database('default2', TRUE); 
   $resultado = $DB2->query('Select * from Productos');
        
        return $resultado;
}
}

?>
