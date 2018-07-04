<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfficeSupplies extends CI_Controller {

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
		$data['officeSupplies']=$this->db_model->getOfficeSupplies();
		//$this->load->view('Assistant/officeSupplies', $data);
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('Assistant/officeSupplies');
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
			$this->load->view('Assistant/Office_supplies');
		}else if($check == 'Assistant'){
			$this->load->view('Assistant/Office_supplies');
		}else if($check == 'Supervisor'){
			$this->load->view('Supervisor/Office_supplies');
		}else{
			header('Location: ../login');
		} */
		
	}
	public function getOfficeSupplies(){
		$this->load->view('Assistant/php/OfficeSuppliesFetch');
	}
	public function addOfficeSupplies(){
		$this->load->view('Assistant/php/OfficeSuppliesAdd');
	}
	public function OfficeSuppliesadd(){
		$this->load->view('Assistant/php/OfficeSuppliesAddQuantity');
	}
	public function deleteOfficeSupplies(){
		$this->load->view('Assistant/php/OfficeSuppliesDelete');
	}
	public function editOfficeSupplies(){
		$this->load->view('Assistant/php/OfficeSuppliesEdit');
	}
	public function reconcileOfficeSupplies(){
		$this->load->view('Assistant/php/OfficeSuppliesReconcile');
	}
	public function addOfficeSuppliesIssueTo(){
		$this->load->view('Assistant/php/OfficeSuppliesIssueTo');
	}
	public function totalOfficeSupplies(){
		$this->load->view('Assistant/php/OfficeSuppliesTotalQuantity');
	}
    public function addUser(){
		$this->load->view('Assistant/php/userAdd2');
	}
	public function generated(){
        $this->load->view('Assistant/php/generateoffrep');
    }
}
