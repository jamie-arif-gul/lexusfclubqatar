<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container"> 
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">Received Requests</h3>
      <hr class="style7">
      <div class="tbl_base">
      <?php $this->load->view('errors'); ?>
      <?php if($results) { ?>
      <table class="mypropertytbl" width="100%">
        <thead>
          <tr>
            <td>property</td>
            <td>name</td>
            <td>Price</td>
            <td>Transaction Details</td>
            <td>requested on</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result) { ?>
          <tr>
          <?php
          $search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
          $img_src = 'images/default_image.png';
            if($search_image[0]['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $search_image[0]['image']))){
            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
            $img_src = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
            }
          ?>
            <td><img height="80" width="80" src="<?php echo $img_src; ?>" class="thumbnail" /></td>
            <!-- <td><a href="<?php //echo base_url('properties/property_detail').'/'.encode_url($result['property_id']); ?>"><?php //echo $result['name']; ?></a></td> -->
            <td><a href="<?php echo base_url('requests/request_detail').'/'.encode_url($result['request_id']).'/1'; ?>"><?php echo $result['name']; ?></a></td>
            <td>$<?php echo $result['price']; ?>.00</td>
            <td><?php
              if($result['payment_id'] > 0){
                echo '<div class="btn btn-sm btn-pending" title="Your request is padding.">Purchased</div>';
              }else{
                if($result['request_status'] == 0){ ?>
                  <a href="<?php echo base_url('requests/request_detail').'/'.encode_url($result['request_id']).'/1'; ?>" class="btn btn-sm btn-pending" title="Your request is padding.">pending</a>
                <?php }
                if($result['request_status'] == 1){
                  echo '<div class="btn btn-sm btn-accepted" title="Your request is accepted.">accepted</div>';
                }
                if($result['request_status'] == 2){
                  echo '<div class="btn btn-sm btn-rejected" title="Your request is rejected.">rejected</div>';
                }
              } 
            ?></td>
            <td><?php echo date('m-d-Y', strtotime($result['created'])).' | '.date('h:i A', strtotime($result['created'])). ' EST'; ?></td>
            <td>
              <?php
                if($result['request_status'] == 0){ ?>
                <span id="processing">
                <a  href="javascript:void(0)" onclick="accept_request('<?php echo encode_url($result['request_id']); ?>');">Accept</a> |
                <a  href="javascript:void(0)" onclick="reject_request('<?php echo encode_url($result['request_id']); ?>');">Reject</a>
                </span>
              <?php }else{ 
                
                if($result['cancel_on'] != 0){ ?>
                   <a class="action" href="javascript:void(0)">Canceled</a>
                <?php }else{ ?>
                  <a class="action" href="javascript:void(0)" onclick="cancel_request('<?php echo encode_url($result['request_id']); ?>');">Cancel</a>
                <?php }
                ?>

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
        echo 'No requests have been received.';
        echo'</div>';
        } ?>
      </div>
    </div>
   </div>
  </div>

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
    function delete_object(id){
        var c = window.confirm("Are you sure you want to cancel your reservation? Please review our Guest Refund Policy and Help Section before proceeding.");
        if (c){
            window.location = '<?php echo base_url('requests/deleteRequest'); ?>/<?php echo $uri; ?>/'+ id+'/r';
        }
    }

    function cancel_request(id){
        var c = window.confirm("Are you sure you want to cancel your reservation? Please review our Guest Refund Policy and Help Section before proceeding.");
        if (c){
            window.location = '<?php echo base_url('requests/cancelRequest'); ?>/<?php echo $uri; ?>/'+ id+'/s';
        }
    }

</script>