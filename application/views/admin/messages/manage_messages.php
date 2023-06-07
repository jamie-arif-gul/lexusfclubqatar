<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage Conversation
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
                            <th class="col-xs-4 col-sm-4 col-md-4">Subject</th>
                            <th class="col-xs-3 col-sm-2 col-md-2">Sender</th>
                            <th class="col-xs-3 col-sm-2 col-md-2">Receiver</th>
                            <th class="hidden-phone col-sm-2 col-md-2">Created On</h>
                            <th class="col-xs-2 col-sm-2 col-md-2">Updated On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result) {
                       ?> 
          
                        <tr>
                        	<td class="col-xs-4 col-sm-4 col-md-4"><a href="<?php echo base_url('administrator/messages_detail').'/'.$uri.'/'.encode_url($result['thread_id']); ?>"><?php echo $result['subject']; ?></a></td>
                            <td class="col-xs-3 col-sm-2 col-md-2"><?php echo $result['sender_first_name']; ?></td>
                            <td class="col-xs-3 col-sm-2 col-md-2"><?php echo $result['receiver_first_name']; ?></td>
                            <td class="hidden-phone col-sm-2 col-md-2"><?php echo date('m-d-Y', strtotime($result['created_on'])).' | '.date('h:i A', strtotime($result['created_on'])); ?></td>
                            <td class="col-xs-2 col-sm-2 col-md-2"><?php echo (strtotime($result['updated_on']))? date('m-d-Y', strtotime($result['updated_on'])).' | '.date('h:i A', strtotime($result['updated_on'])) : '--------'; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                        <?php }else{
                            echo '<div class="alert alert-danger alert-dismissable"> ';
                            echo 'No Conversation found..';
                            echo'</div>';
                            } ?>
                    
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
    function delete_object(id){
        var c = window.confirm("Are you sure, you want to delete this Request.?");
        if (c){
            window.location = '<?php echo base_url('administrator/deleteRequest/'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }

    function accept_request(id){
        var c = window.confirm("Are you sure, you want to accept this request?");
        if (c){
            window.location = '<?php echo base_url('administrator/acceptRequest'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }

    function reject_request(id){
        var c = window.confirm("Are you sure, you want to reject this request?");
        if (c){
            window.location = '<?php echo base_url('administrator/rejectRequest'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }

    function accept_payment(id){
        //alert(id);
        var c = window.confirm("Are you sure, you want to excute this transection?");
        if (c){
            window.location = '<?php echo base_url('administrator/acceptPayment'); ?>/<?php echo $uri; ?>/'+ id;
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