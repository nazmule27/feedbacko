<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_home extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('admin_home_model');
        $this->load->model('instructor_home_model');
        if((($this->session->userdata('role'))!=='admin')) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }

    public function index() {
        $data['my_courses'] = $this->admin_home_model->getCourses();
        $this->load->view('admin_home_view', $data);
    }
    public function feedback_summery_course_wise( $cid, $semid) {
        $data['course_feedback'] = $this->instructor_home_model->getFeedbackSummeryForCourse($cid, $semid);
        $data['course_comment'] = $this->instructor_home_model->getCommentForCourse($cid, $semid);
        $data['course_id']=$cid;
        $data['semester_id']=$semid;
        $this->load->view('course_feedback_summery_view', $data);
    }
    public function feedback_summery_teacher_wise($tid, $cid, $semid) {
        $data['teacher_feedback'] = $this->instructor_home_model->getFeedbackSummeryForTeacher($tid, $cid, $semid);
        $data['instructor_comment'] = $this->instructor_home_model->getCommentForInstructor($tid, $cid, $semid);
        $data['teacher_id']=$tid;
        $data['course_id']=$cid;
        $data['semester_id']=$semid;
        $this->load->view('instructor_feedback_summery_view', $data);
    }

}
?>