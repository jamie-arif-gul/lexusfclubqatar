             
<?php if ($this->session->flashdata('notActive') != "") { ?>
<div class="alert alert-info container" style="border-radius:0;">    
    <?php print_r($this->session->flashdata('notActive')); ?>
</div>
<?php } ?>
<?php $this->load->view('frontend/includes/search'); ?>
<!-- content area start -->
      <div class="container-fluid featured-listing">
          <div class="container">
              <h1 class="section-heading"><i class="watermark"></i> featured listings </h1>
                <div class="clear5"></div>
                <p class="section-des"></p>
                <div class="clear20"></div>
                <div class="section-data" id="listings">
                <?php if($featured){ $i=1; foreach($featured as $result){ 
            $img_src = 'images/default_image.png';
            if($result['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $result['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$result['image'];}
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="list padding0">
                        <span class="list-label"><p>rent</p></span>
                            <img src="<?php echo $img_src; ?>" class="list-thumb" alt="" />
                            <div class="clear20"></div>
                            <div class="list-details">
                                <!-- <p class="list-title">Apartment:</p> -->
                                <p class="list-desc"><?php echo $result['city']; ?>, <?php echo $result['state']; ?>, <?php echo $result['country']; ?></p>
                                
                                <p class="list-desc"># of Bedrooms: <?php echo $result['bedrooms']; ?></p>
                                <p class="list-desc"># of Bathrooms: <?php echo $result['bathrooms']; ?></p>
                                <!-- <div class="list-tags"><a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a></div> -->
                                <div class="clear10"></div>
                                <p class="list-price">$<?php echo $result['price'].'.00'; ?></p>
                                <div class="rateit bigstars" style="padding:8px;" data-rateit-value="<?php echo get_rating($result['property_id']); ?>" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-readonly="true"></div>
                                <div class="clear5"></div>
                                <a href="<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>" class="pull-right readmore-list"> <i class="fa fa-arrow-right"></i> </a>
                            </div>
                        </div>
                  </div>
                <?php $i++; } } ?>

                    <div class="clear50"></div>
            </div>
        </div>
      </div>
        

      <!-- popular listing -->
      
      <div class="container-fluid popular-listing">
          <div class="container">
              <h1 class="section-heading" style="font-size:45px;"><i class="watermark"></i> Most Popular Listings </h1>
                <div class="clear5"></div>
                <p class="section-des"></p>
                <div class="clear20"></div>
                <div class="section-data">
                  <?php if($featured){ $i=1; foreach($featured as $result){ 
            $img_src = 'images/default_image.png';
            if($result['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $result['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$result['image'];}
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="list padding0">
                        <span class="list-label"><p>rent</p></span>
                            <img src="<?php echo $img_src; ?>" class="list-thumb" alt="" />
                            <div class="clear20"></div>
                            <div class="list-details">
                                <!-- <p class="list-title">Apartment:</p> -->
                                <p class="list-desc"><?php echo $result['city']; ?>, <?php echo $result['state']; ?>, <?php echo $result['country']; ?></p>
                                
                                <p class="list-desc"># of Bedrooms: <?php echo $result['bedrooms']; ?></p>
                                <p class="list-desc"># of Bathrooms: <?php echo $result['bathrooms']; ?></p>
                                <!-- <div class="list-tags"><a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a></div> -->
                                <div class="clear10"></div>
                                <p class="list-price">$<?php echo $result['price'].'.00'; ?></p>
                                <div class="rateit bigstars" style="padding:8px;" data-rateit-value="<?php echo get_rating($result['property_id']); ?>" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-readonly="true"></div>
                                <div class="clear5"></div>
                                <a href="<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>" class="pull-right readmore-list"> <i class="fa fa-arrow-right"></i> </a>
                            </div>
                        </div>
                  </div>
                <?php $i++; } } ?>
                
                
                <div class="clearfix"></div>
            </div>
        </div>
       
      </div>