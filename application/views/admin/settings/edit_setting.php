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
                Edit Setting
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <?php $this->load->view('errors'); ?>
                        <form method="post" role="form" id="new_page" action="<?php echo base_url('administrator/edit_setting')."/".$uri. "/" . encode_url($results[0]['st_id']); ?>">
                            <div class="form-group col-md-7">
                                <label for="page_title">Title</label>
                                <input type="text" value="<?php if (isset($results)) echo $results[0]['st_title']; ?>" placeholder="Enter Title" id="st_title" name="st_title" class="form-control" readonly>
                            </div>
                            
                            <div class="form-group col-md-7">
                                <label for="content">Content</label>
                                <textarea placeholder="Enter content here" name="st_content" id="content" class="form-control"><?php  if (isset($results)) echo $results[0]['st_content']; ?></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                                <div class="col-md-6">
                                    <input type="submit" value="Update" class="btn btn-shadow btn-primary"/>
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