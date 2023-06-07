<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
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
  .dashboard-heading{
		  color:#5cb85c !important;
	  }
	  .btn-primary{
		  font-size:13px !important;
	  }
	  @media screen and (min-width:992px) and (max-width:1199px){
      .unitnum{
        margin-right:28px !important;
      }
    }
    @media screen and (min-width:768px) and (max-width:991px){
      .unitnum{
        margin-right:42px !important;
      }
    }
</style>
  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">List Your Space</h3>
	<hr class="style7">
  
<form id="createProperty" action="<?php echo base_url('properties/editProperty'.'/'.$uri.'/'.encode_url($property_data[0]['property_id'])); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
      <div class="col-sm-6">

        <div class="form-group">
          <label for="name">Property Name</label>
          <input type="text" class="form-control" name="name" value="<?php echo $property_data[0]['name']; ?>" id="name" placeholder="Ex:  Great St. Louis apartment close to the Central West End" required>
        </div>
        <div class="clear5"></div>
		<div class="form-group">
		<div class="col-sm-12 padding0">
          <label for="date_from">Dates Available to Rent</label>
		  </div>
		  <div class="col-sm-6 col-xs-12" style="padding-left: 0">
		  
          <input type="text" class="form-control" name="date_from" value="<?php echo date('m/d/Y',$property_data[0]['date_from']); ?>" id="check-in" placeholder="From" required>
		  </div>
		  <div class="col-sm-6 col-xs-12" style="padding-right: 0">
          <input type="text" class="form-control" name="date_to" value="<?php echo date('m/d/Y',$property_data[0]['date_to']); ?>" id="check-out" placeholder="To" required>
		  </div>
        </div>
		<div class="clear5"></div>
        <div class="form-group">
		<div class="col-lg-9 col-md-8 col-sm-6 col-xs-9 padding0">
          <label for="address">Address</label>
          <input type="text" onchange="getMap()" class="form-control" name="address" id="autocomplete" value="<?php echo $property_data[0]['address']; ?>" placeholder="Ex: 1234 Chestnut Street" required>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-3 padding0">
			<label for="unit" class="pull-right unitnum" style="margin-right: 16px;">Unit Number</label>
            <input type="text" style="width:77%; float:right;" class="form-control" name="unit" id="" value="<?php echo $property_data[0]['unit']; ?>">
		</div>
        </div>
        <div class="clear5"></div>

        <div class="form-group">
          <label for="country">Country</label>
          <select class="form-control" onchange="get_stets(this)" name="country_id" id="country_id" required>
            <option value="" >Please Select</option>
            <option value="United States" <?php if($property_data[0]['country'] == 'United States'){ echo 'selected="selected"'; } ?> >United States</option>
            <?php 
            //helper function
            //get('table',where array,fields1,field2,order by array)
            $countries = get('countries',array('id !=' => 1),'*',array('country_name' => 'asc'));
            if($countries){
              foreach ($countries as $country) { ?>
                <option value="<?php echo $country['country_name']; ?>" <?php if($property_data[0]['country'] == $country['country_name']){ echo 'selected="selected"'; } ?> ><?php echo $country['country_name'];?></option>';
            <?php  }
            }else{
              echo '<option value="1">United States</option>';
            }?>
          </select>
        </div>
        <div class="clear5"></div>
        
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" name="city" id="locality" value="<?php echo $property_data[0]['city']; ?>" required>
        </div>
<div class="clear5"></div>
        <div class="form-group">

          <label for="state">State</label>
          <div id="state_input" <?php if($property_data[0]['country'] == 'United States'){ echo 'style="display:none"'; }else { echo 'style="display:block"'; } ?> >
            <input type="text" class="form-control" name="state" id="administrative_area_level_1" value="<?php echo $property_data[0]['state']; ?>" <?php if($property_data[0]['country'] == 'United States'){ echo 'disabled="disabled"'; } ?> required>
          </div>
          
          <div id="state_select" <?php if($property_data[0]['country'] == 'United States'){ echo 'style="display:block"'; }else { echo 'style="display:none"'; } ?> >
            <select class="form-control" name="state" id="state_id"  <?php if($property_data[0]['country'] != 'United States'){ echo 'disabled="disabled"'; } ?> required>
            <option value="">Please Select</option>
            <?php
            //helper function
            //get('table',where array,fields1,field2,order by array)
            $states = get('states',false,'*',array('state' => 'asc'));
            if($states){
              foreach ($states as $state) { ?>
                <option value="<?php echo $state['state']; ?>" <?php if($state['state'] == $property_data[0]['state']){ echo 'selected="selected"'; } ?> ><?php echo $state['state'];?></option>
            <?php  }
            }
            ?>
            </select>
          </div>

        </div>
<div class="clear5"></div>
        <div class="form-group">
          <label for="state">Zip Code</label>
          <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo $property_data[0]['zip_code']; ?>" required>
        </div>
<div class="clear5"></div>
        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type" required>
            <option value="">Please Select</option>
            <option value="Apartment" <?php if($property_data[0]['type'] == 'Apartment'){ echo 'selected="selected"'; } ?> >Apartment</option>
            <option value="Bedroom" <?php if($property_data[0]['type'] == 'Bedroom'){ echo 'selected="selected"'; } ?>>Bedroom</option>
            <option value="Condo" <?php if($property_data[0]['type'] == 'Condo'){ echo 'selected="selected"'; } ?> >Condo</option>            
            <option value="Dorm" <?php if($property_data[0]['type'] == 'Dorm'){ echo 'selected="selected"'; } ?> >Dorm</option>
            <option value="House" <?php if($property_data[0]['type'] == 'House'){ echo 'selected="selected"'; } ?> >House</option>
            <option value="Townhouse" <?php if($property_data[0]['type'] == 'Townhouse'){ echo 'selected="selected"'; } ?> >Townhouse</option>
            <option value="Other" <?php if($property_data[0]['type'] == 'Other'){ echo 'selected="selected"'; } ?>>Other</option>
          </select>
        </div>
<div class="clear5"></div>
        

       
        </div>
        
<div class="col-sm-6">

       <div class="form-group">
          <label for="address">Price</label>
          <input type="text" class="form-control" onblur="price_format()" name="price_pre" id="price_pre" value="<?php echo '$'.$property_data[0]['price'].'.00'; ?>" required>
          <input type="hidden" class="form-control" name="price" id="price" value="<?php echo $property_data[0]['price']; ?>" required>
        </div>
		<div class="clear5"></div>
        <div class="form-group">
          <label for="address">Bedroom(s)</label>
          <select class="form-control" name="bedrooms" id="bedrooms" required>
            <option value="">Please Select</option>
            <option value="Studio" <?php if($property_data[0]['bedrooms'] == 'Studio'){ echo 'selected="selected"'; } ?> >Studio</option>
            <?php for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php if($property_data[0]['bedrooms'] == $i){ echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
            <?php } ?>
           </select>
        </div>
<div class="clear5"></div>
        <div class="form-group">
          <label for="address">Bathroom(s)</label>
          <select class="form-control" name="bathrooms" id="bathrooms" required>
            <option value="">Please Select</option>
            <?php for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php if($property_data[0]['bathrooms'] == $i){ echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
            <?php } ?>
           </select>
        </div>
<div class="clear5"></div>

		<div class="form-group">
          <label for="square_feet">Square Feet</label>
          <input type="number" class="form-control" name="area" value="<?php echo $property_data[0]['area']; ?>" id="square_feet" min="1" required>
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
<div class="clear5"></div>
        <div class="form-group">
          <label for="pets_allowed">Pets Allowed?</label>
          <select class="form-control" name="pets_allowed" id="pets_allowed" required>
            <option value="">Please Select</option>
            <option value="Cats Only" <?php if($property_data[0]['pets_allowed'] == 'Cats Only'){ echo 'selected="selected"'; } ?>>Cats Only</option>
            <option value="Dogs Only" <?php if($property_data[0]['pets_allowed'] == 'Dogs Only'){ echo 'selected="selected"'; } ?>>Dogs Only</option>
            <option value="Dogs or Cats" <?php if($property_data[0]['pets_allowed'] == 'Dogs or Cats'){ echo 'selected="selected"'; } ?>>Dogs or Cats</option>
            <option value="No Pets" <?php if($property_data[0]['pets_allowed'] == 'No Pets'){ echo 'selected="selected"'; } ?>>No Pets</option>
            <option value="Other" <?php if($property_data[0]['pets_allowed'] == 'Other'){ echo 'selected="selected"'; } ?>>Other</option>
          </select>
        </div>
<div class="clear5"></div>
        <div class="form-group">
          <label for="parking">Parking?</label>
          <select class="form-control" name="parking" id="parking" required>
            <option value="">Please Select</option>
            <option value="Garage Parking" <?php if($property_data[0]['parking'] == 'Garage Parking'){ echo 'selected="selected"'; } ?> >Garage Parking</option>
            <option value="Street Parking" <?php if($property_data[0]['parking'] == 'Street Parking'){ echo 'selected="selected"'; } ?> >Street Parking</option>
            <option value="Covered Parking" <?php if($property_data[0]['parking'] == 'Covered Parking'){ echo 'selected="selected"'; } ?> >Covered Parking</option>
            <option value="Valet Parking" <?php if($property_data[0]['parking'] == 'Valet Parking'){ echo 'selected="selected"'; } ?> >Valet Parking</option>
            <option value="No Parking" <?php if($property_data[0]['parking'] == 'No Parking'){ echo 'selected="selected"'; } ?> >No Parking</option>
            <option value="Other" <?php if($property_data[0]['parking'] == 'Other'){ echo 'selected="selected"'; } ?> >Other</option>
          </select>
        </div>
        <!-- <div class="clear10"></div>
        <div class="form-group">
          <label for="image">Property Image</label>
          <div class="preview" align="center">
          <img class="img-responsive" id="img-preview" src="<?php if($property_data[0]['image'] != ''){ echo base_url('uploads/img_gallery/property_images').'/'.$property_data[0]['image']; }else{ echo 'images/default_image.png'; } ?>" alt="property image" />
          </div>
          <input type="file" class="form-control" name="image" id="image" value="<?php echo set_value('image'); ?>" onchange="readURL(this);" onload="readURL(this);">
        </div> -->
<div class="clear5"></div>
        <div class="form-group">
          <label for="description">Description (optional)</label>
          <textarea type="text" class="form-control" name="description" placeholder="Please include a couple of sentences describing your listing. What’s great about it? What’s the neighborhood like? Is it quiet and good for studying, or a great launching pad to head to bars?  Please also explain if you selected “Other” for any category." rows="5"><?php echo $property_data[0]['description']; ?></textarea>
        </div>

        </div>
        
        <div class="clear5"></div>
        <div class="col-sm-12">
          <div id="map" style="display:none;"></div>
        </div>
        
        
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