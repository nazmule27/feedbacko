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
            <h4>Feedback Given List:</h4>
            <br>
            <div class="row">
                <div class="col-md-10 col-ms-10 col-xs-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <!--<th>Semester Name</th>-->
                            <th>Student ID</th>
                            <th>Student Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $k=1; for ($i = 0; $i < count($given_list); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <!--<td><?php /*echo $my_courses[$i]->semester_id*/?></td>-->
                                <td>
                                    <?php echo $given_list[$i]->student_id ?>
                                </td>
                                <td>
                                    <?php echo $given_list[$i]->full_name ?>
                                </td>
                            </tr>
                            <?php $k++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>
