<div class="col-sm-12 p0">
    <div class="container p0  reg_main_mrg">
        <div class="registration_bg" id="login_bg">
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="">
                        <div class="col-lg-12">
                            <form id="login-form" action="<?php echo base_url('login'); ?>" method="post" accept-charset="utf-8" role="form" style="display: block;">
                                <?php $this->load->view('errors'); ?>
                                <h2>LOGIN</h2>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="user_name" placeholder="User Name" value="<?php echo set_value('user_name'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="password" name="password" tabindex="2" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" required>
                                </div>
                                <div class="col-xs-12 form-group pull-left checkbox">
                                    <input id="checkbox1" type="checkbox" name="remember">
<!--                                    <label for="checkbox1">Remember Me</label>-->
                                </div>
                                <div class="clear10"></div>
                                <div class="col-xs-12 form-group pull-right">
                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>