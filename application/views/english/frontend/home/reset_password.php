<div class="container">
  <div class="clear10"></div>
  <div class="box-main">    
     
    <div class="col-sm-6 col-md-offset-3 loginbox">
       
      <h3 class="section-heading"> <i class="fa fa-sign-in"></i> Reset Password  </h3>

      <form role="form" action="<?php echo base_url('change_password'); ?>" method="post" id="reset_password">
      <span>
      <?php $this->load->view('errors'); ?> 
        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="form-control" name="password_confirm" id="password_confirmation">
        </div>
        <input type="hidden" name="activation_code" value="{{ $activation_code }}">
        <button type="submit" class="btn btn-primary">Reset Password</button>
      </form>
    </div>
  </div>
</div>