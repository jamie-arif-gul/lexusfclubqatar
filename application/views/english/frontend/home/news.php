
<div class="col-sm-12 p0">
    <div class="container p0  reg_main_mrg">
        <h3 class="news_heading">NEWS</h3>
        <div class="registration_bg" id="news_main">
            <?php foreach ($result as $value) { ?>
                <div class="col-sm-12 p0 news_detail">
                    <div class="col-sm-3">
                        <img src="<?php echo base_url() . 'uploads/news_image/' . $value['news_image']; ?>">
                    </div>
                    <div class="col-sm-9">
                        <h3><?php echo $value['title']; ?></h3>
                        <p><?php echo $value['description']; ?></p>
                    </div>
                </div>
            <?php } ?>

            <?php echo $pagination; ?>

            <div class="clearfix"></div>
        </div>
    </div>
</div>