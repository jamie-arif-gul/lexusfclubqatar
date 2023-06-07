<?php //echo '<pre>'; print_r($result); echo '</pre>'; die; ?>
<style type="text/css">
.request_table thead tr td {
	background: none repeat scroll 0 0 #214472;
	color: white;
	font-weight: bold;
	padding: 10px;
}
.request_table tbody tr td {
	padding: 10px;
	border-bottom:1px solid #ccc;
}
label{
	font-size:12px;
	font-weight:normal;
}

</style>
<div class="container">
  <div class="clear10"></div>
  <?php if($result){ ?>
  <div class="dashboardbox container">
    <div class="col-sm-12 padding0">
<h3 class="dashboard-heading text-left">Transaction Details</h3>
        <hr class="style7">
        <!-- <div class="list padding0 col-sm-4 col-xs-12">
            
            <?php 
/*
            $search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
              $p_img = 'images/default_image.png';
              if($search_image[0]['image'] != ''){
                $p_img = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
              }*/
            ?>
            <img src="<?php //echo $p_img; ?>" class="list-thumb" alt="" />
      
      <div class="clear10"></div>
      <div id="map" style="height:250px;"></div>
      
      </div> --> 
        
        <!-- -->
        
        <div class="col-sm-12 col-xs-12 list-details2" id="listings">
          <div class="clear10"></div>
          <div class="col-sm-7 col-xs-12">
             <p class="list-desc-main">Dates Available: <?php echo date('m/d/y',$result['date_from']); ?>&nbsp;-&nbsp;<?php echo date('m/d/y',$result['date_to']); ?></p>
             <p class="list-desc-main" style="color:red;">Dates Guest Requested: <?php echo date('m/d/y',$result['check_in_date']); ?>&nbsp;-&nbsp;<?php echo date('m/d/y',$result['check_out_date']); ?></p>
            <?php if($result['request_status'] == 1){ ?>
             <h4><strong>Name:&nbsp;</strong><?php echo $result['name'].' '.$result['last_name']; ?></h4>
            <?php } else{ ?>
              <h4><strong>Name:&nbsp;</strong><?php echo $result['name']; ?></h4>
           <?php } ?>
            <hr />
            <h4><strong>Gender:&nbsp;</strong><?php echo $result['gender']; ?></h4>
            <hr />
            <h4><strong>School:&nbsp;</strong><?php echo $result['school']; ?></h4>
            <hr />
            <h4><strong>Email:&nbsp;</strong><?php if($result['request_status'] == 1){ echo ($result['email'] != "")? $result['email'] : 'Not available';}else{ echo '***********'; } ?></h4>
            <hr />
            <div class="clear10"></div>
          </div>
          <div class="col-sm-5 col-xs-12 padding0">
            <div class="graybox" style="padding:20px; margin-bottom:0;">
              <h5><strong>Number of Guests:&nbsp;</strong><?php echo $result['number_of_guests']; ?></h5>
              <hr />
              <h5><strong>Education Level:&nbsp;</strong><?php echo $result['education_level']; ?></h5>
              <hr />
              <h5><strong>Year in School:&nbsp;</strong><?php echo $result['year_in_school']; ?></h5>
              <hr />
              <h5><strong>Guest’s Purpose of Stay:&nbsp;</strong>
                <div class="clear10"></div>
                <p><?php echo ($result['description'] != "")? $result['description'] : '<div class="alert alert-danger">Purpose of stay not provided.</div>'; ?></p>
              </h5>
              <hr />
              <h5><strong>Phone:&nbsp;</strong><?php if($result['request_status'] == 1){ echo ($result['phone_number'] != "")? $result['phone_number'] : 'Not available';}else{ echo '***********'; } ?></h5>

            </div>
          </div>
          <div class="clear10"></div>
          <?php if($this->uri->segment(4) == 1){ ?>
          <div class="col-sm-12 col-xs-12 graybox" style="margin-bottom:0; padding:0;">
            <table class="request_table" width="100%">
              <thead>
                <tr>
                  <td></td>
                  <td class="text-center">Cost</td>
                </tr>
              </thead>
              <tbody>
                <?php $transaction_fee = round( (($result['total_amount']/100 )*10) , 2); ?>
                <tr>
                  <td>TheBindel.com Transaction and Service Fee Per Month </td>
                  <td class="text-center"><?php echo ($result['total_months'] > 1)? '$'.round($transaction_fee/$result['total_months'], 2) : '--'; ?></td>
                </tr>
                <tr>
                  <td>Total Transaction and Service Fee </td>
                  <td class="text-center">$<?php echo $transaction_fee; ?></td>
                </tr>
                <tr>
                  <td><span class="bg_yellow">Total Amount You Will Receive by End of Guest's Stay</span></td>
                  <td class="text-center"><span class="bg_yellow">$<?php echo $result['total_amount'] - $transaction_fee; ?></span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="clear10"></div>
          <div class="col-sm-11 col-xs-11 padding0">
            <label for="paid_ensurity" style="font-size:14px;">*TheBindel.com holds a deposit from your Guest equal to a full month’s rent in case damage is incurred.</label>
          </div>
          <div class="clear10"></div>
          <div class="col-sm-11 col-xs-11 padding0">
            <label for="paid_ensurity" style="font-size:14px;">*After you Accept Guest’s Request, TheBindel.com will email you regarding accepting your Guest’s payment.</label>
          </div>
          <div class="clear10"></div>
          <div style="width: 22px; float: left;">
            <?php if($result['request_status'] == 1){ ?>
            <i class="fa fa-check-square" style="color:#214472;"></i>
            <?php }else{ ?>
            <input type="checkbox" name="paid_ensurity" id="paid_ensurity" />
            <?php } ?>
          </div>
          <div class="col-sm-11 col-xs-11 padding0">
            <label for="paid_ensurity" style="font-size:14px;">Want to make sure you collect your rent? For an average of only <u>$<?php echo round($transaction_fee/$result['total_months'],2); ?></u> more per month, TheBindel.com will pay your rent if the Guest does not.</label>
          </div>
          <div class="clear10"></div>
          <div style="width: 22px; float: left;">
          <?php if($result['request_status'] == 1){ ?>
          <i class="fa fa-check-square" style="color:#214472;"></i>
          <?php }else{ ?>
          <input type="checkbox" name="accept_terms" id="accept_terms" />
          <?php } ?>
          </div>
          <div class="col-sm-11 col-xs-11 padding0">
          <label for="accept_terms" style="font-size:14px;">By clicking "Accept Guest's Request" you agree to TheBindel.com's <a href="<?php echo base_url('pages/terms-and-conditions'); ?>">Terms of Service </a>, <a href="<?php echo base_url('pages/host-guarantee-terms'); ?>">Host Guarantee Terms</a>, <a href="<?php echo base_url('pages/guest-refund-policy'); ?>">Guest Refund Policy</a>, <a href="<?php echo base_url('pages/privacy-policy'); ?>">Privacy Policy</a>, and <a href="<?php echo base_url('pages/other-policies'); ?>">Other Policies</a>.</label>
          </div>
          <div class="clear10"></div>
          
          <?php if($result['request_status'] == 1){ ?>
            <button type="button" class="btn btn-success"><i class="fa fa-check-square-o"></i> Accepted</button>
          <?php  }else{ ?>
            <a  href="javascript:void(0)" onclick="accept_request('<?php echo encode_url($result['request_id']); ?>');" class="btn btn-success">Accept Guest's Request</a>
          <?php } ?>

          <?php } ?>

          <?php //if($this->uri->segment(4) == 2){ ?>
          <?php if($result['request_status'] == 1){ ?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#messageModel"><i class="fa fa-check-square-o"></i> Send Message</button>
          <?php  }else{ ?>
            <div class="clear10"></div>
            <div class="alert alert-info">
              <strong>Info!</strong> You will be able to send messages after you rent your space.
            </div>
          <?php } ?>
          <?php //} ?>

          <div class="clear10"></div>
        </div>

    </div>
  </div>
  <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No request detail found..';
        echo'</div>';
        } ?>
</div>

<!-- message Modal start-->
<div id="messageModel" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <div id="status_message" style="display:none;"></div>
        <form id="messageForm" action="" method="post" accept-charset="utf-8">
          <div class="form-group"> 
            <!-- <label for="description">Description</label> -->
            <input type="hidden" id="property_id" value="<?php echo encode_url($result['property_id']); ?>">
            <input type="hidden" id="receiver_id" value="<?php echo ($result['sender_id'] == $this->session->userdata('user_id'))? encode_url($result['receiver_id']) : encode_url($result['sender_id']); ?>">
            <textarea type="text" id="message" class="form-control" placeholder="Enter your message here..." required><?php echo set_value('message'); ?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="submitMessage()" >Send</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function submitMessage(){
      var r_id = $('#receiver_id').val();
      var p_id = $('#property_id').val();
      var message = $('#message').val();
      //alert(p_id+'--'+p_review);
      if(is_login == true){
          $.ajax({
            url: jqv_ajax_url+'messages/create_message_ajax', //your server side script
            type: 'POST',
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            //data : { "receiver_id": r_id, "property_id": p_id, "message": message },
            success: function (result){
              if(result.errors){
                $('#status_message').html(result.errors);
                $('#status_message').show();
              }else{
                $('#status_message').hide();
                $('#status_message').html('');
                $('#messageModel').modal('hide');
                $('#message').val('');
              }
 
             },
             error: function (jxhr, msg, err) {
                 $('#response').append('<li style="color:red">' + msg + '</li>');
             }
         });
        }else{
          alert('Please login to message this place.');
        } 
  }
function accept_request(id){
        /*var c = window.confirm("Are you sure, you want to accept this request?");
        $('#processing').html('<img src="images/processing.gif"/>');
        if (c){*/
            window.location = '<?php echo base_url('requests/acceptRequest'); ?>/0/'+ id;
        /*}*/
    }
</script> 

<!--end message Modal-->