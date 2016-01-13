<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
$full_name = $CI->session->userdata('full_name');
?>

<div class="container paddingT75">
    <div class="row">
        <div class="col-md-12 col-ms-12 col-xs-12">
            <h4>Feedback List:</h4>
            <br>
            <?php $k=1; for ($i = 0; $i < count($my_courses); ++$i) {?>

                <p><?php echo $k.'. ('.$my_courses[$i]->semester_id.') <a href="'.base_url().'admin_home/feedback_summery_course_wise/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'">'.$my_courses[$i]->course_id.'</a> &raquo;'.' <a href="'.base_url().'admin_home/feedback_summery_teacher_wise/'.$my_courses[$i]->teacher_id.'/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'"> '.$my_courses[$i]->teacher_id.'</a>' ?> </p>
                <?php $k++;} ?>
        </div>

    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>
