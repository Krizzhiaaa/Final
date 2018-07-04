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
//	public function index(){
//		$check = $this->session->userdata('type');
//		if($check == 'Supervisor'){
//			/* echo "<pre>";
//				print_r ( $this->session->all_userdata());
//				echo "</pre>"; */
//		$this->load->model('db_model');
//		$data['purchases']=$this->db_model->getPurchases();
//		$this->load->view('Supervisor/purchases', $data);
//	}
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
			$data['purchases']=$this->db_model->getPurchases();
			if($_SESSION['logged_in'] == 'True')
			{
			$this->load->view('Supervisor/purchases', $data);
			}
				else if ($_SESSION['logged_in'] != 'True') 
			{
				$this->load->view('Supervisor/lockscreen');
			}
		}
	}
	
	public function getPurchases(){
		$this->load->view('Supervisor/php/purchasesFetch');
	}
	public function addPurchases(){
		$this->load->view('Supervisor/php/purchasesAdd');
	}
	public function viewPurchases(){
		$this->load->view('Supervisor/php/purchasesOrderView');
	}

}
