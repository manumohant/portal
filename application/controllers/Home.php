<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		if ( $this->session->userdata('logged_in'))
		{
			redirect("dashboard");
		}
		$this->load->model('AuthenticationModel');
		
	}
	public function index()
	{
		$this->load->view('header/header');
		$this->load->view('content/signin');
		$this->load->view('footer/footer');
	}
	public function validate()
	{
	    
		$un=$_POST["Username"];
		$pw=$_POST["Password"];
		$result = $this->AuthenticationModel->verifyLogin($un,$pw);
	    
		if(count($result))
		{
			$newdata = array(
					   'username'  => $un,
					   'role'     => '',
					   'logged_in' => TRUE
				   );

			$this->session->set_userdata($newdata);
		    redirect('/dashboard', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('status', 'Invalid Credentials');
			redirect('/home', 'location');
		}
        
	}
	public function logout()
	{
	exit();
		$items = array('username' => '', 'role' => '','logged_in'=>FALSE);
		$this->session->unset_userdata($items);
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('/home');
	}
}
