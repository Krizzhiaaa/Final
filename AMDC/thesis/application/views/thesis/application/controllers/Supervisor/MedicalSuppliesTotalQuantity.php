<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MedicalSuppliesTotalQuantity extends CI_Controller {

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
//		$data['medicalSuppliesTotalQuantity']=$this->db_model->getMedicalSuppliesTotalQuantity();
//		$this->load->view('Supervisor/php/medicalSuppliesTotalQuantity', $data);
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
			//$data['medical_supplies']=$this->db_model->getMedicalSupplies();
			$data['medicalSuppliesTotalQuantity']=$this->db_model->getMedicalSuppliesTotalQuantity();
			if($_SESSION['logged_in'] == 'True')
			{
			//$this->load->view('Supervisor/medical_supplies', $data);
			$this->load->view('Supervisor/php/medicalSuppliesTotalQuantity', $data);
			}
				else if ($_SESSION['logged_in'] != 'True') 
			{
				$this->load->view('Supervisor/lockscreen');
			}
		}
	}
	
	public function editMedicalSuppliesTotalQuantity(){
		$this->load->view('Supervisor/php/medicalSuppliesTotalQuantityEdit');
	}
    public function addUser(){
		$this->load->view('Supervisor/php/userAdd');
	}
	
}
