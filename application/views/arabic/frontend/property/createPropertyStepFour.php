<style type="text/css">
  div.ajax-file-upload-progress{
    /*display: none !important;*/
  }
  .dashboard-heading{
		  color:#5cb85c;
	  }
	  .sm-di{  
		  color:#d31509;
		  font-size:28px;
		  font-weight:bold;
	  }
	  .btn-primary{
		  font-size:13px !important;
	  }
</style>
<div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">
  List Your Space
  </h3>
	<hr class="style7">
  <input type="hidden" value="<?php echo encode_url($property_data[0]['property_id']); ?>" id="property_id">
  <?php $images = get('property_images',array('property_id' => $property_data[0]['property_id'],'type' => 2)); ?>
    <div class="col-sm-12 loginbox">
      <h4 class="section-heading" style="text-align:left;"> <i class="fa fa-picture-o"></i> Add Photos - <span class="sm-di">Cell Phone Pictures Are Great!</span></h4>
      <p class="bigfont">A picture is worth 1,000 words.<br>Ain't nobody got time for 1,000 words. <br> So snap a picture! Everyone loves photos <br> and each photo you upload increases <br>the likelihood that you will find the right guest!</p>
	  <div class="clear20"></div>
      <span style="margin-bottom: -18px; margin-left:29px;">Please upload photos of your space including the bedroom(s), bathroom(s), kitchen, living room, and the building's exterior.</span>
      <div class="clear20"></div>
    </div>
     <div class="clear10"></div>
     <div class="addphotos">

     <div class="col-sm-2">
          <p class="img-notification">This photo will appear in the search results!</p>
            <div class="imgthumb" id="property_image0">
            <div id="propimg0">
            <?php 
            $search_image = get('property_images',array('property_id' => $property_data[0]['property_id'],'type' => 1));
            if(isset($search_image[0]['image']) && $search_image[0]['image'] != ''){ ?>
                <img src="<?php echo base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image']; ?>" width="100%">
            <?php }else{ ?>
                <i class="fa fa-picture-o"></i>
                <br>
                <p>Add Photo</p>
            <?php } ?>
            </div> 
              </div>
              <div class="clear10"></div>
              <textarea rows="2" class="form-control img-desc" id="img_text0" style="width:100%;" data-img-id="<?php if(isset($search_image[0]['image_id'])){ echo encode_url($search_image[0]['image_id']); }; ?>" onblur="add_img_description(this)" placeholder="Add Description"><?php if(isset($search_image[0]['image_description'])){ echo $search_image[0]['image_description']; }; ?></textarea>
        </div>
     	
      <?php for ($i=1; $i < 6 ; $i++) { ?>
        <div class="col-sm-2">
          <p class="img-notification" style="visibility: hidden">This photo will appear in the search results!</p>
            <div class="imgthumb" id="property_image<?php echo $i; ?>">
            <div id="propimg<?php echo $i; ?>">
            <?php if(isset($images[$i-1]['image']) && $images[$i-1]['image'] != ''){ ?>
                <img src="<?php echo base_url('uploads/img_gallery/property_images').'/'.$images[$i-1]['image']; ?>" height="75" width="122">
            <?php }else{ ?>
                <i class="fa fa-picture-o"></i>
                <br>
                <p>Add Photo</p>
            <?php } ?>
            </div> 
              </div>
              <div class="clear10"></div>
              <textarea rows="2" class="form-control img-desc" id="img_text<?php echo $i; ?>" style="width:100%;" data-img-id="<?php if(isset($images[$i-1]['image_id'])){ echo encode_url($images[$i-1]['image_id']); }; ?>" onblur="add_img_description(this)" placeholder="Add Description"><?php if(isset($images[$i-1]['image_description'])){ echo $images[$i-1]['image_description']; }; ?></textarea>
        </div>
      <?php } ?>
      <div class="clear10"></div>
      <div class="col-sm-12" id="messages" style="display:none;"></div>
     
     </div>
     <div class="clear20"></div>
      <hr class="style7">
	  
	  <div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 pull-right padding0">
      <a class="btn btn-primary" href="<?php echo base_url('properties/myProperties'); ?>"> <i class="fa fa-angle-double-right"></i> Finish</a>
      <div class="clear5"></div>
    </div>
	<div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 padding0">
	<a href="<?php echo base_url('properties/createPropertyStepThree').'/'.encode_url($property_data[0]['property_id']); ?>" class="text-danger back-btn"> <i class="fa fa-angle-double-left"></i> Back</a>
	</div>
	<div class="clear20"></div>
      <div class="col-sm-12 padding0">
    <label for="progress" class="progress_steps">Step 4 of 4</label>
    <div class="progress">		
	  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	  </div>
	</div>
      </div>
      
  </div>