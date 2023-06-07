<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container">
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">Edit Profile</h3>
      <hr class="style7">
      <div class="userinfo">
  

  <form id="updateProfile" action="<?php echo base_url('update_user_profile'); ?>" method="post" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
  <div class="form-group">
  <?php
   //$number = explode(',', $this->session->userdata('number'));
   $dob = explode('/', $this->session->userdata('dob'));
  ?>
        <div class="col-sm-6 form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="First" name="name" value="<?php echo $this->session->userdata('name'); ?>" required>
        </div>
      <div class="col-sm-6 form-group">
        <label for="name">&nbsp;</label>
        <input type="text" class="form-control" id="last_name" placeholder="Last" name="last_name" value="<?php echo $this->session->userdata('last_name'); ?>" required>
      </div>
      <div class="clear10"></div>
        <?php if($this->session->userdata('user_role') == 2){ ?>
        <div class="form-group col-sm-12">
          <label for="school">School</label>
          <input type="text" class="form-control" name="school" value="<?php echo $this->session->userdata('school'); ?>" id="school">
        </div>
        <?php } ?>
        <div class="clear10"></div>
        <div class="form-group">
          <label for="dob" class="col-xs-12 col-sm-3">Birth Date</label>
      <div class="col-xs-4  col-sm-3">
      <!-- <input type="text" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob'); ?>" required> -->
      <select type="text" class="form-control" id="DOBmonth" name="DOBmonth" required>
        <option value="">Month</option>
        <option value="01" <?php if(isset($dob[0]) && $dob[0] == '01'){ echo 'selected="selected"'; } ?>>Jan</option>
        <option value="02" <?php if(isset($dob[0]) && $dob[0] == '02'){ echo 'selected="selected"'; } ?>>Feb</option>
        <option value="03" <?php if(isset($dob[0]) && $dob[0] == '03'){ echo 'selected="selected"'; } ?>>Mar</option>
        <option value="04" <?php if(isset($dob[0]) && $dob[0] == '04'){ echo 'selected="selected"'; } ?>>Apr</option>
        <option value="05" <?php if(isset($dob[0]) && $dob[0] == '05'){ echo 'selected="selected"'; } ?>>May</option>
        <option value="06" <?php if(isset($dob[0]) && $dob[0] == '06'){ echo 'selected="selected"'; } ?>>Jun</option>
        <option value="07" <?php if(isset($dob[0]) && $dob[0] == '07'){ echo 'selected="selected"'; } ?>>Jul</option>
        <option value="08" <?php if(isset($dob[0]) && $dob[0] == '08'){ echo 'selected="selected"'; } ?>>Aug</option>
        <option value="09" <?php if(isset($dob[0]) && $dob[0] == '09'){ echo 'selected="selected"'; } ?>>Sep</option>
        <option value="10" <?php if(isset($dob[0]) && $dob[0] == '10'){ echo 'selected="selected"'; } ?>>Oct</option>
        <option value="11" <?php if(isset($dob[0]) && $dob[0] == '11'){ echo 'selected="selected"'; } ?>>Nov</option>
        <option value="12" <?php if(isset($dob[0]) && $dob[0] == '12'){ echo 'selected="selected"'; } ?>>Dec</option>
      </select>
      </div>
      <div class="col-xs-4 col-sm-3">
      <select type="text" class="form-control" id="DOBday" name="DOBday" required>
        <option value="">Day</option>
        <?php for ($j=1; $j <= 31; $j++) { ?>
          <option value="<?php echo sprintf("%02d", $j); ?>" <?php if(isset($dob[1]) && $dob[1] == sprintf("%02d", $j)){ echo 'selected="selected"'; } ?> ><?php echo sprintf("%02d", $j); ?></option>;
        <?php } ?>
      </select>
      </div>
      <div class="col-xs-4 col-sm-3">
      <select type="text" class="form-control" id="DOByear" name="DOByear" required>
        <option value="">Year</option>
        <?php for ($i=date('Y') -5; $i > date('Y') - 100; $i--) { ?>
          <option value="<?php echo $i; ?>" <?php if(isset($dob[2]) && $dob[2] == $i){ echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
       <?php } ?>
      </select>
      </div>
        </div>
    <div class="clear10"></div>
        <div class="form-group col-sm-12">
          <label for="gender">Gender</label>
          <select class="form-control" name="gender" id="gender" required>
            <option value="">I am...</option>
            <option value="Male" <?php echo ($this->session->userdata('gender') == 'Male')? 'selected="selected"' : '' ?> >Male</option>
            <option value="Female" <?php echo ($this->session->userdata('gender') == 'Female')? 'selected="selected"' : '' ?>>Female</option>
            <option value="I prefer not to disclose my gender" <?php echo ($this->session->userdata('gender') == 'I prefer not to disclose my gender')? 'selected="selected"' : '' ?>>I prefer not to disclose my gender</option>
          </select>
        </div>
    <div class="clear10"></div>
        
        <!-- <div class="form-group col-sm-12">
          <label for="number">Phone Number</label>
          <div style="width:100%;">
           (<input type="text" class="form-control" id="number1" name="number1" value="<?php //echo (isset($number[0]))? $number[0] : ''; ?>" style="display:inline; width:10%" maxlength="3" required>) 
          <input type="text" class="form-control" id="number2" name="number2" value="<?php //echo (isset($number[1]))? $number[1] : ''; ?>" style="display:inline; width:10%" maxlength="3" required> - 
          <input type="text" class="form-control" id="number3" name="number3" value="<?php //echo (isset($number[2]))? $number[2] : ''; ?>" style="display:inline; width:20%" maxlength="4" required>
          </div>
        </div> -->
        <!-- <div class="form-group col-sm-12">
          <label for="description">Description</label>
          <textarea type="text" class="form-control" name="description" id="description" placeholder="Description"><?php //echo $this->session->userdata('description'); ?></textarea>
        </div> -->
		<div class="clear20"></div>
     <div class="col-sm-12">
       <button type="submit" class="btn btn-danger" >Update</button>
     </div>
        
  
  </form>
  </div>
  </div>
  </div>
  </div>
</div>




