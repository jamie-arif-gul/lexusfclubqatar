<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>resources/img/favicon.html">

        <title>Admin Login</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>resources/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>resources/admin/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo base_url(); ?>resources/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>resources/admin/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>resources/admin/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">
        
        

        <div class="container">
<?php
                        if (isset($errors)) {
                            ?>
                            <div class="alert alert-block alert-danger fade in" style="margin-top: 11px;">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                                <strong>Error!</strong>
                                <p><?php print_r($errors); ?></p>
                            </div>
                            <?php
                        }
                        if (isset($success)) {
                            ?>
                            <div class="alert alert-success alert-block fade in" style="margin-top: 11px;">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="fa fa-ok-sign"></i>
                                    Success!
                                </h4>
                                <p><?php echo $success; ?></p>
                            </div>
    <?php
}
?>

              <form id="adminLogin" class="form-signin" action="<?php echo base_url().'index.php/administrator/do_login' ?>" method="post">
                <h2 class="form-signin-heading">sign in now</h2>
                <div class="login-wrap">
                    <input id="email_login" type="text" class="form-control" name="email_login" placeholder="User Email" autofocus>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    <label class="checkbox">
                        <input type="checkbox" value="remember-me"> Remember me
                        <span class="pull-right">
<!--                            <a data-toggle="modal" href="#myModal"> Forgot Password?</a>-->

                        </span>
                    </label>
                    <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
                   <!-- <p>or you can sign in via social network</p>
                    <div class="login-social-link">
                        <a href="#" class="facebook">
                            <i class="fa fa-facebook"></i>
                            Facebook
                        </a>
                        <a href="#" class="twitter">
                            <i class="fa fa-twitter"></i>
                            Twitter
                        </a>
                    </div>-->
                    <!--            <div class="registration">
                                    Don't have an account yet?
                                    <a class="" href="registration.html">
                                        Create an account
                                    </a>
                                </div>-->

                </div>
                 </form>
                <!-- Modal -->
                <form id="forgot_pass" class="form-signin" action="<?php echo base_url().'/administrator/forgot_password' ?>" method="post">
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password ?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <input type="email" name="forgot_password" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

            </form>

        </div>



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>resources/admin/js/jquery.js"></script>
        <script src="<?php echo base_url().'/' ?>resources/admin/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().'/resources/admin' ?>/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().'/resources/admin' ?>/js/form-validation-script.js"></script>

    </body>

</html>
