<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">Frange Detail<a href="<?php echo base_url('/administrator/manage_frange'); ?>" class="btn btn_back pull-right" type="pull-right ">Back</a></header>
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
                        <div class="col-md-4"><img height="50" width="50" src="<?php echo base_url().'uploads/frange_image/'.$frange[0]['frange_image']; ?>" /></div>
                        <div class="col-md-4 ht-60"></div>
                        <div class="col-md-4 ht-60"></div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>Frange Title</dt>
                                <dd><?php echo $frange[0]['title'] ?></dd>
                                <dt>Description</dt>
                                <dd><?php echo $frange[0]['description'] ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-6" dir="rtl">
                            <dl class="dl-horizontal">
                                
                                <dt dir="rtl">عنوان مجموعة F</dt>
                                <dd><?php echo $frange[1]['title'] ?></dd>
                                 <dt dir="rtl">وصف مجموعة F</dt>
                                <dd><?php echo $frange[1]['description'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>




