<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//error_reporting(0);

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');

        $this->load->model('users_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('userid') == "") {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function index() {
        $data['PurchaseShopList'] = $this->users_model->Purchase_shopList();
        //echo "<pre>";print_r($data['PurchaseShopList']);die; 
        $this->load->view('includes/header');
        $this->load->view('user/ShopList', $data);
        $this->load->view('includes/footer');
    }

    public function add_purchase_shop() {
        $msg = "";
        $post_set['name'] = '';
        $post_set['email'] = '';
        $post_set['status'] = '';
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[30]|valid_email|is_unique[purchase_shop.email]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() === TRUE) {
                $set_data = array(
                    'name' => trim($this->input->post('name')),
                    'email' => trim($this->input->post('email')),
                    'status' => trim($this->input->post('status'))
                );
                $addPurchaseShop = $this->users_model->addpurchase_shop($set_data);
                if ($addPurchaseShop == 1) {
                    $this->session->set_flashdata('successmsg', 'Purchase Shop has been added successfully');
                    redirect(base_url() . 'users/', 'refresh');
                } else {
                    $msg = "Purchase Shop has been not added successfully";
                    $post_set = $_POST;
                }
            } else {
                $msg = validation_errors();
                $post_set = $_POST;
            }
        }
        $data = array('msg' => $msg, 'post_set' => $post_set, 'Title' => 'Add');


        $this->load->view('includes/header');
        $this->load->view('user/addEditPurchaseShop', $data);
        $this->load->view('includes/footer');
    }

    public function edit_purchase_shop($id = NULL) {
        $msg = "";
        $PurchaseList = $this->users_model->getPurchase_shopList($id);
        if (count($PurchaseList) > 0) {
            $post_set = $PurchaseList[0];
            if (($this->input->server('REQUEST_METHOD') == 'POST')) {
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[30]|valid_email');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
                if ($this->form_validation->run() === TRUE) {
                    $set_data = array(
                        'name' => trim($this->input->post('name')),
                        'email' => trim($this->input->post('email')),
                        'status' => trim($this->input->post('status'))
                    );
                    $update_rest = $this->users_model->updatepurchase_shop($set_data, $id);
                    if ($update_rest == 1) {
                        $this->session->set_flashdata('successmsg', 'Purchase Shop has been updated successfully');
                        redirect(base_url() . 'users/', 'refresh');
                    }
                } else {
                    $msg = validation_errors();
                    $post_set = $_POST;
                }
            }
            $data = array('msg' => $msg, 'post_set' => $post_set, 'Title' => 'Edit');


            $this->load->view('includes/header');
            $this->load->view('user/addEditPurchaseShop', $data);
            $this->load->view('includes/footer');
        } else {
            redirect(base_url() . 'users/', 'refresh');
        }
    }

    public function delete_PurchaseShop($id = NULL) {
        if ($id != "") {
            $delete_Shop = $this->users_model->deletepurchase_shop($id);
            $this->session->set_flashdata('successmsg', 'Purchase Shop has been deleted successfully');
            redirect(base_url() . 'users/', 'refresh');
        } else {
            redirect(base_url() . 'users/', 'refresh');
        }
    }

    public function Deliver_pickupList() {
        $data['DeliverPickupList'] = $this->users_model->Deliver_PickupList();
        //echo "<pre>";print_r($data['DeliverPickupList']);die; 
        $this->load->view('includes/header');
        $this->load->view('user/DeliveryPickupList', $data);
        $this->load->view('includes/footer');
    }

    public function add_deliver_pickup() {
        $msg = "";
        $post_set['name'] = '';
        $post_set['email'] = '';
        $post_set['status'] = '';
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[30]|valid_email|is_unique[purchase_shop.email]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() === TRUE) {
                $set_data = array(
                    'name' => trim($this->input->post('name')),
                    'email' => trim($this->input->post('email')),
                    'status' => trim($this->input->post('status'))
                );
                $addDeliverPickup = $this->users_model->adddeliver_pickup($set_data);
                if ($addDeliverPickup == 1) {
                    $this->session->set_flashdata('successmsg', 'Delivered / Pickup by has been added successfully');
                    redirect(base_url() . 'users/Deliver_pickupList', 'refresh');
                } else {
                    $msg = "Purchase Shop has been not added successfully";
                    $post_set = $_POST;
                }
            } else {
                $msg = validation_errors();
                $post_set = $_POST;
            }
        }
        $data = array('msg' => $msg, 'post_set' => $post_set, 'Title' => 'Add');


        $this->load->view('includes/header');
        $this->load->view('user/addEditDeliverPickup', $data);
        $this->load->view('includes/footer');
    }

    public function edit_deliver_pickup($id = NULL) {
        $msg = "";
        $PurchaseList = $this->users_model->getDeliver_PickupList($id);
        if (count($PurchaseList) > 0) {
            $post_set = $PurchaseList[0];
            if (($this->input->server('REQUEST_METHOD') == 'POST')) {
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[30]|valid_email');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
                if ($this->form_validation->run() === TRUE) {
                    $set_data = array(
                        'name' => trim($this->input->post('name')),
                        'email' => trim($this->input->post('email')),
                        'status' => trim($this->input->post('status'))
                    );
                    $update_rest = $this->users_model->updatedeliver_pickup($set_data, $id);
                    if ($update_rest == 1) {
                        $this->session->set_flashdata('successmsg', 'Delivered / Pickup by has been updated successfully');
                        redirect(base_url() . 'users/Deliver_pickupList', 'refresh');
                    }
                } else {
                    $msg = validation_errors();
                    $post_set = $_POST;
                }
            }
            $data = array('msg' => $msg, 'post_set' => $post_set, 'Title' => 'Edit');


            $this->load->view('includes/header');
            $this->load->view('user/addEditDeliverPickup', $data);
            $this->load->view('includes/footer');
        } else {
            redirect(base_url() . 'users/Deliver_pickupList', 'refresh');
        }
    }

    public function delete_deliver_pickup($id = NULL) {
        if ($id != "") {
            $delete_DeliverPickup = $this->users_model->deletedeliver_pickup($id);
            $this->session->set_flashdata('successmsg', 'Delivered / Pickup by has been deleted successfully');
            redirect(base_url() . 'users/Deliver_pickupList', 'refresh');
        } else {
            redirect(base_url() . 'users/Deliver_pickupList', 'refresh');
        }
    }

}
