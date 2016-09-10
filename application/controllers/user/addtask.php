<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addtask extends CI_Controller {

	
	
	public function __construct() 
    {
        parent::__construct();        
        $this->load->library('session');

        if($this->session->userdata('userid')=="") {
			redirect(base_url().'user/login/', 'refresh');
		} 
		$this->load->helper(array('form', 'url'));
		$this->load->model('user/task_model');
		$this->load->model('user/user_model');


			
    }
	
	public function index()
	{
		$statusList=$this->task_model->statusList();

		$totalUserlist=$this->user_model->notActivelist();
		$data=array("statusList"=>$statusList,'totalUserlist'=>$totalUserlist);
		
		$this->load->view('includes/header');
		$this->load->view('user/addtask',$data);
		$this->load->view('includes/footer');
		
	}

	public function addtasksuccess()
	{

				
		$this->load->library('form_validation');

		if (($this->input->server('REQUEST_METHOD') == 'POST')) {
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[60]');	
		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]');	
		$this->form_validation->set_rules('priority', 'Priority', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');	
		$this->form_validation->set_rules('user_id', 'User', 'trim|required');	
		
		if($this->form_validation->run() == FALSE) {
				
				echo json_encode(array('response'=>'error', 'msg'=>validation_errors()));
			} 
		else
    	{
        			

				$set_data = array(
				'title' 		=>trim($this->input->post('title')),
				'description' 	=>trim($this->input->post('description')),
				'priority' 	=>trim($this->input->post('priority')),
				'status_id' 	=>trim($this->input->post('status')),
				'assign_to' 	=>trim($this->input->post('user_id')),
				'created_by' 	=>$this->session->userdata('userid')							
				);
				$addAdvertisement=$this->task_model->addtask($set_data);
				echo json_encode(array('response'=>'success'));
			
	    }
      
       }
      					
	}

	public function edit()
	{
		if(isset($_GET['id']))
		{


		$id=$this->input->get('id');
		$taskList=$this->task_model->getTasklist($id);
		$statusList=$this->task_model->statusList();

		$totalUserlist=$this->user_model->notActivelist();
		$data=array("statusList"=>$statusList,'totalUserlist'=>$totalUserlist,'taskList'=>$taskList);
		
		$this->load->view('includes/header');
		$this->load->view('user/edittask',$data);
		$this->load->view('includes/footer');
		}
		else
		{
			redirect(base_url().'user/addtask/', 'refresh');
		}
		
	}

	public function edittasksuccess()
	{

		
		$this->load->library('form_validation');

		if (($this->input->server('REQUEST_METHOD') == 'POST')) {
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[60]');	
		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]');	
		$this->form_validation->set_rules('priority', 'Priority', 'trim|required');	
		$this->form_validation->set_rules('status', 'Status', 'trim|required');	
		$this->form_validation->set_rules('user_id', 'User', 'trim|required');	
		
		if($this->form_validation->run() == FALSE) {
				
				echo json_encode(array('response'=>'error', 'msg'=>validation_errors()));
			} 
		else
    	{
        		$id=$this->input->post('task_id');
    			$current_date=date("Y-m-d H:i:s");
				$set_data = array(
				'title' 		=>trim($this->input->post('title')),
				'description' 	=>trim($this->input->post('description')),
				'priority' 	=>trim($this->input->post('priority')),
				'status_id' 	=>trim($this->input->post('status')),
				'assign_to' 	=>trim($this->input->post('user_id')),
				'updated_on' 	=>$current_date						
				);
				$updatestatus=$this->task_model->updatetask($set_data,$id);
				echo json_encode(array('response'=>'success'));
			
	    }
      
       }
      					
	}


	public function delete()
	{
		if(isset($_GET['id']))
		{


		$id=$this->input->get('id');
		$set_data = array('status_id' =>3);

		$updatestatus=$this->task_model->updatetask($set_data,$id);
		
		redirect(base_url().'user/tasklist/', 'refresh');
		}
		
		
	}
	
	
}