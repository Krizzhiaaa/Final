<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchBaguio extends CI_Controller {

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
//	public function index()
//	{
//		$this->load->model('db_model');
//		$data['branchBaguio']=$this->db_model->getBaguioDepartments();
//		$this->load->view('Supervisor/php/branchBaguio', $data);
//	}
	
	public function index()
	{
		$check = $this->session->userdata('type');
		if($check == 'Supervisor'){
			$_SESSION['logged_in'] = 'True';
			echo "<pre class='hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
			$this->load->model('db_model');
			$data['branchBaguio']=$this->db_model->getBaguioDepartments();
			if($_SESSION['logged_in'] == 'True')
			{
			$this->load->view('Supervisor/php/branchBaguio', $data);
			}
				else if ($_SESSION['logged_in'] != 'True') 
			{
				$this->load->view('Supervisor/lockscreen');
			}
		}
	}
	
	public function getBaguioDepartment(){
		$this->load->view('Supervisor/php/departmentsBaguioFetch');
	}
	public function editBaguioDepartment(){
		$this->load->view('Supervisor/php/departmentsEdit');
	}
    public function addUser(){
		$this->load->view('Supervisor/php/userAdd');
	}
}
