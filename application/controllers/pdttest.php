<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PdtTest extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        $this->load->library('curl');
    }

	public function index()
	{
		$data['cmd'] = "_notify-synch";
		$data['tx'] = $this->input->get('tx');
		$data['at'] = "6dzmGdM2ss-OIeouBGzXLdtdzJfCkpRjdH92pDnxCxSZYHkkG9JDYgtqtGO";

		$result = $this->curl->setUrl("https://www.sandbox.paypal.com/cgi-bin/webscr")->post($data);
		$deformat = $this->deformat($result);

		if($deformat === false)
		{
			echo "There was an issue with your request, log data and research further.";
		}
		else
		{
			if($deformat['payment_status'] == "Completed")
			{
				echo "Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br>You may log into your account at <a href='https://www.paypal.com'>www.paypal.com</a> to view details of this transaction.";
			}
			else
			{
				echo "Payment might be echeck and still processing as it's not completed. I would suggest showing a thank you page but research this further.";
			}
		}

		echo "<ul>";
		foreach($deformat as $key => $value)
		{
			echo "<li>".$key." ===> ".$value."</li>";
		}
		echo "</ul>";

	}



	public function deformat($result)
	{
		$lines = explode("\n", $result);
		$keyarray = array();

		//Check to see if request was a success
		if (strcmp ($lines[0], "SUCCESS") == 0) 
		{
			for ($i=1; $i<count($lines);$i++)
			{
				list($key,$val) = explode("=", $lines[$i]);
				$keyarray[urldecode($key)] = urldecode($val);
			}
			return $keyarray;
		}
		else
		{
			//Their was an issue with the request so return false
			return false;
		}
	}

}
?>