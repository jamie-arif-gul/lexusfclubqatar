<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading"> Edit Offers</header>
            <div class="panel-body">
                <span>
                    <?php
                    if($this->session->flashdata('errors')){
                    echo '<div class="alert alert-danger alert-dismissable"> ';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    print_r($this->session->flashdata('errors'));
                    echo '</span>';
                    echo'</div>';
                    }
//                    echo "<pre>"; print_r($news);die;
                    if (isset($success)) {
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
                }
//                var_dump();die;
                ?>
                </span>
                <form method="post" role="form" id="create_user" action="administrator/edit_offers/<?php echo $this->uri->segment(3); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_en">Offers Title</label>
                                    <input type="text" value="<?php echo set_value('title_en'); echo $offers[0]['title'] ?>" class="form-control" id="title_en" name="title_en" >
                                </div>

                                <div class="form-group">
                                    <label for="description_en">Description</label>
                                    <textarea class="form-control" id="description_en" name="description_en"><?php echo set_value('description_en'); echo $offers[0]['description'] ?></textarea>
<!--                                    <input type="text" value="--><?php //echo set_value('description_en'); echo $offers[0]['description'] ?><!--" class="form-control" id="description_en" name="description_en" >-->
                                </div>

                            </div>
                            <div class="col-md-6" dir="rtl">
                                <div class="form-group" >
                                    <label for="title_ar">عنوان العروض</label>
                                    <input type="text" value="<?php echo set_value('title_ar'); echo $offers[1]['title'] ?>" class="form-control" id="title_ar" name="title_ar" >
                                </div>

                                <div class="form-group">
                                    <label for="description_ar">وصف</label>
                                    <textarea class="form-control" id="description_ar" name="description_ar"><?php echo set_value('description_ar'); echo $offers[1]['description'] ?></textarea>
<!--                                    <input type="text" value="--><?php //echo set_value('description_ar'); echo $offers[1]['description'] ?><!--" class="form-control" id="description_ar" name="description_ar" >-->
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="offers_image">Offers Image</label>
                                    <input type="file" value="" class="form-control"  id="news_image" name="offers_image" >
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="submit" value="Update" class="btn btn-shadow btn-primary"/>
                     <a href="<?php echo base_url().'administrator/manage_offers';?>" class="btn btn-shadow btn-danger">Cancel </a>
                </form>
            </div>
            </div>
        </section>

    </section>
</section>




