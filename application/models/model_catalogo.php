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
}

?>
