 <style type="text/css">
  #img-preview{
    display: block !important;
  }
  .preview{
    background-color: #fff;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #000;
    width: 100%;
    height: 410px;
    overflow: hidden;
  }
  #map {
        height: 300px;
      }
	  .dashboard-heading{
		  color:#5cb85c !important;
	  }
	  .btn-primary{
		  font-size:13px !important;
	  }
</style> 

  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">List Your Space</h3>
	<hr class="style7">
  
<form id="createProperty" action="<?php echo base_url('properties/createProperty'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
      <div class="col-sm-6">

        <div class="form-group">
          <label for="name">Property Name</label>
          <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" id="name" placeholder="Ex:  Great St. Louis apartment close to the Central West End" required>
        </div>
        <div class="clear5"></div>
		<div class="form-group">
		<div class="col-sm-12 padding0">
          <label for="date_from" style="line-height:2.6;">Dates Available to Rent</label>
		  </div>
		  <div class="col-sm-6 col-xs-12" style="padding-left: 0">
		  
          <input type="text" class="form-control" name="date_from" value="<?php echo set_value('date_from'); ?>" id="check-in" placeholder="From" required>
		  </div>
		  <div class="col-sm-6 col-xs-12" style="padding-right: 0">
          <input type="text" class="form-control" name="date_to" value="<?php echo set_value('date_to'); ?>" id="check-out" placeholder="To" required>
		  </div>
        </div>
        <div class="clear5"></div>
        <div class="form-group">
		<div class="col-sm-8 col-xs-12" style="padding-left: 0;">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" value="<?php echo set_value('address'); ?>" placeholder="Ex: 1234 Chestnut Street" required>
		</div>
		<div class="col-sm-4 col-xs-12" style="padding-right: 0;">
			<label for="unit">Unit Number</label>
            <input type="text" class="form-control" name="unit" id="" value="<?php echo set_value('unit'); ?>">
		</div>
        </div>
<div class="clear10"></div>
        <div class="form-group">
          <label for="country">Country</label>
          <select class="form-control" onchange="get_stets(this)" name="country_id" id="country_id" required>
            <option value="" <?php echo set_select('country_id', '', TRUE); ?>>Please Select</option>
            <option value="1" <?php echo set_select('country_id', 1); ?> >United States</option>
            <?php
            //helper function
            //get('table',where array,fields1,field2,order by array)
            $countries = get('countries',array('id !=' => 1),'*',array('country_name' => 'asc'));
            if($countries){
              foreach ($countries as $country) { ?>
                <option value="<?php echo $country['id']; ?>" <?php echo set_select('country_id', $country['id']); ?> ><?php echo $country['country_name'];?></option>
            <?php  }
            }
            ?>
          </select>
        </div>

        <input type="hidden" class="form-control" name="country" id="country" value="<?php echo set_value('country'); ?>" required>
        <div class="clear10"></div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" name="city" id="locality" value="<?php echo set_value('city'); ?>" required>
        </div>
<div class="clear10"></div>
        <div class="form-group">
          <label for="state">State</label>
          <div id="state_input">
            <input type="text" class="form-control" name="state" id="administrative_area_level_1" value="<?php echo set_value('state'); ?>" required>
          </div>
          
          <div id="state_select" style="display:none;">
            <select class="form-control" name="state" id="state_id" disabled required>
            <option value="" <?php echo set_select('state', '', TRUE); ?>>Please Select</option>
            <?php
            //helper function
            //get('table',where array,fields1,field2,order by array)
            $states = get('states',false,'*',array('state' => 'asc'));
            if($states){
              foreach ($states as $state) { ?>
                <option value="<?php echo $state['state']; ?>" <?php echo set_select('state', $state['state']); ?> ><?php echo $state['state'];?></option>
            <?php  }
            }
            ?>
          </select>
          </div>


        </div>
<div class="clear10"></div>
        <div class="form-group">
          <label for="state">Zip Code</label>
          <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo set_value('zip_code'); ?>" required>
        </div>
<div class="clear10"></div>
        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type" required>
            <option value="">Please Select</option>
            <option value="Apartment" <?php echo set_select('type', 'Apartment'); ?> >Apartment</option>          
            <option value="Bedroom" <?php echo set_select('type', 'Bedroom'); ?>>Bedroom</option>
            <option value="Condo" <?php echo set_select('type', 'Condo'); ?>>Condo</option>
            <option value="Dorm" <?php echo set_select('type', 'Dorm'); ?>>Dorm</option>
            <option value="House" <?php echo set_select('type', 'House'); ?>>House</option>
            <option value="Townhouse" <?php echo set_select('type', 'Townhouse'); ?>>Townhouse</option>
          </select>
        </div>
<div class="clear10"></div>

        </div>
        
        <div class="col-sm-6">
		
            <div class="form-group">
          <label for="address">Price</label>
          <input type="text" class="form-control" onblur="price_format()" name="price_pre" id="price_pre" value="<?php echo set_value('price_pre'); ?>" required>
          <input type="hidden" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>">
        </div>
<div class="clear10"></div>
		
        <div class="form-group">
          <label for="address">Bedroom(s)</label>
          <select class="form-control" name="bedrooms" id="bedrooms" required>
            <option value="">Please Select</option>
            <?php for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php echo set_select('bedrooms', $i); ?> ><?php echo $i; ?></option>
            <?php } ?>
           </select>
        </div>
<div class="clear10"></div>
        <div class="form-group">
          <label for="address">Bathroom(s)</label>
          <select class="form-control" name="bathrooms" id="bathrooms" required>
            <option value="">Please Select</option>
            <?php for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php echo set_select('bathrooms', $i); ?> ><?php echo $i; ?></option>
            <?php } ?>
           </select>
        </div>
  <div class="clear10"></div>
        
        <div class="form-group">
          <label for="square_feet">Square Feet</label>
          <input type="number" class="form-control" name="area" value="<?php echo set_value('area'); ?>" id="square_feet" required>
        </div>
        <!--<div class="form-group">
          <label for="address">Number of Guests</label>
          <select class="form-control" name="number_of_guests" id="number_of_guests" required>
            <option value="">Please Select</option>
            <?php //for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php //echo $i; ?>" <?php //if($property_data[0]['number_of_guests'] == $i){ echo 'selected="selected"'; } ?> ><?php //echo $i; ?></option>
            <?php //} ?>
           </select>
        </div>-->
		
<div class="clear10"></div>
        <div class="form-group">
          <label for="pets_allowed">Pets Allowed?</label>
          <select class="form-control" name="pets_allowed" id="pets_allowed" required>
            <option value="" <?php echo set_select('pets_allowed', '', TRUE); ?>>Please Select</option>
            <option value="Cats Only" <?php echo set_select('pets_allowed', 'Cats Only'); ?>>Cats Only</option>
            <option value="Dogs Only" <?php echo set_select('pets_allowed', 'Dogs Only'); ?>>Dogs Only</option>
            <option value="Dogs or Cats" <?php echo set_select('pets_allowed', 'Dogs or Cats'); ?>>Dogs or Cats</option>
            <option value="No Pets" <?php echo set_select('pets_allowed', 'No Pets'); ?>>No Pets</option>
            <option value="Other" <?php echo set_select('pets_allowed', 'Other'); ?>>Other</option>
          </select>
        </div>
<div class="clear10"></div>
        <div class="form-group">
          <label for="parking">Parking?</label>
          <select class="form-control" name="parking" id="parking" required>
            <option value="">Please Select</option>
            <option value="Garage Parking" <?php echo set_select('parking', 'Garage Parking'); ?>>Garage Parking</option>
            <option value="Street Parking" <?php echo set_select('parking', 'Street Parking'); ?>>Street Parking</option>
            <option value="Covered Parking" <?php echo set_select('parking', 'Covered Parking'); ?>>Covered Parking</option>
            <option value="Valet Parking" <?php echo set_select('parking', 'Valet Parking'); ?>>Valet Parking</option>
            <option value="No Parking" <?php echo set_select('parking', 'No Parking'); ?>>No Parking</option>
            <option value="Other" <?php echo set_select('parking', 'Other'); ?>>Other</option>
          </select>
        </div>
<div class="clear10"></div>
<!--<div class="clear10"></div>
        <div class="form-group">        
          <label for="image">Property Image</label>
          <div class="preview" align="center">
          <img class="img-responsive" id="img-preview" src="images/default_image.png" alt="property image" />
          </div>
          <input type="file" class="btn btn-success" name="image" id="image" value="<?php echo set_value('image'); ?>" onchange="readURL(this);" onload="readURL(this);">
        </div> -->
        <div class="clear10"></div>
        <div class="form-group">
          <label for="description">Description (optional)</label>
          <textarea type="text" class="form-control" name="description" id="description" placeholder="Please include a couple of sentences describing your listing. What’s great about it? What’s the neighborhood like? Is it quiet and good for studying, or a great launching pad to head to bars?  Please also explain if you selected “Other” for any category." rows="5"><?php echo set_value('description'); ?></textarea>
        </div>
        
        </div>
        
        <div class="clear10"></div>
        <div class="col-sm-12">
          <div id="map" style="display:none;"></div>
        </div>
        
        <input type="hidden" name="gps" id="gps" value="<?php echo isset($_POST['gps'])? $_POST['gps'] : ''; ?>">
        
        <div class="clear5"></div>

      <div class="clear20"></div>
      <hr class="style7">
	  
	  <div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 pull-right padding0">
      <button class="btn btn-primary" type="submit"> <i class="fa fa-angle-double-right"></i> Next</button>
    </div>
	<div class="clear20"></div>
      <div class="col-sm-12 padding0">
      <!-- <label for="progress">Step 1 of 4</label>
      	<progress id="progressbar" value="25" max="100"></progress> -->
		
		<!--- new progress bar -->
    <label for="progress" class="progress_steps">Step 1 of 4</label>
		<div class="progress">
	  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
	  </div>
	</div>

<!-- new progress bar end -->
      </div>
      
    </form>
  </div>
<div class="clear10"></div>
<script type="text/javascript">
  function price_format(){
    var p = $('#price_pre').val().replace('$', '');
    var price = p.split('.');
    //alert(price[0]);
    if(price[0] != ''){
      if (price[0]%1 === 0){
        $('#price_pre').val('$'+price[0]+'.00');
        $('#price').val(price[0]);
      }
    else{
        alert("price is not an integer");
        $('#price_pre').val('');
        $('#price').val('');
      }
    }

  }
</script>