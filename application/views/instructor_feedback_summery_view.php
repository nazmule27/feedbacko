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
            <h4>Feedback Summary on instructor <?php echo  $instructor_name[0]->full_name;?> of <?php echo $course_name[0]->course_name; ?></h4>
            <a class="download-pdf" href="<?php echo base_url().'super_admin_home/instructor_feedback_pdf/'.$teacher_id.'/'.$course_id.'/'.$semester_id ?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Statement</th>
                    <th width="50">Excellent</th>
                    <th width="50">Very Good</th>
                    <th width="50">Good</th>
                    <th width="50">Average</th>
                    <th width="50">Poor</th>
                    <th width="50">Average point</th>
                </tr>
                </thead>
                <tbody>
                <?php $k=1; $each_avg=0; for ($i = 0; $i < count($teacher_feedback); ++$i) {?>
                    <tr>
                        <td><?php echo $k;?></td>
                        <td><?php echo $teacher_feedback[$i]->question;?></td>
                        <td><?php echo $teacher_feedback[$i]->count4;?></td>
                        <td><?php echo $teacher_feedback[$i]->count3;?></td>
                        <td><?php echo $teacher_feedback[$i]->count2;?></td>
                        <td><?php echo $teacher_feedback[$i]->count1;?></td>
                        <td><?php echo $teacher_feedback[$i]->count0;?></td>
                        <td>
                            <?php
                            $total=($teacher_feedback[$i]->count4)+($teacher_feedback[$i]->count3)+($teacher_feedback[$i]->count2)+($teacher_feedback[$i]->count1)+($teacher_feedback[$i]->count0);
                            $points=(($teacher_feedback[$i]->count4)*5)+(($teacher_feedback[$i]->count3)*4)+(($teacher_feedback[$i]->count2)*3)+(($teacher_feedback[$i]->count1)*2)+(($teacher_feedback[$i]->count0)*1);
                            if($total!=0){
                                $each_avg+=($points/$total);
                                echo round($points/$total,2);
                            }
                            else echo 'N/A';
                            ?>
                        </td>
                    </tr>
                    <?php $k++;} ?>
                </tbody>
            </table>
            <div class="avg-point">
                <?php echo '<b>Overall Average Point: '.round($each_avg/15,2).'</b>';?>
            </div>
            <h4>Expected Grade</h4>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Grade</th>
                            <th>Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $k=1; for ($i = 0; $i < count($grade_count_instructor); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <td><?php echo $grade_count_instructor[$i]->grade;?></td>
                                <td><?php echo $grade_count_instructor[$i]->counts;?></td>
                            </tr>
                            <?php $k++;} ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">
                    <p>
                        Average weekly spent hour for this course outside the class (Approx.): <?php echo $avg_spent_hour_course_instructor[0]->w_spent_time_hour; ?>
                    </p>
                </div>
            </div>
            <h4>Comments:</h4>
            <a class="download-pdf" href="<?php echo base_url().'super_admin_home/instructor_feedbackComments_pdf/'.$teacher_id.'/'.$course_id.'/'.$semester_id ?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            <br>
            <?php $k=1; for ($i = 0; $i < count($instructor_comment); ++$i) {?>
                <p><?php echo $k.'. '.$instructor_comment[$i]->comments;?></p>
            <?php $k++;} ?>
        </div>

    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>

