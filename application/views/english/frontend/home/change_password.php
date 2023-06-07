<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container">
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content">
      <h3 class="dashboard-heading text-left">change Password</h3>
      <hr class="style7">
      <div class="userinfo">
  

   <form class="form-horizontal" role="form" action="<?php echo base_url('update_my_password'); ?>" method="post" id="change_password_form">
<?php $this->load->view('errors'); ?>
<span>
   <?php if (isset($auto_logout) && $auto_logout == TRUE) { ?>
      <div class="alert alert-info">You need to login again with your new password. You will be redirected to home page after 5 seconds.
        <script>
        setTimeout(function() {
            window.location = "<?php echo base_url('logout'); ?>";
          }, 5000);
        </script>
      </div>
<?php } ?>
</span>

  <div class="form-group">
          <label for="name">Current Password</label>
          <input type="password" class="form-control validate[required]" placeholder="Enter Current Password" id="current_password" name="current_password" />
        </div>
		<div class="clear10"></div>
        <div class="form-group">
          <label for="school">New Password</label>
          <input type="password" class="form-control validate[required]" placeholder="Enter New Password" id="password" name="password" />
        </div>
		<div class="clear10"></div>
        <div class="form-group">
          <label for="number">Confirm Password</label>
         <input type="password" class="form-control validate[required,equals[password]]" name="password_confirm" id="password_confirm" placeholder="Repeat New Password"/>
        </div>
		<div class="clear20"></div>
		<div class="form-group">
        <button type="submit" class="btn btn-danger" >Change Password</button>
		</div>
  
  </form>
  </div>
  </div>
  </div>
  </div>