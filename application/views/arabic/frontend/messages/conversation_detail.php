<style type="text/css">
.tbl_base{
    border: 1px solid #ccc;
    border-radius: 8px;
    height: 450px;
    overflow: auto;
    padding: 10px;
    width: 100%;
    background: #fff;
}
.received_msg{
  border-radius:8px;
  background: #BADCFF;
  border: 1px solid #849fbc;
}
  .rec_thumb img{
    border: 2px solid #B4CFEC;
    border-radius: 100px;
   /* margin-left: -16px;*/
  }
  .sent_msg{
    background: #E2EEFB;
    border-radius: 8px;
    border: 1px solid #7DAFCF;
  }
  .sender_thumb img{
    border: 2px solid #ADDFFF;
    border-radius: 100px;
    /*margin-left: -16px;*/
  }
  .conv_msg p{
    line-height: 3;
    margin: 0;
  }
  .msg_date{
    line-height: 2;
  }
  .msg_date{
    line-height: 3;
    text-transform: capitalize;
    font-size: 12px;
  }
</style>
<?php $uri = 0;
if($this->uri->segment(4) != '')
  $uri = $this->uri->segment(4);
?>

<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container"> 
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">Messages</h3>
      <hr class="style7">
      <!-- <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#messageModel"><i class="fa fa-reply"></i> Reply </button> -->
      <div class="clear10"></div>
      <?php $this->load->view('errors'); ?>
      <div class="clear10"></div>
      <div class="tbl_base">
      
      <?php if($results) { 
      	foreach ($results as $result) {
          $sender_pic = 'images/group_thumb.png';
            if($this->session->userdata('gender') == 'Male'){
              $sender_pic = 'images/male_thumb.png';
            }else if($this->session->userdata('gender') == 'Female'){
              $sender_pic = 'images/female_thumb.png';
            }
      		if($result['sender_id'] == $this->session->userdata('user_id')){
          ?>
      		<div class="col-sm-12 col-xs-12 padding0">
            <div class="col-sm-1 col-xs-1 sender_thumb padding0"><img src="<?php echo $sender_pic; ?>"  height="50"/></div>
            <div class="col-sm-11 col-xs-11 sent_msg">
            <div class="col-sm-8 col-xs-12 conv_msg padding0"><p><?php echo $result['message']; ?></p></div>
            <div class="col-sm-4 col-xs-12"><p class="pull-right msg_date"><?php echo date('m-d-Y', strtotime($result['updated_on'])); ?> <?php echo date('h:i A', strtotime($result['updated_on'])); ?></p></div>
            </div>
            </div>
            <div class="clear10"></div>
      		<?php }else{
            $receiver_pic = 'images/group_thumb.png';
            if($result['gender'] == 'Male'){
              $receiver_pic = 'images/male_thumb.png';
            }else if($result['gender']  == 'Female'){
              $receiver_pic = 'images/female_thumb.png';
            }
           ?>
      		<div class="col-sm-12 col-xs-12  padding0">
            <div class="col-sm-1 col-xs-1 rec_thumb padding0"><img src="<?php echo $receiver_pic; ?>" height="50" /></div>
      			<div class="col-sm-11 col-xs-12 received_msg">
            <div class="col-sm-8 col-xs-12 conv_msg padding0"><p><?php echo $result['message']; ?></p></div>
            <div class="col-sm-4 col-xs-12"><p class="pull-right msg_date"><?php echo date('m-d-Y', strtotime($result['updated_on'])); ?> <?php echo date('h:i A', strtotime($result['updated_on'])); ?></p></div>
            </div>
      			</div><div class="clear10"></div>
      	<?php	}
      	}
       ?>
       <span id="current_message"></span>
      <div class=""></div>
      <div class="clear10"></div>
      <div class="col-sm-12">
      <div id="status_message" style="display:none; color:red;"></div>
      <div id="success_message" style="display:none; color:green;"></div>
      <textarea type="text" id="message" class="form-control" rows="1" placeholder="Enter your message here..." required><?php echo set_value('message'); ?></textarea>
      <div class="clear10"></div>
      <button type="button" class="btn btn-danger" style="width:10%;" onclick="submitReply()" >Send</button>
      </div>
      <div class="clear20"></div>
      <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No request has been sended.';
        echo'</div>';
        } ?>
      </div>
    </div>
   </div>
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
            <input type="hidden" id="property_id" value="<?php echo encode_url($results[0]['property_id']); ?>">
            <input type="hidden" id="receiver_id" value="<?php echo ($results[0]['sender_id'] == $this->session->userdata('user_id'))? encode_url($results[0]['receiver_id']) : encode_url($results[0]['sender_id']); ?>">
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
$('.tbl_base').scrollTop($('.tbl_base').height());
function submitMessage(){
      var r_id = $('#receiver_id').val();
      var p_id = $('#property_id').val();
      var message = $('#message').val();
     // alert(p_id);
      if(is_login == true){
          $.ajax({
            url: jqv_ajax_url+'messages/create_message_ajax', //your server side script
            type: 'POST',
            dataType : "json",
            //contentType: "application/json; charset=utf-8",
            data : { "receiver_id": r_id, "property_id": p_id, "message": message },
            success: function (result){
              if(result.errors){
                $('#status_message').html(result.errors);
                $('#status_message').show();
              }else{
                $('#status_message').hide();
                $('#status_message').html('');
                $('#messageModel').modal('hide');
                $('#message').val('');
                location.reload();
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

  function submitReply(){
      var r_id = $('#receiver_id').val();
      var p_id = $('#property_id').val();
      var message = $('#message').val();
      //alert(p_id);
      if(is_login == true){
          $.ajax({
            url: jqv_ajax_url+'messages/create_message_ajax', //your server side script
            type: 'POST',
            dataType : "json",
            //contentType: "application/json; charset=utf-8",
            data : { "receiver_id": r_id, "property_id": p_id, "message": message },
            success: function (result){
              if(result.errors){
                $('#status_message').html(result.errors);
                $('#status_message').show();
              }else{
                $('#status_message').hide();
                $('#status_message').html('');
                //$('#messageModel').modal('hide');
                $('#message').val('');
                //location.reload();
                var html = '<div class="col-sm-12 col-xs-12 padding0">';
                    html += '<div class="col-sm-1 col-xs-1 sender_thumb padding0">';
                    html += '<img src="<?php echo $sender_pic; ?>"  height="50"/>';
                    html += '</div>';
                    html += '<div class="col-sm-11 col-xs-11 sent_msg">';
                    html += '<div class="col-sm-8 col-xs-12 conv_msg padding0">';
                    html += '<p>'+message+'</p>';
                    html += '</div>';
                    html += '<div class="col-sm-4 col-xs-12"><p class="pull-right msg_date">'+result.date+'</p></div>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="clear10"></div>';
                    //console.log(html);
                    $("#success_message").html(result.success_message);
                    $("#success_message").fadeIn().delay(5000).fadeOut();
                    $('#current_message').append(html);
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

</script>

<!--end message Modal-->