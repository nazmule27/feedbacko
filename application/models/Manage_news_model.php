<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_news_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
        if(empty($this->session->userdata('role'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function getNews() {
        $this->db->select("*");
        $this->db->from("feedback_news");
        $this->db->order_by("published_date desc");
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function getNewsById($news_id) {
        $this->db->select("*");
        $this->db->from("feedback_news");
        $this->db->where("id", $news_id);
        $query = $this->db->get();

        return $result = $query->result();
    }

    public function updateNews($nid, $data) {
        $this->db->where('id',$nid);
        $this->db->update('feedback_news', $data);
    }

    public function deleteNewsById($news_id) {
        $this->db->where('id', $news_id);
        $this->db->delete('feedback_news');
    }

    public function saveNews($data)
    {
        $this->db->insert('feedback_news', $data);
    }


    function __destruct() {
        $this->db->close();
    }

}