<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>

<style type="text/css">
.maplabels{
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;     
     border: 2px solid black;
     white-space: nowrap;
     margin-left:-20px !important;
}
.maplabels:visited{
    background-color: red !important;
}

    </style>
    <div class="container">
        <div class="search-home filter-result">
        <!--- -->
        <div class="col-sm-12">
              <input id="range-slider" name="range-slider" type="hidden" class="ui-slider" value="<?php if($this->session->userdata('filter_entry_fee') != ''){ echo str_replace(' ', ',', $this->session->userdata('filter_entry_fee')); }else{ echo "0,10000"; } ?>" />

                <div id="slider"></div>
            </div>
            <div class="form-group">
              <label for="amount" class="col-sm-6 control-label">Amount ($): </label>
              <span class="help-text">Please choose a price range</span>
              <div class="col-sm-6 text-right">
                <input type="hidden" id="amount" class="form-control">
                <p class="price lead" id="amount-label"></p>
                <span class="price" id="price">10 &nbsp;-&nbsp; $1000</span>
              </div>
            </div>
        <!--- -->
        	<form id="search">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fgroup">
                    <input type="text" name="address" id="autocomplete" value="<?php echo ($this->input->get('address') != '')? $this->input->get('address') : ''; ?>" class="form-control" placeholder="Where To? Let The Bindel Begin! Ex:  City, State" required>
                </div>
                <div class="hidden-lg hidden-md clear20"></div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fgroup">
                    <input type="text"  name="check-in" value="<?php echo ($this->input->get('check-in') != '')? $this->input->get('check-in') : ''; ?>" class="form-control" placeholder="Check In" id="check-in">
                </div>
                <div class="hidden-lg hidden-md clear20"></div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fgroup">
                    <input type="text" name="check-out" value="<?php echo ($this->input->get('check-out') != '')? $this->input->get('check-out') : ''; ?>" class="form-control" placeholder="Check Out" id="check-out">
                </div>
                <div class="hidden-lg hidden-md clear20"></div>
                <input type="hidden" name="min" id="min" value="<?php echo ($this->input->get('min') != '')? $this->input->get('min') : '10'; ?>">
                <input type="hidden" name="max" id="max" value="<?php echo ($this->input->get('max') != '')? $this->input->get('max') : '1000'; ?>">
                <input type="hidden" name="city" id="locality" value="<?php echo ($this->input->get('city') != '')? $this->input->get('city') : ''; ?>">
                <input type="hidden" name="state" id="administrative_area_level_1" value="<?php echo ($this->input->get('state') != '')? $this->input->get('state') : ''; ?>">
                <input type="hidden" name="country" id="country" value="<?php echo ($this->input->get('country') != '')? $this->input->get('country') : ''; ?>">
            </form>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 fgroup">
                <button id="search_property" class="btn btn-primary">search</button>
            </div>
            <?php if($this->session->userdata('logged_in')){ ?>
            <div class="clear5"></div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 fgroup pull-right">
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
<?php $this->load->view('errors'); ?>              	
<?php if($results){
$i = 0;
foreach ($results as $result) { ?>

      <?php
      $search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
          $img_src = 'images/default_image.png';
            if($search_image[0]['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $search_image[0]['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
            }
          ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 property" data-id="<?php echo $i; ?>">
                    <?php if($this->session->userdata('logged_in') == true){ ?>
                        <a href="<?php echo base_url('properties/addFavorite').'/'.$uri.'/'.encode_url($result['property_id']); ?>" class="favorite-btn"><i class="fa fa-heart-o"></i></a>
                    <?php } ?>
                    
                        <div class="list padding0">
                        <span class="list-label"><p>rent</p></span>
                            <img src="<?php echo $img_src; ?>" height="225" class="list-thumb" alt="" />
                            <div class="clear20"></div>
                          <div class="list-details">
                                <p class="list-title"><?php echo $result['name']; ?></p>
                                <p class="list-desc"><?php echo substr($result['description'], 0,40); ?></p>
                                <div class="clear10"></div>
                                <p class="list-price">$<?php echo $result['price'].'.00'; ?></p>
                                <div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32"></div>
                                <div class="clear5"></div>
                                <a href="<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>" class="pull-right readmore-list"> <i class="fa fa-arrow-right"></i> </a>
                          </div>
                		</div>
                	</div>
<?php $i++; } }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No Searches Found.';
        echo'</div>';
        } ?>
            <div class="clear50"></div>
            </div>


<div class="section-data search-results-wrap" style="display:none;">
                    
<?php if($results){
$i = 0;
foreach ($results as $result) { ?>

<?php

$gps = explode(',',$result['gps']);    
  if(sizeof($gps)==0){
    $gps[0] = 54.3205;
    $gps[1] = 24.3232;
  }
  if(sizeof($gps)==1){
    $gps[1] = 24.3232;
  }

      $search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
          $img_src = 'images/default_image.png';
            if($search_image[0]['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $search_image[0]['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
            }
?>
                    <div class="marker" data-lat="<?php echo $gps[0]; ?>" data-lng="<?php echo $gps[1]; ?>" data-price="$<?php echo $result['price']; ?>" data-id="<?php echo $i; ?>">
                    <?php if($this->session->userdata('logged_in')){ ?>
                        <a href="<?php echo base_url('properties/addFavorite').'/'.$uri.'/'.encode_url($result['property_id']); ?>" class="favorite-btn"><i class="fa fa-heart-o"></i></a>
                    <?php } ?>
                    
                        <div class="list padding0">
                        <span class="list-label"><p>rent</p></span>
                            <img src="<?php echo $img_src; ?>" height="150" width="200" alt="" />
                            <div class="clear"></div>
                            <div class="list-details">
                                <p class="list-title">Appartment:<?php echo $result['name']; ?></p>
                                <p class="list-desc"><?php echo substr($result['description'], 0,40); ?></p>
                                <div class="clear5"></div>
                                <div class="col-sm-8 padding0">
                                <p class="list-price">$<?php echo $result['price'].'.00'; ?></p>
                                </div>
                                <div class="col-sm-4 padding0">
                                  <a href="<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>" class="pull-right readmore-list"> <i class="fa fa-arrow-right"></i> </a>  
                                </div>
                                
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
             <input type="text" class="form-control validate[required]" id="title" name="title" maxlength="100" style=" border: 1px solid #ccc;">
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

var markers = [];
var map;
var gmarkers = [];
var $markers = [];
var myCenter=new google.maps.LatLng(37.09024,-95.71289100000001);


function initialize()
{
$markers = $('.search-results-wrap').find('.marker');
var mapProp = {
  center:myCenter,
  zoom:6,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

map = new google.maps.Map(document.getElementById("search_map"),mapProp);

var country = "<?php echo ($this->input->get('address') != '')? $this->input->get('address') : 'United States'; ?>"

var geocoder = new google.maps.Geocoder();
  geocoder.geocode( { 'address': country }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      map.fitBounds(results[0].geometry.viewport);
      
    } else {
      alert("Could not find location: " + location);
    }
});

map.markers = [];

  // add markers
  $markers.each(function(){      
      add_marker( $(this), map );
  });


}
google.maps.event.addDomListener(window, 'load', initialize);

</script>

<script type="text/javascript">
function add_marker( $marker, map ){

  // var
  var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

  // create marker
  var lable_content = $marker.attr('data-price');
  //alert(lable_content);
  var marker = new MarkerWithLabel({
      position  : latlng,
      map     : map,
      draggable: false,
      raiseOnDrag: true,
      labelContent: lable_content,
      labelAnchor: new google.maps.Point(0, 0),
      labelClass: "maplabels", // the CSS class for the label
      labelInBackground: true
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
        infowindow.close();
        infowindow.setContent(content);
         if($('.gm-style-iw').length) {
             $('.gm-style-iw').parent().hide();
          }
        infowindow.open(map, marker);
       // $('.gdfg').css;
      }
    }
    )(marker, content));

    google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
    });
 
 google.maps.event.addListener(infowindow, 'domready', function() {

    
    var iwOuter = $('.gm-style-iw');
    var iwBackground = iwOuter.prev();

    iwBackground.children(':nth-child(2)').css({'display' : 'none'});

    
    iwBackground.children(':nth-child(4)').css({'display' : 'none'});

    iwOuter.css({top: '30px'});
    
    var iwCloseBtn = iwOuter.next();

    
    iwCloseBtn.css({display: 'none'});

    if($('.iw-content').height() < 140){
      $('.iw-bottom-gradient').css({display: 'none'});
    }


    });
      
  }


}

$('.maplabels').on('click',function(){
    console.log('gdfgdf');
    alert('kljkl');
  });

</script>