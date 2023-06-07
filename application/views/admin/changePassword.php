<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">

                    <?php
                    if (isset($errors)) {
                        ?>
                        <div class="alert alert-block alert-danger fade in">
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
                        <div class="alert alert-success alert-block fade in">
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

                    <header class="panel-heading">
                        Change Password
                    </header>
                    <div class="panel-body">
                        <div class=" form">
                            <form id="change_password" class="cmxform form-horizontal tasi-form" method="post" action="<?php echo base_url('administrator/password'); ?>">
                                <div class="form-group ">
                                    <label for="old_password" class="control-label col-lg-2">Old Password (required)</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" name="old_password" type="password" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="new_password" class="control-label col-lg-2">New Password (required)</label>
                                    <div class="col-lg-10">
                                        <input id="new_password" class="form-control" name="new_password"  type="password"  required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cnfrm_password" class="control-label col-lg-2">Confirm Password (required)</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" name="confirm_password" type="password" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-info" type="submit">Change Password</button>
                                        <!--<button class="btn btn-default" type="button">Cancel</button>-->
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </section>
            </div>
        </div>


        <!-- page end-->
    </section>
</section>