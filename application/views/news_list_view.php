<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
?>
<div class="container paddingT75">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-12">


                    <h3>Feedback News</h3>
                    <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Description</th>
                                <th>Published Date</th>
                                <th>Status</th>
                                <th colspan="2" class="txt-center">Option</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php $k=1; for ($i = 0; $i < count($all_news); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <td><?php echo $all_news[$i]->heading;?></td>
                                <td><?php echo date('Y-m-d', strtotime($all_news[$i]->published_date));?></td>
                                <td><?php echo $all_news[$i]->status;?></td>
                                <td><a href="<?=base_url();?>manage_news/load_edit_news/<?=$all_news[$i]->id;?>"> Edit </a></td>
                                <td><a href="<?=base_url();?>manage_news/delete_news/<?=$all_news[$i]->id;?>" onclick="return confirm('Are you sure you want to delete this item?');"> Delete </a></td>
                            </tr>
                        <?php $k++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /news -->

<?php
$this->load->view('common/footer');
?>
