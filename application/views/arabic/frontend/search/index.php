<?php $uri = 0;
//echo get_max_price(); die();
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
//echo '<pre>'; print_r($results); die();
?>
<style type="text/css">
.maplabels {
	 /*background-color: grey;*/
    /*border: 2px solid black;*/
    /*background: url("images/box-red.png") no-repeat;*/
    color: white;
    font-family: "Lucida Grande","Arial",sans-serif;
    font-size: 15px;
    font-weight: bold;
    margin-top: -30px !important;
    text-align: center;
    white-space: nowrap;
    width: 60px;
    height: 30px;

	margin-left:-28px !important;
  z-index: 1 !important;
}

.maplabels_box_red {
   /*background-color: grey;*/
    /*border: 2px solid black;*/
    background: url("images/box-red.png") no-repeat;
    color: white;
    font-family: "Lucida Grande","Arial",sans-serif;
    font-size: 15px;
    font-weight: bold;
    margin-top: -30px !important;
    text-align: center;
    white-space: nowrap;
    width: 60px;
    height: 30px;

  margin-left:-28px !important;
  z-index: 1 !important;
}


.maplabels_box_gray {
   /*background-color: grey;*/
    /*border: 2px solid black;*/
    background: url("images/box-gray.png") no-repeat;
    color: white;
    font-family: "Lucida Grande","Arial",sans-serif;
    font-size: 15px;
    font-weight: bold;
    margin-top: -30px !important;
    text-align: center;
    white-space: nowrap;
    width: 60px;
    height: 30px;

  margin-left:-28px !important;
  z-index: 1 !important;
}

.maplabels_box_green {
   /*background-color: grey;*/
    /*border: 2px solid black;*/
    background: url("images/box-green.png") no-repeat;
    color: white;
    font-family: "Lucida Grande","Arial",sans-serif;
    font-size: 15px;
    font-weight: bold;
    margin-top: -30px !important;
    text-align: center;
    white-space: nowrap;
    width: 60px;
    height: 30px;

  margin-left:-28px !important;
  z-index: 1 !important;
}

.loginbox label {
	color:#fff;
}
.btn-dropdown{
	color: #6e6e6e;
    background-color: #fff;
    border-color: #ccc;
    border: 1px solid #fff;
    font-family:Arial, Helvetica, sans-serif;
    font-size: 12px;
    font-weight: normal;
    line-height: 2;
	  text-align:left;
    width: 100%;
	  height:38px;
}
.list-details-search > p {
    margin: 0 0 7px !important;
}
.favorite-btn {
    left: 34% !important;
}
.favorite-btn-map {
    color: #000;
    display: none;
    font-size: 25px;
    left: 30%;
    top: 1%;
    position: absolute;
    z-index: 3;
}
.gm-style-iw:hover .favorite-btn-map{
  display: block;
}
</style>
<div class="container">
  <div class="search-home filter-result"> 
    <!--- -->
    <div class="col-sm-12">
      <input id="range-slider" name="range-slider" type="hidden" class="ui-slider" value="<?php if($this->session->userdata('filter_entry_fee') != ''){ echo str_replace(' ', ',', $this->session->userdata('filter_entry_fee')); }else{ echo "0,10000"; } ?>" />
      <div id="slider-3"></div>
    </div>
    <div class="form-group">
      <label for="amount" class="col-sm-6 control-label">Amount ($): </label>
      <span class="help-text">Please choose a price range</span>
      <div class="col-sm-6 text-right">
        <input type="hidden" id="amount" class="form-control">
        <p class="price lead" id="amount-label"></p>
        <span class="price" id="price">10 &nbsp;-&nbsp; $<?php echo get_max_price(); ?></span> </div>
      <?php echo $this->session->userdata('state'); ?> </div>
    <!--- -->
    
    <form id="search">
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fgroup">
        <input type="text" name="address" id="autocomplete" value="<?php echo ($this->input->get('address') != '')? $this->input->get('address') : ''; ?>" class="form-control" placeholder="Where To? Let The Bindel Begin! Ex:  City, State">
      </div>
      <div class="hidden-lg hidden-md clear20"></div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fgroup">
        <input type="text"  name="check-in" value="<?php echo ($this->input->get('check-in') != '')? $this->input->get('check-in') : ''; ?>" class="form-control search" placeholder="Check In" id="check-in">
      </div>
      <div class="hidden-lg hidden-md clear20"></div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fgroup">
        <input type="text" name="check-out" value="<?php echo ($this->input->get('check-out') != '')? $this->input->get('check-out') : ''; ?>" class="form-control search" placeholder="Check Out" id="check-out">
      </div>
      <div class="hidden-lg hidden-md clear20"></div>
      <input type="hidden" name="min" id="min" value="<?php echo ($this->input->get('min') != '')? $this->input->get('min') : '10'; ?>">
      <input type="hidden" name="max" id="max" value="<?php echo ($this->input->get('max') != '')? $this->input->get('max') : get_max_price(); ?>">
      <input type="hidden" name="city" id="locality" value="<?php echo ($this->input->get('city') != '')? $this->input->get('city') : ''; ?>">
      <!-- <input type="hidden" name="state" id="administrative_area_level_1" value="<?php //echo ($this->input->get('state') != '')? $this->input->get('state') : ''; ?>">
      <input type="hidden" name="country" id="country" value="<?php //echo ($this->input->get('country') != '')? $this->input->get('country') : ''; ?>"> -->
      
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 fgroup">
        <button id="search_property_2" class="btn btn-primary">search</button>
      </div>
      <div class="clear10"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
        <div class="form-group col-sm-2 col-xs-12 fgroup"> 
          <!--<label for="address">Bedroom(s)</label>-->
          <select class="form-control search" name="bedrooms" id="bedrooms">
            <option value="">Bedroom(s)</option>
            <option value="Studio" <?php if($this->input->get('bedrooms') == 'Studio'){ echo 'selected="selected"'; } ?> >Studio</option>
            <?php for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php echo ($this->input->get('bedrooms') == $i)? 'selected="selected"' : ''; ?> ><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>
        
        <div class="form-group col-sm-2 col-xs-12 fgroup"> <a class="btn btn-dropdown" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Amenities <i class="fa fa-caret-down" style="position: absolute;right: 12px;top: 36%;"></i> </a> </div>
        
        <div class="form-group col-sm-2 col-xs-12 fgroup"> 
          <!--<label for="address">Bathroom(s)</label>-->
          <select class="form-control search" name="bathrooms" id="bathrooms">
            <option value="">Bathroom(s)</option>
            <?php for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php echo ($this->input->get('bathrooms') == $i)? 'selected="selected"' : ''; ?> ><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-sm-2 col-xs-12 fgroup"> 
          <!--<label for="square_feet">Square Feet</label>-->
          <input type="number" placeholder="Square Feet" class="form-control search" name="area" value="<?php echo ($this->input->get('area') != '')? $this->input->get('area') : ''; ?>" id="square_feet" min="1">
        </div>
        <div class="form-group col-sm-2 col-xs-12 fgroup"> 
          <!--<label for="pets_allowed">Pets Allowed?</label>-->
          <select class="form-control search" name="pets_allowed" id="pets_allowed">
            <option value="" >Pets Allowed?</option>
            <option value="Cats Only" <?php echo ($this->input->get('pets_allowed') == 'Cats Only')? 'selected="selected"' : ''; ?>>Cats Only</option>
            <option value="Dogs Only" <?php echo ($this->input->get('pets_allowed') == 'Dogs Only')? 'selected="selected"' : ''; ?>>Dogs Only</option>
            <option value="Dogs or Cats" <?php echo ($this->input->get('pets_allowed') == 'Dogs or Cats')? 'selected="selected"' : ''; ?>>Dogs or Cats</option>
            <option value="No Pets" <?php echo ($this->input->get('pets_allowed') == 'No Pets')? 'selected="selected"' : ''; ?>>No Pets</option>
            <option value="Other" <?php echo ($this->input->get('pets_allowed') == 'Other')? 'selected="selected"' : ''; ?>>Other</option>
          </select>
        </div>
        <div class="form-group col-sm-2 col-xs-12 fgroup search"> 
          <!--<label for="parking">Parking?</label>-->
          <select class="form-control" name="parking" id="parking">
            <option value="">Parking?</option>
            <option value="Garage Parking" <?php echo ($this->input->get('parking') == 'Garage Parking')? 'selected="selected"' : ''; ?>>Garage Parking</option>
            <option value="Street Parking" <?php echo ($this->input->get('parking') == 'Street Parking')? 'selected="selected"' : ''; ?>>Street Parking</option>
            <option value="Covered Parking" <?php echo ($this->input->get('parking') == 'Covered Parking')? 'selected="selected"' : ''; ?>>Covered Parking</option>
            <option value="Valet Parking" <?php echo ($this->input->get('parking') == 'Valet Parking')? 'selected="selected"' : ''; ?>>Valet Parking</option>
            <option value="No Parking" <?php echo ($this->input->get('parking') == 'No Parking')? 'selected="selected"' : ''; ?>>No Parking</option>
            <option value="Other"<?php echo ($this->input->get('parking') == 'Other')? 'selected="selected"' : ''; ?>>Other</option>
          </select>
        </div>
      </div>
      
      <?php $amenities = ($this->input->get('amenities') != '')? $this->input->get('amenities') : false; ?>
      <div class="collapse <?php echo ($amenities)? 'in' : ''; ?>" id="collapseExample">
        <div class="col-sm-12 col-xs-12"> 
          
          <!----- amenities ---->
          
          <div class="col-sm-12 col-xs-12 loginbox">
            <div class="form-group col-sm-4 alert">
              <input type="checkbox" id="tv" name="amenities[]" value="TV" <?php if($amenities && in_array("Tv", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="tv">TV</label>
              <div class="clear20"></div>
              <input type="checkbox" id="cabletv" name="amenities[]" value="Cable Tv" <?php if($amenities && in_array("Cable Tv", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="cabletv">Cable TV</label>
              <div class="clear20"></div>
              <input type="checkbox" id="aircond"  name="amenities[]" value="Air Conditioning" <?php if($amenities && in_array("Air Conditioning", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="aircond">Air Conditioning</label>
              <div class="clear20"></div>
              <input type="checkbox" id="heating" name="amenities[]" value="Heating" <?php if($amenities && in_array("Heating", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="heating">Heating</label>
              <div class="clear20"></div>
              <!-- -->
              
              <input type="checkbox" id="internet" name="amenities[]" value="Internet" <?php if($amenities && in_array("Internet", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="internet">Internet</label>
              <div class="clear20"></div>
              <input type="checkbox" id="balcony" name="amenities[]" value="Balcony" <?php if($amenities && in_array("Balcony", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="balcony">Balcony</label>
              <div class="clear20"></div>
              <input type="checkbox" id="pool" name="amenities[]" value="Pool" <?php if($amenities && in_array("Pool", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="pool">Pool</label>
              <div class="clear20"></div>
              
            </div>
            <!-- -->
            
            <div class="form-group col-sm-4 alert">
            
            <input type="checkbox" id="gym" name="amenities[]" value="Gym" <?php if($amenities && in_array("Gym", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="gym">Gym</label>
              <div class="clear20"></div>
              
              <input type="checkbox" id="other" name="amenities[]" value="Other" <?php if($amenities && in_array("Other", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="other">Other</label>
              <div class="clear20"></div>
              <input type="checkbox" id="wheelchair" name="amenities[]" value="Wheelchair Accessible" <?php if($amenities && in_array("Wheelchair Accessible", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="wheelchair">Wheelchair Accessible</label>
              <div class="clear20"></div>
              <input type="checkbox" id="fireplace" name="amenities[]" value="Indoor Fireplace" <?php if($amenities && in_array("Indoor Fireplace", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="fireplace">Indoor Fireplace</label>
              <div class="clear20"></div>
              <input type="checkbox" id="doorman" name="amenities[]" value="Doorman">
              <label for="doorman">Doorman</label>
              <!--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>-->
              <div class="clear20"></div>
              
              <input type="checkbox" id="concierge" name="amenities[]" value="Concierge" <?php if($amenities && in_array("Concierge", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="concierge">Concierge</label>
              <div class="clear20"></div>
              
              <input type="checkbox" id="bar" name="amenities[]" value="Bar">
              <label for="bar">Bar</label>
              <div class="clear20"></div>
            </div>
            <!-- -->
            <div class="form-group col-sm-4 alert">
              
              
              <input type="checkbox" id="rroom"  name="amenities[]" value="Recreational Room" <?php if($amenities && in_array("Recreational Room", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="rroom">Recreational Room</label>
              <!--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>-->
              <div class="clear20"></div>
              <input type="checkbox" id="washer" name="amenities[]" value="Washer" <?php  if($amenities && in_array("Washer", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="washer">Washer</label>
              <div class="clear20"></div>
              <input type="checkbox" id="dryer" name="amenities[]" value="Dryer" <?php if($amenities && in_array("Dryer", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="dryer">Dryer</label>
              <div class="clear20"></div>
              <input type="checkbox" id="dishwasher" name="amenities[]" value="Dishwasher" <?php if($amenities && in_array("Dishwasher", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="dishwasher">Dishwasher</label>
              <div class="clear20"></div>
              <input type="checkbox" id="buzzer" name="amenities[]" value="Buzzer/Wireless Intercom" <?php if($amenities && in_array("Buzzer/Wireless Intercom", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="buzzer">Buzzer/Wireless Intercom</label>
              <!--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>-->
              <div class="clear20"></div>
              <input type="checkbox" id="elevator" name="amenities[]" value="Elevator" <?php if($amenities && in_array("Elevator", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="elevator">Elevator</label>
              <div class="clear20"></div>
              <input type="checkbox" id="smoking" name="amenities[]" value="Smoking Allowed" <?php if($amenities && in_array("Smoking Allowed", $amenities)){ echo 'checked="checked"'; } ?>>
              <label for="smoking">Smoking Allowed</label>
              <div class="clear20"></div>
            </div>
          </div>
          
          <!---- amenities end ------> 
          
        </div>
      </div>
    </form>
    <?php if($this->session->userdata('logged_in')){ ?>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 fgroup pull-right" style="margin-top: 10px;"> 
      <!-- <a href="<?php //echo base_url('save_search'); ?>" class="btn btn-primary">save search</a> -->
      <button class="btn btn-primary" data-toggle="modal" data-target="#saveSearchModal">save search</button>
    </div>
    <?php } ?>
  </div>
  <div class="clear20"></div>
</div>
<!-- content area start -->
<div class="container-fluid results-fluid">
  <div class="container">
    <h1 class="section-heading"><i class="watermark"></i> search results </h1>
    <div class="clear20"></div>
    <div class="col-lg-7 col-md-7 col-sm-10 col-xs-12 padding0">
      <div class="section-data results-wrap">
        <?php $this->load->view('errors');
        ?>
        <?php if($results){
$i = 1;
foreach ($results as $result) {

  ?>
        <?php
      //$search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
          $img_src = 'images/default_image.png';
            if($result['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $result['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$result['image'];            
            }
            $total_images = get_total('property_images',array('property_id' => $result['property_id']));
          ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 property" data-id="<?php echo $i; ?>">
          <?php //if($this->session->userdata('logged_in') == true){ ?>
          <a href="<?php echo base_url('properties/addFavorite').'/'.$uri.'/'.encode_url($result['property_id']); ?>" class="favorite-btn"><i class="fa fa-heart-o"></i></a>
          <?php //} ?>
          <div class="p_container" onclick="window.location='<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>'">
            <div class="list padding0" style="display:flex;">
              <div class="col-sm-5 col-xs-12 padding0"> <span class="list-label">
                <p>rent</p>
                </span> <img src="<?php echo $img_src; ?>" class="list-thumb-search" height="150" alt="" /> <span class="photo-count"><?php echo $total_images; ?> Photos</span> </div>
              <div class="list-details-search col-sm-7 col-xs-12"> 
                <!-- <p class="list-title">Apartment:</p> -->
                <div class="clear10"></div>
                 <p class="list-title-search"><?php echo (strlen($result['name']) < 30)? $result['name'] : substr($result['name'], 0,25).'.....'; ?></p>
                <p class="list-title-search"><?php echo $result['city']; ?>, <?php echo $result['state']; ?>, <?php echo $result['country']; ?></p>
                <p class="list-price-search">$<?php echo $result['price'].'.00'; ?> / month</p>
                <p class="list-feature"><strong><?php echo $result['bedrooms']; ?></strong>&nbsp;Bed |&nbsp;</p>
                <p class="list-feature"><strong><?php echo $result['bathrooms']; ?></strong>&nbsp;Bath | Apartment</p>
                <div class="clear5"></div>
                <p class="list-feature"><?php echo $result['area']; ?>&nbsp; Sq Ft</p>
                <div class="clear5"></div>
                <p class="list-date-search">Dates Available: <?php echo date('m/d/y',$result['date_from']); ?>&nbsp;-&nbsp;<?php echo date('m/d/y',$result['date_to']); ?></p>
                <!-- <div class="list-tags"><a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a> <a href="<?php //echo base_url('#'); ?>">Bed:3</a></div> -->
                <div class="clear10"></div>
                
                <!--<div class="rateit bigstars" style="padding:8px;" data-rateit-value="<?php //echo get_rating($result['property_id']); ?>" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-readonly="true"></div>-->
                <div class="clear5"></div>
                <!--<a href="<?php //echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>" class="pull-right readmore-list"> <i class="fa fa-arrow-right"></i> </a>--> 
              </div>
            </div>
          </div>
        </div>
        <?php 
                if($i%2 == 0){
                  echo '<div class="clear5"></div>';
                }
                $i++;
                } 
              }else{
                  echo '<div class="alert alert-danger alert-dismissable"> ';
                  echo 'No properties found. Please try again later, as our listings change daily.';
                  echo'</div>';
                }
              ?>
        <div class="clear50"></div>
      </div>
      <div class="section-data search-results-wrap" style="display:none;">
        <?php
        $address = false;
        if($results){
         $state_properties = $results;
         $address = ($this->input->get('address') != '')? $this->input->get('address') : ''; 
        }else{
          $where = array();
          if($this->session->userdata('country')){
              $where['country'] = $this->session->userdata('country');
              $address = $this->session->userdata('country');
          }
          if($this->session->userdata('state')){
              $where['state'] = $this->session->userdata('state');
              $address = $this->session->userdata('state').', '.$this->session->userdata('country');
          }
          if($this->session->userdata('city')){
              $address = $this->session->userdata('city').', '.$this->session->userdata('state').', '.$this->session->userdata('country');
          }

          $state_properties = $this->comman_model->get('properties', $where);
        }
        
if($state_properties){
$i = 0;
foreach ($state_properties as $result) { ?>
<?php

$gps = explode(',',$result['gps']);    
  if(sizeof($gps)==0){
    $gps[0] = 54.3205;
    $gps[1] = 24.3232;
  }
  if(sizeof($gps)==1){
    $gps[1] = 24.3232;
  }
//$favorits;
  $marker_icon = 'box-red.png';
  $lable_class = 'maplabels_box_red';
  if(in_array($result['property_id'], $visited)){
    $marker_icon = 'box-gray.png';
    $lable_class = 'maplabels_box_gray';
  }
  if(in_array($result['property_id'], $favorits)){
    $marker_icon = 'box-green.png';
    $lable_class = 'maplabels_box_green';
  }
      $search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
          $img_src = 'images/default_image.png';
            if($search_image[0]['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $search_image[0]['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
            }
?>
        <div class="marker" data-lat="<?php echo $gps[0]; ?>" data-lng="<?php echo $gps[1]; ?>" data-price="<span style='font-size:12px;'>$</span><?php echo $result['price']; ?>" data-id="<?php echo $i; ?>" data-lableclass ="<?php echo $lable_class; ?>" data-markericon ="<?php //echo $marker_icon; ?>">
          <?php //if($this->session->userdata('logged_in')){ ?>
          <a href="<?php echo base_url('properties/addFavorite').'/'.$uri.'/'.encode_url($result['property_id']); ?>" class="favorite-btn-map"><i class="fa fa-heart-o"></i></a>
          <?php //} ?>
          <div class="list padding0 p_container" onclick="window.open('<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>/map')" style="display:flex; background-color:#fff;">
            <div class="col-sm-6 col-xs-12 padding0"> 
              <!-- <span class="list-label"><p>rent</p></span> --> 
              <img src="<?php echo $img_src; ?>" height="80" width="100" style="padding: 5px;"  alt="" /> </div>
            <div class="list-details-search col-sm-6 col-xs-12 padding0" style="padding: 5px;">
              <p style="margin: 0 0 5px; font-weight: bold;">$<?php echo $result['price'].'.00'; ?></p>
              <p style="margin: 0 0 5px;"><?php echo $result['bedrooms']; ?> bed, <?php echo $result['bathrooms']; ?> bath</p>
              <p style="margin: 0 0 5px;"><?php echo $result['area']; ?> sqft</p>
            </div>
          </div>
        </div>
        <?php $i++; } } ?>
        <div class="clear50"></div>
      </div>
    </div>
    <div class="clear50 hidden-lg hidden-md"></div>
    <!--- Search Maps -->
    
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 padding0">
      <div class="mapbox">
        <div id="search_map" style="width:100%; height:848px;"></div>
      </div>
    </div>
    <div class="clear20"></div>
  </div>
</div>
<!-- Save Search Modal start -->
<div class="modal fade" id="saveSearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header memberloginbg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <label class="modal-title" id="myModalLabel">Save Search</label>
      </div>
      <div class="modal-body">
      <form id="forgot" action="<?php echo base_url('save_search'); ?>" method="post" accept-charset="utf-8">
        <div id="msgbox_register_forgot"></div>
        <div class="clear10"></div>
        <div class="form-group">
          <label for="email">Search Title</label>
          <input type="text" class="form-control validate]" id="title" name="title" maxlength="100" style=" border: 1px solid #ccc;">
        </div>
        <div class="clear5"></div>
        <div class="clear"></div>
        </div>
        <div class="modal-footer">
        <button type="submit" role="button" class="btn">Save Search</button>
        <button type="button" class="btn" data-dismiss="modal" style="margin-bottom:0;">Close</button>
      </form>
    </div>
  </div>
</div>
</div>

<!-- Save Search Modal end --> 
<script>

$(document).ready(function(){
   google.maps.event.addDomListener(window, 'load', initAutocomplete);
});


var markers = [];
var map;
var gmarkers = [];
var $markers = [];
var myCenter=new google.maps.LatLng(37.09024,-95.71289100000001);
//var coords = "<?php echo $this->session->userdata('coords'); ?>";

function initialize()
{
$markers = $('.search-results-wrap').find('.marker');
var mapProp = {
  center:myCenter,
  zoom:14,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

map = new google.maps.Map(document.getElementById("search_map"),mapProp);

var country = "<?php echo ($address)? $address : 'United States'; ?>"

var geocoder = new google.maps.Geocoder();
  geocoder.geocode( { 'address': country }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      map.fitBounds(results[0].geometry.viewport);
      //alert(map.getZoom());
      /*if (gmarkers.length < 5) {
        map.setZoom(12);
      }*/
      /*if(coords != ''){
        var geomAry = coords.split('|');
        var XY = new Array(); 
        var points = []; 
        for (var i = 0; i < geomAry.length; i++){ 
          XY = geomAry[i].split(','); 
          points.push( new google.maps.LatLng(parseFloat(XY[1]),parseFloat(XY[0]))) ; 
        }

        polygon = new google.maps.Polygon({
              paths : points,
              strokeColor : "red",
              strokeOpacity : 1.5,
              strokeWeight : 2,
              fillOpacity : .1
          });

          polygon.setMap(map);
      }*/
    
    } else {
      alert("Could not find location: " + country);
    }
});

map.markers = [];

  // add markers
  $markers.each(function(){
     //alert(gmarkers.length);       
      add_marker( $(this), map );
  });


}
google.maps.event.addDomListener(window, 'load', initialize);

</script> 
<script type="text/javascript">
function add_marker( $marker, map ){

  // var
  var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
  
  if (gmarkers.length != 0) {
      for (i=0; i < gmarkers.length; i++) {
          var existingMarker = gmarkers[i];
          var pos = existingMarker.getPosition();
          //if a marker already exists in the same position as this marker
          if (latlng.equals(pos)) {
              
              //update the position of the coincident marker by applying a small multipler to its coordinates
              var newLat = latlng.lat() + (Math.random() -.5) / 1500;// * (Math.random() * (max - min) + min);
              var newLng = latlng.lng() + (Math.random() -.5) / 1500;// * (Math.random() * (max - min) + min);
              latlng = new google.maps.LatLng(newLat,newLng);
              
          }
      }
  }
  // create marker
  var lable_content = $marker.attr('data-price');
  var markericon = $marker.attr('data-markericon');
  var lableclass = $marker.attr('data-lableclass');
  //alert(markericon);
  var marker = new MarkerWithLabel({
      position  : latlng,
      map     : map,
      draggable: false,
      raiseOnDrag: true,
      labelContent: lable_content,
      labelAnchor: new google.maps.Point(0, 0),
      labelClass: lableclass, // the CSS class for the label
      labelInBackground: true,
      icon: '<?php echo base_url("/ass/frontend/images"); ?>/'+ markericon
  });

  // add to array
      
  map.markers.push( marker );
  gmarkers.push(marker);
  
  var infowindow = new google.maps.InfoWindow;
  // if marker contains HTML, add it to an infoWindow
  if( $marker.html() )
  {
    // create info window
    var infowindow = new google.maps.InfoWindow({});
    var content = $marker.html();
    google.maps.event.addListener(marker, 'click', (function(marker, content) {
      
      return function() {
        //marker.showHideMarker('markerShowHide');
        marker.setVisible(false);
        infowindow.close();
        infowindow.setContent(content);
         if($('.gm-style-iw').length) {
             $('.gm-style-iw').parent().hide();
          }
        infowindow.open(map, marker);
       // $('.gdfg').css;
       //marker.setIcon('<?php echo base_url("assets/frontend/images"); ?>/box-gray.png');
       marker.set("labelClass", "maplabels_box_gray");
      }
    }
    )(marker, content));

    google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
        marker.setVisible(true);
    });
 
 google.maps.event.addListener(infowindow, 'domready', function() {

    
    var iwOuter = $('.gm-style-iw');
    var parent = iwOuter.parent();
    parent.children(':nth-child(1)').css({'top' : '35px'});
    var iwBackground = iwOuter.prev();

    iwBackground.children(':nth-child(2)').css({'display' : 'none'});

    
    iwBackground.children(':nth-child(4)').css({'display' : 'none'});

    iwOuter.css({top: '55px',left: '25px'});
    
    var iwCloseBtn = iwOuter.next();

    
    iwCloseBtn.css({display: 'none'});

    if($('.iw-content').height() < 140){
      $('.iw-bottom-gradient').css({display: 'none'});
    }


    });
      
  }


}


</script> 
<script>
    $(function() {
        $( "#slider-3" ).slider({
          range:true,
          min: 10,
          max: <?php echo get_max_price(); ?>,
          values: [ <?php echo ($this->input->get('min') != '')? $this->input->get('min') : '10'; ?>, <?php echo ($this->input->get('max') != '')? $this->input->get('max') : get_max_price(); ?>],
               
               slide: function( event, ui ) {
                  $( ".ui-slider" ).val( ui.values[ 0 ] + "," + ui.values[ 1 ] );
                  if($(".ui-slider").val() == '10,<?php echo get_max_price(); ?>'){
                    $( "#price" ).html( '10  -  $<?php echo get_max_price(); ?>' );
                    $("#min").val(10);
                    $("#max").val(<?php echo get_max_price(); ?>);
                  }else{
                    $( "#price" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                    $("#min").val(ui.values[ 0 ]);
                    $("#max").val(ui.values[ 1 ]);
                  }
                  
               },
               change: function( event, ui ) {  
                  setTimeout(function(){ $('#search_property_2').click(); }, 1000);
                }
           });
         });
</script>