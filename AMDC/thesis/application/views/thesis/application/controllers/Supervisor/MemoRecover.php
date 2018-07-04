<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemoRecover extends CI_Controller {

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
		if($check == 'Supervisor'){
			$_SESSION['logged_in'] = 'True';
			echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
		$this->load->model('db_model');
		$data['memoRecover']=$this->db_model->getMemoRecover();
		//$this->load->view('Supervisor/memoRecover', $data);
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('Supervisor/memoRecover');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "Supervisor/lockscreen";
           			$this->load->view('Supervisor/lockscreen');
      			}
	}
		//$check = $this->session->userdata('stts');
		//if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/user_accounts');
		//}else if($check == 'Assistant'){
		//	$this->load->view('Assistant/user_accounts');
		//}else if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/user_accounts');
		//}else{
		//	header('Location: ../login');
		//}
		
	}
	public function getMemoRecover(){
		$this->load->view('Supervisor/php/memoFetchRecover');
	}
	public function deleteMemoRecover(){
		$this->load->view('Supervisor/php/memoRecoverDelete');
	}
    public function addUser(){
		$this->load->view('Supervisor/php/userAdd');
	}
}
