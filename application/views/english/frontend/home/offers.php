<div class="col-sm-12 p0">
    <div class="container p0  reg_main_mrg">
        <div class="registration_bg" id="offers_main">

            <h3><?php echo $result_c[0]['title'] ;?></h3>
            <p><?php echo $result_c[0]['description'] ;?></p>
            <!--<p>Our wide range of special offers means vehicle ownership is straightforward and affordable from start to finish. For more information about what is currently available you can follow the links below and fill in the online enquiry form and our friendly sales team will get back to you with expert help and advice as soon as they can.</p>-->
            <?php
            $o = 0;
            foreach ($result as $value) {
                ?>
                <div class="col-sm-6">
                    <img src="<?php echo base_url() . 'uploads/offers_image/' . $value['offers_image']; ?>">
                    <label> <?php echo $value['title'] ?></label>
                </div>

                <?php if ($o % 2 != 0) { ?>
                    <div class="clearfix"></div>
                <?php } ?>
                <?php $o++;
            } ?>
            <div class="clearfix"></div>
<?php echo $pagination; ?>
        </div>

    </div>
</div>
