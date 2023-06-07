<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>--::Ultimate-Sports::--</title>
<!-- ************************************************************************ !-->
<!-- *****                                                              ***** !-->
<!-- *****       ¤ Designed and Developed by  LEADconcept               ***** !-->
<!-- *****               http://www.leadconcept.com                     ***** !-->
<!-- *****                                                              ***** !-->
<!-- ************************************************************************ !-->

<link href="<?php echo base_url('assets/frontend/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/frontend/css/style.css'); ?>" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url('assets/frontend/js/jquery-1.11.1.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/frontend/js/bootstrap.js'); ?>"></script>

</head>

<body>




<style>
	.aboutmainh1 > label {
    border-bottom: none;
}
.regfooter {
   position:fixed;
   left:0px;
   bottom:0px;
   width:100%;
}
</style>
<div class="col-xs-12 col-sm-12 col-lg-12">
  <div class="container">
    <div class="col-xs-12  col-sm-12 col-md-12 col-lg-12  contentareastatic" align="center">

	<div class="col-sm-12 aboutmainh1"><label>YOU HAVE SUCCESSFULLY REGISTERED</label></div>
	
	<div class="clear10"></div>
	
	<div class="col-sm-12"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/frontend/images/logo.png'); ?>" class="img-responsive" style="width:auto;"  /></a> </div>
	<div class="clear30"></div>
	<div class="col-sm-12 pull-left form-group aboutmaintext" style="color:#000;">
		<p style="line-height:25px; color:#000;">Dear <?php echo $this->session->userdata('first_name'); ?> <?php echo $this->session->userdata('last_name');  ?></p>
		<p style="line-height:25px; color:#000;">Thank you for registering at Ultimate E-Sports you are now registered into the best daily fantasy Esports Drafting site on the internet.</p>
		<p style="line-height:25px; color:#000;">Please keep your username and password safe.</p>
		<p style="line-height:25px; color:#000;">Check out our weekly Guaranteed contests and test your skills for big money prizes.</p>
	</div>

	<div class="col-sm-12 pull-left form-group">
	<button class="btn btnsubmit btnslider" onclick="window.location = '<?php echo base_url('profile'); ?>';">My Account</button>
	</div>

</div>

  </div>
  <div class="clear20"></div>
  <!--content Area container End--> 
</div>
<!--content Area End-->












<div class="col-xs-12 col-sm-12 col-lg-12 padding pull-left footernew regfooter">
  <div class="container">
    <div class=" col-lg-12 footer_text">
      <div class="clear20"></div>
      <div class=" col-sm-7 footer_text" style="color:#fff;">All Rights Reserved © 2015 UltimateSports.com </div>
      <div class=" col-sm-5 footerarea2text" style="color:#fff;">Designed & Developed by <a href="http://leadconcept.com/" style="color:#000;">LEADconcept</a> </div>
      <div class="clear10"></div>
    </div>
  </div>
</div>

