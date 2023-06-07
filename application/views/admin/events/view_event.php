<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">Event Detail<a href="<?php echo base_url('/administrator/manage_events'); ?>" class="btn btn_back pull-right" type="pull-right ">Back</a></header>
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
                        <div class="col-md-4"><img height="60" width="60" src="<?php echo base_url().'uploads/event_image/'.$event[0]['event_image']; ?>"></div>
                        <div class="col-md-4 ht-60"></div>
                        <div class="col-md-4 ht-60"></div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd><?php echo $event[0]['name'] ?></dd>
                                <dt>Description</dt>
                                <dd><?php echo $event[0]['description'] ?></dd>
                                <dt>Location</dt>
                                <dd><?php echo $event[0]['location'] ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>اسم الحدث</dt>
                                <dd><?php echo $event[1]['name'] ?></dd>
                                <dt>وصف</dt>
                                <dd><?php echo $event[1]['description'] ?></dd>
                                <dt>موقعك</dt>
                                <dd><?php echo $event[1]['location'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
<!--    Event Users            -->
                <?php
                $lower_limit = 0;
                if($this->uri->segment(4) != "")
                    $lower_limit = $this->uri->segment(4);
                ?>
                <section id="">
                    <section class="wrapper site-min-height">
                        <!-- page start-->
                        <section class="panel">
                            <header class="panel-heading">
                                Event Users
                            </header>
                            <table class="table table-striped table-advance table-hover" id="manage_users">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($event_users)){ foreach ($event_users as $key => $row) { ?>
                                    <tr>
                                        <td ><?php echo $row['name']." ".$row['last_name']; ?></td>
                                        <td ><?php echo $row['user_name']; ?></td>
                                        <td ><?php echo $row['email']; ?></td>
                                        <td ><?php echo $row['number']; ?></td>
                                        <td >
<!--                                            <button class="btn btn-primary btn-xs" title="View" onclick="window.location = '--><?php //echo base_url('administrator/view_event') . "/" . $row['id']; ?>
<!--                                            //';"><i class="fa fa-th-list"></i></button>-->
<!--                                            <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '--><?php //echo base_url('administrator/edit_event') . "/" . $row['id']; ?>
<!--                                            //';"><i class="fa fa-pencil-square-o"></i></button>-->
<!--                                            <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_page(--><?php //echo $lower_limit . "," . $row['id']; ?>
<!--                                            //);"><i class="fa fa-trash-o "></i></button>-->
                                        </td>
                                    </tr>
                                <?php }} ?>
                                </tbody>
                            </table>
                            <br>
                            <?php echo $pagination; ?>
                            <br>
                        </section>
                        <script type="text/javascript" charset="utf-8">
                            $(document).ready(function() {
                                $('#manage_users').dataTable({
                                    "aaSorting": [[4, "desc"]],
                                    "bPaginate": false
                                });

                                // JS code to remove other extra html elements
                                $('#manage_users_length').parent('div').css("display", "none");
                                $('#manage_users_filter').parent('div').removeClass('span6');
                                $('#manage_users_filter').parent('div').addClass('col-sm-12');
                                $('#manage_users_filter').parent('div').after('<br>');
                                $('.dataTables_paginate.paging_bootstrap.pagination').parent('div').css('display', "none");
                            });

                        </script>
                        <!-- page end-->
                    </section>
                </section>
                <script>
                    function delete_page(low, id){
                        var c = window.confirm("Are you sure, you want to delete this event?");
                        if (c){
                            window.location = '<?php echo base_url('administrator/delete_event'); ?>/' + low + "/" + id;
                        }
                    }
                </script>

                <style>
                    .pagntion{
                        margin-left: 3px;
                    }
                    .row-fluid{
                        /*display: none;*/
                    }
                </style>

            </div>
        </section>
    </section>
</section>

