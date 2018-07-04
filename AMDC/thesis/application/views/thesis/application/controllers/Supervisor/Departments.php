<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

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
	public function index()
	{
		$check = $this->session->userdata('type');
		if($check == 'Supervisor'){
			$_SESSION['logged_in'] = 'True';
			echo "<pre class='hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
			$this->load->model('db_model');
			$data['departments']=$this->db_model->getDepartments();
			if($_SESSION['logged_in'] == 'True')
			{
			$this->load->view('Supervisor/departments', $data);
			}
				else if ($_SESSION['logged_in'] != 'True') 
			{
				$this->load->view('Supervisor/lockscreen');
			}
		}
	}
	public function getDepartment(){
		$this->load->view('Supervisor/php/departmentsFetch');
	}
	public function addDepartment(){
		$this->load->view('Supervisor/php/departmentsAdd');
	}
	public function editDepartment(){
		$this->load->view('Supervisor/php/departmentsEdit');
	}
	public function deleteDepartments(){
		$this->load->view('Supervisor/php/departmentsDelete');
	}
    public function addUser(){
		$this->load->view('Supervisor/php/userAdd');
	}

}
