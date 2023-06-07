<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">Create Property</header>
            <div class="panel-body">
                <?php $this->load->view('errors'); ?>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <div class="col-md-7">
                        <form method="post" role="form" id="create_user" action="create_user">
                            <div class="form-group">
                                <label for="first_name">Property Name</label>
                                <input type="text" value="<?php echo set_value('name') ?>" class="form-control" id="name" name="name" required>
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
                              <input type="text" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>" >
                            </div>
                            <div class="form-group">
                              <label for="address">Bedrooms</label>
                              <input type="text" class="form-control" name="bedrooms" id="bedrooms" value="<?php echo set_value('bedrooms'); ?>" >
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
                              <label for="address">Address</label>
                              <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value('address'); ?>" >
                            </div>

                            <div class="form-group">
                              <label for="city">City</label>
                              <input type="text" class="form-control" name="city" id="locality" value="<?php echo set_value('city'); ?>">
                            </div>

                            <div class="form-group">
                              <label for="state">State</label>
                              <input type="text" class="form-control" name="state" id="administrative_area_level_1" value="<?php echo set_value('state'); ?>">
                            </div>

                            <div class="form-group">
                              <label for="country">Country</label>
                              <input type="text" class="form-control" name="country" id="country" value="<?php echo set_value('country'); ?>">
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
                              <textarea type="text" class="form-control" name="description" placeholder="Description"><?php echo set_value('description'); ?></textarea>
                            </div>
                            

                          <input type="hidden" name="gps" id="gps" value="<?php echo isset($_POST['gps'])? $_POST['gps'] : ''; ?>">
                                  <input type="hidden" name="" id="street_number">
                                  <input type="hidden" name="" id="route">
                                  <input type="hidden" name="zip" id="postal_code">
                                  <input type="hidden" name="country" id="country">


                            <input type="submit" value="Create" class="btn btn-shadow btn-primary"/>
                        </form>
                        </div>
                        <div class="clear"></div>
                          <div class="col-sm-12">
                            <div id="map"></div>
                          </div>
                    </div>

                </div>
            </div>
        </section>   

</section>
</section>

<script>
var placeSearch, searchBox;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete(){
  //if(position)
  //alert(position);
  var myLatlng = new google.maps.LatLng(31.55460609999999 ,74.35715809999999);
  <?php if(isset($_POST['gps'])){ ?>
    var myLatlng = new google.maps.LatLng(<?php echo $_POST['gps']; ?>);
  <?php } ?>
  
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
  //$('#gps').val(position.coords.latitude +' ,'+position.coords.longitude);
  //$('#longitude').val(position.coords.longitude);
  // Create the search box and link it to the UI element.
  var input = document.getElementById('address');
  searchBox = new google.maps.places.SearchBox(input);
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
      $('#gps').val(place.geometry.location.H+' ,'+place.geometry.location.L);
      //$('#longitude').val(place.geometry.location.K);
      //alert('longlat : '+place.geometry.location.G +' ,'+place.geometry.location.K);
      //console.log(place);
      for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
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


// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = searchBox.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGdT9HWlXzs7eWW95LFVVb3VSGuvewn3A&libraries=places&callback=initAutocomplete" async defer></script>


