<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoryReconciliation extends CI_Controller {

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
		if($check == 'BusinessManager'){
			$_SESSION['logged_in'] = 'True';
			echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
		$this->load->model('db_model');
		$data['InventoryReconciliation']=$this->db_model->getInventoryReconciliation();
		//$this->load->view('BusinessManager/medicalSupplies', $data);
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('BusinessManager/inventoryReconciliation');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "BusinessManager/lockscreen";
           			$this->load->view('BusinessManager/lockscreen');
      			}
		}
		
	}
	// public function getMedicalSupplies(){
	// 	$this->load->view('BusinessManager/php/medicalSuppliesFetch');
	// }
	// public function addMedicalSupplies(){
	// 	$this->load->view('BusinessManager/php/medicalSuppliesAdd');
	// }
	// public function MedicalSuppliesadd(){
	// 	$this->load->view('BusinessManager/php/medicalSuppliesAddQuantity');
	// }
	// public function deleteMedicalSupplies(){
	// 	$this->load->view('BusinessManager/php/medicalSuppliesDelete');
	// }
	// public function editMedicalSupplies(){
	// 	$this->load->view('BusinessManager/php/medicalSuppliesEdit');
	// }
	// public function reconcileMedicalSupplies(){
	// 	$this->load->view('BusinessManager/php/medicalSuppliesReconcile');
	// }
	// public function addMedicalSuppliesIssueTo(){
	// 	$this->load->view('BusinessManager/php/medicalSuppliesIssueTo');
	// }
 //    public function addUser(){
	// 	$this->load->view('BusinessManager/php/userAdd2');
	// }
    
	
}
