<?php

class Model_paypal extends CI_Model {

    //Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
    function insertUser($email, $password) {
        //La consulta se efect�a mediante Active Record. Una manera alternativa, y en lenguaje m�s sencillo, de generar las consultas Sql.
        $DB1 = $this->load->database('default', TRUE);
        $data = array('password' => md5($password), 'email' => $email);
        $str = $DB1->insert_string('users', $data);
        $DB1->query($str);
        //Devolvemos al controlador la fila que coincide con la b�squeda. (FALSE en caso que no existir coincidencias)
        return;
    }
    
    function getUser($email,$password){
        $DB1 = $this->load->database('default',TRUE);
        
        $query = $DB1->where('email',$email);
        $query = $DB1->where('password',$password);
        $query = $DB1->get('users');
        
        //Devolvemos al controlador la fila que coincide con la b�squeda. (FALSE en caso que no existir coincidencias)
        return $query->row();
    }

}

?>
 