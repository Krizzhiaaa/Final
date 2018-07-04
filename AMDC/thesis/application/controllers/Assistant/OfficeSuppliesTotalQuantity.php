<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfficeSuppliesTotalQuantity extends CI_Controller {

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
		if($check == 'Assistant'){
			$_SESSION['logged_in'] = 'True';
			echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
		$this->load->model('db_model');
		$data['officeSuppliesTotalQuantity']=$this->db_model->getOfficeSuppliesTotalQuantity();
		//$this->load->view('Assistant/php/officeSuppliesTotalQuantity', $data);
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('Assistant/php/officeSuppliesTotalQuantity');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "Assistant/lockscreen";
           			$this->load->view('Assistant/lockscreen');
      			}
	}
		/*
		$check = $this->session->userdata('stts');
		if($check == 'Assistant'){
			$this->load->view('Assistant/medical_supplies');
		}else if($check == 'Assistant'){
			$this->load->view('Assistant/medical_supplies');
		}else if($check == 'Supervisor'){
			$this->load->view('Supervisor/medical_supplies');
		}else{
			header('Location: ../login');
		} */
		
	}
	public function editOfficeSuppliesTotalQuantity(){
		$this->load->view('Assistant/php/officeSuppliesTotalQuantityEdit');
	}
    public function addUser(){
		$this->load->view('Assistant/php/userAdd2');
	}
	
}
