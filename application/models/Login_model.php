<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @name: Login model
 * @author: Nazmul
 */
class Login_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($data) {
        $this->db->where('username', $data['username']);
        //$this->db->where('password', md5($data['password']));
        $this->db->where('password', $data['password']);
        return $this->db->get('feedback_users')->row();
    }
    public function data_user($data) {
        $this->db->select("*");
        $this->db->from("feedback_users");
        $this->db->where('username', $data['username']);
        $query = $this->db->get();
        return $result = $query->row();
    }
    public function semester_user() {
        $this->db->select("semester_name");
        $this->db->from("semester_list");
        $this->db->order_by("id desc");
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->row();
    }

    function __destruct() {
        $this->db->close();
    }

}