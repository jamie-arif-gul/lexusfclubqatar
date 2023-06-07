<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading"> Offers Content</header>
            <div class="panel-body">
                <span>
                    <?php
                    if (isset($success)) {
                        echo '<div class="alert alert-success alert-dismissable"> ';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        print_r($success);
                        echo '</span>';
                        echo'</div>';
                    }
                    ?>
                </span>
                <span>
                    <?php
                    if (isset($errors)) {
                        echo '<div class="alert alert-danger alert-dismissable"> ';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        print_r($errors);
                        echo '</span>';
                        echo'</div>';
                    }
                    ?>
                </span>
                <form method="post" role="form" id="create_user" action="administrator/offers_content_create" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_en">Offers Content Title</label>
                                    <input type="text" value="<?php echo set_value('title_en') ?>" class="form-control" id="title_en" name="title_en" >
                                </div>

                                <div class="form-group">
                                    <label for="description_en"> Offers Content Description</label>
                                    <textarea class="form-control" id="description_en" name="description_en"><?php echo set_value('description_en'); ?></textarea>
<!--                                    <input type="text" value="--><?php //echo set_value('description_en') ?><!--" class="form-control" id="description_en" name="description_en" >-->
                                </div>

                            </div>
                            <div class="col-md-6" dir="rtl">
                                <div class="form-group" >
                                    <label for="title_ar"> عنوان محتوى الأخبار</label>
                                    <input type="text" value="<?php echo set_value('title_ar') ?>" class="form-control" id="title_ar" name="title_ar" >
                                </div>

                                <div class="form-group">
                                    <label for="description_ar">وصف محتوى الأخبار</label>
                                    <textarea class="form-control" id="description_ar" name="description_ar" dir="rtl"><?php echo set_value('description_ar'); ?></textarea>
<!--                                    <input type="text" value="--><?php //echo set_value('description_ar') ?><!--" class="form-control" id="description_ar" name="description_ar" >-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Create" class="btn btn-shadow btn-primary"/>
                     <a href="<?php echo base_url().'administrator/manage_offers';?>" class="btn btn-shadow btn-danger">Cancel </a>
                </form>
            </div>
            </div>
        </section>

    </section>
</section>




