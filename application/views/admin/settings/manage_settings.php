<?php
$uri = 0;
if($this->uri->segment(3) != "")
    $uri = $this->uri->segment(3);
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage Settings
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
                            <th class="col-xs-2">Title</th>
                            <th class="col-xs-8">content</th>
                            <th class="col-xs-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result) {
                        ?>
                        <tr>
                        	<td class="col-xs-2"><?php echo $result['st_title']; ?></td>
                            <td class="col-xs-8"><?php echo $result['st_content']; ?></td>
                            <td class="col-xs-2">
                                <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('administrator/edit_setting')."/".$uri. "/" . encode_url($result['st_id']); ?>';"><i class="fa fa-pencil"></i></button>                              
                            </td>
                        </tr>
                        <?php } ?>
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

<style>
    .pagntion{
        margin-left: 3px;
    }
    .row-fluid{
        /*display: none;*/
    }   
</style>