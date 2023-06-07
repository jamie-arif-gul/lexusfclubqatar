<div class="col-sm-12 p0">
    <div class="container p0 reg_main_mrg">
        <h3 class="news_heading_arabic">الأخبار</h3>
        <div class="registration_bg" id="news_main_arabic">
            <?php foreach ($result as $value) { ?>
                <div class="col-sm-12 p0 news_detail news_arabic_flex">
                    <div class="col-sm-9">
                        <h3><?php echo $value['title']; ?></h3>
                        <p><?php echo $value['description']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <img src="<?php echo base_url() . 'uploads/news_image/' . $value['news_image']; ?>">
                    </div>

                </div>
            <?php } ?>
            <?php echo $pagination; ?>
            <div class="clearfix"></div>
        </div>
         
    </div>
    
</div>