<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispose extends CI_Controller {

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
		//$this->load->view('BusinessManager/php/dispose');
		if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('BusinessManager/php/dispose');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "BusinessManager/lockscreen";
           			$this->load->view('BusinessManager/lockscreen');
      			}
		}
		//$data['users']=$this->db_model->getUsers();
		//$this->load->view('BusinessManager/user_accounts', $data);
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
	public function getUser(){
		$this->load->view('BusinessManager/php/userFetch');
	}
	public function addUser(){
		$this->load->view('BusinessManager/php/userAdd');
	}
	
	
	public function editUser(){
		$this->load->view('BusinessManager/php/userEdit');
	}
    public function addUser2(){
		$this->load->view('BusinessManager/php/userAdd2');
	}
}
