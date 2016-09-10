<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();

        date_default_timezone_set('America/New_York');
        $this->load->helper('url');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    public function addpurchase_shop($data) {

        $this->db->insert('purchase_shop', $data);
        if ($this->db->affected_rows() >= 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updatepurchase_shop($set_data, $id) {

        $this->db->where('md5(id)', $id);
        $this->db->update('purchase_shop', $set_data);
        return 1;
    }

    function deletepurchase_shop($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete('purchase_shop');
    }

    function getPurchase_shopList($id) {
        $row = array();
        $this->db->select('*');
        $this->db->from('purchase_shop');
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function Purchase_shopList() {
        $row = array();
        $this->db->select('*');
        $this->db->from('purchase_shop');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    public function adddeliver_pickup($data) {

        $this->db->insert('delivered_pickup_by', $data);
        if ($this->db->affected_rows() >= 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updatedeliver_pickup($set_data, $id) {

        $this->db->where('md5(id)', $id);
        $this->db->update('delivered_pickup_by', $set_data);
        return 1;
    }

    function deletedeliver_pickup($id) {
        $this->db->where('md5(id)', $id);
        $this->db->delete('delivered_pickup_by');
    }

    function getDeliver_PickupList($id) {
        $row = array();
        $this->db->select('*');
        $this->db->from('delivered_pickup_by');
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function Deliver_PickupList() {
        $row = array();
        $this->db->select('*');
        $this->db->from('delivered_pickup_by');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

}
