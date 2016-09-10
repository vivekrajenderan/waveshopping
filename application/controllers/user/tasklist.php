<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasklist extends CI_Controller {

	
	
	public function __construct() 
    {
        parent::__construct();   

        $this->load->helper('url');	 
        $this->load->library('session');
        $this->load->helper('form'); 
		
		$this->load->model('user/user_model');
		$this->load->model('user/task_model');

		if($this->session->userdata('userid')=="") {
			redirect(base_url().'user/login/', 'refresh');
		} 

			
    }
	
	public function index()
	{

		$statusList=$this->task_model->statusList();
		$taskList=$this->task_model->taskList();
		$post_set['status']='';
		$ErrorMessage="";	

		if (($this->input->server('REQUEST_METHOD') == 'POST')) {
			$this->form_validation->set_rules('status', 'Status', 'trim|required');

			if($this->form_validation->run() == FALSE)
			{
				$ErrorMessage=validation_errors();
				
				
				$post_set=$_POST;	
				
				
			}
			else{

				$taskList=$this->task_model->getSelectedtask($this->input->post('status'));
				$post_set=$_POST;
			}

		}


		
		$data=array('taskList'=>$taskList,'statusList'=>$statusList,'ErrorMessage' => $ErrorMessage,
			'post_set' => $post_set,
		);
		
		$this->load->view('includes/header');
		$this->load->view('user/tasklist',$data);
		$this->load->view('includes/footer');
		
	}

	/*public function ajaxtasklist()
	{

		$id=$this->input->post('id');
		$taskList=$this->task_model->getSelectedtask($id);
		$data=array('taskList'=>$taskList);
		$this->load->view('user/ajaxtasklist',$data);

	}*/



	

	
}