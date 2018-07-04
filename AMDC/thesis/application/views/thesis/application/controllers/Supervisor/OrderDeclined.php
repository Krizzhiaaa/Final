<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderDeclined extends CI_Controller {

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
		// $check = $this->session->userdata('type');
		// if($check == 'BusinessManager'){
		// 	echo "<pre>";
		// 		print_r ( $this->session->all_userdata());
		// 		echo "</pre>";
		// 	$this->load->model('db_model');
		// 	$data['departments']=$this->db_model->getDepartments();
		// 	$this->load->view('BusinessManager/departments', $data);

		// }
		$_SESSION['logged_in'] = 'True';
		//$this->load->view('BusinessManager/dep_orders');
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('Supervisor/orders_declined');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "BusinessManager/lockscreen";
           			$this->load->view('Supervisor/lockscreen');
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
	// public function getDepartment(){
	// 	$this->load->view('BusinessManager/php/departmentsFetch');
	// }
	public function editOrder(){
		$this->load->view('Supervisor/order_edit');
	}
	public function viewOrder(){
		$this->load->view('Supervisor/php/order_view');
	}
	public function addOrder(){
		$this->load->view('Supervisor/php/order_add');
	}
	public function declineOrder(){
		$this->load->view('Supervisor/php/decline_order');
	}
    public function addItem(){
		$this->load->view('Supervisor/name');
	}
	public function updateItem(){
		$this->load->view('Supervisor/update_order');
	}

}
