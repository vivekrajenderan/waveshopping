<?php

class Report_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->helper('url');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    public function addExtra_Expense($data) {

        $this->db->insert('extra_expenses', $data);
        return $this->db->insert_id();
    }

    public function addInvoice($data) {

        $this->db->insert('invoice', $data);
        return $this->db->insert_id();
    }

    function purchase_shop_list() {
        $row = array();
        $this->db->select('*');
        $this->db->from('purchase_shop');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function deliver_pickup_list() {
        $row = array();
        $this->db->select('*');
        $this->db->from('delivered_pickup_by');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function payment_mode_list() {
        $row = array();
        $this->db->select('*');
        $this->db->from('payment_mode');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function expense_type_list() {
        $row = array();
        $this->db->select('*');
        $this->db->from('expense_type');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function month_common_List($start_date, $end_date) {
        $row = array();
        $list_array = array();

        //Total Orders
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('order_date >=', $start_date);
        $this->db->where('order_date <=', $end_date);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->result_array();
            $list_array['total_orders'] = count($row);
        } else {
            $list_array['total_orders'] = 0;
        }

        //Total Canceled Order
        $this->db->select('payment_mode.id,payment_mode.name,count(invoice.payment_id) as total_cancel');
        $this->db->from('payment_mode');
        $this->db->join('invoice', 'payment_mode.id=invoice.payment_id');
        $this->db->where('invoice.order_date >=', $start_date);
        $this->db->where('invoice.order_date <=', $end_date);
        $this->db->where('payment_mode.id', 4);
        $this->db->group_by('invoice.payment_id');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->result_array();
            $list_array['total_cancel_order'] = $row[0]['total_cancel'];
        } else {
            $list_array['total_cancel_order'] = 0;
        }

        //Total Purchase and Deliver Order
        $this->db->select('id,sum(purchase_price) as total_purchase,sum(deliver_cost) as total_deliver');
        $this->db->from('invoice');
        $this->db->where('order_date >=', $start_date);
        $this->db->where('order_date <=', $end_date);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->result_array();
            $list_array['total_purchase'] = $row[0]['total_purchase'];
            $list_array['total_deliver'] = $row[0]['total_deliver'];
        } else {
            $list_array['total_purchase'] = 0;
            $list_array['total_deliver'] = 0;
        }

        return $list_array;
    }

    function month_extra_expenseList($start_date, $end_date) {

        $row = array();
        $this->db->select('expense_type.id,expense_type.name,sum(extra_expenses.amount) as expense_amount');
        $this->db->from('expense_type');
        $this->db->join('extra_expenses', 'expense_type.id = extra_expenses.type_id');
        $this->db->where('extra_expenses.expense_date >=', $start_date);
        $this->db->where('extra_expenses.expense_date <=', $end_date);
        $this->db->group_by('extra_expenses.type_id');

        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function month_deliveredList($start_date, $end_date) {

        $row = array();
        $this->db->select('delivered_pickup_by.id,delivered_pickup_by.name,count(invoice.deliver_pickup_id) as total_deliver');
        $this->db->from('delivered_pickup_by');
        $this->db->join('invoice', 'delivered_pickup_by.id=invoice.deliver_pickup_id');
        $this->db->where('invoice.order_date >=', $start_date);
        $this->db->where('invoice.order_date <=', $end_date);
        $this->db->group_by('invoice.deliver_pickup_id');

        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function month_paymentmodeList($start_date, $end_date) {

        $row = array();
        $this->db->select('payment_mode.id,payment_mode.name,sum(invoice.cash_received) as total_cash');
        $this->db->from('payment_mode');
        $this->db->join('invoice', 'payment_mode.id=invoice.payment_id');
        $this->db->where('invoice.order_date >=', $start_date);
        $this->db->where('invoice.order_date <=', $end_date);
        $this->db->group_by('invoice.payment_id');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

    function month_report_view_List($start_date, $end_date) {
        $row = array();
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('order_date >=', $start_date);
        $this->db->where('order_date <=', $end_date);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return $row;
        }
    }

}
