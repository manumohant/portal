<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct() 
	{
		
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
		{
			echo "auth error";
		}	
		$this->load->model('MetaDataModel');
	}
	public function upsertMetadata()
	{
		header('Access-Control-Allow-Origin: *');
		$postdata = json_decode(file_get_contents("php://input"), true);
		echo $this->MetaDataModel->upsert($postdata);
	}
	
}
