<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<meta name="google-signin-client_id" content="520795234001-5lmfkn9s6og7hu2opir22j7sjamd0n1n.apps.googleusercontent.com">
</head>
<body>
<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="map" style="height:250px;"></div>
<script type="text/javascript">
function initMap(a,b) {

  var myLatLng = {lat: a, lng: b};

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

google.maps.event.addDomListener(window, 'load', initMap(29.353452,71.702271));
</script>

<script src="https://apis.google.com/js/platform.js" async defer></script>

<script type="text/javascript">

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
}
</script>

<div class="g-signin2" data-onsuccess="onSignIn"></div>
</body>
</html>