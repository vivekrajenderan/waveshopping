<?php

class User_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		date_default_timezone_set('America/New_York');
		$this->load->helper('url');
		$this->load->library('table','session'); 
		$this->load->database();
		
    }
	
	function userList()
	{
		$row=array();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by("name","asc");		
		$query = $this->db->get();		
        if($query->num_rows>0){          
            $row=$query->result_array();          
			return $row;
           }
           else
           {
           	return $row;
           }
			
	}
	
	function notActivelist()
	{
		$row=array();		
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('id !=',$this->session->userdata('userid'));
		$this->db->where('status',1);
		$query = $this->db->get();
		
        if($query->num_rows>0){          
            $row=$query->result_array();
			return $row;
           }
           else
           {
           	return $row;
           }
			
	}
	
	 
}
