<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container"> 
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">Mailbox</h3>
      <hr class="style7">
      <div class="tbl_base">
      <?php $this->load->view('errors'); ?>
      <?php if($results) { ?>
      <table class="msgtbl" width="100%">
        <thead>
          <tr>
            <td>From</td>
            <td>Message</td>
            <td>Date</td>
            <td>Property Name</td>
            <td class="text-center">Unread</td>
            <td class="text-center">Status</td>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result) { 
          $unreaded_messages = $this->messages_model->get_unread_messages($result['thread_id']);
          ?>
          <tr onclick="window.location='<?php echo base_url('messages/conversation_detail').'/'.encode_url($result['thread_id']); ?>'" <?php echo ($unreaded_messages > 0)? 'style="background-color: #ADDFFF;"' : ''; ?>>          
            <td><?php 
            if($this->session->userdata('user_id') == $result['sender_id']){
              echo $result['receiver_first_name'].' '.$result['receiver_last_name'];
            }else{
              echo $result['sender_first_name'].' '.$result['sender_last_name'];
            }

             ?></td>
            <td><?php echo $result['subject']; ?></td>
            <td><?php echo date('m-d-Y', strtotime($result['updated_on'])); ?> | <?php echo date('h:i A', strtotime($result['updated_on'])); ?></td>
            <td><?php echo (strlen($result['property_name']) > 20)? substr($result['property_name'], 0,20).'...' : $result['property_name']; ?></td>
            <td class="text-center"><?php echo ($unreaded_messages > 0)? $unreaded_messages : '0'; ?></td>
            <td class="text-center">
            <?php 
              if($unreaded_messages > 0){
                echo '<i class="fa fa-certificate"></i>';
              }else{
                echo '<i class="fa fa-check-circle"></i>';
              }
             ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="clear10"></div>
      <div class="col-sm-12"><?php echo $pagination; ?></div>
      <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'You will be able to send messages after you rent your space.';
        echo'</div>';
        } ?>
      </div>
    </div>
   </div>
  </div>

<script>
    /*function delete_object(id){
        var c = window.confirm("Are you sure, you want to delete this request?");
        if (c){
            window.location = '<?php echo base_url('requests/deleteRequest'); ?>/<?php echo $uri; ?>/'+ id+'/s';
        }
    }*/
</script>