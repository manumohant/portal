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
	public function getAppDetails()
	{
		$appId = $_GET["appId"];
		echo $this->MetaDataModel->getAppDetails($appId);
	}
	public function getSingle()
	{
		echo $this->MetaDataModel->getSingle($_GET["desc"],$_GET["module"],$_GET["appId"]);
	}
	public function deleteDoc()
	{
		echo $this->MetaDataModel->deleteSingle($_GET["desc"],$_GET["module"],$_GET["appId"]);
	}
	
}
