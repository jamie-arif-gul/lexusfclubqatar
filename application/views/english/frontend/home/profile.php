<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container">
  <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">account information 
      <!-- upgrade profile section start-->
<!--      --><?php //if($this->session->userdata('user_role') == 3){ ?>
<!--        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#upgradeProfileModel"> Upgrade </button>-->
<!--        --><?php //} ?>
        </h3>
      <!-- upgrade profile section end-->
      <hr class="style7">
      <div class="userinfo">
        <ul class="padding0">
        <?php //$number = explode(',', $this->session->userdata('number')); ?>
          <li><b>Name:</b> <?php echo $this->session->userdata('name').' '.$this->session->userdata('last_name');; ?></li>
          <li><b>Email:</b> <?php echo $this->session->userdata('email'); ?></li>
          <?php if($this->session->userdata('user_role') == 2){ ?>
<!--          <li><b>School:</b> --><?php //echo $this->session->userdata('school'); ?><!--</li>-->
          <?php } ?>
          <li><b>Birth Date:</b> <?php echo $this->session->userdata('dob'); ?></li>
          <li><b>Gender:</b> <?php echo $this->session->userdata('gender'); ?></li>
          <!-- <li><b>Phone:</b> (<?php //echo (isset($number[0]))? $number[0] : ''; ?>) <?php //echo (isset($number[1]))? $number[1] : ''; ?> - <?php //echo (isset($number[2]))? $number[2] : ''; ?></li> -->
        </ul>
      </div>
<!--      <h3 class="dashboard-heading text-left">Property listings</h3>-->
      <hr class="style7">
      <div class="col-sm-12 padding0" style="margin-bottom:200px; float:left;">
        
<!-- } else{
            echo '<div class="alert alert-danger alert-dismissable"> ';
            echo 'No Properties Found.';
            echo'</div>';
        }?>


      
      </div>
      <div class="col-sm-12">
<!--        --><?php //echo $pagination; ?>
      </div>
    </div>
  </div>
</div>