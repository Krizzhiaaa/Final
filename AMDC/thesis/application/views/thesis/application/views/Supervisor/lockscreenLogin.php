<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
  public function index(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->load->model('db_model');
    $this->db_model->logindata($username,$password);

    
    $checklogin = $this->session->userdata('username');
    $ty = $this->session->userdata('type');
    $st = $this->session->userdata('stts');
    
 if(empty($checklogin)){
        header("Location: errorLockscreen.php");
  //header('Location: index.php?err=1');
 }else{
    $t = $this->session->userdata('type');
    $s = $this->session->userdata('stts');

      if( $ty == 'Supervisor' && $st == 'Active'){
        // $_SESSION['last_login_timestamp'] = time();
       $this->load->view('Supervisor/dashboard');
       // session_write_close();
      }//elseif( $_SESSION['sess_userrole'] == "Assistant"){
       //header('Location: AssistantModule/dashboard.php');
       //session_write_close();
      //}else{
       // header('Location: SupervisorModule/dashboard.php');
        //session_write_close();
      //}
      }
  }
  } 
  ?>