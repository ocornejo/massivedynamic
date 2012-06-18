<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_Paypal extends CI_Controller {

    public function ppp() {
        $desc = "Compra en Massive Dynamic's Store";//set to the order description to be appear on the PayPal website;
        $orderno = 1; //set to unique order number;
        $json = file_get_contents('http://currencies.apps.grandtrunk.net/getlatest/usd/clp');
        $data = (int) json_decode($json, TRUE); //set to productTotal + shipmentFee + tax;
        $nettotal = (int) (5000 / $data);
//Save order information to database using the unique order number with status set as Pending...


        $url = "https://www.sandbox.paypal.com/cgi-bin/webscr"; //Test
        //$url = "https://www.paypal.com/cgi-bin/webscr"; //Live
        $ppAcc = "oc77_1338396747_biz@gmail.com"; //PayPal account email
        $cancelURL = "http://massivedynamic.inf.utfsm.cl";
        $returnURL = "http://massivedynamic.inf.utfsm.cl/index.php/controller_paypal/index";

        $buffer =
                "<form action='$url' method='post' name='frmPayPal'>\n" .
                "<input type='hidden' name='business' value='$ppAcc'>\n" .
                "<input type='hidden' name='cmd' value='_xclick'>\n" .
                "<input type='hidden' name='item_name' value='$desc'>\n" .
                "<input type='hidden' name='item_number' value='$orderno'>\n" .
                "<input type='hidden' name='amount' value='$nettotal'>\n" .
                "<input type='hidden' name='no_shipping' value='1'>\n" .
                "<input type='hidden' name='currency_code' value='USD'>\n" .
                "<input type='hidden' name='handling' value='0'>\n" .
                "<input type='hidden' name='cancel_return' value='$cancelURL'>\n" .
                "<input type='hidden' name='return' value='$returnURL'>\n" .
                "<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif' name='submit' alt='Pagar ahora' />" .
                "</form>\n" .
                "<script language='javascript'>document.frmPayPal.submit();'</script>\n'";

        echo($buffer);
        
        
    }

    public function index() {
        $this->load->library('curl');
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

    }

    public function deformat($result) {
        $lines = explode("\n", $result);
        $keyarray = array();

//Check to see if request was a success
        if (strcmp($lines[0], "SUCCESS") == 0) {
            for ($i = 1; $i < count($lines); $i++) {
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
