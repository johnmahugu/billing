<?php

class Gateway extends Controller {

	function gateway()
	{
		parent::Controller();	
	}
	
	function index()
	{
		// grab the request
		$request = $this->input->post('request');
		
		// Log the request
		$this->log_model->LogRequest($request);
		
		// find out if the request is valid XML
		$xml = simplexml_load_string($request);
		
		// if it is not valid XML...
		if(!$xml) {
			die($this->response->Error(1000));
		}
		
		// get the api ID and secret key
		$api_id = (string)$xml->authentication->api_id;
		$secret_key = (string)$xml->authentication->secret_key;
		
		// authenticate the api ID
		$this->load->model('authentication_model', 'auth');
		
		$client = $this->auth->Authenticate($api_id, $secret_key);
		$client_id = $client->client_id;
		
		if(!$client_id) {
			die($this->response->Error(1001));
		}	
		
		// Get the request type
		$request_type = (string)$xml->type;
		
		// Make sure the first letter is capitalized
		$request_type = ucfirst($request_type);
		
		// validate the request type
		$this->load->model('request_type_model', 'request_type');
		$request_type_model = $this->request_type->ValidateRequestType($request_type);
		
		if(!$request_type_model) {
			die($this->response->Error(1002));
		}
		
		foreach($xml as $key => $value)
		{
			$params[(string)$key] = (string)$value;
		}
		
		// Load the correct model and method
		$this->load->model($request_type_model);
		$response = $this->$request_type_model->$request_type($client_id, $params, $xml);
		
		// Echo the response
		echo $this->response->FormatResponse($response, (string)$xml->format);		
	}
}

/* End of file gateway.php */
/* Location: ./system/application/controllers/gateway.php */