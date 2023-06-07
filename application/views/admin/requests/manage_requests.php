<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage Requests
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
                            <th >Name</th>
                            <th >Sender</th>
                            <th >Receiver</th>
                            <th >Status</th>
                            <th >Requested On</th>
                            <th >Acceted On</th>
                            <th >Canceled On</th>
                            <th >Payments</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result) { 
                        $payments = $this->comman_model->get('request_payments',array('request_id' => $result['request_id']));
                        //echo '<pre>'; print_r($payments); die;
                       ?> 
          
                        <tr>
                        	<td ><a href="<?php echo base_url('administrator/request_detail').'/'.$uri.'/'.encode_url($result['request_id']); ?>"><?php echo $result['name']; ?></a></td>
                            <td ><?php echo $result['sender_name']; ?></td>
                            <td ><?php echo $result['receiver_name']; ?></td>
                            <td >
                            <?php 
                                if($result['teansection_id'] != ''){
                                    echo '<div class="btn btn-sm btn-pending" title="Your request is padding.">Purchased</div>';
                                  }else{
                                    if($result['request_status'] == 0){
                                      echo '<div class="btn btn-sm btn-pending" title="Your request is padding.">pending</div>';
                                    }
                                    if($result['request_status'] == 1){
                                      echo '<div class="btn btn-sm btn-accepted" title="Your request is accepted.">accepted</div>';
                                    }
                                    if($result['request_status'] == 2){
                                      echo '<div class="btn btn-sm btn-rejected" title="Your request is rejected.">rejected</div>';
                                    }
                                  } 
                            ?>
                            </td>
                            <td ><?php echo date('m-d-Y', strtotime($result['created'])).' | '.date('h:i A', strtotime($result['created'])).' EST'; ?></td>
                            <td ><?php echo (strtotime($result['modified']) > 0)? date('m-d-Y', strtotime($result['modified'])).' | '.date('h:i A', strtotime($result['modified'])).' EST' : '--------'; ?></td>
                            <td ><?php echo (strtotime($result['cancel_on']) > 0)? date('m-d-Y', strtotime($result['cancel_on'])).' | '.date('h:i A', strtotime($result['cancel_on'])).' EST' : '--------'; ?></td>
                            <td >
                                <?php
                                foreach ($payments as $payment){ ?>
                                    <button 
                                    <?php if($payment['payment_status'] == 'panding'){ ?>
                                        onclick="accept_payment('<?php echo encode_url($payment['payment_id']); ?>');" 
                                        class="btn btn-info btn-xs"
                                        title="Due Date : <?php echo date('m-d-Y',$payment['due_date']); ?>"> 
                                        <?php echo $payment['amount_due']; ?>
                                    <?php }else{ ?>
                                            class="btn btn-success btn-xs" 
                                            title="Paid Date : <?php echo date('m-d-Y',strtotime($payment['modified_on'])).' | '.date('h:i A',strtotime($payment['modified_on'])); ?>"> 
                                            <?php echo $payment['amount_due']; ?>
                                        <?php } ?>
                                    </button>
                                <?php }
                                ?>
                            </td>
                            <td >
                            <?php if($result['request_status'] == 0){ ?>
                                <button class="btn btn-success btn-xs" title="Accept" onclick="accept_request('<?php echo encode_url($result['request_id']); ?>');"><i class="fa fa-check "></i></button>
                                <button class="btn btn-danger btn-xs" title="Reject" onclick="reject_request('<?php echo encode_url($result['request_id']); ?>');"><i class="fa fa-ban "></i></button>
                            <?php } ?>    
                                <button class="btn btn-danger btn-xs" title="Delete" onclick="delete_object('<?php echo encode_url($result['request_id']); ?>');"><i class="fa fa-trash-o "></i></button>                                
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                        <?php }else{
                            echo '<div class="alert alert-danger alert-dismissable"> ';
                            echo 'No requests found..';
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