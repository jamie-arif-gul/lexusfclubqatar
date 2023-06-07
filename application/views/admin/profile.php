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
                        Update Profile
                    </header>
                    <div class="panel-body">
                        <div class=" form">
                            <form id="" class="cmxform form-horizontal tasi-form" method="post" action="<?php echo base_url('admin/adminSetting/admin_profile_update'); ?>" enctype="multipart/form-data">
                                <div class="form-group ">
                                    <label for="admin_user_name" class="control-label col-lg-2">User name (required)</label>
                                    <div class="col-lg-10">
                                        <input placeholder="Enter admin name" class=" form-control" name="admin_user_name" type="text" value="<?php echo $this->session->userdata('admin_name') ?>" required />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="admin_image" class="control-label col-lg-2">Display Image (required)</label>
                                    <div class="col-lg-10">
                                        <div name="admin_image" data-provides="fileupload" class="fileupload fileupload-new">
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input name="admin_image" type="file" class="default">
                                                </span>
                                                  <span style="margin-left:5px;" class="fileupload-preview"></span>
                                                  <a style="float: none; margin-left:5px;" data-dismiss="fileupload" class="close fileupload-exists" href="#"></a>
                                        </div>
                                    </div>
                                </div>                                
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-info" type="submit">Update Profile</button>
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