<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">News Detail<a href="<?php echo base_url('/administrator/manage_news'); ?>" class="btn btn_back pull-right" type="pull-right ">Back</a></header>
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
                        <div class="col-md-4"><img height="50" width="50" src="<?php echo base_url().'uploads/news_image/'.$news[0]['news_image']; ?>" /></div>
                        <div class="col-md-4 ht-60"></div>
                        <div class="col-md-4 ht-60"></div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>News Title</dt>
                                <dd><?php echo $news[0]['title'] ?></dd>
                                <dt>Description</dt>
                                <dd><?php echo $news[0]['description'] ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-6" dir="rtl">
                            <dl class="dl-horizontal">
                                <dt dir="rtl">عنوان الخبر</dt>
                                <dd><?php echo $news[1]['title'] ?></dd>
                                <dt dir="rtl">وصف</dt>
                                <dd><?php echo $news[1]['description'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>




