<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentsFetches extends CI_Model {
    public function logindata($username,$password){
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('users');
        if ($query->num_rows() >0){
            foreach ($query->result() as $row){
                if($username == $row->username && $password == $row->password){

                    $sess = array(
                    'username' => $row->username,
                    'password' => $row->password,
                    'type'     => $row->user_type,
                    'stts'     => $row->user_status
                    );

                    $this->session->set_userdata($sess);
                        if($row->user_type == 'BusinessManager' && $row->user_status == 'Active'){
                            redirect('/BusinessManager/dashboard');
                        }else if($row->user_type == 'Assistant' && $row->user_status == 'Active'){
                            redirect('/Assistant/dashboard');
                        }else if($row->user_type == 'Supervisor' && $row->user_status == 'Active'){
                            redirect('/Supervisor/dashboard');
                        }else{
                            $this->session->set_flashdata('info', 'This account is inactive!');
                            redirect('login');
                        }
                }
                    


            }
                
        
        } else {
            $this->session->set_flashdata('info', 'The username or password is incorrect!');
            redirect('login');
        }
    }
}
