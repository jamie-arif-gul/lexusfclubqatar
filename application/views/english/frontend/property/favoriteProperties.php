<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container"> 
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">Favorite Properties</h3>
      <hr class="style7">
      <div class="tbl_base">
      <?php $this->load->view('errors'); ?>
      <?php if($results) { ?>
      <table class="mypropertytbl" width="100%">
        <thead>
          <tr>
            <td>image</td>
            <td>name</td>
            <td>Type</td>
            <td>price</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result) { ?>
          <tr>
          <?php
          //$search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
          $img_src = 'images/default_image.png';
            if($result['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $result['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$result['image'];
            }
          ?>
            <td><img height="80" width="80" src="<?php echo $img_src; ?>" class="thumbnail" /></td>
            <td><a href="<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>"><?php echo $result['name']; ?></a></td>
            <td><?php echo $result['type']; ?></td>
            <td> $<?php echo $result['price']; ?></td>
            <td><a class="action" href="javascript:void(0)" onclick="delete_object('<?php echo encode_url($result['property_id']); ?>');">Remove</a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="clear10"></div>
      <div class="col-sm-12"><?php echo $pagination; ?></div>
      <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No properties found.';
        echo'</div>';
        } ?>
      </div>
    </div>
   </div>
  </div>

<script>
    function delete_object(id){
        var c = window.confirm("Are you sure, you want to remove from favrites?");
        if (c){
            window.location = '<?php echo base_url('properties/removeFavorite'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }
</script>