<?php
class Model_registro extends CI_Model{
    //Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el user
    function ValidarUsuario($usuario){
        //La consulta se efect�a mediante Active Record. Una manera alternativa, y en lenguaje m�s sencillo, de generar las consultas Sql.
        $DB1=$this->load->database('default',TRUE);
        $query = $DB1->where('Username',$usuario);
        $query = $DB1->get('Usuarios');
        
        //Devolvemos al controlador la fila que coincide con la b�squeda. (FALSE en caso que no existir coincidencias)
        return $query->row();
    }
    
    //Ingresar� al usuario
    function IngresarUsuario($usuario,$password,$nombre,$correo){
        //La consulta se efect�a mediante Active Record. Una manera alternativa, y en lenguaje m�s sencillo, de generar las consultas Sql.
        $DB1=$this->load->database('default',TRUE);
        $data = array('Username' => $usuario, 'Password' => md5($password), 'Nombre' => $nombre,'Email' => $correo);
        $str = $DB1->insert_string('Usuarios', $data);
        $DB1->query($str);
        return;
    }
}
?>
 