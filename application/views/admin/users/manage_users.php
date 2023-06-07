<?php
$lower_limit = 0;
if($this->uri->segment(3) != "")
    $lower_limit = $this->uri->segment(3);
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage Users
            </header>
    <?php if (isset($success)) {?>
        <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php print_r($success); ?>
        </div>
    <?php } ?>
    <?php if (isset($errors)) { ?>
        <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php print_r($errors); ?>
        </div>
    <?php } ?>
                <table class="table table-striped table-advance table-hover" id="manage_users">
                    <thead>
                        <tr>
                            <th class="col-xs-3 col-sm-2 col-md-2">Name</th>
                            <th class="col-xs-4 col-sm-4 col-md-4">Email Address</th>
                            <th class="hidden-phone col-sm-2 col-md-2">Qid</th>
                            <th class="hidden-phone col-sm-1 col-md-1">Year Make</th>
                            <th class="col-xs-2 col-sm-1 col-md-1">Status</th>
                            <th class="col-xs-3 col-sm-2 col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result){ foreach ($result as $row) {
                        $number = explode(',', $row['number']);
                        ?>
                        <tr>
                        	<td class="col-xs-3 col-sm-2 col-md-2"><?php echo $row['name'].' '.$row['last_name']; ?></td>
                            <td class="col-xs-4 col-sm-4 col-md-4"><?php echo $row['email']; ?></td>
                            <td class="hidden-phone col-sm-2 col-md-2"><?php echo $row['qid']; ?></td>
                            <td class="hidden-phone col-sm-1 col-md-1"><?php echo $row['year_of_make']; ?></td>
                            <td class="col-xs-2 col-sm-1 col-md-1">
                                <?php if ($row['account_status'] == 1 && $row['email_confirmed'] == 1) { ?>
                                <span class="btn btn-success btn-xs cursor_default" title="Active"><i class="fa fa-check"></i></span>
                                <?php } else { ?>
                                <span class="btn btn-danger btn-xs cursor_default" title="Deactive"><i class="fa fa-ban"></i></span>
                                <?php } ?>
                            </td>
                            <td class="col-xs-3 col-sm-2 col-md-2">
                                <button class="btn btn-primary btn-xs" title="View" onclick="window.location = '<?php echo base_url('administrator/view_user') . "/" . $row['user_id']; ?>';"><i class="fa fa-th-list"></i></button>
                                <?php if ($row['account_status'] == 1 && $row['email_confirmed'] == 1) { ?>
                                <a href="<?php echo base_url('administrator/update_user_status/' . $lower_limit . "/" . $row['user_id'] . "/0"); ?>" class="btn btn-danger btn-xs" title="Deactivate User"><i class="fa fa-ban"></i></a>
                                <?php } else { ?>
                                <a href="<?php echo base_url('administrator/update_user_status/' . $lower_limit . "/" . $row['user_id'] . "/1"); ?>" class="btn btn-success btn-xs" title="Activate User"><i class="fa fa-check"></i></a>
                                <?php } ?>
                                <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_page(<?php echo $lower_limit . "," . $row['user_id']; ?>);"><i class="fa fa-trash-o "></i></button>                                
                            </td>
                        </tr>
                        <?php } }?>
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
        var c = window.confirm("Are you sure, you want to delete this user?");
        if (c){
            window.location = '<?php echo base_url('administrator/delete_user'); ?>/' + low + "/" + id;
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