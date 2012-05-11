<?PHP
class Controller_login extends CI_Controller {
    
    function login()
    {
        $this->load->library('session');
        $this->load->helper('form');
        if($this->session->userdata('Username')!=null){
            $data['usuario']=$this->session->userdata('Username');
                    //Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje a presentar en pantalla
                    $this->load->view('Principal',$data); 
        }
        else{
        //Si no recibimos ningún valor proveniente del formulario, significa que el usuario recién ingresa:
        if(!isset ($_POST['username'])){
            //Por lo tanto le presentamos la pantalla del formulario de ingreso:        
            $this->load->view('view_login');        
        }
        else{//Si el usuario ya pasó por la pantalla inicial y presionó el botón "Ingresar"
            
            //Configuramos las validaciones ayudandonos con la librería form_validation del Framework Codeigniter       
            $this->form_validation->set_rules('passwordlogin','password','required');
            
            //Verificamos si el usuario superó la validación
            if(($this->form_validation->run()==FALSE)){
                //En caso que no, volvemos a presentar la pantalla de login
                $this->load->view('view_login');
            }
            else{//Si ambos campos fueron correctamente rellanados por el usuario,
                $this->load->model('model_login');
                
                //Comprobamos que el usuario exista en la base de datos y la password ingresada sea correcta
                $ExisteUsuarioyPassoword=$this->model_login->ValidarUsuario($_POST['username'],$_POST['passwordlogin']);
                
                //La variable $ExisteUsuarioyPassoword recibe valor TRUE si el usuario existe y FALSE en caso que no. Este valor lo determina el modelo.
                if($ExisteUsuarioyPassoword){
                    /*Si el usuario ingresó datos de acceso válido,
                      Muestro la vista principal de lo que sería mi aplicación,
                      enviándole como dato el usuario
                    */
                    $this->session->set_userdata('Username',$_POST['username']);
                    $data['usuario']=$_POST['username'];
                    //Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
                    $this->load->view('Principal',$data);  
                }
                else{//Si no logró validar
                    $data['error']="Usuario o password incorrecto, por favor vuelva a intentar";
                    //Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
                    $this->load->view('view_login',$data);
                }
            }
        }
    }
    
    
    }
    function logout()
    {
        $this->load->library('session');
        $this->session->destroy();
        $this->load->view('view_login');
    }
}
?>