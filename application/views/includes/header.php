<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<html lang="en">-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="leadconcept">
    <meta name="keyword" content="admin, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<!--    <link rel="shortcut icon" href="--><?php //echo ASSETS_URL.'resources/admin' ?><!--/img/favicon.html">-->
    <base href="<?php echo base_url(); ?>">
    <title>Administrator</title>
    <!-- Bootstrap core CSS -->
    <script type="text/javascript"> var jqv_ajax_url = '<?php echo ASSETS_URL; ?>';</script>
    <link href="<?php echo 'resources/admin' ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo 'resources/admin' ?>/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo 'resources/admin' ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!--external css-->
    <link rel="stylesheet" type="text/css" href="<?php echo 'resources/admin' ?>/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo 'resources/admin' ?>/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo 'resources/admin' ?>/assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo 'resources/admin' ?>/assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo 'resources/admin' ?>/assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo 'resources/admin' ?>/assets/jquery-multi-select/css/multi-select.css" />

    

    <link href="<?php echo 'resources/admin' ?>/assets/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" >
    <!-- Custom styles for this template -->
    <link href="<?php echo 'resources/admin' ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo 'resources/admin' ?>/css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" id="theme">
    <script src="<?php echo 'assets/frontend/js/jquery-1.11.1.js' ?>" type="text/javascript"></script>
    <!-- FANCYBOX CSS -->
    <link href="<?php echo 'assets/admin/fancybox/source/jquery.fancybox.css' ?>" rel="stylesheet" />
    

<!--    For menu sorting-->
    <link rel="stylesheet" href="<?php echo 'resources/admin/assets/nestable' ?>/jquery.nestable.css" />
     <link rel="stylesheet" href="<?php echo 'assets/frontend/css/jquery.datetimepicker.css' ?>">
<!--    End here-->

<!--For uploader-->
<script src="<?php echo 'resources/admin/upload_js' ?>/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo 'resources/admin/upload_js' ?>/uploadify.css">

<!--For Events-Calendar-->
<link rel="stylesheet" href="assets/admin/eventcalendar/css/eventCalendar.css">
<link rel="stylesheet" href="assets/admin/eventcalendar/css/eventCalendar_theme_responsive.css">
    <link rel="stylesheet" type="text/css" href="resources/admin/simditor/site/assets/styles/simditor.css" />
    <!-- Include external CSS. -->
<!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">-->

    <!-- Include Editor style. -->
<!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />-->
<script src="assets/admin/eventcalendar/js/jquery.eventCalendar.js" type="text/javascript"></script>
<!-- FANCYBOX JS -->
        <script src="<?php echo 'assets/admin/fancybox/source/jquery.fancybox.js' ?>"></script>
        <script src="http://jwpsrv.com/library/SML16CF4EeSERCIACyaB8g.js"></script>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  
<script src="<?php echo 'assets/frontend/js/jquery.datetimepicker.js' ?>" type="text/javascript" charset="utf-8"></script>
</head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">

      <div class="col-sm-4">
      <div class="sidebar-toggle-box">
          <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
      </div>

        <!--logo start-->
        <a href="<?php echo 'administrator/dashboard' ?>" class="logo" ><img width="60" src="<?php echo 'assets/frontend/images/logo.png' ?>"><span> <!--Admin--></span></a>
      </div>
        
        <!--logo end-->
          <div class="col-sm-4 admin_header">
        <center><h3>Club Qatar</h3></center>
        </div>
          <div class="col-sm-4">
        <div class="top-nav ">
          <ul class="nav pull-right top-menu">

              <!-- user login dropdown start-->
              <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                      <img style="margin-right: 5px;" alt="Profile Image" width="50" src="<?php echo 'uploads/img_gallery/admin_images'."/".$this->session->userdata('admin_profile_pic') ?>" />
                      <span class="username"> <?php print_r($this->session->userdata('admin_user_name')); ?></span>
                      <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu extended logout">
                      <div class="log-arrow-up"></div>
                      <li><a href="<?php echo base_url().'administrator/profile'?>"><i class=" fa fa-suitcase"></i>Profile</a></li>
                      <li><a href="<?php echo base_url().'administrator/change_password' ?>"><i class="fa fa-cog"></i>Password</a></li>
                      <li><a href="<?php echo base_url().'administrator/admin_email'?>"><i class="fa fa-envelope-o"></i> Email</a></li>
                      <li><a href="<?php echo base_url().'administrator/admin_logout'?>"><i class="fa fa-key"></i> Log Out</a></li>
                  </ul>
              </li>
              <!-- user login dropdown end -->
          </ul>
      </div>
          </div>
      <style type="text/css">
      .tbl-alerts {
          border-radius: 2px;
          font-size: 12px;
          padding: 3px;
          text-align: center;
          text-transform: uppercase;
      }

      .btn-pending {
        background-color: #5bc0de;
        color: #fff;
        font-family: "Raleway",sans-serif;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 6px;
        /*width: 100%;*/
      }
      .btn-accepted {
        background-color: #5cb85c;
        color: #fff;
        font-family: "Raleway",sans-serif;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 6px;
        /*width: 100%;*/
      }
      .btn-rejected {
        background-color: #d31509;
        color: #fff;
        font-family: "Raleway",sans-serif;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 6px;
        /*width: 100%;*/
      }
      </style>
      </header>
      <!--header end-->