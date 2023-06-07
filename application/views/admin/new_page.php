<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php if (isset($result)) echo 'Edit Page'; else echo 'Add New Page'; ?>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
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
                        <form method="post" role="form" id="new_page" action="<?php if(!isset($result)) echo base_url('administrator/save_page'); else echo base_url('administrator/update_page'); ?>">
                            <?php if (isset($result)) { ?>
                            <input type="hidden" name="id" value="<?php echo $result[0]['page_id']; ?>"/>
                            <?php } ?>
                            <div class="form-group col-md-7">
                                <label for="page_title">Page Title</label>
                                <input type="text" value="<?php if (isset($result)) echo $result[0]['page_title']; else { if (!isset($success)) echo set_value('page_title'); } ?>" placeholder="Enter Page Title" id="page_title" name="page_title" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-7">
                                <label for="parent_page">Parent*</label>
                                <select class="form-control" name="parent_page">
                                    <option value="">Select</option>
                                    <option value="0" <?php echo (isset($result) && $result[0]['parent']==0) ? 'selected="selected"':''; ?>>Main page (no parent)</option>
                                    <?php 
                                    if (isset($pages)) { 
                                        foreach ($pages as $page_data) {
                                            echo '<option value="'.$page_data['page_id'].'" '.(  (isset($result) && $page_data['page_id']==$result[0]['parent']) ? 'selected="selected"':'' ).'>'.$page_data['page_title'].'</option>';
                                        }
                                    } 
                                        ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-7">
                                <label for="content">Content</label>
                                <textarea placeholder="Enter page content here" name="content" id="content" class="form-control"><?php  if (isset($result)) echo $result[0]['content']; else { if (!isset($success)) echo set_value('content'); } ?></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <div class="form-group">
                                    <label class="label_check" for="publish_page">
                                        <input name="publish_page" id="publish" type="checkbox" <?php if (isset($result)) echo ($result[0]['status']==1) ? 'checked="checked"':''; ?> value="on" /> Publish
                                    </label>
                                </div>
                                <br>
                                <div class="col-md-6">
                                    <input type="submit" value="<?php  if (isset($result)) echo "Update"; else echo 'Add Page'; ?>" class="btn btn-shadow btn-primary"/>
                                </div>
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
           </section>     
        <!-- page end-->
       </section>    
   </section>  