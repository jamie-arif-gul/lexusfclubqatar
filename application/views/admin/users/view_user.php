<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">User Detail<a href="<?php echo base_url('/administrator/manage_users'); ?>" class="btn btn_back pull-right" type="pull-right ">Back</a></header>
            <div class="panel-body">
                <span>
                    <?php if (isset($success)) {
                        echo '<div class="alert alert-success alert-dismissable"> ';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        print_r($success);
                        echo '</span>';
                        echo'</div>';
                    } ?>
                </span>
                <span>
                <?php if (isset($errors)) {
                    echo '<div class="alert alert-danger alert-dismissable"> ';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    print_r($errors);
                    echo '</span>';
                    echo'</div>';
                } ?>
                </span>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-7">
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd><?php echo $user['name']." ".$user['last_name'] ?></dd>
                                <dt>Qid</dt>
                                <dd><?php echo $user['qid'] ?></dd>
                                <dt>User Name</dt>
                                <dd><?php echo $user['user_name'] ?></dd>
                                <dt>Password</dt>
                                <dd><?php echo $user['pass'] ?></dd>
                                <dt>Email</dt>
                                <dd><?php echo $user['email'] ?></dd>
                                <dt>Phone Number</dt>
                                <dd><?php echo $user['number'] ?></dd>
                                <dt>Vehicle</dt>
                                <dd><?php echo $user['vehicle'] ?></dd>
                                <dt>Year Make</dt>
                                <dd><?php echo $user['year_of_make'] ?></dd>
                                <dt>Chassis Number</dt>
                                <dd><?php echo $user['chassis_number'] ?></dd>
                                <dt>Registration Number</dt>
                                <dd><?php echo $user['registration_number'] ?></dd>
                                <dt>T-shirt Size</dt>
                                <dd><?php echo $user['t_shirt_size'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>




