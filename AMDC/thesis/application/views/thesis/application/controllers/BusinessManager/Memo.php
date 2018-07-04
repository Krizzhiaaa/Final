<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memo extends CI_Controller {

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
		$data['memo']=$this->db_model->getMemo();
		//$this->load->view('BusinessManager/memo', $data);
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('BusinessManager/memo');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "BusinessManager/lockscreen";
           			$this->load->view('BusinessManager/lockscreen');
      			}
	}
		//$check = $this->session->userdata('stts');
		//if($check == 'BusinessManager'){
		//	$this->load->view('BusinessManager/user_accounts');
		//}else if($check == 'Assistant'){
		//	$this->load->view('Assistant/user_accounts');
		//}else if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/user_accounts');
		//}else{
		//	header('Location: ../login');
		//}
		
	}
	public function getMemo(){
		$this->load->view('BusinessManager/php/memoFetch');
	}
	public function addMemo(){
		$this->load->view('BusinessManager/php/memoAdd');
	}
	public function deleteMemo(){
		$this->load->view('BusinessManager/php/memoDelete');
	}
	public function getChange(){
		$this->load->view('BusinessManager/php/memoChange');
	}
	public function editMemo(){
		$this->load->view('BusinessManager/php/memoEdit');
	}
    public function addUser(){
		$this->load->view('BusinessManager/php/userAdd2');
	}

	public function viewMemo(){
		$this->load->view('BusinessManager/php/memo_view');
	}
}
