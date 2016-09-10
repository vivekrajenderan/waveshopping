<?php

class Task_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		date_default_timezone_set('America/New_York');
		$this->load->helper('url');
		$this->load->library('table','session'); 
		$this->load->database();
		
    }
	public function addtask($data)
	 {
	 	
        $this->db->insert('task', $data);   
        return $this->db->insert_id(); 
	 }

	 function updatetask($set_data,$id)
    {

       $this->db->where('id',$id);
       $this->db->update('task',$set_data);
       
        return $id;
    }
	 
	
	function statusList()
	{
		$row=array();
		$this->db->select('*');
		$this->db->from('status');
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
	
	function taskList()
	{
		
		$row=array();
        $select =   array(
                '*'
        );
     	$select=array('A.name as assign_name','C.name as created_name','T.id','T.title','T.description','T.priority','T.created_on','T.updated_on','S.status_name');
        $this->db->select($select);    
        $this->db->from('task T');
        $this->db->join('status S', 'T.status_id= S.id'); 
        $this->db->join('users A', 'T.assign_to= A.id'); 
        $this->db->join('users C', 'T.created_by= C.id');  
       
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
	

	function getSelectedtask($id)
	{
		
		$row=array();
        $select =   array(
                '*'
        );
     	$select=array('A.name as assign_name','C.name as created_name','T.id','T.title','T.description','T.priority','T.created_on','T.updated_on','S.status_name');
        $this->db->select($select);    
        $this->db->from('task T');
        $this->db->join('status S', 'T.status_id= S.id'); 
        $this->db->join('users A', 'T.assign_to= A.id'); 
        $this->db->join('users C', 'T.created_by= C.id');
        $this->db->where('S.id',$id);          
       
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
	


	function getTasklist($id)
	{
		$row=array();
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where('id',$id);
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
