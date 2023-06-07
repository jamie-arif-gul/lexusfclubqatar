 <?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?> 

  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">Edit Your Space</h3>
	<hr class="style7">
  <?php $this->load->view('errors'); ?>
    <div class="col-sm-6 loginbox">
      <h4 class="section-heading" style="text-align:left;"> <i class="fa fa-check-square-o"></i> Amenities </h4>
      <br>
      <form id="createPropertyTwo" action="<?php echo base_url('properties/editPropertyStepTow').'/'.$uri.'/'.encode_url($property_data[0]['property_id']); ?>" method="post">
          <div class="form-group col-sm-6">
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
          
          <input type="checkbox" id="gym" name="amenities[]" value="Gym" <?php if($amenities && in_array("Gym", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="gym">Gym</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="elevator" name="amenities[]" value="Elevator" <?php if($amenities && in_array("Elevator", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="elevator">Elevator</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="fireplace" name="amenities[]" value="Indoor Fireplace" <?php if($amenities && in_array("Indoor Fireplace", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="fireplace">Indoor Fireplace</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="doorman" name="amenities[]" value="Doorman">
          <label for="doorman">Doorman</label>
          <!--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>-->
          <div class="clear20"></div>
          </div>
          
          <div class="form-group col-sm-6">
          <input type="checkbox" id="concierge" name="amenities[]" value="Concierge" <?php if($amenities && in_array("Concierge", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="concierge">Concierge</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="bar" name="amenities[]" value="Bar">
          <label for="bar">Bar</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="rroom"  name="amenities[]" value="Recreational Room" <?php if($amenities && in_array("Recreational Room", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="rroom">Recreational Room</label>
          <!--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>-->
          <div class="clear20"></div>
          
          <input type="checkbox" id="washer" name="amenities[]" value="Washer" <?php if($amenities && in_array("Washer", $amenities)){ echo 'checked="checked"'; } ?>>
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
                   
          <input type="checkbox" id="smoking" name="amenities[]" value="Smoking Allowed" <?php if($amenities && in_array("Smoking Allowed", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="smoking">Smoking Allowed</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="wheelchair" name="amenities[]" value="Wheelchair Accessible" <?php if($amenities && in_array("Wheelchair Accessible", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="wheelchair">Wheelchair Accessible</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="other" name="amenities[]" value="Other" <?php if($amenities && in_array("Other", $amenities)){ echo 'checked="checked"'; } ?>>
          <label for="other">Other</label>
          <div class="clear20"></div>
        </div>
        <!-- <button type="submit" class="btn btn-danger">Register</button>-->
      
    </div>
    <div class="col-sm-6 loginbox">
    <h4 class="section-heading" style="text-align:left;">Additional Description </h4>
      <textarea class="form-control additional-des" rows="12" cols="12" placeholder="Add Additional Description Here" name="additional_description"><?php if($property_data[0]['additional_description'] != ''){ echo $property_data[0]['additional_description']; } ?></textarea>
      </div>
      <div class="clear20"></div>
      <hr class="style7">
      <div class="col-sm-8">
      <label for="progress">25% Completed</label>
      	<progress id="progressbar" value="25" max="100"></progress>
      </div>
      <div class="col-sm-2 col-lg-1 col-md-2 col-xs-4 pull-right padding0">
      <button class="btn btn-primary" type="submit"> <i class="fa fa-angle-double-right"></i> Next</button>
      </form>
      <div class="clear5"></div>
      <a class="btn btn-danger" href="<?php echo base_url('properties/editPropertyStepThree').'/'.$uri.'/'.encode_url($property_data[0]['property_id']); ?>"> <i class="fa fa-stop"></i> Skip</a>
    </div>
  </div>