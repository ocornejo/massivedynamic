<?php
class Model_registro extends CI_Model{
    //Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
    function ValidarUsuario($usuario){
        //La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        $DB1=$this->load->database('default',TRUE);
        $query = $DB1->where('Username',$usuario);
        $query = $DB1->get('Usuarios');
        
        //Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
        return $query->row();
    }
    function IngresarUsuario($usuario,$password,$nombre,$correo){
        //La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        $DB1=$this->load->database('default',TRUE);
        $data = array('usuario' => $usuario, 'password' => $password, 'nombre' => $nombre,'correo' => $correo);
        $str = $DB1->insert_string('Usuarios', $data);
        $DB1->query($str);
        //Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
        return;
    }
}
?>
 