<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
?>
<div class="container paddingT75">
    <div class="row">
        <div class="col-lg-12">
            <h3>Post a news</h3>
            <br>
            <div class="row">
                <form method="post" action="<?=base_url();?>manage_news/upload" enctype="multipart/form-data">
                    <div class="form-group col-md-7 col-sm-6">
                        <input type="text" id="news_heading" name="news_heading" class="form-control custom-text"  placeholder="Give News Heading *" required>
                    </div>
                    <div class="form-group col-md-5 col-sm-6">
                        <input type="text" id="news_published_date" name="news_published_date" class="form-control custom-text"  placeholder="Select Published Date *" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Select news file (.pdf/.doc)</label>
                        <input type="file" name="news_file_name" id="news_file_name" required>
                        <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-default custom-text"><i class="glyphicon glyphicon-cloud-upload"></i> Post News</button>
                    </div>
                </form>
            </div>
            <?php if (isset($success_msg)) { echo $success_msg; } ?>
            <div class="sign-bottom"></div>
        </div>
    </div>
</div>
<!-- /post_news -->

<?php
$this->load->view('common/footer');
?>
