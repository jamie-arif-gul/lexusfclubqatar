<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='hammad.tahir.ch-facilitator@gmail.com'; // Business email ID

?>
<!-- search home-->
<?php //echo "<pre>"; print_r($result); die(); ?>
<style type="text/css">
  .add_review_detail {
    left: 100px;
    top: 55px;
}
.arrow_down {
    left: 11%;
    position: absolute;
    top: -18%;
    transform: rotate(180deg);
}

.rateit {
    float: left;
    padding: 5px;
    /*width: 50%;*/
}

.list-tags2 a:hover {
    text-decoration: none;
}


</style>
<div class="container">
  <div class="clear10"></div>
  <?php if($result){ ?>
  <div class="dashboardbox container">
    <div class="col-sm-12 padding0">
        <div class="col-lg-12 col-xs-12">
          <div class="list padding0 col-sm-4 col-xs-12">
            
            <?php 

            $search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
              $p_img = 'images/default_image.png';
              if($search_image[0]['image'] != ''){
                $p_img = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
              }
            ?>
            <img src="<?php echo $p_img; ?>" class="list-thumb" alt="" />
      <div class="gallery-thumbnails text-center">
        <?php $all_images = get('property_images',array('property_id' => $result['property_id']));

        if($all_images){
          foreach ($all_images as $images) {
            $image = 'images/default_image.png';
            if($images['image'] != ''){
                $image = base_url('uploads/img_gallery/property_images').'/'.$images['image'];
              }
            ?>
             <a class="fancybox-button" rel="fancybox-button" href="<?php echo $image; ?>" title="<?php echo $images['image_description']; ?>">
              <img src="<?php echo $image; ?>" class="img-thumbnail" width="15%" />
             </a>
        <?php  }
        }
        ?>

      </div>
      <div class="clear10"></div>
      <div id="map" style="height:250px;"></div>
      <!-- <div class="dtl-userinfo">
        <div class="col-sm-4 col-xs-12 padding0">
          <img src="images/listing-thumbnail.jpg" class="img-responsive" />
        </div>
        <div class="col-sm-8 col-xs-12">
          <h4>user name</h4>
          <hr />
          <p>Joined: 20 days ago</p>
        </div>
      </div> -->
      </div>
      
      <!-- -->
      
      
      <div class="col-sm-8 col-xs-12 list-details2" id="listings">
      <div class="clear10"></div>
              <p class="list-title-main alert"><?php echo $result['type']; ?></p>

              <!--add rating and reviews start-->
                            
              <!--add review start-->                           
              <div id="<?php echo $result['property_id']*99; ?>" class="add_review add_review_detail">
                  <img class="arrow_down" src="<?php echo base_url()."assets/frontend/images/arrow486.png"; ?>" />
                  <div>
                    Thanks for your rating. Consider leaving a review and let others know more about your experience.
                    <button type="button" class="btn btn-xs btn-review pull-right" onclick="show_popup(<?php echo $result['property_id']*99; ?>)"> review </button>
                    <div class="separator"></div>
                    <a href="javascript:void(0)" onclick="close_review(<?php echo $result['property_id']*99; ?>)" class="close_review"><i class="fa fa-times-circle"></i> close</a>
                  </div>
              </div>
              <!--add review end-->
              <input type="range" value="<?php echo get_rating($result['property_id']); ?>" data-val="<?php echo get_rating($result['property_id']); ?>" step="0.25" id="backing">
              <div class="rateit bigstars" data-productid="<?php echo $result['property_id']*99; ?>" data-rateit-backingfld="#backing" data-rateit-starwidth="32" data-rateit-starheight="32"></div>
              <!--end add rating and reviews-->

        <?php 
            if($result['user_id'] != $this->session->userdata('user_id')){

              $request_data = get_request($result['property_id']);
              
              if($request_data === false){ ?>
                <a href="<?php echo base_url('requests/send').'/'.encode_url($result['property_id']).'/'.encode_url($result['user_id']); ?>" class="btn btn-sm btn-review pull-right" title="send request for this place.">send request</a>
              <?php }else{
                 
                 if($request_data['payment_id'] == 0){
                 
                     if($request_data['request_status'] == 0){
                      echo '<div class="btn btn-sm btn-pending pull-right" title="Your request is padding.">pending</div>';
                    }
                    
                    if($request_data['request_status'] == 1){ ?>
                      <div class="btn btn-sm btn-accepted pull-right" title="Your request is accepted.">accepted</div>
                    
                      <form id="updateProfile" action="<?php echo $paypal_url; ?>" method="post" accept-charset="utf-8"> 
                          <input type='hidden' name='business' value='<?php echo $paypal_id; ?>'>
                          <input type='hidden' name='cmd' value='_xclick'>
                          <input type='hidden' name='item_name' value='<?php echo $result['name']; ?>'>
                          <input type='hidden' name='item_number' value='1'>
                          <input type='hidden' name='amount' id="dynamic_amount" value='<?php echo $result['price']; ?>'>
                          <input type='hidden' name='no_shipping' value='1'>
                          <input type='hidden' name='currency_code' value='CHF'>
                          <input type='hidden' name='cancel_return' value='<?php echo base_url(); ?>'>
                          <input type='hidden' name='return' value='<?php echo base_url('properties/purchase').'/'.encode_url($request_data['request_id']); ?>'>
                          <input type='hidden' name='rm' value='2'>
                          <input type="hidden" name="cbt" value="Please Click Here to Complete Payment">
                            
                          <input type="submit" role="button" class="btn btn-sm btn-pending" value="&nbsp;Purchase&nbsp;"/>
                        
                      </form>
                   <?php }
                    if($request_data['request_status'] == 2){
                      echo '<div class="btn btn-sm btn-rejected  pull-right" title="Your request is rejected.">rejected</div>';
                    }
               }else{
                  echo '<div class="btn btn-sm btn-pending pull-right" title="Successfully Purchased.">Successfully Purchased</div>';
               }
              } //end else
                
            }else{
              echo '<div class="btn btn-sm btn-pending pull-right" title="Your request is padding.">added by you</div>';            
            } //end else
            
         ?>
        <div class="clear10"></div>
              <p class="list-desc-main"><?php echo $result['name']; ?></p>
              <p class="list-desc-main"><?php echo $result['city'].', '.$result['state'].', '.$result['country']; ?></p>
        <hr />
              
              <p class="list-price" style="width:100%;"> <i class="fa fa-money"></i> $<?php echo $result['price'].'.00'; ?></p>
        <hr />

        <div class="clear10"></div>
        <div class="list-tags2"> <i class="fa fa-tags fatag"></i> 
          <a href="javascript:void(0)">Bedrooms: <strong><?php echo $result['bedrooms']; ?></strong></a> 
          <a href="javascript:void(0)">Bathrooms: <strong><?php echo $result['bathrooms']; ?></strong></a>
          <a href="javascript:void(0)">Pets: <strong><?php echo $result['pets_allowed']; ?></strong></a> 
          <a href="javascript:void(0)">Parking: <strong><?php echo $result['parking']; ?></strong></a> 
          
        </div>
 
        <div class="clear20"></div>
        <div class="alert alert-info property-txt" style="width:100%;">
        <p class="list-title-main alert">Description:</p>
		<?php echo $result['description']; ?> <br/>
    <?php echo $result['additional_description']; ?>
        </div>
        
        <div class="clear5"></div>
        <div class="col-sm-6" style="padding-left:0px;">
          <div class="alert">
          <p class="list-title-main alert" style="width:100%;">Amenities:</p>
          <div class="clear10"></div>
          <ul class="amenities-res">
          <?php
          if($result['amenities'] != ''){
             $amenities = json_decode($result['amenities'],true);
             foreach ($amenities as $amenitie) {
               echo '<li>'.$amenitie.'</li>';
             }
          }else{
            echo '<li>amenities are not avilible</li>';
          }
          ?>
		  </ul>
          </div>
        </div>

        <div class="col-sm-6" style="padding-left:0px;">
          <div class="alert">
          <p class="list-title-main alert" style="width:100%;">Stereotype Your Neighborhood:</p>
          <?php //echo $result['description']; ?>
		  <div class="clear10"></div>
		  <ul class="amenities-res">
			<?php 
          if($result['stereotype'] != ''){
             $stereotypes = json_decode($result['stereotype'],true);
             foreach ($stereotypes as $stereotype) {
               echo '<li>'.$stereotype.'</li>';
             }
          }else{
            echo '<li>Stereotype Your Neighborhood are not available</li>';
          }
          ?>
		  </ul>
          </div>
        </div>
		<div class="clear5"></div>
<hr class="style7">
		<!---- user reviews ---->
		<h4 class="master-title">User Reviews</h4>
		<div class="user-reviews">
			<div class="col-sm-12 col-xs-12">
				
  <?php if($reviews){
    foreach ($reviews as $review) { ?>
        <div class="review">
              <div class="reviewer-pic col-sm-2 col-xs-12">
            <img src="<?php echo base_url()."assets/frontend/images/reviewer.png" ?>" class="img-responsive img-thumbnail" />
          </div>
          <div class="col-sm-10 col-xs-12">
            <strong><?php echo $review['name'].' '.$review['last_name']; ?></strong> &nbsp; <i class="text-muted"><?php echo date('m-d-Y' , strtotime($review['updated'])); ?></i>
            <br>
            <p><?php echo $review['reviews']; ?></p>
          </div>
        </div>
  <?php } }else {
                    echo '<div class="alert alert-danger alert-dismissable"> ';
                    echo 'No Reviews available.';
                    echo'</div>';
                } ?>
					
			</div>
		</div>
		
        </div>
          
        </div>
        </div>
      </div>
      <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No property detail found..';
        echo'</div>';
        } ?>
    </div>
<script type="text/javascript">
var myCenter=new google.maps.LatLng(51.508742,-0.120850);
function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:6,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("map"),mapProp);
var markers = [];
var country = "<?php echo ($result['address'] != '')? $result['address'] : 'Pakistan'; ?>";

var geocoder = new google.maps.Geocoder();
  geocoder.geocode( { 'address': country }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      map.fitBounds(results[0].geometry.viewport);
      markers.push(new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
      }));
      
    } else {
      alert("Could not find location: " + location);
    }
});


}
google.maps.event.addDomListener(window, 'load', initialize);

</script>