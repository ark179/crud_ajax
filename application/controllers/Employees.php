<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('employees_model');
        }

        public function index()
	{
            $data['employees']= $this->employees_model->employee_list();
            $this->load->view('employees/list',$data);
	}
        public function emp_list()
	{
            $employees= $this->employees_model->employee_list();            
            if(!empty($employees))
                $data=[
                    "success"=>1,
                    "message"=>"Employees data found",
                    "data"=>$employees
                ];
             else
                $data=[
                    "success"=>0,
                    "message"=>  "No data available in table",
                    "data"=>[]
            ];
            echo json_encode($data);exit;
	}
        
        public function add()
	{
            $this->form_validation->set_error_delimiters(' *  <label class="error">', '</label><br>');
            $this->form_validation->set_rules('emp_name', 'Employee Name', 'required|max_length[60]|min_length[5]|xss_clean');
            $this->form_validation->set_rules('emp_dob', 'Employee Date of Birth', 'required|xss_clean');
            $this->form_validation->set_rules('emp_email', 'Employee Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('emp_mobile', 'Employee Mobile', 'required|max_length[10]|integer|xss_clean');
            if ($this->form_validation->run() != FALSE)
            {
                $post_arr=$this->input->post();
                if(!empty($post_arr))
                {
                    $insert_id= $this->employees_model->add_employee($post_arr);
                    if($insert_id>0)
                    {
                        $data=[
                            "success"=>1,
                            "message"=>"Employee added successfully.",
                            "data"=>["emp_id"=>$insert_id]
                        ];
                    }
                    else {
                        $data=[
                            "success"=>0,
                            "message"=>  "Some error occured.Please try again.",
                            "data"=>[]
                        ];
                    }
                }
            }
            else {
                $data=[
                    "success"=>0,
                    "message"=>  validation_errors(),
                    "data"=>[]
                ];
                $this->session->set_flashdata('success','Some error occured.Please try again.');

            }
            echo json_encode($data);exit;
	}
        
        public function edit()
	{
            $this->form_validation->set_error_delimiters(' *  <label class="error">', '</label><br>');
            $this->form_validation->set_rules('emp_id', 'Employee Id', 'required|xss_clean');
            $this->form_validation->set_rules('emp_name', 'Employee Name', 'required|max_length[60]|min_length[5]|xss_clean');
            $this->form_validation->set_rules('emp_dob', 'Employee Date of Birth', 'required|xss_clean');
            $this->form_validation->set_rules('emp_email', 'Employee Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('emp_mobile', 'Employee Mobile', 'required|max_length[10]|integer|xss_clean');
            if ($this->form_validation->run() != FALSE)
            {
                $post_arr=$this->input->post();
                
                if(!empty($post_arr))
                {
                    $affected_rows= $this->employees_model->update_employee($post_arr);
                    if($affected_rows>0)
                        $data=[
                            "success"=>1,
                            "message"=>"Employee updated successfully",
                            "data"=>["affected_rows"=>$affected_rows]
                        ];
                    else
                        $data=[
                            "success"=>0,
                            "message"=>  "Some error occured.Please try again.",
                            "data"=>[]
                        ];
                }
            }
            else {
                $data=[
                    "success" => 0,
                    "message" => validation_errors(),
                    "data" => []
                ];
            }
            echo json_encode($data);exit;
        }
        
        public function delete()
	{
            $id=$this->input->post('employee_id');
            $affected_rows= $this->employees_model->delete_employee($id);
            if($affected_rows>0)
                $data=[
                    "success"=>1,
                    "message"=>"Employee deleted successfully",
                    "data"=>["affected_rows"=>$affected_rows]
                ];
            else
                $data=[
                    "success"=>0,
                    "message"=>  "Some error occured.Please try again.",
                    "data"=>[]
            ];
            echo json_encode($data);exit;
	}
        
        public function view($id)
	{
            $emp_data= $this->employees_model->get_employee($id);
            if(!empty($emp_data))
                $data=[
                    "success"=>1,
                    "message"=>"Employee data found",
                    "data"=>$emp_data
                ];
             else
                $data=[
                    "success"=>0,
                    "message"=>  "Some error occured.Please try again.",
                    "data"=>[]
            ];
            echo json_encode($data);exit;
	}
        
        public function delete_all()
        {
            $ids=$this->input->post('checked_id');
            //$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
            //$this->form_validation->set_rules('checked_id[]', 'Product Id', 'required|xss_clean',array('required'=>'Please select at least 1 record.'));
            //if ($this->form_validation->run() != FALSE)
            //{
                $delete=$this->employees_model->delete_employees($ids);
                if($delete>0)
                    $this->session->set_flashdata('success','employee(s) deleted successfully');
                else
                    $this->session->set_flashdata('failure','Some error occured.Please try again.');
            //}
            //else
            //    $this->session->set_flashdata('failure',  validation_errors());
            redirect('employees','refresh');
        }
}   