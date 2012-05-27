<?php
class Model_login extends CI_Model{
    //Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
    function ValidarUsuario($usuario,$password){
        //La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        $DB1=$this->load->database('default',TRUE);
        $query = $DB1->where('Username',$usuario);
        $query = $DB1->where('Password',md5($password));
        $query = $DB1->get('Usuarios');
        
        //Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
        return $query->row();
    }
}
?>
 