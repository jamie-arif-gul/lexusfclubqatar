<div class="clear20"></div>
	<div class="container"><!---- Sidebar Container start ---->
    	<?php $this->load->view('frontend/includes/side_bar'); ?>
   
       
       <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 profile-description">
       <div class="nopadding p_title_f">
       		<span class="avatar-username" style="text-align:left;">Compose</span>
       </div>
       <div class="box" style="width:100%;">
        <?php if(isset($errors)){ ?>
          <div class="alert alert-danger fade in">
        		<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Oops!&nbsp;</strong> <?php print_r($errors); ?></div> 
		  <?php }?>
          <?php if(isset($success)){ ?> 
          
          <div class="alert alert-success fade in">
        		<a href="#" class="close" data-dismiss="alert">&times;</a>
				<?php print_r($success);?></div>  
		  
		  <?php }?>
    <form class="form-horizontal" action="<?php echo base_url().'create_messages'; ?>" method="post">
  <div class="form-group">
    <label for="select" class="col-sm-4 control-label">Select your friend</label>
    <div class="col-sm-8">
		<select name="receiver_user_id" class="form-control">
        <?php if(get_users_accept_current_user()){
			foreach(get_users_accept_current_user() as $conversation){?>
				<option value="<?php echo $this->encrypt->encode($conversation['user_id']); ?>">
				<?php echo $conversation['user_full_name'] ?>
                </option>
				<?php }?>
				
		<?php } ?>
			<!--<option>example</option>
			<option>example</option>
			<option>example</option>
			<option>example</option>
			<option>example</option>
			<option>example</option>-->
            
		</select>
    </div>
  </div>
  <div class="form-group">
    <label for="message" class="col-sm-4 control-label">Message</label>
    <div class="col-sm-8">
      <textarea type="text" class="form-control" rows="11" name="message" id="message" placeholder="Type your message"></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-sky pull-right">Send</button>
    </div>
  </div>
</form>
    </div>
    </div>
    <div class="clear20"></div>
    </div>