
<div class="container">
  <div class="clear10"></div>
  <div class="box-main">    
     
    <div class="col-sm-6 col-md-offset-3 loginbox">
       
      <h3 class="section-heading"> <i class="fa fa-sign-in"></i> Forgot Password </h3>
      <form role="form" action="<?php echo base_url('forgot_password_email'); ?>" method="post" id="forgot_password">
<?php $this->load->view('errors'); ?>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="clear10"></div>
        <button type="submit" class="btn btn-primary">Send Mail</button>
         </form>
       <!-- lagin form close -->
    </div>
  </div>
</div>
