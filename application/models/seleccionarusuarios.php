<?php
class seleccionarusuarios extends CI_Model{
function get_usuarios()
{
   // $this->db_productos = $this->CI->load->database("default2", TRUE);
    $sql = $DB2->query('SELECT * from Productos');
    return $sql->result();
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
