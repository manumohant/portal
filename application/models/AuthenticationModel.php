<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

 class AuthenticationModel extends CI_Model
 {
 	
 	public function __construct()
	{
 		parent::__construct();
 		
 		 $this->load->library('mongo_db');
 	}


 	public function verifyLogin($un,$pw)
 	{
 		
 		$where=array( '$and' => array( array('username' =>$un), array('password'=>$pw) ) );
       	return $this->mongo_db->db->authDoc->findOne($where);  

 	}
 }
