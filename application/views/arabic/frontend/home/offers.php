<div class="col-sm-12 p0">
    <div class="container p0 reg_main_mrg">
        <div class="registration_bg" id="offers_main_arabic">
            <h3><?php echo $result_c[0]['title'] ;?></h3>
            <p><?php echo $result_c[0]['description'] ;?></p><?php 
            $o=0;
            foreach($result as $value){
             ?>
            <div class="col-sm-6">
                <img src="<?php echo base_url().'uploads/offers_image/'.$value['offers_image'] ;?>">
                <label>   <?php echo $value['title']?></label>
            </div>
            
            <?php  if ($o%2 != 0 ){?>
            <div class="clearfix"></div>
            <?php  } ?>
            <?php $o++; } ?>
            <div class="clearfix"></div>
            <?php echo $pagination;?>
        </div>

    </div>
</div>