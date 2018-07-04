<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lockscreen extends CI_Controller {

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
	public function _construct(){
		parent::_construct();
		$this->load->library('session');
	}
	public function index(){
		$check = $this->session->userdata('type');
		if($check == 'Assistant'){
			    echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
				$_SESSION['logged_in'] = 'True';
			$this->load->model('db_model');
			$this->load->view('Assistant/lockscreen');

		}
		
		//$check = $this->session->userdata('stts');
		//if($check == 'Assistant'){
		//	$this->load->view('Assistant/departments');
		//}else if($check == 'Assistant'){
		//	$this->load->view('Assistant/departments');
		//}else if($check == 'Supervisor'){
		//	$this->load->view('Supervisor/departments');
		//}else{
	//		header('Location: ../login');
	//	}
		
	}

	public function checklogin(){
		$username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->load->model('db_model');
    $result = $this->db_model->logindata($username,$password);
        foreach ($result as $row) {
            $sess_data = [
                'fname' => $row->fname,
					'lname' => $row->lname,
					'username' => $row->username,
					'user_email' => $row->user_email,
					'password' => $row->password,
					'type'	   => $row->user_type,
					'stts'	   => $row->user_status
            ];
            $this->session->set_userdata('logged_in', $sess_data);
        }
        return TRUE;
    header('Location: ' . $_SERVER['HTTP_REFERER']);

	}

	public function refer(){
		$password = $this->input->get('password');
		$current_pass = $this->session->userdata('password');
		if($password == $current_pass){
			header('Location: ' . $_SESSION['current_page']);
		}else{
			redirect ('Assistant/lockscreen');
		}
		
	}
    public function addUser(){
		$this->load->view('Assistant/php/userAdd2');
	}

}
