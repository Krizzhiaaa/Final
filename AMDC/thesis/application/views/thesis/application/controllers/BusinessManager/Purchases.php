<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller {

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
		$data['purchases']=$this->db_model->getPurchases();
		//$this->load->view('BusinessManager/purchases', $data);
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('BusinessManager/purchases');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "BusinessManager/lockscreen";
           			$this->load->view('BusinessManager/lockscreen');
      			}
	}
		//$check = $this->session->userdata('stts');
		//if($check == 'BusinessManager'){
		//	$this->load->view('BusinessManager/suppliers');
		//}
		//else if($check == 'Assistant'){
		//	$this->load->view('Assistant/suppliers');
		//}else if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/suppliets');
		//}else{
		//	header('Location: ../login');
		//}
	}
	public function getPurchases(){
		$this->load->view('BusinessManager/php/purchasesFetch');
	}
	public function getChange(){
		$this->load->view('BusinessManager/php/purchasesChange');
	}
	public function addPurchases(){
		$this->load->view('BusinessManager/php/purchasesAdd');
	}
	public function viewPurchases(){
		$this->load->view('BusinessManager/php/purchaseOrderView');
	}
	public function editPurchases(){
		$this->load->view('BusinessManager/php/purchasesEdit');
	}
    public function addUser(){
		$this->load->view('BusinessManager/php/userAdd2');
	}
	public function updatePurchases(){
		$this->load->view('BusinessManager/update_purchase');
	}
    public function addUser2(){
		$this->load->view('BusinessManager/php/flagrange');
	}
    
    public function generated(){
    $this->load->view('BusinessManager/php/generaterep');
	}
}