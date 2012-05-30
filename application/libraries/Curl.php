<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * CodeIgniter Curl PHP Class
 *
 * @author	Jason Michels
 * @link	https://thebizztech@github.com/thebizztech/Simple-Codeigniter-Curl-PHP-Class.git
 */

class Curl {
	
	private $url = "";
	private $headers = array(); //Headers are built in set_headers() and passed in execute()
	private $post_data = "";
	private $fields_string = "";
	private $ci = "";

	public function __construct()
    {
    	$this->ci =& get_instance();
    }

	
	//setUrl() must be set by Codeigniter controller or models
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	public function buildPostString()
	{
		$this->fields_string = null;
		foreach($this->post_data as $key=>$value) { $this->fields_string .= $key.'='.$value.'&'; }
		$this->fields_string = rtrim($this->fields_string,"&");
		return $this;
	}

	//These are no longer necesary
	public function setString($string)
	{
		$this->fields_string = $string;
		return $this;
	}

	//These are no longer necesary
	public function setArray($array)
	{
		$this->post_data = $array;
		$this->buildPostString();
		return $this;
	}
	
	//Headers can be modified depending on what you need cURL to accomplish
	private function setHeaders($type = '')
	{
		$this->headers = array(
						CURLOPT_URL => $this->url,
						CURLOPT_VERBOSE => 1,
						CURLOPT_SSL_VERIFYPEER => FALSE,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_RETURNTRANSFER => TRUE
		);

		if($type == 'post')
		{
			$this->headers[CURLOPT_POST] = TRUE;
			$this->headers[CURLOPT_POSTFIELDS] = $this->fields_string;
		}
		return $this;
	}

	//Set the headers and process curl via a GET
	public function get()
	{
		return $this->setHeaders()->execute();
	}
	
	//Set the headers and process curl via a POST
	//Checks if an array and processes data
	public function post($data = null)
	{
		if(is_array($data))
		{
			$this->post_data = $data;
			$this->buildPostString();
		}
		else
		{
			$this->fields_string = $data;
		}

		return $this->setHeaders('post')->execute();
	}
	
	//Starts curl and sets headers and returns the data in a string
	private function execute()
	{
		$ch = curl_init();

		//log request
		if($this->ci->config->item('log_curl_request')){ log_message('DEBUG', "URL => ".$this->url." DATA => ".$this->fields_string);}
		
		curl_setopt_array($ch, $this->headers);

		// grab URL
		$result = curl_exec($ch);

		//log response
		if($this->ci->config->item('log_curl_response')){ log_message('DEBUG', "RESULT => ".$result);}
	
		curl_close($ch);
		return $result;
	}
}

/* End of file Curl.php */