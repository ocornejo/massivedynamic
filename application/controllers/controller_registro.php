
<?PHP
class Controller_registro extends CI_Controller {
    
    function registrar()
    {
        $this->load->library('session');
        $this->load->helper('form');
        //Si no recibimos ningún valor proveniente del formulario, significa que el usuario recién ingresa:
        if(!isset ($_POST['username'])){
            //Por lo tanto le presentamos la pantalla del formulario de ingreso:        
            $this->load->view('view_registro');        
        }
        else{//Si el usuario ya pasó por la pantalla inicial y presionó el botón "Ingresar"
            
            //Configuramos las validaciones ayudandonos con la librería form_validation del Framework Codeigniter       
            $this->form_validation->set_rules('correo','Email','required');
            
            //Verificamos si el usuario superó la validación
            /*if(($this->form_validation->run()==FALSE)){
                //En caso que no, volvemos a presentar la pantalla de login
                $this->form_validation->set_message('correo', 'Correo no valido');
                $this->load->view('view_registro');
            }
            else{//Si los campos fueron correctamente rellanados por el usuario,
                $this->load->model('model_registro');
                
                //Vemos si el usuario existe en la base de datos 
                $ExisteUsuarioyPassoword=$this->model_registro->ValidarUsuario($_POST['username']);
                
                //La variable $ExisteUsuarioyPassoword recibe valor TRUE si el usuario existe y FALSE en caso que no. Este valor lo determina el modelo.
                if($ExisteUsuarioyPassoword){
                   
                    /*Si el usuario ingresó datos de acceso válido,
                      Muestro la vista principal de lo que sería mi aplicación,
                      enviándole como dato el usuario
                    */
                 //   $this->form_validation->set_message('username', 'Usuario ya existe');
                   // $this->load->view('view_registro');
                      
                }
                //else{//Si no existe
                     $this->model_registro->IngresarUsuario($_POST['username'],$_POST['passwordlogin'],$_POST['nombre'],$_POST['correo']);
                     $this->load->view('view_registrado');
                     $this->session->set_userdata('Username',$_POST['username']);
               // }
            }
        //}
    
    
    
    
}
?>
