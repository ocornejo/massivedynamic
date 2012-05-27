
<?PHP
class Controller_registro extends CI_Controller {
    
    function registrar() //para registrar a un usuario
    {
        //cargar las librer�a de formulario y de session
        $this->load->library('session');
        $this->load->helper('form');
        //Si no recibimos ning�n valor proveniente del formulario, significa que el usuario reci�n ingresa:
        if(!isset ($_POST['username'])){
            //Por lo tanto le presentamos la pantalla del formulario de ingreso:        
            $this->load->view('view_registro');        
        }
        else{//Si el usuario ya pas� por la pantalla inicial y presion� el bot�n "Ingresar"
            
            //Configuramos las validaciones ayudandonos con la librer�a form_validation del Framework Codeigniter       
            $this->form_validation->set_rules('correo','Email','required');
            
            //Verificamos si el usuario super� la validaci�n
            if(($this->form_validation->run()==FALSE)){
                //En caso que no, volvemos a presentar la pantalla de registro
                $this->form_validation->set_message('correo', 'Correo no valido');
                $this->load->view('view_registro');
            }
            else{
                //Si los campos fueron correctamente rellanados por el usuario, cargamos el model
                $this->load->model('model_registro');
                
                //Vemos si el usuario ya existe en la base de datos 
                $ExisteUsuarioyPassoword=$this->model_registro->ValidarUsuario($_POST['username']);
                
                //La variable $ExisteUsuarioyPassoword recibe valor TRUE si el usuario existe y FALSE en caso que no. Este valor lo determina el modelo.
                if($ExisteUsuarioyPassoword){
                   
                    //Si el usuario ya exist�a vuelve a la p�gina de registro con mensaje de error
                    $this->form_validation->set_message('username', 'Usuario ya existe');
                    $this->load->view('view_registro');
                      
                }
                else{
                    ////Si no existe se ingresa en la base de datos, se crea la session y se manda a la pagina de registrado
                     $this->model_registro->IngresarUsuario($_POST['username'],$_POST['passwordlogin'],$_POST['nombre'],$_POST['correo']);
                     $this->session->set_userdata('Username',$_POST['username']);
                     $this->load->view('view_registrado');
                }
            }
        }
    }
}
?>
