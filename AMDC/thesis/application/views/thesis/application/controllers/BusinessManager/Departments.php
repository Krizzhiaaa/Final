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
	public function index(){
		$check = $this->session->userdata('type');
		if($check == 'BusinessManager'){
			$_SESSION['logged_in'] = 'True';
			echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
			$this->load->model('db_model');
			$data['departments']=$this->db_model->getDepartments();
			//$this->load->view('BusinessManager/departments', $data);
			if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			//$this->load->view('BusinessManager/dashboard');
           			$this->load->view('BusinessManager/departments', $data);
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "BusinessManager/lockscreen";
           			$this->load->view('BusinessManager/lockscreen');
      			}

		}
		
		//$check = $this->session->userdata('stts');
		//if($check == 'BusinessManager'){
		//	$this->load->view('BusinessManager/departments');
		//}else if($check == 'Assistant'){
		//	$this->load->view('Assistant/departments');
		//}else if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/departments');
		//}else{
	//		header('Location: ../login');
	//	}
		
	}
	public function getDepartment(){
		$this->load->view('BusinessManager/php/departmentsFetch');
	}
	public function getChange(){
		$this->load->view('BusinessManager/php/departmentsChange');
	}
	public function addDepartment(){
		$this->load->view('BusinessManager/php/departmentsAdd');
	}
	public function editDepartment(){
		$this->load->view('BusinessManager/php/departmentsEdit');
	}
	public function deleteDepartments(){
		$this->load->view('BusinessManager/php/departmentsDelete');
	}
    public function addUser(){
		$this->load->view('BusinessManager/php/userAdd2');
	}

}
