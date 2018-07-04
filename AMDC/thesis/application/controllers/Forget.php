<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function _construct(){
		parent::_construct();
		$this->load->library('session');
	}

	public function index(){
		$checkuser = $this->session->userdata('username');
		if(empty($checkuser)){
			$this->load->view('login_view');
		}else{
			$ty = $this->session->userdata('type');
			$st = $this->session->userdata('stts');

			if($ty == 'BusinessManager' && $st == 'Active'){
				// echo "<pre>";
				// print_r ( $this->session->all_userdata());
				// echo "</pre>";
				// $exit = $this->session->mark_as_temp(array('username', 'password'), 300);
					//$this->session->sess_destroy();

			$this->load->view('BusinessManager/forget');
			}else if($ty == 'Assistant' && $st == 'Active'){
			$this->load->view('BusinessManager/forget');
			}else if($ty == 'Supervisor' && $st == 'Active'){
			$this->load->view('BusinessManager/forget');
			}else{
				$this->load->view('login_view');
			}
		}
		 
	}


	public function forgetPass()
  	{
     	$uname = $this->input->post('uname');
		$this->load->model('dbforget_model');
		$this->dbforget_model->logdata($uname);

  	}
  	public function editPass(){
		$this->load->view('BusinessManager/forget');
	}

	
}
