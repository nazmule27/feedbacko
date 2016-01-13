<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_news extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('manage_news_model');
        if((($this->session->userdata('role'))!=='admin')&&(($this->session->userdata('role'))!=='superadmin')) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function index() {
        $data['all_news'] = $this->manage_news_model->getNews();
        $this->load->view('news_list_view', $data);
    }
    public function delete_news($id) {
        $this->manage_news_model->deleteNewsById($id);
        $data['all_news'] = $this->manage_news_model->getNews();
        $this->load->view('news_list_view', $data);
    }
    public function load_edit_news($news_id) {
        $data['e_news'] =$this->manage_news_model->getNewsById($news_id);
        $this->load->view('edit_news_view', $data);
    }
    public function update_news($news_id) {
        $heading=$this->input->post('news_heading');
        if(isset($_POST['status'])) {
            $status='active';
        }
        else {
            $status='inactive';
        }
        $data = array(
            'heading' => $heading,
            'status' => $status,
        );
        $this->manage_news_model->updateNews($news_id, $data);
        $data['e_news'] =$this->manage_news_model->getNewsById($news_id);

        $data['success_msg'] = '<div class="alert alert-success text-center">News updated successfully.<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
        //$this->load->view('edit_news_view', $data);
        redirect('manage_news');
    }
    public function post_news() {
        $this->load->view('post_news_view');

    }
    public function upload() {
        $config['upload_path'] = 'assets/img/news/';
        $config['allowed_types'] = 'doc|pdf';
        $config['max_size']    = '1000';

        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('news_file_name'))
        {
            // case - failure
            $upload_error = array('error' => $this->upload->display_errors());
            $this->load->view('post_news_view', $upload_error);
        }
        else
        {
            // case - success
            $upload_data = $this->upload->data();

            $CI = &get_instance();
            $student_id = $CI->session->userdata('username');

            $data = array(
                'heading' => $this->input->post('news_heading'),
                'file_name' => $upload_data['file_name'],
                'published_date' => $this->input->post('news_published_date'),
                'published_by' => $student_id,
            );
            $this->manage_news_model->saveNews($data);
            $data['success_msg'] = '<div class="alert alert-success text-center">Your News <strong>'.'<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a>'. $data['heading'].' and file '.$upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
            $this->load->view('post_news_view', $data);
        }
    }

}
?>