<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbforget_model extends CI_Model {
	public function logdata($uname){
		$this->db->where('username', $uname);

		$query = $this->db->get('users');
		if ($query->num_rows() >0){
			foreach ($query->result() as $row){
				if($uname == $row->username){

					$sess = array(
						'id' => $row->user_id,
					'fname' => $row->fname,
					'lname' => $row->lname,
					'username' => $row->username,
					'password' => $row->password,
					'type'	   => $row->user_type,
					'stts'	   => $row->user_status,
					);

					$this->session->set_userdata($ses);
					// if($row->user_type == 'BusinessManager' && $row->user_status == 'Active'){ 
					// $this->load->view('BusinessManager/forget');
						
					//  }else if($row->user_type == 'Assistant' && $row->user_status == 'Active'){
					//  $this->load->view('BusinessManager/forget'); 
						
					//  }else if($row->user_type == 'Supervisor' && $row->user_status == 'Active'){
					//  $this->load->view('BusinessManager/forget'); 
						
					//  }else{
					// 	$this->session->set_flashdata('info', 'This account is inactive!');
					// 	redirect('/thesis/login');
					// }
				}
			}
		} else {
			$this->session->set_flashdata('info', 'The username or password is incorrect!');
			redirect('login');
		}
	}

}
