<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends CI_Controller {

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
		// if($this->session->userdata('loggedIn')){
  //     		redirect('dashboard');
  //   }
	}

	public function index()
	{

		$checklogin = $this->session->userdata('type');
		if(empty($checklogin)){
			$this->load->view('login_view');
		}else{
			$ty = $this->session->userdata('type');
			$st = $this->session->userdata('stts');

			if($ty == 'BusinessManager' && $st == 'Active' ){
					$_SESSION['logged_in'] = 'True';
				echo "<pre class = 'hidden'>";
				print_r ( $this->session->all_userdata());
				echo "</pre>";
				// $exit = $this->session->mark_as_temp(array('username', 'password'), 300);
				// if($exit == ""){
				// 	// $this->session->sess_destroy();
				// 	$this->load->view('BusinessManager/lockscreen');
				// }
				// $_SESSION['Login'] = 'True';
				// $_SESSION['Time'] = time();
				//$_SESSION['username'] = $username;
				//$_SESSION['Login'] = 'True';
				//$_SESSION['Time'] = time();
				$this->load->model('db_model');
				if($_SESSION['logged_in'] == 'True')  
      			{  
           			// echo 'dashboard';
           			$this->load->view('BusinessManager/php/return');
      			}  
      			else if ($_SESSION['logged_in'] != 'True')  
      			{  
           			// echo "BusinessManager/lockscreen";
           			$this->load->view('BusinessManager/lockscreen');
      			}  
     	 		
			
			
			}
		}
		
	}

	public function returnButton(){
	$this->load->view('BusinessManager/php/return');
	}

	public function checklogin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->load->model('db_model');
		$result = $this->db_model->logindata($username,$password);
		  if($result != null){
        foreach ($result as $row) {
            $sess = [
                'fname' => $row->fname,
					'lname' => $row->lname,
					'username' => $row->username,
					'user_email' => $row->user_email,
					'password' => $row->password,
					'type'	   => $row->user_type,
					'stts'	   => $row->user_status,
            ];
            $this->session->set_userdata('logged_in', $sess);
        }
        return TRUE;
    }
	}
    
    public function addUser(){
		$this->load->view('BusinessManager/php/userAdd2');
	}
}
