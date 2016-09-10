<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(0);

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');

        $this->load->model('login_auth');
        $this->load->library('form_validation');
        if ($this->session->userdata('userid') != "") {
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }

    public function index() {
        $msg = "";
        $post_set['username'] = "";
        $post_set['password'] = "";

        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('password', 'Last Name', 'trim|required|maxn_length[30]');
            if ($this->form_validation->run() === TRUE) {
                $login_verify = $this->login_auth->login_verify(trim($this->input->post('email')), trim($this->input->post('password')));
                if ($login_verify == 1) {
                    redirect(base_url() . 'dashboard', 'refresh');
                } else {
                    $msg = "Invalid Credential";
                }
            } else {
                $post_set = $_POST;
            }
        }
        $data = array('post_set' => $post_set, 'msg' => $msg);

        $this->load->view('user/login', $data);
    }

    public function register() {
        $msg = "";
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[30]|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Last Name', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            if ($this->form_validation->run() === TRUE) {
                $set_data = array(
                    'email' => trim($this->input->post('email')),
                    'password' => trim(md5($this->input->post('password'))),
                    'name' => trim($this->input->post('name')),
                    'gender' => trim($this->input->post('gender')),
                    'status' => 1
                );
                $addUser = $this->login_auth->adduser($set_data);
                if ($addUser == 1) {
                    $this->session->set_flashdata('successmsg', 'Register has been added successfully');
                    redirect(base_url() . 'login/', 'refresh');
                } else {
                    $msg = "Signup is not successfully.";
                }
            } else {
                $msg = validation_errors();
            }
        }
        $data = array('msg' => $msg);

        $this->load->view('user/register', $data);
    }

    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */