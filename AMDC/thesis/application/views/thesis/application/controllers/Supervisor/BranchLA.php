<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchLA extends CI_Controller {

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
//		$data['branchLA']=$this->db_model->getLADepartments();
//		$this->load->view('Supervisor/php/branchLA', $data);		
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
			$data['branchLA']=$this->db_model->getLADepartments();
			if($_SESSION['logged_in'] == 'True')
			{
			$this->load->view('Supervisor/php/branchLA', $data);
			}
				else if ($_SESSION['logged_in'] != 'True') 
			{
				$this->load->view('Supervisor/lockscreen');
			}
		}
	}
	
	public function getLADepartment(){
		$this->load->view('Supervisor/php/departmentsLAFetch');
	}
	public function editLADepartment(){
		$this->load->view('Supervisor/php/departmentsEdit');
	}
    public function addUser(){
		$this->load->view('Supervisor/php/userAdd');
	}
}
