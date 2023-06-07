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

.list-title-main{
	clear:none;
	float:left;
	width:20%;
	text-align:center;
	margin-top:0 !important;
}
.dotted_box{
	background: transparent none repeat scroll 0 0 !important;
    border: 1px dashed  !important;
    color: black  !important;
}

.description_box{
  background: transparent none repeat scroll 0 0 !important;
    /*border: 1px dashed  !important;*/
    text-align: left;
    color: black  !important;
    width: 49%;
    padding: 0px;
    height: 55px;
    overflow-y: scroll;
    margin-right: 0 !important;
    font-weight: bold;
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
          foreach ($all_images as $images){
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
              <!-- <p class="list-title-main alert"><?php //echo $result['type']; ?></p> -->

              <!--add rating and reviews start-->
              <?php $user_visited = $this->comman_model->get('request_property', array('sender_id' => $this->session->userdata('user_id'),'property_id' => $result['property_id'],'check_out_date < '=> time(),'request_status'=> 1)); ?>            
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
               <!-- <input type="range" value="5" data-val="5" step="0.25" id="backing"> -->
              <div class="rateit bigstars" data-productid="<?php echo $result['property_id']*99; ?>" data-rateit-backingfld="#backing" data-rateit-starwidth="32" data-rateit-starheight="32" <?php if($this->session->userdata('logged_in')){ echo (!$user_visited)? 'data-rateit-readonly="true"' : ''; }else{ echo 'data-rateit-readonly="true"'; } ?> ></div>
              <!--end add rating and reviews-->
        <div class="top_buttons pull-right">

        <?php
            $is_rented = $this->comman_model->get('request_property', array('property_id' => $result['property_id'],'check_out_date > '=> time(),'request_status'=> 1,'cancel_on'=> 0));
            if($is_rented){ ?>
              <div class="btn btn-accepted" title="Property has been rented out.">Rented</div>
            <?php }else{
              if($result['user_id'] != $this->session->userdata('user_id')){

              //$request_data = get_request($result['property_id']);
              
              if($result['request_id'] == ''){ 
                 if($this->session->userdata('user_role') == 3){

                 }else{ ?>
                 <a href="<?php echo base_url('requests/request_step_one').'/'.encode_url($result['property_id']).'/'.encode_url($result['user_id']); ?>" class="btn btn-review" title="send request for this place.">Request to Rent</a>
                <?php } ?>
                
              <?php }else{
                 
                 if($result['payment_id'] == 0){
                 
                     if($result['request_status'] == 0){
                      echo '<div class="btn btn-pending" title="Your request is padding.">pending</div>';
                    }
                    
                    if($result['request_status'] == 1){ ?>
                      <!-- <button type="button" class="btn btn-pending btn-sm"  data-toggle="modal" data-target="#messageModel"> send message </button> -->
                      <div class="btn btn-accepted" title="Property has been rented out.">Rented</div>
                   <?php }
                    if($result['request_status'] == 2){
                      echo '<div class="btn btn-sm btn-rejected" title="Your request is rejected.">rejected</div>';
                    }
               }else{
                  echo '<div class="btn btn-pending" title="Successfully Purchased.">Successfully Purchased</div>';
               }
              } //end else
                
            }else{
               echo '<a href="'.base_url('properties/editProperty').'/0/'.encode_url($result['property_id']).'" class="btn btn-sm btn-pending" title="Edit Property.">Edit</a>';            
            } //end else
            }
            
         ?>
        </div>
        <div class="clear10"></div>
              <p class="list-desc-main"><?php echo $result['name']; ?></p>
              <p class="list-desc-main"><?php echo $result['city'].', '.$result['state'].', '.$result['country']; ?></p>
              <p class="list-desc-main">Dates Available: <?php echo date('m/d/y',$result['date_from']); ?>&nbsp;-&nbsp;<?php echo date('m/d/y',$result['date_to']); ?></p>
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
        <p class="list-title-main alert">Description:</p><p class="list-title-main alert dotted_box"><?php echo $result['type']; ?></p>
        <p class="list-title-main alert description_box">
        <?php echo ($result['description'] != '')? $result['description'] : ''; ?>
        <?php echo ($result['additional_description'] != '')? '<br/>'.$result['additional_description'] : ''; ?></p>
        </div>
        
        <div class="clear5"></div>
        <div class="col-sm-6" style="padding-left:0px;">
          <div class="alert">
          <p class="list-title-main alert" style="width:100%;">Amenities:</p>
          <div class="clear10"></div>
          <ul class="amenities-res">
          <?php 
          if($result['amenities'] != 'false'&& $result['amenities'] != NULL){
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
          if($result['stereotype'] != 'false' && $result['stereotype'] != NULL){
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
<?php /*
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
*/ ?>		
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



<!-- message Modal start-->
<div id="messageModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <div id="status_message" style="display:none;"></div>
        <form id="messageForm" action="" method="post" accept-charset="utf-8">
        <div class="form-group">
            <!-- <label for="description">Description</label> -->
            <input type="hidden" id="property_id" value="">
            <input type="hidden" id="receiver_id" value="<?php echo encode_url($result['user_id']); ?>">
            <textarea type="text" id="message" class="form-control" placeholder="Enter your message here..." required><?php echo set_value('message'); ?></textarea>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="submitMessage()" >Send</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
function submitMessage(){
      var r_id = $('#receiver_id').val();
      var p_id = $('#property_id').val();
      var message = $('#message').val();
      //alert(p_id+'--'+p_review);
      if(is_login == true){
          $.ajax({
            url: jqv_ajax_url+'messages/create_message_ajax', //your server side script
            type: 'POST',
            dataType : "json",
            //contentType: "application/json; charset=utf-8",
            data : { "receiver_id": r_id, "property_id": p_id, "message": message },
            success: function (result){
              if(result.errors){
                $('#status_message').html(result.errors);
                $('#status_message').show();
              }else{
                $('#status_message').hide();
                $('#status_message').html('');
                $('#messageModel').modal('hide');
                $('#message').val('');
              }
 
             },
             error: function (jxhr, msg, err) {
                 $('#response').append('<li style="color:red">' + msg + '</li>');
             }
         });
        }else{
          alert('Please login to message this place.');
        } 
  }

</script>

<!--end message Modal-->
<?php 
$gps = explode(',',$result['gps']);    
  if(sizeof($gps)==0){
    $gps[0] = 54.3205;
    $gps[1] = 24.3232;
  }
  if(sizeof($gps)==1){
    $gps[1] = 24.3232;
  }
?>


<script type="text/javascript">
//var myCenter=new google.maps.LatLng(51.508742,-0.120850);
/*function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:6,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("map"),mapProp);
var markers = [];
var country = "<?php echo ($result['address'] != '')? $result['address'] : 'United States'; ?>";

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


}*/

function initMap() {
  var myLatLng = {lat: <?php echo $gps[0]; ?>, lng: <?php echo $gps[1]; ?>};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  });
}

google.maps.event.addDomListener(window, 'load', initMap);

</script>