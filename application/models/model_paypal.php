<?php

class Model_paypal extends CI_Model {

    //Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
    function insertarPago($deformat) {
        //La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        $DB1 = $this->load->database('default', TRUE);
        $data = array('email' => $email);
        $str = $DB1->insert_string('Compra', $data);
        $DB1->query($str);
        //Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
        return;
    }
    
   

}

?>
 