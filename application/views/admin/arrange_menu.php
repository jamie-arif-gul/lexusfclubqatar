<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Menu Arrangement
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <div>
                            <form action="<?php echo base_url('admin/menus/re_arrange'); ?>" method="post">
                                <textarea id="nestable_list_output" name="output" rows="5" cols="50"></textarea>
                                <input type="submit" class="btn btn-primary" value="Submit"/>
                            </form>
                        </div>
                        <div class="dd" id="nestable_list">
                            <?php echo $menu; ?>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $('#nestable_list li div').bind('click', function(){
                    alert('clicked');
                });
            </script>
        <!-- page end-->
        

