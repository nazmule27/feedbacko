<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('instructor_home_model');
        $this->load->model('admin_home_model');
        $this->load->model('course_feedback_model');
        if(($this->session->userdata('role'))!=='teacher') {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }

    public function index() {
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $data['my_courses'] = $this->instructor_home_model->getCourses($tid);
        $this->load->view('instructor_home_view', $data);
    }
    public function feedback_summery_course_wise($cid, $semid) {
        $data['course_feedback'] = $this->instructor_home_model->getFeedbackSummeryForCourse($cid, $semid);
        $data['course_comment'] = $this->instructor_home_model->getCommentForCourse($cid, $semid);
        $data['course_id']=$cid;
        $data['semester_id']=$semid;
        $data['course_name'] = $this->course_feedback_model->getCourseName($cid);
        $data['avg_spent_hour_course'] = $this->admin_home_model->getAvgSpentHourCourseWise($cid);
        $data['grade_count'] = $this->admin_home_model->getGradesCount($cid);
        $this->load->view('course_feedback_summery_view', $data);
    }
    public function feedback_summery_teacher_wise($tid, $cid, $semid) {
        $data['teacher_feedback'] = $this->instructor_home_model->getFeedbackSummeryForTeacher($tid, $cid, $semid);
        $data['instructor_comment'] = $this->instructor_home_model->getCommentForInstructor($tid, $cid, $semid);
        $data['teacher_id']=$tid;
        $data['course_id']=$cid;
        $data['semester_id']=$semid;
        $data['course_name'] = $this->course_feedback_model->getCourseName($cid);
        $data['instructor_name'] = $this->admin_home_model->getInstructorNameOnly($tid);
        $data['avg_spent_hour_course_instructor'] = $this->admin_home_model->getAvgSpentHourInstructorWise($cid, $tid);
        $data['grade_count_instructor'] = $this->admin_home_model->getGradesCountInstructor($cid, $tid);
        $this->load->view('instructor_feedback_summery_view', $data);
    }

}
?>