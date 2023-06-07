<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
      <div class="container-fluid featured-listing">
          <div class="container">
              <h1 class="section-heading"><i class="watermark"></i> All Properties </h1>
                <div class="clear20"></div>
                <p class="section-des"></p>
                <div class="clear20"></div>
                <?php $this->load->view('errors'); ?>
                <div class="section-data" id="listings">
                <?php if($results){ $i =0; foreach ($results as $result) { ?>
                <?php
                   $img_src = 'images/listing-thumbnail.jpg';
                   if($result['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $result['image']))){
                    //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
                    $img_src = base_url('uploads/img_gallery/property_images').'/'.$result['image'];
                   }
                ?>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 property">
                    <a href="<?php echo base_url('properties/addFavorite').'/'.$uri.'/'.encode_url($result['property_id']); ?>" class="favorite-btn"><i class="fa fa-heart-o"></i></a>
                      <div class="list padding0">
                        <span class="list-label"><p>rent</p></span>
                        <img src="<?php echo $img_src; ?>" height="225" class="list-thumb" alt="" />
                        <div class="clear20"></div>
                        <div class="list-details">
                            <p class="list-desc"><?php echo $result['city']; ?>, <?php echo $result['state']; ?>, <?php echo $result['country']; ?></p>
                            <p class="list-desc"># of Bedrooms: <?php echo $result['bedrooms']; ?></p>
                            <p class="list-desc"># of Bathrooms: <?php echo $result['bathrooms']; ?></p>
                            <p class="list-price">$<?php echo $result['price']; ?></p>
                            
                            <!--add rating and reviews start-->
                            
                            <!--add review start-->                           
                            <div id="<?php echo $result['property_id']*99; ?>" class="add_review">
                            <div>
                            Thanks for your rating. Consider leaving a review and let others know more about your experience.
                            <button type="button" class="btn btn-xs btn-review pull-right" onclick="show_popup(<?php echo $result['property_id']*99; ?>)"> review </button>
                            <div class="separator"></div>
                            <a href="javascript:void(0)" onclick="close_review(<?php echo $result['property_id']*99; ?>)" class="close_review"><i class="fa fa-times-circle"></i> close</a>
                            </div>
                            <img class="arrow_down" src="<?php echo base_url()."assets/frontend/images/arrow486.png"; ?>" />
                            </div>
                            <!--add review end-->
                              <input type="range" value="<?php echo get_rating($result['property_id']); ?>" data-val="<?php echo get_rating($result['property_id']); ?>" step="0.25" id="backing<?php echo $i; ?>">
                              <div class="rateit bigstars" data-productid="<?php echo $result['property_id']*99; ?>" data-rateit-backingfld="#backing<?php echo $i; ?>" data-rateit-starwidth="32" data-rateit-starheight="32"></div>
                            <!--end add rating and reviews-->
                            
                            <div class="clear5"></div>

                              <a href="<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>" class="pull-right readmore-list"> <i class="fa fa-arrow-right"></i> </a>
                        </div>
                        <!-- <a href="<?php //echo base_url('requests/send').'/'.encode_url($result['property_id']).'/'.encode_url($result['user_id']); ?>">send request</a> -->
                    </div>
                  </div>
                
                <?php $i++; } } else{
                    echo '<div class="alert alert-danger alert-dismissable"> ';
                    echo 'No Properties Found.';
                    echo'</div>';
                } ?>
                <div class="clear50"></div>
            </div>
        </div>
      </div>
    <div class="clear50"></div>


