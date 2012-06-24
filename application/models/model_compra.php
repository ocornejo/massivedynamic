<?php
class Model_Compra extends CI_Model{

        //Ingresará al usuario
    function IngresarCompra($usuario,$producto,$pago){ 
        
        //La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        $DB1=$this->load->database('default',TRUE);
        //se setea el producto comprado, el usuario que lo compra, como lo paga (0 para paypal y 1 para facebook) y la fecha
        $data = array('idProducto' => $producto,'idUsuaios' => $usuario,'idMedioPago' => $pago, 'Fecha'=>date("Y-m-d"));
        $str = $DB1->insert_string('Compra', $data);
        $DB1->query($str);
        return ;
        
    }
}
?>
 