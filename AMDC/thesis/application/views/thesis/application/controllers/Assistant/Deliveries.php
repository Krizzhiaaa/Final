<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliveries extends CI_Controller {

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
		// $this->load->model('db_model');
		// $data['deliveries']=$this->db_model->getDeliveries();
		// $this->load->view('Assistant/deliveries', $data);
		echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
				$_SESSION['logged_in'] = 'True';
		//$this->load->view('Assistant/deliveries');
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			//$this->load->view('Assistant/dashboard');
           			$this->load->view('Assistant/deliveries');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "Assistant/lockscreen";
           			$this->load->view('Assistant/lockscreen');
      			}
		//$check = $this->session->userdata('stts');
		//if($check == 'Assistant'){
		//	$this->load->view('Assistant/suppliers');
		//}
		//else if($check == 'Assistant'){
		//	$this->load->view('Assistant/suppliers');
		//}else if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/suppliets');
		//}else{
		//	header('Location: ../login');
		//}
	}
	public function deleteDelivery(){
		$this->load->view('Assistant/php/deliveriesDelete');
	}
	// public function getChange(){
	// 	$this->load->view('Assistant/php/supplierChange');
	// }
	public function editDelivery(){
		$this->load->view('Assistant/php/deliveriesEdit');
	}
	
	public function viewDelivery(){
		$this->load->view('Assistant/php/deliveriesView');
	}
    public function addUser(){
		$this->load->view('Assistant/php/userAdd2');
	}
	public function returnDelivery(){
		$this->load->view('BusinessManager/php/deliveriesReturn');
	}

	public function returnDashboard(){
		$this->load->view('BusinessManager/php/dashboardReturn');
	}
}
