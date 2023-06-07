
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
      <h3 class="dashboard-heading text-left">Create Property</h3>
      <hr class="style7">
      <div class="userinfo">
  

  <form id="createProperty" action="<?php echo base_url('properties/createProperty'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<span>
    <?php if (isset($success)) {
      echo '<div class="alert alert-success alert-dismissable"> ';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      print_r($success);
      echo '</span>';
      echo'</div>';
    } ?>
</span>
<span>
    <?php if (isset($errors)) {
      echo '<div class="alert alert-danger alert-dismissable"> ';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      print_r($errors);
      echo '</span>';
      echo'</div>';
    } ?>
</span>
      <div class="col-sm-6">

        <div class="form-group">
          <label for="name">Property Name</label>
          <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" id="name" placeholder="Name">
        </div>

        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type" required>
            <option value="">Select Type</option>
            <option value="Sale">for sale</option>
            <option value="Rent">for rent</option>
          </select>
        </div>

        <div class="form-group">
          <label for="address">Price</label>
          <input type="text" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>"  placeholder="Price">
        </div>
        
        <div class="form-group">
          <label for="address">Bedrooms</label>
          <input type="text" class="form-control" name="bedrooms" id="bedrooms" value="<?php echo set_value('bedrooms'); ?>"  placeholder="bedrooms">
        </div>
        
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value('address'); ?>"  placeholder="Address">
        </div>
        
        </div>
        
        <div class="col-sm-6">
        
        <div class="form-group">
          <label for="address">City</label>
          <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city'); ?>"  placeholder="City">
        </div>

        <div class="form-group">
          <label for="pets_allowed">Pets Allowed</label>
          <select class="form-control" name="pets_allowed" id="pets_allowed" required>
            <option value="">Pets Allowed</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>

        <div class="form-group">
          <label for="parking">Parking</label>
          <select class="form-control" name="parking" id="parking" required>
            <option value="">Select Parking</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>

        <div class="form-group">
          <label for="parking">Pool</label>
          <select class="form-control" name="pool" id="pool" required>
            <option value="">Select pool</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
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
        
        <div class="clear"></div>
        <div class="col-sm-12">
          <div id="map"></div>
        </div>
        
        <input type="hidden" name="gps" id="gps">
        <input type="hidden" name="longitude" id="longitude">
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
<script>
getLocation();

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getMap);
    } else {
         alert("Geolocation is not supported by this browser.");
    }
}

function getMap(position) {
  //if(position)
  //alert(position);
  var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var map = new google.maps.Map(document.getElementById('map'), {
    //center: {lat: -33.8688, lng: 151.2195},
    center: myLatlng,
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  var marker = new google.maps.Marker({
    position: myLatlng,
    map: map
  });
  $('#gps').val(position.coords.latitude +' ,'+position.coords.longitude);
  //$('#longitude').val(position.coords.longitude);
  // Create the search box and link it to the UI element.
  var input = document.getElementById('address');
  var searchBox = new google.maps.places.SearchBox(input);
  //map.controls[google.maps.ControlPosition.TOP_LEFT];
  
  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));
      $('#gps').val(place.geometry.location.G+' ,'+place.geometry.location.K);
      //$('#longitude').val(place.geometry.location.K);
      //alert('longlat : '+place.geometry.location.G +' ,'+place.geometry.location.K);
      //console.log(place);
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
  // [END region_getplaces]
}
</script>