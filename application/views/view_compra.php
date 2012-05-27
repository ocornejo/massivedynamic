<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Nettuts.com | Purchase access to download area</title>
        <link rel="stylesheet" type="text/css" media="All"/>
    </head>
    <body>

        <div id="wrap">
            <h3>Purchase Access</h3>
            <p>Please click the button below to receive login details for the download area. <br />
    
                Already have an account?
       
                <?php 
                $this->load->helper('url');
                echo anchor('controller_paypal/login', 'Login', 'title="Login"');?>
            </p>

            <!-- Paste your PayPal button code here (That you will get in the next step) -->
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="8Y76UBA8P2QEY">
                <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
            </form>

        </div>

    </body>
</html>
