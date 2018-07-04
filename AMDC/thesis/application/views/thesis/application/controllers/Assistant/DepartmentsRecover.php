<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentsRecover extends CI_Controller {

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
		$data['departmentsRecover']=$this->db_model->getRecoverDepartments();
		//$this->load->view('Assistant/departmentsRecover', $data);
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('Assistant/departmentsRecover');
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
	public function getDepartmentsRecover(){
		$this->load->view('Assistant/php/departmentsRecoverFetch');
	}
	public function deleteDepartmentsRecover(){
		$this->load->view('Assistant/php/departmentsRecoverDelete');
	}
    public function addUser(){
		$this->load->view('Assistant/php/userAdd2');
	}

}
