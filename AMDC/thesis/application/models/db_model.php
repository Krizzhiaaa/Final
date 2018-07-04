<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model {
	public function logindata($username,$password){
		$this->db->where("(user_email = '$username' OR username = '$username')");
		$this->db->where('password', $password);

		$query = $this->db->get('users');
		if ($query->num_rows() > 0){
			foreach ($query->result() as $row){
				
				if(($username == $row->username && $password == $row->password)
					||($username == $row->user_email && $password == $row->password)){

			        $sess = array(
					'id'	=> $row->user_id,
					'fname' => $row->fname,
					'lname' => $row->lname,
					'username' => $row->username,
					'user_email' => $row->user_email,
					'password' => $row->password,
					'type'	   => $row->user_type,
					'stts'	   => $row->user_status,
                    'dept_name'   => $row->dept_name,
                    'image'   => $row->image,
					);

					$this->session->set_userdata($sess);
					if($row->user_type == 'BusinessManager' && $row->user_status == 'Active'){
						$_SESSION['logged_in'] = 'True';
						redirect('dashboard');
					}else if($row->user_type == 'Assistant' && $row->user_status == 'Active'){
						$_SESSION['logged_in'] = 'True';
						redirect('dashboard');
					}else if($row->user_type == 'Supervisor' && $row->user_status == 'Active'){
						$_SESSION['logged_in'] = 'True';
						redirect('dashboard');
					}else{
						$this->session->set_flashdata('info', '<h3><span class="label label-warning">This account is inactive!</span></h3>');
							redirect('login');
					}
			    }
			}
		} else {
			if(preg_match("/^ /", $username) || preg_match("/^ /", $password)){
			    header("Location: ../login");
			    exit();
			}else {
				$this->session->set_flashdata('info', '<h3><span class="label label-danger">The username or password is incorrect!</span></h3>');
				redirect('login');
			}
		}

	}

	public function getSuppliers(){
		$query=$this->db->query("SELECT * FROM suppliers");
		return $query->result();
	}
	public function getDepartments(){
		$query=$this->db->query("SELECT * FROM departments");
		return $query->result();
	}
	public function getRecoverDepartments(){
		$query=$this->db->query("SELECT * FROM departments");
		return $query->result();
	}
	public function getBaguioDepartments(){
		$query=$this->db->query("SELECT * FROM departments WHERE location = 'Baguio City'");
		return $query->result();
	}
	public function getLADepartments(){
		$query=$this->db->query("SELECT * FROM departments WHERE location = 'La Trinidad'");
		return $query->result();
	}
	public function getUsers(){
		$query=$this->db->query("SELECT * FROM users");
		return $query->result();
	}
	public function getPurchases(){
		$query=$this->db->query("SELECT * FROM inventory_order io");
		return $query->result();
	}
	/* public function deleteSupplier($supplier_id){
		$this->db->where("id", $supplier_id);
		$this->db->delete("suppliers");

	} */

	public function getMedicalSupplies(){
		$query=$this->db->query("SELECT * FROM supplies WHERE supply_Type = 'Medical'");
		return $query->result();
	}
	public function getMedicalSuppliesTotalQuantity(){
		$query=$this->db->query("SELECT * FROM supplies WHERE supply_Type = 'Medical'");
		return $query->result();
	}
	public function getIssuedSupplies(){
		$query=$this->db->query("SELECT * FROM request_supplies");
		return $query->result();
	}
	public function getMemo(){
		$query=$this->db->query("SELECT * FROM memo");
		return $query->result();
	}
	public function getMemoRecover(){
		$query=$this->db->query("SELECT * FROM memo");
		return $query->result();
	}
	public function getOfficeSupplies(){
		$query=$this->db->query("SELECT * FROM supplies WHERE supply_Type= 'Office' ");
		return $query->result();
	}
	public function getOfficeSuppliesTotalQuantity(){
		$query=$this->db->query("SELECT * FROM supplies WHERE supply_Type = 'Office'");
		return $query->result();
	}
	public function getMedicalSuppliesRecover(){
		$query=$this->db->query("SELECT * FROM supplies WHERE supply_Type = 'Medical'");
		return $query->result();
	}
	public function getOfficeSuppliesRecover(){
		$query=$this->db->query("SELECT * FROM supplies WHERE supply_Type = 'Office'");
		return $query->result();
	}

	public function getLogs(){
		$query=$this->db->query("SELECT * FROM logs");
		return $query->result();
	}

	public function getInventoryReconciliation(){
		$query=$this->db->query("SELECT * FROM reconciliation");
		return $query->result();
	}
	public function getReorderUpdate(){
		$query=$this->db->query("SELECT * FROM reorderlevelupdate");
		return $query->result();
	}
    public function getUnitPriceUpdate(){
		$query=$this->db->query("SELECT * FROM unitPriceUpdate");
		return $query->result();
	}

}
