<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
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
      <h3 class="dashboard-heading text-left">Edit Property</h3>
      <hr class="style7">
      <div class="userinfo">
  

  <form id="createProperty" action="<?php echo base_url('properties/editProperty'.'/'.$uri.'/'.encode_url($property_data[0]['property_id'])); ?>" method="post" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
      <div class="col-sm-6">

        <div class="form-group">
          <label for="name">Property Name</label>
          <input type="text" class="form-control" name="name" value="<?php echo $property_data[0]['name']; ?>" id="name">
        </div>

        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type" required>
            <option value="">Select Type</option>
            <option <?php echo ($property_data[0]['type'] == 'Sale')? 'selected="selected"' : ''; ?> value="Sale">for sale</option>
            <option <?php echo ($property_data[0]['type'] == 'Rent')? 'selected="selected"' : ''; ?> value="Rent">for rent</option>
          </select>
        </div>

        <div class="form-group">
          <label for="address">Price</label>
          <input type="text" class="form-control" name="price" id="price" value="<?php echo $property_data[0]['price']; ?>" >
        </div>
        
        <div class="form-group">
          <label for="address">Bedrooms</label>
          <input type="text" class="form-control" name="bedrooms" id="bedrooms" value="<?php echo $property_data[0]['bedrooms']; ?>" >
        </div>

        <div class="form-group">
          <label for="pets_allowed">Pets Allowed</label>
          <select class="form-control" name="pets_allowed" id="pets_allowed" required>
            <option value="">Pets Allowed</option>
            <option <?php echo ($property_data[0]['pets_allowed'] == 'Yes')? 'selected="selected"' : ''; ?> value="Yes">Yes</option>
            <option <?php echo ($property_data[0]['pets_allowed'] == 'No')? 'selected="selected"' : ''; ?> value="No">No</option>
          </select>
        </div>

        <div class="form-group">
          <label for="parking">Parking</label>
          <select class="form-control" name="parking" id="parking" required>
            <option value="">Select Parking</option>
            <option <?php echo ($property_data[0]['parking'] == 'Yes')? 'selected="selected"' : ''; ?> value="Yes">Yes</option>
            <option <?php echo ($property_data[0]['parking'] == 'No')? 'selected="selected"' : ''; ?> value="No">No</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" onchange="getMap()" class="form-control" name="address" id="autocomplete" value="<?php echo $property_data[0]['address']; ?>" >
        </div>
        
        </div>
        
        <div class="col-sm-6">        
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" name="city" id="locality" value="<?php echo $property_data[0]['city']; ?>">
        </div>

        <div class="form-group">
          <label for="state">State</label>
          <input type="text" class="form-control" name="state" id="administrative_area_level_1" value="<?php echo $property_data[0]['state']; ?>">
        </div>

        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" class="form-control" name="country" id="country" value="<?php echo $property_data[0]['country']; ?>">
        </div>

        <div class="form-group">
          <label for="parking">Pool</label>
          <select class="form-control" name="pool" id="pool" required>
            <option value="">Select pool</option>
            <option value="Yes" <?php echo ($property_data[0]['pool'] == 'Yes')? 'selected="selected"' : ''; ?> >Yes</option>
            <option value="No" <?php echo ($property_data[0]['pool'] == 'No')? 'selected="selected"' : ''; ?> >No</option>
          </select>
        </div>

        <div class="form-group">
          <label for="image">Property Image</label>
          <input type="file" class="form-control" name="image" id="image" value="<?php echo set_value('image'); ?>" onchange="readURL(this);" onload="readURL(this);">
        </div>
        <div class="clear10"></div>
        <div class="form-group">
          <img class="img-responsive" id="img-preview" src="" alt="property image" height="50" width="50" />
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="text" class="form-control" name="description" id="description"><?php echo $property_data[0]['description']; ?></textarea>
        </div>
        </div>
        
        <div class="clear"></div>
        <div class="col-sm-12">
          <div id="map" style="display:none;"></div>
        </div>
        
        <input type="hidden" name="gps" id="gps" value="<?php echo $property_data[0]['gps']; ?>">
        
        <div class="clear5"></div>
        <div class="col-sm-12">
        <button type="submit" class="btn btn-danger" >Update</button>
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
$(document).ready(function(){
getMap();
});
</script>