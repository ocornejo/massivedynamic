<?php
class Model_login extends CI_Model{
    //Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
    function ValidarUsuario($usuario,$password){
        //La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        
        $query = $this->DB1->where('Username',$usuario);
        $query = $this->DB1->where('Password',$password);
        $query = $this->DB1->get('Usuarios');
        
        return $sql->result();
        
        //Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
        return $query->row();
    }
}
?>
 