<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_Paypal extends CI_Controller {

    public function ppp() {
        $this->load->library('cart');
        $num = 1;
        $json = file_get_contents('http://currencies.apps.grandtrunk.net/getlatest/usd/clp');
        $data = (int) json_decode($json, TRUE); //set to productTotal + shipmentFee + tax;
        
        ?>

        <form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' name='frmPayPal'>
            <input type='hidden' name='cmd' value='_cart'>
            <input type='hidden' name='upload' value='1'> 
            <input type='hidden' name='business' value='oc77_1338396747_biz@gmail.com'>
            
            <?php foreach($this->cart->contents() as $items): ?>
                <input type='hidden' name='item_name_<?php echo $num;?>' value='<?php echo $items['name']; ?>'>
                <input type='hidden' name='item_number_<?php echo $num;?>' value='<?php echo $num ?>'>
                <input type='hidden' name='amount_<?php echo $num;?>' value='<?php echo (int)($items['price'] / $data) ?>'>
                <input type='hidden' name='quantity_<?php echo $num;?>' value='<?php echo $items['qty']; ?>'>
                <?php $num = $num + 1; 
            endforeach;?>
            
            <input type='hidden' name='currency_code' value='USD'>
            <input type='hidden' name='cancel_return' value='http://massivedynamic.inf.utfsm.cl'>
            <input type='hidden' name='return' value='http://massivedynamic.inf.utfsm.cl/index.php/controller_paypal/index'>
            <input type='image' src='https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif' name='submit' alt='Pagar ahora' />
        </form>
        <script language="JavaScript" type="text/javascript">
            window.onload=function() {
            window.document.frmPaypal.submit();
            }
        </script>
    
    <?php
    }

    public function index() {
        $this->load->library('curl');
        $this->load->library('cart');
        $this->cart->destroy();
        $data['cmd'] = "_notify-synch";
        $data['tx'] = $this->input->get('tx');
        $data['at'] = "6dzmGdM2ss-OIeouBGzXLdtdzJfCkpRjdH92pDnxCxSZYHkkG9JDYgtqtGO";

        $result = $this->curl->setUrl("https://www.sandbox.paypal.com/cgi-bin/webscr")->post($data);
        $deformat = $this->deformat($result);

        if ($deformat === false) {
            echo "There was an issue with your request, log data and research further.";
        } else {
            if ($deformat['payment_status'] == "Completed") {
                echo "Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br>You may log into your account at <a href='https://www.paypal.com'>www.paypal.com</a> to view details of this transaction.";
            } else {
                echo "Payment might be echeck and still processing as it's not completed. I would suggest showing a thank you page but research this further.";
            }
        }

        echo "<ul>";
        foreach ($deformat as $key => $value) {
            echo "<li>" . $key . " ===> " . $value . "</li>";
        }
        echo "</ul>";
        $this->model_paypal->ingresaPago($deformat);
        $num=0;
        $data["link"]=array();
        while($deformat["item_name".$num]!=null){
          $this->model_compra->IngresarCompra($this->session->userdata('idUsuarios'),$deformat["item_number".$num],0);
          $data["link"][]="<a href='".site_url("controller_descarga/bajar/")."/".$deformat["item_number".$num]."'>Descargar ".$deformat["item_name".$num]."</a>";
          $num=$num+1;       
          }
       $this->load->view('view_comprado',$data);
    }

    public function deformat($result) {
        $lines = explode("\n", $result);
        $keyarray = array();

//Check to see if request was a success
        if (strcmp($lines[0], "SUCCESS") == 0) {
            for ($i = 0; $i < count($lines); $i++) {
                list($key, $val) = explode("=", $lines[$i]);
                $keyarray[urldecode($key)] = urldecode($val);
            }
            return $keyarray;
        } else {
//Their was an issue with the request so return false
            return false;
        }
    }

}

/* End of file pdttest.php */
/* Location: ./application/controllers/pdttest.php */
