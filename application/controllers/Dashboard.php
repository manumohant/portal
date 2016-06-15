<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() 
	{
		
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
		{
			redirect("home");
		}	
		$this->load->model('MetaDataModel');
	}
	public function index()
	{

	    
		$this->load->view('header/header');
		$this->load->view('content/mainview');
		$this->load->view('footer/footer');
	}
	public function dashboardview()
	{

		$this->load->view('content/dashboard');
	}
	public function metadataview()
	{
		$result["metadata"] = $this->MetaDataModel->getAllMetaData();
		$this->load->view('content/metadata',$result);
	}
	public function newMetaData()
	{
		$result["metadata"] = $this->MetaDataModel->getAllMetaData();
		$this->load->view('content/newmetadata',$result);
	}
	public function viewMetaData()
	{
		$this->load->view('content/viewmetadata');
	}
}
