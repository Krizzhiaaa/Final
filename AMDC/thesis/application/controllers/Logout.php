<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index(){
		$check = $this->session->userdata('username');
		if(empty($check)){
			header('Location: login');
		} else {
			$this->session->sess_destroy();
			header('Location: login');
		}
	}
}
