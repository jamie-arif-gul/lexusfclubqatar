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
                        Update Email
                    </header>
                    <div class="panel-body">
                        <div class=" form">
                            <form id="" class="cmxform form-horizontal tasi-form" method="post" action="<?php echo base_url('admin/adminSetting/admin_email_change'); ?>">
                                <div class="form-group ">
                                    <label for="old_email" class="control-label col-lg-2">Old email (required)</label>
                                    <div class="col-lg-10">
                                        <input placeholder="Enter old email" class=" form-control" name="old_email" type="email" required />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="admin_email" class="control-label col-lg-2">Email (required)</label>
                                    <div class="col-lg-10">
                                        <input placeholder="Enter your email" class=" form-control" name="admin_email" type="email" required />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-info" type="submit">Update Email</button>
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