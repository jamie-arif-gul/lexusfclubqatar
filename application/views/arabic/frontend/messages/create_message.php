<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container">
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left">Create Message</h3>
      <hr class="style7">
      <div class="userinfo">
  

  <form id="create" action="<?php echo base_url('messages/create'); ?>" method="post" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
  <div class="form-group">
        <div class="col-sm-6 form-group">
         <label for="name">To</label>
         <select type="text" class="form-control" id="receiver_id" name="receiver_id" required>
        <option value="">Please Select</option>
        <?php 
        $users = get('users',array('user_id !=' => $this->session->userdata('user_id'),'account_status' => 1,'email_confirmed' => 1,'user_role' => 2,'is_deleted' => 0),'user_id,name,last_name',array('name' => 'desc','last_name' => 'desc'));
        if($users){
        	foreach ($users as $user) { ?>
        	<option value="<?php echo encode_url($user['user_id']); ?>"><?php echo ucfirst($user['name']).' '.ucfirst($user['last_name']); ?></option>	
        <?php	}
        } ?>
      </select>
        </div>
        
        <div class="clear10"></div>

        <div class="form-group col-sm-12">
          <label for="message">Message</label>
          <textarea type="text" class="form-control" name="message" id="message" placeholder="message" rows="5"></textarea>
        </div>
		
		<div class="clear20"></div>
     
     <div class="col-sm-2">
       <button type="submit" class="btn btn-danger" >Send</button>
     </div>
        
  
    </form>
  </div>
  </div>
  </div>
  </div>

</div>