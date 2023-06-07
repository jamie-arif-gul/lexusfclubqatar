<style>
.new_chatbox{
	background:#FFF;
	padding:20px;
	height: auto;
	border-radius: 10px;
}
.chatbox{
	background:#FFF;
	border:1px solid #666;
}
.chat_title{
	background: none repeat scroll 0 0 #1d2230;
    border-top: 1px solid white;
    color: #fff;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 16px;
    padding: 1px;
    text-transform: uppercase;
    width: 100%;
}
.chat_title > h5{
	color:#FFF;
    text-transform: capitalize;
	padding: 2px 18px;
}
.chat_title>.box>.alert-catilized {
	 text-transform: none;
	}
.chat_area{
	background:url("assets/frontend_assets/images/crossword.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
	height:460px;
	overflow-y:scroll;
}
.received_msg{
  background: #1d2230;
	color:#FFF;
	padding:10px;
	margin: 11px 0;
	border-radius: 5px;
	clear:both;
	float:left;
}
.sent_msg{
	float:right;
	background: #12768c;
	color:#FFF;
	padding:10px;
	margin: 11px 0;
	border-radius: 5px;
	clear:both;
}
/*.my-caret{
	border-color: #000000 transparent -moz-use-text-color !important;
    border-style: solid solid dotted;
    border-width: 0 6px 5px;
    color: black;
    display: inline-block;
    height: 0;
    margin-left: 2px;
    margin-top: -47px;
    vertical-align: middle;
    width: 0;
}*/
.fa-caret-left{
	color: #1d2230;
    font-size: 28px;
    margin-left: -19px;
    margin-top: -7px;
    position: absolute;
}
.sent_msg .fa-caret-right{
	color: #12768c;
    font-size: 28px;
    margin-top: -2px;
    position: absolute;
	right: -9px;
}
.panel-body > fa-caret-right{
	font-size:12px !important;
}
.chat_line_break{
	-moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: -moz-use-text-color -moz-use-text-color white;
    border-image: none;
    border-style: none none dotted;
    border-width: 0 0 1px;
	margin: 0.5em auto !important;
}
.fa-times{
	font-size:16px;
	margin-right:10px;
}


</style>

<div class="clear20"></div>
	<div class="container"><!---- Sidebar Container start ---->
    	<?php $this->load->view('frontend/includes/side_bar'); ?>
    <?php //echo "<pre>"; print_r($conversation_msg); echo "</pre>"; ?>
    
    
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    		<!--reply box-->
            <div class="chat_title">
       		<span style="text-align:left;" class="avatar-username">Compose reply</span>
       </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profile-description chat_title">
       <div style="width:100%;" class="box">
        <?php if(isset($errors)){ ?>
          <div class="alert alert-danger fade in alert-catilized">
        		<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Oops!&nbsp;</strong> <?php print_r($errors); ?></div> 
		  <?php }?>
          <?php if(isset($success)){ ?> 
          
          <div class="alert alert-success fade in alert-catilized">
        		<a href="#" class="close" data-dismiss="alert">&times;</a>
				<?php print_r($success);?></div>  
		  
		  <?php }?>
    <form method="post" action="<?php echo base_url('conversation_reply');?>" class="form-horizontal">
    <input type="hidden" name="receiver_user_id" value="<?php echo $this->encrypt->encode(decode_uri($this->uri->segment(3))); ?>" />
    <input type="hidden" name="hidden_url" value="<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" />
  <div class="form-group">
    <div class="col-sm-12">
      <textarea placeholder="Type your message" id="message" name="message" rows="5"  cols="10"class="form-control" type="text"></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button class="btn btn-sky pull-right" type="submit">Send</button>
    </div>
  </div>
</form>
    </div>
    </div>
    <div class="clear10"></div>
            <!--reply box end-->
             <div class="pull-right"><?php print_r($pagination); ?></div>
             <div class="clear10"></div>
    <div class="chatbox col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
            	<div class="chat_title">
                	<h5><?php $user_name =  
						get_user_information_by_column(
						array('user_full_name') , 
						decode_uri($this->uri->segment(3)));
						echo $user_name[0]['user_full_name']; ?>
                        </h5>
                </div>
                <div class="chat_area col-lg-12">
                <div class="clear10"></div>

	<?php
		if($conversation_msg){
	 foreach($conversation_msg as $con_msg){
		
		if($con_msg['user_id'] != $this->session->userdata('user_id')){?>
		<div class="received_msg col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<a role="button" href="<?php echo base_url('delete_conversation_msg').'/'.encode_url($con_msg['c_id_fk']).'/'.encode_url($con_msg['user_id']).'/'.encode_url($con_msg['cr_id']) ?>" 
        onclick="return confirm('Do you want to delete this message?');" style="position: absolute; right: -3px; color:white; top:7.5%;" class="pull-right" title="Delete"><i class="fa fa-times"></i></span></a>
                        	<i class="fa fa-caret-left"></i>
                        	<span><?php echo $con_msg['message']; ?></span>
                            <hr class="chat_line_break">
                            <span class="pull-right msg_date"><?php echo $con_msg['cr_created_date']; ?></span>
                        </div>
		<?php }else{?>
		<div class="sent_msg col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<a role="button" href="<?php echo base_url('delete_conversation_msg').'/'.encode_url($con_msg['c_id_fk']).'/'.encode_url($con_msg['user_id']).'/'.encode_url($con_msg['cr_id']) ?>" onclick="return confirm('Do you want to delete this message?');" style="position: absolute; right: -3px; color:white; top:7.5%;" class="pull-right" title="Delete"><i class="fa fa-times"></i></span></a>
                        	<span><?php echo $con_msg['message']; ?></span>
                            <i class="fa fa-caret-right"></i>
                            <hr class="chat_line_break">
                            <span class="pull-right msg_date_2"><?php echo $con_msg['cr_created_date'];?></span>
                        </div>
		<?php }?>	          	
<?php } 

}else{?> 
		<div class="alert alert-danger fade in">
        <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
        <strong>Oops!&nbsp;</strong> All messages are deleted.</div>
<?php }?>
            </div>
            </div>
            
    </div>
    <div class="clear20"></div>
    </div>