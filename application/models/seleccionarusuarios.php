<?php
class seleccionarusuarios extends CI_Model{
function get_usuarios()
{
   $DB1 = $this->load->database('default', TRUE); 

   $query = $DB1->query('SELECT * FROM Productos');
    return $query;
    /* you simply return the results as an object
     * also note you can use the ActiveRecord class for this...might make it easier
     */
}
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
