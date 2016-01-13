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
                    <?php for ($i = 0; $i < count($all_news); ++$i) { ?>

                    <p><a href="assets/img/news/<?php echo $all_news[$i]->file_name;?>" target="_blank"><i class="glyphicon glyphicon-pushpin"></i> <?php echo $all_news[$i]->heading;?> <i class="newsDate"> [<?php echo date('Y-m-d', strtotime($all_news[$i]->published_date));?>] </i></a></p>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /news -->

<?php
$this->load->view('common/footer');
?>
