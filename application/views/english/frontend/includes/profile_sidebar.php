<div class="col-sm-3 sidebar">
<?php
       $img_src = "images/Gender_Other_Bindel.jpg";
       if($this->session->userdata('gender') == 'Male'){
          $img_src = "images/Male_Student_Bindel.jpg";
        }elseif($this->session->userdata('gender') == 'Female') {
          $img_src = "images/Female_Student_Bindel.jpg";
        }
        //$unviewed_requests = $this->comman_model->get_total('request_property',array('receiver_id' => $this->session->userdata('user_id'),'is_viewed' => 0));
    ?>
      <div class="userimage col-sm-12 padding0"> <img src="<?=$img_src?>" class="img-responsive" /> </div>
      <div class="clear"></div>
      <!-- <div class="col-sm-12 col-lg-12 padding0" id="pic_form">
            <div id="profile_pic_form">Change profile picture</div>
            <div id="upload_pic_status"></div>
      </div> -->
      <div class="clear10"></div>
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Profile </a> </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in <?php echo ($this->uri->segment(1) == 'profile')? 'in' : ''; ?>" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body padding0">
              <ul class="padding0">
                <li><a href="<?php echo base_url('profile/profile_view'); ?>"> Edit Profile </a></li>
                <li><a href="<?php echo base_url('profile/change_my_password'); ?>"> Change Password </a></li>
                <li><a href="javascript:void(0)" onclick="delete_user();"> Deactivate Account </a></li>
              </ul>
            </div>
          </div>
        </div>
        
<!--        <div class="panel panel-default">-->
<!--          <div class="panel-heading" role="tab" id="headingTwo">-->
<!--            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Properties </a> </h4>-->
<!--          </div>-->
<!--          <div id="collapseTwo" class="panel-collapse collapse in --><?php //echo ($this->uri->segment(1) == 'properties')? 'in' : ''; ?><!--" role="tabpanel" aria-labelledby="headingTwo">-->
<!--            <div class="panel-body padding0">-->
<!--              <ul class="padding0">-->
<!--                <li><a href="--><?php //echo base_url('properties/myProperties'); ?><!--"> My Properties </a></li>-->
<!--                <li><a href="--><?php //echo base_url('properties/favorite'); ?><!--"> My Favorites </a></li>-->
<!--                <li><a href="--><?php //echo base_url('properties/searches'); ?><!--"> Saved Searches </a></li>-->
<!--                <li><a href="--><?php //echo base_url('properties/createProperty'); ?><!--"> List Your Apartment or Bedroom </a></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="panel panel-default">-->
<!--          <div class="panel-heading" role="tab" id="headingThree">-->
<!--            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo"> Requests </a> </h4>-->
<!--          </div>-->
<!--          <div id="collapseThree" class="panel-collapse collapse in --><?php //echo ($this->uri->segment(1) == 'requests')? 'in' : ''; ?><!--" role="tabpanel" aria-labelledby="headingTwo">-->
<!--            <div class="panel-body padding0">-->
<!--              <ul class="padding0">-->
<!--              --><?php //if($this->session->userdata('user_role') == 2){ ?>
<!--                <li><a href="--><?php //echo base_url('requests/send_requests'); ?><!--"> Sent Requests </a></li>-->
<!--              --><?php //} ?><!--  -->
<!--                <li><a href="--><?php //echo base_url('requests/received_requests'); ?><!--"> Received Requests</a> <span class="notifications" ></span></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!---->
<!--        <div class="panel panel-default">-->
<!--          <div class="panel-heading" role="tab" id="headingFour">-->
<!--            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Mailbox </a> </h4>-->
<!--          </div>-->
<!--          <div id="collapseThree" class="panel-collapse collapse in --><?php ////echo ($this->uri->segment(1) == 'requests')? 'in' : ''; ?><!--" role="tabpanel" aria-labelledby="headingTwo">-->
<!--            <div class="panel-body padding0">-->
<!--              <ul class="padding0">-->
<!--                 <li><a href="--><?php //echo base_url('messages/create'); ?><!--"> Create message </a></li>-->
<!--                <li><a href="--><?php //echo base_url('messages/conversation'); ?><!--"> Messages </a><span class="message_alert" ></span></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
        
      </div>

</div>
<script type="text/javascript">
  $(document).ready(function(){

    //get notification alerts
    new_nitifications();
    setInterval(function(){ new_nitifications(); }, 30000);

    new_messages();
    setInterval(function(){ new_messages(); }, 30000);

  });

  function delete_user(){
    var c = window.confirm("Are you sure you want to deactivate your account? Deactivating your account erases all of your listings/data and your account cannot be reinstated.");
        if (c){
          //alert('dfsdf');
            window.location = '<?php echo base_url('profile/deactivate_account'); ?>';
      }
  }
</script>