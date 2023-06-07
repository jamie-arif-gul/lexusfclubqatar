<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage Pages
            </header>
            <?php 
                if (isset($errors) || isset($success))
                {
            ?>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-11">
                <?php 
                    if (isset($errors))
                    {
                ?>
                    <div class="alert alert-block alert-danger fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Error!</strong>
                        <p><?php print_r($errors); ?></p>
                    </div>
                        <?php 
                        } 
                        if (isset($success))
                        {
                         ?>
                    <div class="alert alert-success alert-block fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4>
                            <i class="fa fa-ok-sign"></i>
                            Success!
                        </h4>
                        <p><?php echo $success; ?></p>
                    </div>
                <?php
                    }
                    ?>
                </div>
            </div>
            </div>
            <?php } 
            ?>
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th class="col-xs-6 col-sm-3 col-md-4">Title</th>
                        <th class="hidden-phone col-sm-5 col-md-6">Description</th>
                        <th class="col-xs-3 col-sm-2 col-md-1">Status</th>
                        <th class="col-xs-3 col-sm-2 col-md-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td class="col-xs-6 col-sm-3 col-md-4"><a href="#"><?php echo $row['page_title']; ?></a></td>
                        <td class="hidden-phone col-sm-5 col-md-6"><?php echo substr($row['content'], 0, 150); ?></td>
                        <td class="col-xs-3 col-sm-2 col-md-1">
                                <?php if ($row['status']==1) { ?>
                            <a href="<?php echo base_url('administrator/update_page_status/'.$lower_limit."/".$row['page_id']."/0"); ?>" class="btn btn-success btn-xs" title="Unpublish"><i class="fa fa-check"></i></a>
                                <?php } else { ?>
                            <a href="<?php echo base_url('administrator/update_page_status/'.$lower_limit."/".$row['page_id']."/1"); ?>" class="btn btn-danger btn-xs" title="Publish"><i class="fa fa-ban"></i></a>
                                <?php } ?>
                        </td>
                        <td class="col-xs-3 col-sm-2 col-md-1">
                            <button class="btn btn-primary btn-xs" title="Edit" onclick="window.location = '<?php echo base_url('administrator/edit_page')."/".$row['page_id']; ?>';"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_page(<?php echo $lower_limit.",".$row['page_id'];?>);"><i class="fa fa-trash-o "></i></button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br><br>
            <?php echo $pagination; ?>
            <br><br><br><br>
           </section>     
        <script>
            function delete_page(low, id)
            {
                var c = window.confirm("Are you sure, you want to delete this page?");
                if (c)
                {
                    window.location = '<?php echo base_url('administrator/delete_page');?>/'+low+"/"+id;
                }
            }
        </script>
        <!-- page end-->
       </section>   
   </section>   