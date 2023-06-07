<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">Booking Detail<a href="<?php echo base_url('/administrator/manage_bookings'); ?>" class="btn btn_back pull-right" type="pull-right ">Back</a></header>
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
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd><?php echo $result[0]['name'] ?></dd>
                                <dt>Phone Number</dt>
                                <dd><?php echo $result[0]['phone_number'] ?></dd>
                                <dt>Email</dt>
                                <dd><?php echo $result[0]['email'] ?></dd>
                                <dt>Model</dt>
                                <dd><?php echo $result[0]['model'] ?></dd>
                                <dt>Drive Date</dt>
                                <dd><?php echo $result[0]['drive_date'] ?></dd>
                                <dt>Drive Time</dt>
                                <dd><?php echo $result[0]['drive_time'] ?></dd>
                                <dt>Comments</dt>
                                <dd><?php echo $result[0]['comments'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>




