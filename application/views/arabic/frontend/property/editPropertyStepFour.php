<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>

<div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">
  List Your Space
  </h3>
	<hr class="style7">
  <input type="hidden" value="<?php echo encode_url($property_data[0]['property_id']); ?>" id="property_id">
  <?php $images = get('property_images',array('property_id' => $property_data[0]['property_id']),'image_id,image,image_description'); ?>
    <div class="col-sm-12 loginbox">
      <h4 class="section-heading" style="text-align:left;"> <i class="fa fa-picture-o"></i> Add Photos - <i style="color:#d31509; font-size:14px;">Cell Phone Pictures Are Great!</i></h4>
      <p>A picture is worth 1,000 words. Ain't nobody got time for 1,000 words. So snap a picture! Everyone loves photos and each photo you upload increases the likelihood that you will find the right guest!</p>
      <p>Please uploadphotos of your space including the bedroom(s), bathroom(s), kitchen, living room, and the building's exterior</p>
      <br>
    </div>
     <div class="clear20"></div>
     <div class="addphotos">
     	
      <?php for ($i=0; $i < 6 ; $i++) { ?>
        <div class="col-sm-2">
          <p class="img-notification">This photo will appear in the search results!</p>
            <div class="imgthumb" id="property_image<?php echo $i; ?>">
            <div id="propimg<?php echo $i; ?>">
            <?php if(isset($images[$i]['image']) && $images[$i]['image'] != ''){ ?>
                <img src="<?php echo base_url('uploads/img_gallery/property_images').'/'.$images[$i]['image']; ?>" height="75" width="122">
            <?php  }else{ ?>
                <i class="fa fa-picture-o"></i>
                <br>
                <p>Add Photo</p>
            <?php    } ?>
            </div> 
              </div>
              <div class="clear10"></div>
              <textarea rows="2" class="form-control img-desc" id="img_text<?php echo $i; ?>" style="width:100%;" data-img-id="<?php if(isset($images[$i]['image_id'])){ echo encode_url($images[$i]['image_id']); }; ?>" onblur="add_img_description(this)" placeholder="Add Description"><?php if(isset($images[$i]['image_description'])){ echo $images[$i]['image_description']; }; ?></textarea>
        </div>
      <?php } ?>
      <div class="clear10"></div>
      <div class="col-sm-12" id="messages" style="display:none;"></div>
     
     </div>
     <div class="clear20"></div>
      <hr class="style7">
      <div class="col-sm-8">
      <label for="progress">75% Completed</label>
      	<progress id="progressbar" value="75" max="100"></progress>
      </div>
      <div class="col-sm-2 col-lg-1 col-md-2 col-xs-4 pull-right padding0">
      <a class="btn btn-primary" href="<?php echo base_url('properties/myProperties').'/'.$uri; ?>"> <i class="fa fa-angle-double-right"></i> Finish</a>
    </div>
  </div>