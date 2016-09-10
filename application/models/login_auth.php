<?php

class Login_auth extends CI_Model {

    function __construct() {
        parent::__construct();

        date_default_timezone_set('America/New_York');
        $this->load->helper('url');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    function login_verify($email, $password) {
        $row = array();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->result_array();
            $session_data = array(
                'userid' => $row[0]['id'],
                'name' => $row[0]['name'],
                'email' => $row[0]['email']
            );

            $this->session->set_userdata($session_data);
            return 1;
        } else {
            return 0;
        }
    }

    public function adduser($data) {

        $this->db->insert('users', $data);
        if ($this->db->affected_rows() >= 0) {
            return 1;
        } else {
            return 0;
        }
    }

}
