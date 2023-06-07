<!--- Ratings CSS -->
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/content/bigstars.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/content/antenna.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/content/svg.css" rel="stylesheet" type="text/css">
<!-- syntax highlighter -->
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/sh/shCore.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/frontend'); ?>/rateit/example/sh/shCoreDefault.css" rel="stylesheet" type="text/css">

<!--- Ratings JS -->
<script src="<?php echo base_url('assets/frontend'); ?>/rateit/src/jquery.rateit.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){

$(".fancybox-button").fancybox({
    prevEffect    : 'none',
    nextEffect    : 'none',
    closeBtn    : false,
    helpers   : {
      title : { type : 'inside' },
      buttons : {}
    }
  });

});
</script>
<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<style type="text/css">
.list-thumb {
    width: 100%;
}
.gallery-thumbnails {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    padding: 10px;
}
.list-details2 {
    background: #f2f2f2 none repeat scroll 0 0;
    float: left;
    margin-bottom: 10px;
    padding: 5px 20px;
}
.list-title-main {
    border: 1px dashed #ccc;
    border-radius: 4px;
    clear: both;
    float: left;
    margin-bottom: 20px;
    padding: 15px;
}
.list-desc-main {
    color: #706666;
    font-size: 20px;
    font-weight: bold;
}
.list-price {
    color: #d13027;
    float: left;
    font-size: 22px;
}
.list-tags2 a {
    background: #214472 none repeat scroll 0 0;
    color: #fff;
    padding: 3px;
}
.property-txt {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    display: table;
}
.property-txt .list-title-main {
    background: #214472 none repeat scroll 0 0;
    border: 0 none;
    border-radius: 0;
    color: #fff;
    margin-right: 20px;
}
ul.amenities-res {
    padding-left: 20px;
}
ul.amenities-res li {
    list-style-image: url("<?php echo base_url('assets/frontend/images/list-checkmark.png'); ?>");
}
.clear10{
	clear: both;
	height: 10px;
}
.clear20{
	clear: both;
	height: 20px;
}
.clear5{
	clear: both;
	height: 5px;
}
.padding0{
   padding: 0;
}
.rateit {
    float: left;
    padding: 5px;
}
.rateit {
    width: 50%;
}
button.rateit-reset {
    display: none !important;
}

hr.style7 {
    border-bottom: 1px solid #fff;
    border-top: 1px solid #8c8b8b;
}

.master-title {
    background: #214472 none repeat scroll 0 0;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    color: white;
    margin-bottom: 0;
    padding: 10px;
}

.user-reviews {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    border-color: -moz-use-text-color #ccc #ccc;
    border-image: none;
    border-style: none solid solid;
    border-width: 0 1px 1px;
    height: 150px;
    overflow-x: hidden;
    overflow-y: auto;
    padding: 25px;
}

.user-reviews .review {
    border-bottom: 1px solid #ccc;
    display: table;
    margin-bottom: 20px;
    padding-bottom: 10px;
    width: 100%;
}
.delete-review{
  background-color: #D13027;
  padding: 0px 5px;
  color: #fff;
  border-radius: 10px;
}
.delete-review:hover{
  color: #fff;
  font-weight: bold;
}



</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Property Detail
            </header>
              <?php
              //$property_data = get('properties',array('property_id' => $property_id));
              if($property_data){ ?>
                <div class="col-sm-12 padding0">
                	<div class="col-sm-3 padding0">
                		<?php //print_r($property_data); ?>
                		 <?php 
			              $search_image = get('property_images',array('property_id' => $property_data[0]['property_id'],'type' => 1));
                    $p_img = base_url('assets/frontend').'/images/default_image.png';
                    if($search_image[0]['image'] != ''){
                      $p_img = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
                    }
			            ?>
			            <img src="<?php echo $p_img; ?>" class="list-thumb" alt="" />
	<div class="gallery-thumbnails text-center">
        <?php $all_images = get('property_images',array('property_id' => $property_data[0]['property_id']));

        if($all_images){
          foreach ($all_images as $images) {
            $image = base_url('assets/frontend/images/default_image.png');
            if($images['image'] != ''){
                $image = base_url('uploads/img_gallery/property_images').'/'.$images['image'];
              }
            ?>
             <a class="fancybox-button" rel="fancybox-button" href="<?php echo $image; ?>" title="<?php echo $images['image_description']; ?>">
              <img src="<?php echo $image; ?>" class="img-thumbnail" width="15%" />
             </a>
        <?php  } } ?>
        </div>
       </div>        	
       
       <div class="col-sm-9 list-details2">
                		
        <div class="clear10"></div>
        <p class="list-title-main alert"><?php echo $property_data[0]['type']; ?></p>
        <div class="rateit bigstars" style="padding:8px;" data-rateit-value="<?php echo get_rating($property_data[0]['property_id']); ?>" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-readonly="true"></div>
        <div class="clear10"></div>
        <p class="list-desc-main"><?php echo $property_data[0]['name']; ?></p>
        <p class="list-desc-main"><?php echo $property_data[0]['city'].', '.$property_data[0]['state'].', '.$property_data[0]['country']; ?></p>
        <p class="list-desc-main">Dates Available: <?php echo date('m/d/y',$property_data[0]['date_from']); ?>&nbsp;-&nbsp;<?php echo date('m/d/y',$property_data[0]['date_to']); ?></p>
        <hr />
              
              <p class="list-price" style="width:100%;"> <i class="fa fa-money"></i> $<?php echo $property_data[0]['price']; ?>.00</p>
        <hr />
        <div class="clear10"></div>
        <div class="list-tags2"> <i class="fa fa-tags fatag"></i> 
          <a href="<?php echo base_url('#'); ?>">Bedrooms:<?php echo $property_data[0]['bedrooms']; ?></a> 
          <a href="<?php echo base_url('#'); ?>">Bathrooms:<?php echo $property_data[0]['bathrooms']; ?></a> 
          <a href="<?php echo base_url('#'); ?>">Pets:<?php echo $property_data[0]['pets_allowed']; ?></a> 
          <a href="<?php echo base_url('#'); ?>">Parking:<?php echo $property_data[0]['parking']; ?></a> 
         
        </div>
        <div class="clear20"></div>
        <div class="alert alert-info property-txt" style="width:100%;">
        <p class="list-title-main alert">Description:</p>
		<?php echo $property_data[0]['description']; ?> <br/>
    	<?php echo $property_data[0]['additional_description']; ?>
        </div>
        
        <div class="clear5"></div>
        <div class="col-sm-6" style="padding-left:0px;">
          <div class="alert">
          <p class="list-title-main alert" style="width:100%;">Amenities:</p>
          <div class="clear10"></div>
          <ul class="amenities-res">
          <?php
          if($property_data[0]['amenities'] != ''){
             $amenities = json_decode($property_data[0]['amenities'],true);
             foreach ($amenities as $amenitie) {
               echo '<li>'.$amenitie.'</li>';
             }
          }else{
            echo '<li>amenities are not avilible</li>';
          }
          ?>
		  </ul>
          </div>
        </div>

        <div class="col-sm-6" style="padding-left:0px;">
          <div class="alert">
          <p class="list-title-main alert" style="width:100%;">Stereotype Your Neighborhood:</p>
          <?php //echo $property_data[0]['description']; ?>
		  <div class="clear10"></div>
		  <ul class="amenities-res">
			<?php 
          if($property_data[0]['stereotype'] != ''){
             $stereotypes = json_decode($property_data[0]['stereotype'],true);
             foreach ($stereotypes as $stereotype) {
               echo '<li>'.$stereotype.'</li>';
             }
          }else{
            echo '<li>Stereotype Your Neighborhood are not avilible</li>';
          }
          ?>
		  </ul>
          </div>
        </div>

<div class="clear5"></div>
<hr class="style7">
    <!---- user reviews ---->
    <h4 class="master-title">User Reviews</h4>
    <div class="user-reviews">
      <div class="col-sm-12 col-xs-12">

  <?php if($reviews){
    foreach ($reviews as $review) { ?>
        <div class="review">
              <div class="reviewer-pic col-sm-2 col-xs-12">
            <img src="<?php echo base_url()."assets/frontend/images/reviewer.png" ?>" class="img-responsive img-thumbnail" />
          </div>
          <div class="col-sm-10 col-xs-12">
            <strong><?php echo $review['name'].' '.$review['last_name']; ?></strong> &nbsp; <i class="text-muted"><?php echo date('m-d-Y' , strtotime($review['updated'])); ?></i>
            <a href="javascript:void(0)" onclick="delete_object('<?php echo encode_url($review['rating_id']); ?>')" class="delete-review pull-right">x</a>
            <br>
            <p><?php echo $review['reviews']; ?></p>
          </div>
        </div>
  <?php } }else {
                    echo '<div class="alert alert-danger alert-dismissable"> ';
                    echo 'No Reviews available.';
                    echo'</div>';
                } ?>
          
      </div>
    </div>


                	</div>
                </div>
              <?php }else{
              echo '<div class="alert alert-danger alert-dismissable"> ';
        			echo 'No property detail found..';
        			echo'</div>';
              	}
              ?>
         <div class="col-sm-12">
         	<a href="<?php echo base_url('administrator/manage_properties').'/'.$uri; ?>" class="btn btn-primary pull-right">Back</a>
         </div>
        </section>
            <!-- page end-->
        </section> 
    </section>

<script>
  function delete_object(id){
      var c = window.confirm("Are you sure, you want to delete this review?");
      if (c){
        window.location = '<?php echo base_url('administrator/delete_review'); ?>/<?php echo $uri; ?>/<?php echo $this->uri->segment(4); ?>/'+ id;
      }
    }
</script>