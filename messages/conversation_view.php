<div class="clear20"></div>
	<div class="container"><!---- Sidebar Container start ---->
    	<?php $this->load->view('frontend/includes/side_bar'); ?>
    
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 profile-description">
    <?php //print_r($conversation_threads); ?>
    <?php if($conversation_threads){?>
     <?php if(isset($errors)){ ?>
          <div class="alert alert-danger fade in">
        		<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Oops!&nbsp;</strong> <?php print_r($errors); ?></div> 
		  <?php }?>
          <?php if(isset($success)){ ?> 
          
          <div class="alert alert-success fade in">
        		<a href="#" class="close" data-dismiss="alert">&times;</a>
				<?php print_r($success);?></div>  
		  
		  <?php }?>
				<table class="inboxtbl" width="100%">
		<thead>
			<tr>
				<th>Username</th>
				<th>Message</th>
				<th>Time</th>
				<th>Actions</th>
			</tr>
		</thead>
		
		<tbody>
        <?php
		
		 foreach($conversation_threads as $thread){?>
			<tr>
				<td><?php 
				if($thread['sender_user_id'] == $this->session->userdata('user_id')){
					$reciver_user_id =  $thread['receiver_user_id'];
					$user_name = 
					get_user_information_by_column(array('user_full_name') , 
					$reciver_user_id);
					echo $user_name[0]['user_full_name'];
					}else if($thread['receiver_user_id'] == $this->session->userdata('user_id')){
						$reciver_user_id =  $thread['sender_user_id'];
						$user_name = 
						get_user_information_by_column(array('user_full_name') , 
						$reciver_user_id);
						echo $user_name[0]['user_full_name'];
						}
				?></td>
				<td><?php echo $thread['message']; ?></td>
				<td><?php echo $thread['created_date']; ?></td>
				<td><a href="<?php echo base_url('get_all_conversation')."/".encode_url($thread['c_id']).'/'.encode_url($reciver_user_id) ?>">
                <i class="fa fa-search"></i></a> &nbsp; 
                
                <a onclick="return confirm('Do you want to delete this conversation?');" href="<?php echo base_url('delete_conversation').'/'.encode_url($thread['c_id']); ?>"><i class="fa fa-trash-o"></i></a></td>
			</tr>
            <?php } ?>
		</tbody>
	</table>
    <div class="clear10"></div>
    <div class="pull-right"><?php print_r($pagination); ?></div>
	<?php }else{?>
                <div class="alert alert-danger fade in">
        <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
        <strong>Oops!&nbsp;</strong> No thread found.</div>
	<?php } ?>
    
    </div>
   <div class="clear20"></div>
    </div>
    <script>
    	/*update staus all new messages*/
	setInterval(function(){  
		//console.log('hello');
		//ajax start 
		  $.ajax({
				url: base_url+"update_unread_message_status",
				//data: {obj_id : obj_id , package_id : package_id } ,
				type: "POST",
				dataType : "text",
				success: function( json ) {
					//console.log(json);
					$('#get_msg_notifications').addClass('hide');
					$('#get_msg_notifications_head').addClass('hide');
						
					},
				error: function( xhr, status, errorThrown ) {
					console.log( "Error: " + errorThrown );
					console.log( "Status: " + status );
					console.dir( xhr );
				},
				complete: function( xhr, status ) {
					console.log(status);
				}
			});
		// ajax end
	}, 2000);
	/*update ststua all new message code end*/
    </script>