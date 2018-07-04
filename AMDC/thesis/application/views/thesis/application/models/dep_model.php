<?php  
 class dep_model extends CI_Model  
 {  
      var $table = "departments";  
      var $select_column = array("department_id", "department_name", "location");  
      var $order_column = array(null, "department_name", "location");  
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);  
           if(isset($_REQUEST["search"]["value"]))  
           {  
                $this->db->like("department_id", $_REQUEST["search"]["value"]);
                $this->db->or_like("department_name", $_REQUEST["search"]["value"]);  
                $this->db->or_like("location", $_REQUEST["search"]["value"]);  
           }  
           if(isset($_REQUEST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('department_id', 'DESC');  
           }  
      }  
      function make_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table);  
           return $this->db->count_all_results();  
      }  
      function insert_departments($data)  
      {  
           $this->db->insert('departments', $data);  
      }  
      function fetch_single_department($department_id)  
      {  
           $this->db->where("department_id", $department_id);  
           $query=$this->db->get('departments');  
           return $query->result();  
      }  
      function update_departments($user_id, $data)  
      {  
           $this->db->where("department_id", $department_id);  
           $this->db->update("departments", $data);  
      }  
 }