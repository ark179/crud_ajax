<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {

        Private $table_name;
        Private $primary_key;
        
        public function __construct() {
            parent::__construct();
            $this->table_name = 'employees';
            $this->primary_key = 'id';
        }

        public function add_employee($post_arr)
	{
            //echo "";print_r($post_arr);die;
            $insert_data=[
                'name'=>$post_arr['emp_name'],
                'dob'=>date('Y-m-d',strtotime($post_arr['emp_dob'])),
                'email'=>$post_arr['emp_email'],
                'mobile'=>$post_arr['emp_mobile'],
                'created_at'=>date('Y-m-d'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            //echo "<pre>";print_r($insert_data);die;
            $this->db->insert($this->table_name,$insert_data);
            $insert_id=$this->db->insert_id();
            return $insert_id;
	}
        
        public function update_employee($post_arr)
	{
            $update_data=[
                'name'=>$post_arr['emp_name'],
                'dob'=>date('Y-m-d',strtotime($post_arr['emp_dob'])),
                'email'=>$post_arr['emp_email'],
                'mobile'=>$post_arr['emp_mobile'],
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $this->db->where($this->primary_key,$post_arr['emp_id']);
            $this->db->update($this->table_name,$update_data);
            $affected_rows=$this->db->affected_rows();
            return $affected_rows;
        }
        
        public function delete_employee($id)
	{
            if(is_array($id))
                $this->db->where_in($this->primary_key,$id);           
            else
                $this->db->where($this->primary_key,$id);
            $this->db->delete($this->table_name);
            $affected_rows=$this->db->affected_rows();
            return $affected_rows;
	}
        
        public function get_employee($id)
	{
            $this->db->select("id AS id,name AS name,dob AS dob,email AS email,mobile AS mobile,DATE_FORMAT(created_at,' %d %b %Y') AS created_at,DATE_FORMAT(updated_at,' %d %b %Y') AS updated_at");
            $this->db->from($this->table_name);
            $this->db->where($this->primary_key,$id);
            $employee=$this->db->get()->row();
            return $employee;
	}
        
        public function employee_list()
	{
            $this->db->select("id AS emp_id,name AS emp_name,dob AS emp_dob,email AS emp_email,mobile AS emp_mobile");
            $employees= $this->db->get($this->table_name)->result();
            return $employees;
	}
}   