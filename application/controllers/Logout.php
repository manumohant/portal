<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
	}
	public function index()
	{
		$items = array('username' => '', 'role' => '','logged_in'=>FALSE);
		$this->session->unset_userdata($items);
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('/home');
	}
	
}
