<style type="text/css">
	.box-main{
		margin:0 auto;
		margin-bottom:10% !important;
		width:70%;
	}
</style>
<div class="container">
  <div class="clear10"></div>
  <div class="box-signup col-lg-7 col-md-8 col-sm-11 col-xs-12">
    <div class="loginbox">
      <h3 class="section-heading"> <i class="fa fa-user-plus"></i> Create An Account </h3>
      <form id="signup" action="<?php echo base_url('signup'); ?>" method="post" accept-charset="utf-8">
      <?php $this->load->view('errors'); ?>
<!--			<div class="form-group col-sm-12">-->
<!--			  <input type="radio" id="student" name="user_role" value="2" --><?php //if(set_value('user_role') == 2){ echo 'checked="checked"'; } ?><!-- onclick="set_email_textbox()" required>-->
<!--              <label for="student">I am a student [full access]</label>-->
<!--		    </div>-->

<!--		    <div class="form-group col-sm-12">-->
<!--			  <input type="radio" id="host" name="user_role" value="3" --><?php //if(set_value('user_role') == 3){ echo 'checked="checked"'; } ?><!-- onclick="set_email_textbox()" required>-->
<!--              <label for="host">I would like to be a Host and rent my space to a student [restricted to listing space] </label>-->
<!--		    </div>-->

            <div class="clear10"></div>
			<div class="col-sm-6 form-group">
			  <label for="name">Name</label>
			  <input type="text" class="form-control" id="name" placeholder="First" name="name" value="<?php echo set_value('name'); ?>" required>
		    </div>
			<div class="col-sm-6 form-group">
			  <label for="name">&nbsp;</label>
			  <input type="text" class="form-control" id="last_name" placeholder="Last" name="last_name" value="<?php echo set_value('last_name'); ?>" required>
			</div>
			<div class="clear10"></div>
        <div class="form-group col-sm-12">
          <label for="email">Email address</label>
          <span id="email_field">
             <input type="email" class="form-control placeholder-right signup_email validate[custom[email]]" placeholder="@example.com" name="email" id="signup_email" value="<?php echo set_value('email'); ?>" required>
          </span>
        </div>
		<div class="clear10"></div>
        <div class="col-sm-6 form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control validate[]" id="password" name="password" value="<?php echo set_value('password'); ?>" required>
        </div>
        <div class="col-sm-6 form-group">
          <label for="repate_password">Confirm Password</label>
          <input type="password" class="form-control validate[]" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>" required>
        </div>
		<div class="clear10"></div>
<!--        <div class="form-group col-sm-12">-->
<!--          <label for="school">School</label>-->
<!--          <input type="text" class="form-control" id="school" name="school" value="--><?php //echo set_value('school'); ?><!--" required>-->
<!--        </div>-->
		<div class="clear10"></div>
        <div class="form-group">
          <label for="dob" class="col-sm-3" style="line-height: 2.7; padding-right: 0">Birth Date</label>
		  <div class="col-sm-3 padding0">
			<!-- <input type="text" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob'); ?>" required> -->
			<select type="text" class="form-control" id="DOBmonth" name="DOBmonth" required>
				<option value="">Month</option>
				<option value="01" <?php echo set_select('DOBmonth', '01'); ?> >Jan</option>
				<option value="02" <?php echo set_select('DOBmonth', '02'); ?> >Feb</option>
				<option value="03" <?php echo set_select('DOBmonth', '03'); ?> >Mar</option>
				<option value="04" <?php echo set_select('DOBmonth', '04'); ?> >Apr</option>
				<option value="05" <?php echo set_select('DOBmonth', '05'); ?> >May</option>
				<option value="06" <?php echo set_select('DOBmonth', '06'); ?> >Jun</option>
				<option value="07" <?php echo set_select('DOBmonth', '07'); ?> >Jul</option>
				<option value="08" <?php echo set_select('DOBmonth', '08'); ?> >Aug</option>
				<option value="09" <?php echo set_select('DOBmonth', '09'); ?> >Sep</option>
				<option value="10" <?php echo set_select('DOBmonth', '10'); ?> >Oct</option>
				<option value="11" <?php echo set_select('DOBmonth', '11'); ?> >Nov</option>
				<option value="12" <?php echo set_select('DOBmonth', '12'); ?> >Dec</option>
			</select>
		  </div>
		  <div class="col-sm-3">
			<select type="text" class="form-control" id="DOBday" name="DOBday" required>
				<option value="">Day</option>
				<?php for ($j=1; $j <= 31; $j++) { ?>
					<option value="<?php echo sprintf("%02d", $j); ?>" <?php echo set_select('DOBday', sprintf("%02d", $j)); ?> ><?php echo sprintf("%02d", $j); ?></option>
				<?php } ?>
			</select>
		  </div>
		  <div class="col-sm-3">
			<select type="text" class="form-control" id="DOByear" name="DOByear" required>
				<option value="">Year</option>
				<?php for ($i=date('Y') -18; $i > date('Y') - 99; $i--) { ?>
					<option value="<?php echo $i; ?>" <?php echo set_select('DOByear', $i); ?> > <?php echo $i; ?></option>
				<?php } ?>
			</select>
		  </div>
        </div>
		<div class="clear10"></div>
        <div class="form-group col-sm-12">
          <label for="gender">Gender</label>
          <select class="form-control" name="gender" id="gender" required>
            <option value="">I am...</option>
            <option value="Male" <?php echo set_select('gender', 'Male'); ?> >Male</option>
            <option value="Female" <?php echo set_select('gender', 'Female'); ?> >Female</option>
            <option value="I prefer not to disclose my gender" <?php echo set_select('gender', 'I prefer not to disclose my gender'); ?>>I prefer not to disclose my gender</option>  
          </select>
        </div>
		<div class="clear10"></div>
        <!-- <div class="form-group col-sm-12">
          <label for="number">Phone Number</label>
          <div style="width:100%; color:#000;">
          (<input type="text" class="form-control text-center" id="number1" name="number1" value="<?php echo set_value('number1'); ?>" style="display:inline; width:12%;" maxlength="3" required>) 
          <input type="text" class="form-control text-center" id="number2" name="number2" value="<?php echo set_value('number3'); ?>" style="display:inline; width:12%;" maxlength="3" required> - 
          <input type="text" class="form-control text-center" id="number3" name="number3" value="<?php echo set_value('number3'); ?>" style="display:inline; width:15%;" maxlength="4" required>
          </div>
        </div>
		<div class="clear10"></div> -->
        <!-- <div class="form-group col-sm-12">
          <label for="description">Description</label>
          <textarea type="text" class="form-control" id="description" name="description" ><?php echo set_value('description'); ?></textarea>
        </div> -->
		<div class="clear10"></div>
<!--        <div class="form-group col-sm-12">-->
<!--        <p style="color:#000;">By signing up, I accept The Bindel’s <a href="--><?php //echo base_url('pages/terms-and-conditions'); ?><!--"><span style="color:red;">Terms and Conditions</span></a>, <a href="--><?php //echo base_url('pages/host-guarantee-terms'); ?><!--"><span style="color:red;">Host Gaurantee Terms</span></a>, <a href="--><?php //echo base_url('pages/privacy-policy'); ?><!--"><span style="color:red;">Privacy Policy</span></a>, <a href="--><?php //echo base_url('pages/guest-refund-policy'); ?><!--"><span style="color:red;"> Guest Refund Policy</span></a>, and <a href="--><?php //echo base_url('pages/other-policies'); ?><!--"><span style="color:red;">Other Policies</span></a>.</p>-->
<!--        </div>-->
		<div class="clear10"></div>
		<div class="form-group col-sm-12">
			<button type="submit" class="btn btn-danger">Sign Up</button>
		</div>
  </form>
  <div class="clear5"></div>
<p style="color:#000; padding: 15px; text-align:center;">Already a member of The QcLub? <a href="<?php echo base_url('login'); ?>" style="color:red;">Login</a></p>
    </div>
  </div>
</div>

<script>
    
    $(document).ready(function(){
       set_email_textbox();
    });
    function set_email_textbox(){
    	//alert($("input[name=user_role]:checked").val());
    	if($("input[name=user_role]:checked").val() == 2){
    	  $('#email_field').html('<input type="email" class="form-control validate[custom[email]]" placeholder="@example.edu" name="email" id="signup_email" value="" required>');
        $('#school').removeAttr('disabled');
        $('#school').val('');
    	}else if($("input[name=user_role]:checked").val() == 3){
          $('#email_field').html('<input type="email" class="form-control validate[custom[email]]" placeholder="Email" name="email" value="" required>');
          $('#school').val('N/A');
          $('#school').attr('disabled','disabled');
		}
    }


</script>
