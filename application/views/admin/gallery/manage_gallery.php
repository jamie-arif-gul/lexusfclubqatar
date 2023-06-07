<?php
$lower_limit = '0';
if ($this->uri->segment(3) != "")
    $lower_limit = $this->uri->segment(3);
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage Gallery
            </header>
            <?php if (isset($success)) { ?>
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
            <a href="<?php echo base_url('administrator/create_gallery') ?>"><input type="submit" value="Add new" class="btn btn-shadow btn-primary" style="
                                                                                    margin: 17px 0px;
                                                                                    "></a>
            <table class="table table-striped table-advance table-hover" id="manage_users">
                <thead>
                    <tr>
                        <th class="col-xs-3 col-sm-2 col-md-2">Image</th>
                        <th class="col-xs-4 col-sm-4 col-md-4">Title</th>
<!--                        <th class="col-xs-3 col-sm-2 col-md-2">Description</th>-->
                        <th class="col-xs-4 col-sm-4 col-md-4">عنوان</th>
<!--                        <th class="col-xs-3 col-sm-2 col-md-2">وصف</th>-->
                        <th class="col-xs-3 col-sm-2 col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        foreach ($result as $key => $row) {
                            ?>
                            
                            <tr>
                                <td class="col-xs-3 "><img height="50" width="50" src="<?php echo base_url() . 'uploads/gallery_image/' . $row[0]['gallery_image']; ?>" /></td>
                                <td class="col-xs-3 "><?php echo $row[0]['title']; ?></td>
<!--                                <td class="hidden-phone col-sm-1 col-md-1">--><?php //echo $row[0]['description']; ?><!--</td>-->
                                <td class="col-xs-3"><?php echo $row[1]['title']; ?></td>
<!--                                <td class="hidden-phone col-sm-1 col-md-1">--><?php //echo $row[1]['description']; ?><!--</td>-->
                                <td class="col-xs-3 ">
                                    <button class="btn btn-primary btn-xs" title="View" onclick="window.location = '<?php echo base_url('administrator/view_gallery') . "/" . $row[0]['id']; ?>';"><i class="fa fa-th-list"></i></button>
                                    <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('administrator/edit_gallery') . "/" . $row[0]['id']; ?>';"><i class="fa fa-pencil-square-o"></i></button>
                                    <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_page(<?php echo $lower_limit . "," . $row[0]['id']; ?>);"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                </tbody>
            </table>
            <br>
<?php echo $pagination; ?>
            <br>
        </section>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
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
    function delete_page(low, id) {
        var c = window.confirm("Are you sure, you want to delete this Gallery?");
        if (c) {
            window.location = '<?php echo base_url('administrator/delete_gallery'); ?>/' + low + "/" + id;
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