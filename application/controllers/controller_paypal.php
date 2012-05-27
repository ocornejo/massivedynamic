

<?php
//Hecho en base a http://es.paperblog.com/paypal-nvp-api-con-codeigniter-278257/
//variables en https://cms.paypal.com/us/cgi-bin/?&cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_SetExpressCheckout


define('PAYPAL_URL', 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=');

class Controller_Paypal extends CI_Controller {

    function ipn() {

        $this->load->model('model_paypal');

// read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
// post back to PayPal system to validate
        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

        $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);

        if (!$fp) {
// HTTP ERROR
        } else {
            fputs($fp, $header . $req);
            while (!feof($fp)) {
                $res = fgets($fp, 1024);
                if (strcmp($res, "VERIFIED") == 0) {

// PAYMENT VALIDATED & VERIFIED!
                    $email = $_POST['payer_email'];
                    $password = mt_rand(1000, 9999);
                    $this->model_paypal->insertUser($password, $email);

                    $to = $email;
                    $subject = 'Download Area | Login Credentials';
                    $message = '

Thank you for your purchase

Your account information
-------------------------
Email: ' . $email . '
Password: ' . $password . '
-------------------------

You can now login at http://yourdomain.com/PayPal/';
                    $headers = 'From:noreply@yourdomain.com' . "\r\n";

                    mail($to, $subject, $message, $headers);
                } else if (strcmp($res, "INVALID") == 0) {

// PAYMENT INVALID & INVESTIGATE MANUALY!
                    $to = 'invalid@yourdomain.com';
                    $subject = 'Download Area | Invalid Payment';
                    $message = '

Dear Administrator,

A payment has been made but is flagged as INVALID.
Please verify the payment manualy and contact the buyer.

Buyer Email: ' . $email . '
';
                    $headers = 'From:noreply@yourdomain.com' . "\r\n";

                    mail($to, $subject, $message, $headers);
                }
            }
            fclose($fp);
        }
    }

    function pagar() {
        $this->load->view('view_compra');
    }

    function login() {


        $this->load->model('model_paypal');

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = mysql_escape_string($_POST['email']);
            $password = md5($_POST['password']);
            
            $data["resultado"] = $this->model_paypal->getUser($email,$password);
            $data["isSet"]=TRUE;
            
            $verify = mysql_num_rows($data["resultado"]);
            $data["verify"]= $verify;
            
                    
            $this->load->view('view_loginPaypal',$data);
        } else {
            
            $data["isSet"] = FALSE;
            
            $this->load->view('view_loginPaypal',$data);
            
                      
        }
        


    }

}
?>
