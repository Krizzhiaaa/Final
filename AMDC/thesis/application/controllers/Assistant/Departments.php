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
		if($check == 'Assistant'){
			$_SESSION['logged_in'] = 'True';
			echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
			$this->load->model('db_model');
			$data['departments']=$this->db_model->getDepartments();
			//$this->load->view('Assistant/departments', $data);
			if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			//$this->load->view('Assistant/dashboard');
           			$this->load->view('Assistant/departments', $data);
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "Assistant/lockscreen";
           			$this->load->view('Assistant/lockscreen');
      			}

		}
		
		//$check = $this->session->userdata('stts');
		//if($check == 'Assistant'){
		//	$this->load->view('Assistant/departments');
		//}else if($check == 'Assistant'){
		//	$this->load->view('Assistant/departments');
		//}else if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/departments');
		//}else{
	//		header('Location: ../login');
	//	}
		
	}
	public function getDepartment(){
		$this->load->view('Assistant/php/departmentsFetch');
	}
	public function getChange(){
		$this->load->view('Assistant/php/departmentsChange');
	}
	public function addDepartment(){
		$this->load->view('Assistant/php/departmentsAdd');
	}
	public function editDepartment(){
		$this->load->view('Assistant/php/departmentsEdit');
	}
	public function deleteDepartments(){
		$this->load->view('Assistant/php/departmentsDelete');
	}
    public function addUser(){
		$this->load->view('Assistant/php/userAdd2');
	}

}
