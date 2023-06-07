<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<style type="text/css">
  .block{
    height: 100%;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    position: absolute;
    text-align: center;
    font-size: 50px;
    color: #FB0000;
  }
</style>
<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container"> 
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">My Properties</h3>
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
            <td>
            <!-- <div class="block"><i class="fa fa-ban"></i></div> -->
            <img height="80" width="80" src="<?php echo $img_src; ?>" class="thumbnail" />
            </td>
            <td><a href="<?php echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>"><?php echo $result['name']; ?></a></td>
            <!-- <td><a href="<?php //echo base_url('#'); ?>"><?php //echo $result['name']; ?></a></td> -->
            <td><?php echo $result['type']; ?></td>
            <td> $<?php echo $result['price'].'.00'; ?></td>
            <td>
            <?php if($result['request_status'] != ''){
               if($result['request_status'] == 1 && $result['cancel_on'] == 0){ ?>
                 <a  href="javascript:void(0)">Rented</a> | <a class="action" href="javascript:void(0)" onclick="cancel_request('<?php echo encode_url($result['request_id']); ?>');">Cancel</a>
              <?php }elseif($result['request_status'] == 0 && $result['cancel_on'] == 0){ ?>
                <span id="processing">
                <a  href="javascript:void(0)" onclick="accept_request('<?php echo encode_url($result['request_id']); ?>');">Accept</a> |
                <a  href="javascript:void(0)" onclick="reject_request('<?php echo encode_url($result['request_id']); ?>');">Reject</a>
                </span>
              <?php }else{ ?>
                <a class="action" href="<?php echo base_url('properties/editProperty').'/'.$uri.'/'.encode_url($result['property_id']); ?>">Edit</a> | <a class="action" href="javascript:void(0)" onclick="delete_object('<?php echo encode_url($result['property_id']); ?>');">Delete</a>
              <?php }
              ?>
            
            <?php }else{ ?>
               <a class="action" href="<?php echo base_url('properties/editProperty').'/'.$uri.'/'.encode_url($result['property_id']); ?>">Edit</a> | <a class="action" href="javascript:void(0)" onclick="delete_object('<?php echo encode_url($result['property_id']); ?>');">Delete</a>
            <?php } ?>

            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="clear10"></div>
      <div class="col-sm-12"><?php echo $pagination; ?></div>
      <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No Properties Found.';
        echo'</div>';
        } ?>
      </div>
    </div>
   </div>
  </div>

<script>
    function delete_object(id){
        var c = window.confirm("Are you sure, you want to delete this property?");
        if (c){
            window.location = '<?php echo base_url('properties/deleteProperty'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }
</script>

<script>
    function accept_request(id){
      alert("In order to Accept, you must click on \"Pending\" and Accept Guest's Request.");
        /*var c = window.confirm("Are you sure, you want to accept this request?");
        $('#processing').html('<img src="images/processing.gif"/>');
        if (c){
            window.location = '<?php echo base_url('requests/acceptRequest'); ?>/<?php echo $uri; ?>/'+ id;
        }*/
    }

    function reject_request(id){
        var c = window.confirm("Are you sure, you want to reject this request?");
        if (c){
            window.location = '<?php echo base_url('requests/rejectRequest'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }
    
    function cancel_request(id){
        var c = window.confirm("Are you sure you want to cancel your reservation? Please review our Guest Refund Policy and Help Section before proceeding.");
        if (c){
            window.location = '<?php echo base_url('requests/cancelRequest'); ?>/<?php echo $uri; ?>/'+ id+'/s';
        }
    }
</script>