<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta name="description" content="Welcome to the Lexus F Club! An elite group of thrill seekers who are fueled by the passion for ultimate performance and are driven by the adrenaline for adventure. The Lexus F Club is a pit stop for the like-minded Lexus F and F SPORT owners and enthusiasts to connect, engage, and share their passion, experience, and adventures. It also serves as a podium for exclusive previews and latest updates from the Lexus F range. Be certain that the Lexus F Club opens door to a whole new level of thrilling experience. ">
  <meta name="keywords" content="Let the thrill drive you, Lexus F club Qatar, Lexus F Club, F club, Club Qatar, Lexus Club
">
  <meta name="author" content="Lexus F Club Qatar">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lexus F Club Qatar</title>
  <base href="<?php echo base_url().'assets/frontend'.'/'; ?>">
<!-- ************************************************************************ !-->
<!-- *****                                                              ***** !-->
<!-- *****       ¤ Designed and Developed by  LEADconcept  ¤            ***** !-->
<!-- *****               http://www.leadconcept.com                     ***** !-->
<!-- *****                                                              ***** !-->
<!-- ************************************************************************ !-->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/mystyle.css">
  <link rel="stylesheet" href="css/slippry.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
  <link href="https://db.onlinewebfonts.com/c/ed2e26fc1814fa803b3f94dbc97f922b?family=Nobel-Regular" rel="stylesheet">
  <link href="css/thumbs2.css" rel="stylesheet" />
  <link href="css/thumbnail-slider.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/magnific-popup.css">
  <script src="js/jquery-1.11.1.js"></script>
  <style type="text/css">
    .error{
      clear: inherit;
      color: #ff0000 !important;
      font-size: 14px !important;
      font-weight: bold !important;
    }
    .error p{
      clear: inherit;
      color: #ff0000 !important;
      font-size: 14px !important;
      font-weight: bold !important;
    }
    .theme_color{
      color: #E5E5EF;
      background: #737373 !important;
      border: #737373 !important;
    }
    @media only screen and (min-width: 768px) and (max-width: 1920px) {
      .navbar-brand-centered{
        z-index: 999 !important;
      }
    }
  </style>
</head>

<body>


<!-- page_background -->
<?php if(uri_string() == "" || uri_string() == "signup"){ ?>
<div id="fullscreen_bg" class="fullscreen_bg_main" />
<?php } else {?>
<div id="fullscreen_bg" class="fullscreen_bg" />
<?php } ?>
<!-- Login_bar -->

<div class="container p0">
  <div class="col-sm-9"></div>
  <div class="col-sm-3 login_bg">
    <div class="image_content">
      <a class="pull-left arabic" href="<?php echo base_url('LanguageSwitcher/switchLang/arabic'); ?>">العربية</a>
        <?php if($this->session->userdata('logged_in') == FALSE) echo  "<a class='pull-right english' href='".base_url('/login')."'>LOGIN</a>" ?>
        <?php if($this->session->userdata('logged_in') == TRUE) echo  "<a class='pull-right english' href='".base_url('/logout')."'>LOGOUT</a>" ?>
    </div>
  </div>
</div>

<!-- Navbar -->

<div class="col-sm-12 p0">
  <div class="container-fluid p0">
    <nav class="navbar navbar-default" role="navigation" id="navbar_qatar_reg">
      <div class="container p0">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo base_url(); ?>"><div class="navbar-brand navbar-brand-centered"><img src="images/logo.png"></div></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
          <ul class="nav navbar-nav" id="navbar_left">
            <li><a <?php if(uri_string() == 'frange') echo "class='active'";  ?> href="<?php echo base_url('frange'); ?>"><b>F </b>RANGE</a></li>
            <li><a <?php if(uri_string() == 'events') echo "class='active'";  ?> href="<?php echo base_url('events'); ?>">EVENTS</a></li>
            <li><a <?php if(uri_string() == 'news') echo "class='active'";  ?> href="<?php echo base_url('news'); ?>">NEWS</a></li>
            <li><a <?php if(uri_string() == 'gallery') echo "class='active'";  ?> href="<?php echo base_url('gallery'); ?>">GALLERY</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right" id="navbar_right">
            <li><a <?php if(uri_string() == 'offers') echo "class='active'";  ?> href="<?php echo base_url('offers'); ?>">OFFERS</a></li>
            <li><a <?php if(uri_string() == 'accessories') echo "class='active'";  ?> href="<?php echo base_url('accessories'); ?>">ACCESSORIES </a></li>
            <li><a <?php if(uri_string() == 'booking') echo "class='active'";  ?> href="<?php echo base_url('booking'); ?>">BOOKING</a></li>
            <li><a <?php if(uri_string() == 'contact') echo "class='active'";  ?> href="<?php echo base_url('contact'); ?>">CONTACT</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </div>
</div>

<div class="clearfix"></div>

<!-- <div class="container-fluid p0">

</div> -->