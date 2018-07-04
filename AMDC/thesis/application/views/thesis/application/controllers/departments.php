<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class Departments extends CI_Controller {  
      //functions  
      function index(){  
           $data["title"] = "Business Manager | Deoartments";  
           $this->load->view('BusinessManager/departments', $data);  
      }  
      function fetch_departments(){  
           $this->load->model("dep_model");  
           $fetch_data = $this->dep_model->make_datatables();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();
                $sub_array[] = $row->departments_name;  
                $sub_array[] = $row->location;  
                $sub_array[] = '<button type="button" name="update" id="'.$row->department_id.'" class="btn btn-warning btn-xs update">Edit</button>';  
                $sub_array[] = '<button type="button" name="delete" id="'.$row->department_id.'" class="btn btn-danger btn-xs delete">Delete</button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"              =>     intval($_REQUEST["draw"]),  
                "recordsTotal"      =>     $this->dep_model->get_all_data(),  
                "recordsFiltered"   =>     $this->dep_model->get_filtered_data(),  
                "data"              =>     $data  
           );  
           echo json_encode($output);  
      }  
      function user_action(){  
           if($_POST["action"] == "Add")  
           {  
               $insert_data = array(  
                     'department_name'    =>     $this->input->post('department_name'),  
                     'location'     =>     $this->input->post("location")  
                    //'image'         =>     $this->upload_image()  
                );  
                $this->load->model('dep_model');  
                $this->dep_model->insert_departments($insert_data);  
                echo 'Data Inserted';  
           }  
           if($_POST["action"] == "Edit")  
           {  
                $updated_data = array(  
                     'first_name'   =>     $this->input->post('department_name'),  
                     'last_name'    =>     $this->input->post('location')
                );  
                $this->load->model('dep_model');  
                $this->dep_model->update_departments($this->input->post("departments_id"), $updated_data);  
                echo 'Data Updated';  
           }  
      }  
      //function upload_image()  
      //{  
      //     if(isset($_FILES["user_image"]))  
      //     {  
      //          $extension = explode('.', $_FILES['user_image']['name']);  
      //          $new_name = rand() . '.' . $extension[1];  
      //          $destination = './upload/' . $new_name;  
      //          move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
      //          return $new_name;  
      //     }  
      //}  
      //function fetch_single_user()  
      //{  
      //     $output = array();  
      //     $this->load->model("dep_model");  
      //     $data = $this->crud_model->fetch_single_user($_REQUEST["department_id"]);  
      //     foreach($data as $row)  
      //     {  
      //          $output['department_name'] = $row->department_name;  
      //          $output['location'] = $row->location;  
      //          if($row->image != '')  
      //          {  
      //               $output['user_image'] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row->image.'" />';  
      //          }  
      //          else  
      //          {  
      //               $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
      //          }  
      //     }  
      //     echo json_encode($output);  
      //}  
 } 