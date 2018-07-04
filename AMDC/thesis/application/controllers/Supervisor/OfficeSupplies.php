<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfficeSupplies extends CI_Controller {

//	public function index()
//	{
//		$check = $this->session->userdata('type');
//		if($check == 'Supervisor'){
//			echo "<pre class='hidden'>";
//				print_r ( $this->session->all_userdata());
//				echo "</pre>";
//		$this->load->model('db_model');
//		$data['office_supplies']=$this->db_model->getOfficeSupplies();
//		$this->load->view('Supervisor/office_supplies', $data);
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
			$data['office_supplies']=$this->db_model->getOfficeSupplies();
			if($_SESSION['logged_in'] == 'True')
			{
			$this->load->view('Supervisor/office_supplies', $data);
			}
				else if ($_SESSION['logged_in'] != 'True') 
			{
				$this->load->view('Supervisor/lockscreen');
			}
		}
	}
		
	
	public function getOfficeSupplies(){
		$this->load->view('Supervisor/php/OfficeSuppliesFetch');
	}
	public function addOfficeSupplies(){
		$this->load->view('Supervisor/php/OfficeSuppliesAdd');
	}
	public function OfficeSuppliesadd(){
		$this->load->view('Supervisor/php/OfficeSuppliesAddQuantity');
	}
	public function deleteOfficeSupplies(){
		$this->load->view('Supervisor/php/OfficeSuppliesDelete');
	}
	public function editOfficeSupplies(){
		$this->load->view('Supervisor/php/OfficeSuppliesEdit');
	}
	public function reconcileOfficeSupplies(){
		$this->load->view('Supervisor/php/OfficeSuppliesReconcile');
	}
	public function addOfficeSuppliesIssueTo(){
		$this->load->view('Supervisor/php/OfficeSuppliesIssueTo');
	}
	public function totalOfficeSupplies(){
		$this->load->view('Supervisor/php/OfficeSuppliesTotalQuantity');
	}
    public function addUser(){
		$this->load->view('Supervisor/php/userAdd');
	}
}
