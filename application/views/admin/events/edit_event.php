<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading"> Edit Event</header>
            <div class="panel-body">
                <span>
                    <?php
                    if ($this->session->flashdata('errors')) {
                        echo '<div class="alert alert-danger alert-dismissable"> ';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        print_r($this->session->flashdata('errors'));
                        echo '</span>';
                        echo'</div>';
                    }
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
                <form method="post" role="form" id="create_user" action="administrator/edit_event/<?php echo $this->uri->segment(3); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_en">Event Name</label>
                                    <input type="text" value="<?php echo $event[0]['name']; ?>" class="form-control" id="name_en" name="name_en" >
                                </div>

                                <div class="form-group">
                                    <label for="description_en">Description</label>
                                    <textarea class="form-control" id="description_en" name="description_en"><?php echo $event[0]['description']; ?></textarea>
<!--                                    <input type="text" value="--><?php //echo $event[0]['description']; ?><!--" class="form-control" id="description_en" name="description_en" >-->
                                </div>

                                <div class="form-group">
                                    <label for="location_en">Location</label>
                                    <input type="text" value="<?php echo $event[0]['location']; ?>" class="form-control"  id="location_en" name="location_en" >
                                </div>
                            </div>
                            <div class="col-md-6" dir="rtl">
                                <div class="form-group">
                                    <label for="name_ar">اسم الحدث</label>
                                    <input type="text" value="<?php echo $event[1]['name']; ?>" class="form-control" id="name_ar" name="name_ar" >
                                </div>

                                <div class="form-group">
                                    <label for="description_ar">وصف</label>
                                    <textarea class="form-control" id="description_ar" name="description_ar"><?php echo $event[1]['description']; ?></textarea>
<!--                                    <input type="text" value="--><?php //echo $event[1]['description']; ?><!--" class="form-control" id="description_ar" name="description_ar" >-->
                                </div>

                                <div class="form-group">
                                    <label for="location_ar">موقعك</label>
                                    <input type="text" value="<?php echo $event[1]['location']; ?>" class="form-control"  id="location_ar" name="location_ar" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="event_date">Event Date</label>
                                    <input type="date" value="<?php echo $event[1]['event_date']; ?>" class="form-control"  id="event_date" name="event_date" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="event_time">Event Time</label>
                                    <input type="time" value="<?php echo $event[1]['event_time']; ?>" class="form-control"  id="event_time" name="event_time" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="event_image">Event Image</label>
                                    <input type="file" value="" class="form-control"  id="event_image" name="event_image" >
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="submit" value="Update" class="btn btn-shadow btn-primary"/>
                    <a href="<?php echo base_url().'administrator/manage_events';?>" class="btn btn-shadow btn-danger">Cancel </a>
                </form>
            </div>
            </div>
        </section>

    </section>
</section>




