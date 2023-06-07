<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage Properties
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
    
    <?php if($results){ ?>
                <table class="table table-striped table-advance table-hover" id="manage_users">
                    <thead>
                        <tr>
                            <th class="col-xs-2 col-sm-3 col-md-3">Name</th>
                            <th class="hidden-phone col-sm-1 col-md-1">Image</th>                          
                            <th class="col-xs-2 col-sm-1 col-md-1">Type</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 text-center">Featured</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 text-center">Expired On</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 text-center">Views</th>
                            <th class="col-xs-2 col-sm-1 col-md-1 text-center">Status</th>
                            <th class="col-xs-3 col-sm-2 col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result) { 
                           $search_image = get('property_images',array('property_id' => $result['property_id'],'type' => 1));
                            $img_src = base_url('assets/frontend').'/images/default_image.png';
                            if($search_image[0]['image'] != ''  && file_exists(realpath('uploads/img_gallery/property_images/' . $search_image[0]['image']))){
                            //$img_src = base_url('uploads/img_gallery/property_images').'/'.preg_replace('"\.(jpg|gif|png|jpeg)$"', '_100x100.jpg', $result['image']);
                            $img_src = base_url('uploads/img_gallery/property_images').'/'.$search_image[0]['image'];
                            }
                        ?>
                        <tr>
                        	<td class="col-xs-2 col-sm-3 col-md-3"><a href="<?php echo base_url('administrator/property_detail').'/'.$uri.'/'.encode_url($result['property_id']); ?>"><?php echo $result['name']; ?></a></td>
                            <td class="hidden-phone col-sm-1 col-md-1"><img height="50" width="50" src="<?php echo $img_src; ?>" class="thumbnail" /></td>
                            <td class="col-xs-2 col-sm-1 col-md-1"><?php echo $result['type']; ?></td>
                            <td class="col-xs-1 col-sm-1 col-md-1 text-center"><?php echo ($result['is_feature'] == 0)? '<i class="fa fa-ban">' : '<i class="fa fa-check"></i>'; ?></td>
                            <td class="col-xs-1 col-sm-1 col-md-1 text-center"><?php echo ($result['date_to'] > time())? date('m-d-Y', $result['date_to']).' | '.date('h:i A', $result['date_to']).' EST' : 'Expired'; ?></td>
                            <td class="col-xs-1 col-sm-1 col-md-1 text-center">
                             <input id="views_<?php echo ($result['property_id']*99); ?>" style="width:60%" onblur="add_views('<?php echo ($result['property_id']*99); ?>');" value="<?php echo $result['views_counter']; ?>">
                             <div id="messages_<?php echo ($result['property_id']*99); ?>" style="display:none;"></div>
                            </td>
                            <td class="col-xs-2 col-sm-1 col-md-1 text-center">
                            
                            <?php if($result['status'] == 1){ ?>
                                <button class="btn btn-success btn-xs cursor_default" title="property is active"><i class="fa fa-check "></i></button>
                            <?php }else{ ?>
                                <button class="btn btn-danger btn-xs cursor_default" title="property is deactive"><i class="fa fa-ban"></i></button>
                            <?php } ?>
                            
                            </td>
                            
                            <td class="col-xs-3 col-sm-2 col-md-2">
                            
                            <?php if($result['is_feature'] == 1){ ?>
                                <button class="btn btn-danger btn-xs" title="Make this property unfeatured" onclick="window.location = '<?php echo base_url('administrator/featured').'/'.$uri.'/'.encode_url($result['property_id']).'/0'; ?>'"><i class="fa fa-ban "></i></button>
                            <?php }else{ ?>
                                <button class="btn btn-success btn-xs" title="Make this property featured" onclick="window.location = '<?php echo base_url('administrator/featured').'/'.$uri.'/'.encode_url($result['property_id']).'/1'; ?>'"><i class="fa fa-check "></i></button>
                            <?php } ?>

                            <?php if($result['status'] == 1){ ?>
                                <button class="btn btn-danger btn-xs" title="Deactivate this property" onclick="window.location = '<?php echo base_url('administrator/updateStatus').'/'.$uri.'/'.encode_url($result['property_id']).'/0'; ?>'"><i class="fa fa-ban "></i></button>
                            <?php }else{ ?>
                                <button class="btn btn-success btn-xs" title="Activate this property" onclick="window.location = '<?php echo base_url('administrator/updateStatus').'/'.$uri.'/'.encode_url($result['property_id']).'/1'; ?>'"><i class="fa fa-check "></i></button>
                            <?php } ?>
                                <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo encode_url($result['property_id']); ?>');"><i class="fa fa-trash-o "></i></button>                                
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <?php echo $pagination; ?>
                <br>
        <?php }else{
            echo '<div class="alert alert-danger alert-dismissable"> ';
            echo 'No property found..';
            echo'</div>';
        } ?>
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
    function delete_object(id){
        var c = window.confirm("Are you sure, you want to delete this property?");
        if (c){
            window.location = '<?php echo base_url('administrator/deleteProperty/'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }

    function add_views(id){
        var views = $('#views_'+id).val();
        var p_id = id;
        if(views != ""){
            if (views%1 === 0){
          $.ajax({
                url: "<?php echo base_url('administrator/add_property_views'); ?>",
                type: 'post',
                datType: 'JSON',
                data: {property_id: p_id,views_counter:views},
                success: function(response){
                  $('#messages_'+id).html(response);
                  $('#messages_'+id).fadeIn("slow");
                  setTimeout(function(){
                  $('#messages_'+id).fadeOut("slow");
                  $('#messages_'+id).html('');
                 }, 3000);
                },

            });
           }
    else{
        alert("views must be an integer");
      }
            //alert($(that).data('img-id'));
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
    .list-tags a {
    background: #eeeeee none repeat scroll 0 0;
    color: #66667a;
    padding: 3px;
} 
</style>