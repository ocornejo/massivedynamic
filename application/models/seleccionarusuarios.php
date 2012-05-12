<?php
class seleccionarusuarios extends CI_Model{
function get_usuarios()
{
   $DB2=$this->load->database("default2", TRUE); 

   $query = $DB2->query('SELECT * FROM Productos');
    return $query;

}
}

?>
