<?PHP
class Controller_login extends CI_Controller {
    
    function login()
    {
        $this->load->library('session');
        $this->load->helper('form');
        if($this->session->userdata('Username')!=null){
            $data['log']=$this->session->userdata('Username');
            $this->cargarcatalogo(); 
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
                    $this->session->set_userdata('idUsuarios',$ExisteUsuarioyPassoword->idUsuario);
                    $data['log']=$this->session->userdata('Username');
                    $this->cargarcatalogo(); 
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
        $this->session->sess_destroy();//destruye la session y va a la vista de login
        $this->session->sess_destroy();
        $this->cargarcatalogo();
    }
    function cargarcatalogo() {
        $this->load->library('pagination');
        $this->load->model('model_catalogo');
        
        $config['base_url'] = site_url('controller_catalogo/index/');
        $config['total_rows'] = $this->model_catalogo->get_productos_cantidad();
        $config['per_page'] = '3';
        $config['num_links'] = '2'; //Número de enlaces antes y después de la página actual
        $config['first_link'] = '&lt;&lt;'; //Texto del enlace que nos lleva a la página
        $config['last_link'] = '&gt;&gt;'; //Texto del enlace que nos lleva a la última página
        
        $this->pagination->initialize($config);
        $data["resultado"] = $this->model_catalogo->get_productos($config['per_page'],$this->uri->segment(3));
        
        $this->load->library('session');
        if ($this->session->userdata('Username') != null) {
            $data["log"] = $this->session->userdata('Username');
        } else {
            $data["log"] = null;
        }
        /* note - you don't need to have the extension when it's a php file */
        $this->load->view('view_catalogo', $data);
    }
}
?>