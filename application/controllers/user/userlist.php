<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlist extends CI_Controller {

	
	
	public function __construct() 
    {
        parent::__construct();   

        $this->load->helper('url');	 
        $this->load->library('session');
        $this->load->helper('form'); 
		
		$this->load->model('user/user_model');

		if($this->session->userdata('userid')=="") {
			redirect(base_url().'user/login/', 'refresh');
		} 

			
    }
	
	public function index()
	{

		
		$totalUserlist=$this->user_model->userList();	
		
		$data=array('totalUserlist'=>$totalUserlist,
		);
		
		$this->load->view('includes/header');
		$this->load->view('user/userlist',$data);
		$this->load->view('includes/footer');
		
	}

	

	
}