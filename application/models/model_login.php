<?php
class Model_login extends CI_Model{
    //Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
    function ValidarUsuario($usuario,$password){
        //La consulta se efect�a mediante Active Record. Una manera alternativa, y en lenguaje m�s sencillo, de generar las consultas Sql.
        $this->load->database("default");
        $query = $this->db->where('Username',$usuario);
        $query = $this->db->where('Password',$password);
        $query = $this->db->get('Usuarios');
        
        //Devolvemos al controlador la fila que coincide con la b�squeda. (FALSE en caso que no existir coincidencias)
        return $query->row();
    }
}
?>
 