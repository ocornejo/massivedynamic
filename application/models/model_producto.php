<?php
class Model_Producto extends CI_Model{
    
    function get_compra($usuario,$producto){
        //La consulta se efect�a mediante Active Record. Una manera alternativa, y en lenguaje m�s sencillo, de generar las consultas Sql.
        $DB1=$this->load->database('default',TRUE);
        //$query = $DB1->where('idUsuarios',$usuario);
        $query = $DB1->where('idProducto',$producto);
        $query = $DB1->get('Compra');
        
        
        //Devolvemos al controlador la fila que coincide con la b�squeda. (FALSE en caso que no existir coincidencias)
        return $query->row();
    }
    
  
}

?>
