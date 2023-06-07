<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">Accessory Detail<a href="<?php echo base_url('/administrator/manage_accessories'); ?>" class="btn btn_back pull-right" type="pull-right ">Back</a></header>
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
                                <dd><?php echo $accessories['name']?></dd>
                                <dt>Email</dt>
                                <dd><?php echo $accessories['email'] ?></dd>
                                <dt>Phone No</dt>
                                <dd><?php echo $accessories['phone_number'] ?></dd>
                                <dt>Model</dt>
                                <dd><?php echo $accessories['model'] ?></dd>
                                <dt>Chassis Number</dt>
                                <dd><?php echo $accessories['chassis_number'] ?></dd>
                             </dl>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>




