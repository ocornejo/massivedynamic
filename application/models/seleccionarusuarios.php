<?php
class seleccionarusuarios extends CI_Model{
function get_usuarios()
{
     $this->load->database();
    $sql = $this->db->query('SELECT * from usuarios');
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
