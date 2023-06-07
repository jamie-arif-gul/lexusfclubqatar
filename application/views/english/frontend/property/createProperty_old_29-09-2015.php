
    <style>
     
      #map {
        height: 300px;
      }

    </style>
    <title>Places Searchbox</title>
    <style>
      #target {
        width: 345px;
      }
    </style>

<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container">
    <div class="col-sm-12 dashboard-content">
      <h3 class="dashboard-heading text-left">List Your Space</h3>
      <hr class="style7">
      <div class="userinfo">
  

  <form id="createProperty" action="<?php echo base_url('properties/createProperty'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
      <div class="col-sm-6">

        <div class="form-group">
          <label for="name">Property Name</label>
          <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" id="name" placeholder="Ex: Great St. Louis apartment close to the Central West End" required>
        </div>
        
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" onchange="getMap()" class="form-control" name="address" id="autocomplete" value="<?php echo set_value('address'); ?>" placeholder="Ex: 1234 ChestnutStreet" required>
        </div>
        <input type="hidden" class="form-control" name="country" id="country" value="<?php echo set_value('country'); ?>" required>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" name="city" id="locality" value="<?php echo set_value('city'); ?>" required>
        </div>

        <div class="form-group">
          <label for="state">State</label>
          <input type="text" class="form-control" name="state" id="administrative_area_level_1" value="<?php echo set_value('state'); ?>" required>
        </div>

        <div class="form-group">
          <label for="country">Country</label>
          <select class="form-control" name="country_id" id="country_id" required>
            <option value="" <?php echo set_select('country_id', '', TRUE); ?>>Please Select</option>
            <?php 
            $countries = get('countries',array('id !=' => 0));
            if($countries){
              foreach ($countries as $country) { ?>
                <option value="<?php echo $country['id']; ?>" <?php echo set_select('country_id', $country['id']); ?> ><?php echo $country['country_name'];?></option>';
            <?php  }
            }else{
              echo '<option value="1">United States</option>';
            }?>
          </select>
        </div>


        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type" required>
            <option value="">Select Type</option>
            <option value="Apartment" <?php echo set_select('type', 'Apartment'); ?> >Apartment</option>
            <option value="Condo" <?php echo set_select('type', 'Condo'); ?>>Condo</option>
            <option value="House" <?php echo set_select('type', 'House'); ?>>House</option>
            <option value="Townhouse" <?php echo set_select('type', 'Townhouse'); ?>>Townhouse</option>
            <option value="Bedroom" <?php echo set_select('type', 'Bedroom'); ?>>Bedroom</option>
            <option value="Dorm" <?php echo set_select('type', 'Dorm'); ?>>Dorm</option>
          </select>
        </div>

        <div class="form-group">
          <label for="address">Price</label>
          <input type="text" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>" required>
        </div>
        
        </div>
        
        <div class="col-sm-6">
        
        <div class="form-group">
          <label for="address">Bedrooms</label>
          <input type="text" class="form-control" name="bedrooms" id="bedrooms" value="<?php echo set_value('bedrooms'); ?>" required>
        </div>

        <div class="form-group">
          <label for="address">Bathrooms</label>
          <input type="text" class="form-control" name="bathrooms" id="bathrooms" value="<?php echo set_value('bathrooms'); ?>" required>
        </div>

        <div class="form-group">
          <label for="address">Number of Guests</label>
          <input type="text" class="form-control" name="number_of_guests" id="number_of_guests" value="<?php echo set_value('number_of_guests'); ?>" required>
        </div>

        <div class="form-group">
          <label for="pets_allowed">Pets Allowed?</label>
          <select class="form-control" name="pets_allowed" id="pets_allowed" required>
            <option value="" <?php echo set_select('pets_allowed', '', TRUE); ?>>Please Select</option>
            <option value="Dogs Only" <?php echo set_select('pets_allowed', 'Dogs Only'); ?>>Dogs Only</option>
            <option value="Cats Only" <?php echo set_select('pets_allowed', 'Cats Only'); ?>>Cats Only</option>
            <option value="Dogs or Cats" <?php echo set_select('pets_allowed', 'Dogs or Cats'); ?>>Dogs or Cats</option>
            <option value="No Pets" <?php echo set_select('pets_allowed', 'No Pets'); ?>>No Pets</option>
            <option value="Other" <?php echo set_select('pets_allowed', 'Other'); ?>>Other</option>
          </select>
        </div>

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

        <div class="form-group">
          <label for="parking">Pool</label>
          <select class="form-control" name="pool" id="pool" required>
            <option value="" <?php echo set_select('pool', '', TRUE); ?> >Select pool</option>
            <option value="Yes" <?php echo set_select('pool', 'Yes'); ?> >Yes</option>
            <option value="No" <?php echo set_select('pool', 'No'); ?> >No</option>
          </select>
        </div>

        <div class="form-group">
          <label for="image">Property Image</label>
          <input type="file" class="form-control" name="image" id="image" value="<?php echo set_value('image'); ?>" onchange="readURL(this);" onload="readURL(this);">
        </div>
        <div class="form-group">
          <img class="img-responsive" id="img-preview" src="#" alt="property image" height="50" width="50" />
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="text" class="form-control" name="description" id="description" placeholder="Description"><?php echo set_value('description'); ?></textarea>
        </div>
        </div>
        
        <div class="clear10"></div>
        <div class="col-sm-12">
          <div id="map" style="display:none;"></div>
        </div>
        
        <input type="hidden" name="gps" id="gps" value="<?php echo isset($_POST['gps'])? $_POST['gps'] : ''; ?>">
        
        <div class="clear5"></div>
        <div class="col-sm-12">
        <button type="submit" class="btn btn-danger" >Create</button>
        </div>
  
  </form>

  
</div>
  </div>
  </div>
  </div>
  </div>
<script type="text/javascript">
var myCenter = new google.maps.LatLng(51.508742,-0.120850);

function initialize()
{
  //alert($('#autocomplete').val());
//myCenter = new google.maps.LatLng($('#autocomplete').val());
var mapProp = {
  center:myCenter,
  zoom:8,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("map"),mapProp);
var markers = [];
var country = $('#autocomplete').val();

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

function getMap(){
  if($('#autocomplete').val() != ''){
    $('#map').show();
    setTimeout(function(){
      initialize();
     }, 1000);
  }else{
    $('#map').html('');
    $('#map').hide();
  }
 }

</script>
