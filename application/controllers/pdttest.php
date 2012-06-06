<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PdtTest extends CI_Controller {

    public function ppp() {
        $desc = //set to the order description to be appear on the PayPal website;
                //$orderno = //set to unique order number;
        $dolar= 508;        
        $nettotal = (int) 3000/$dolar; //set to productTotal + shipmentFee + tax;

//Save order information to database using the unique order number with status set as Pending...


        $url = "https://www.sandbox.paypal.com/cgi-bin/webscr"; //Test
//$url = "https://www.paypal.com/cgi-bin/webscr"; //Live
        $ppAcc = "oc77_1338396747_biz@gmail.com"; //PayPal account email
        $cancelURL = "http://www.yourmerchant.com/paypal_cancel.php";
        $returnURL = "http://massivedynamic.inf.utfsm.cl/index.php/pdttest/index";

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
                "<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif' name='submit' alt='Buy Now' />".
                "</form>\n" .
                "<script language='javascript'>document.frmPayPal.submit();'</script>\n'";

        echo($buffer);
    }

    public function index() {
        $ppAcc = "oc77_1338396747_biz@gmail.com";
        $at = "6dzmGdM2ss-OIeouBGzXLdtdzJfCkpRjdH92pDnxCxSZYHkkG9JDYgtqtGO"; //PDT Identity Token
        $url = "https://www.sandbox.paypal.com/cgi-bin/webscr"; //Test
//$url = "https://www.paypal.com/cgi-bin/webscr"; //Live
        $tx = $_REQUEST["tx"]; //this value is return by PayPal
        $cmd = "_notify-synch";
        $post = "tx=$tx&at=$at&amp;cmd=$cmd";

//Send request to PayPal server using CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $result = curl_exec($ch); //returned result is key-value pair string
        $error = curl_error($ch);

        if (curl_errno($ch) != 0) //CURL error
            exit("ERROR: Failed updating order. PayPal PDT service failed.");

        $longstr = str_replace("\r", "", $result);
        $lines = explode("\n", $longstr);
        //$lines = split("\n", $longstr);

//parse the result string and store information to array
        if ($lines[0] == "SUCCESS") {
//successful payment
            $ppInfo = array();
            for ($i = 1; $i < count($lines); $i++) {
                $parts = split("=", $lines[$i]);
                if (count($parts) == 2) {
                    $ppInfo[$parts[0]] = urldecode($parts[1]);
                }
            }

            $curtime = gmdate("d/m/Y H:i:s");
//capture the PayPal returned information as order remarks
            $oremarks =
                    "##$curtime##\n" .
                    "PayPal Transaction Information...\n" .
                    "Txn Id: " . $ppInfo["txn_id"] . "\n" .
                    "Txn Type: " . $ppInfo["txn_type"] . "\n" .
                    "Item Number: " . $ppInfo["item_number"] . "\n" .
                    "Payment Date: " . $ppInfo["payment_date"] . "\n" .
                    "Payment Type: " . $ppInfo["payment_type"] . "\n" .
                    "Payment Status: " . $ppInfo["payment_status"] . "\n" .
                    "Currency: " . $ppInfo["mc_currency"] . "\n" .
                    "Payment Gross: " . $ppInfo["payment_gross"] . "\n" .
                    "Payment Fee: " . $ppInfo["payment_fee"] . "\n" .
                    "Payer Email: " . $ppInfo["payer_email"] . "\n" .
                    "Payer Id: " . $ppInfo["payer_id"] . "\n" .
                    "Payer Name: " . $ppInfo["first_name"] . " " . $ppInfo["last_name"] . "\n" .
                    "Payer Status: " . $ppInfo["payer_status"] . "\n" .
                    "Country: " . $ppInfo["residence_country"] . "\n" .
                    "Business: " . $ppInfo["business"] . "\n" .
                    "Receiver Email: " . $ppInfo["receiver_email"] . "\n" .
                    "Receiver Id: " . $ppInfo["receiver_id"] . "\n";
            echo $oremarks;

//Update database using $orderno, set status to Paid
//Send confirmation email to buyer and notification email to merchant
//Redirect to thankyou page
        }

//Payment failed
        else {
//Delete order information
//Redirect to failed page
        }
    }

}

/* End of file pdttest.php */
/* Location: ./application/controllers/pdttest.php */
