 <style type="text/css">
  #img-preview{
    display: block !important;
  }
  .preview{
    background-color: #fff;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #000;
    width: 100%;
    height: 410px;
    overflow: hidden;
  }

	  .dashboard-heading{
		  color:#5cb85c !important;
	  }
	  .btn-primary{
		  font-size:13px !important;
	  }
	  @media screen and (min-width:992px) and (max-width:1199px){
		  .unitnum{
			  margin-right:28px !important;
		  }
	  }
	  @media screen and (min-width:768px) and (max-width:991px){
		  .unitnum{
			  margin-right:42px !important;
		  }
	  }
	  .request_table thead tr td{
		  background: none repeat scroll 0 0 #214472;
			color: white;
			font-weight: bold;
			padding: 10px;
	  }
	  .request_table tbody tr td{
			padding: 10px;
			border-bottom:1px solid #ccc;
	  }
</style> 

  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">Request to Rent</h3>
	<hr class="style7">
  
<form action="<?php echo base_url('requests/request_step_one').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
    <div class="col-sm-6">
		<label for="address">Number of Guests</label>
         <select class="form-control" name="number_of_guests" id="number_of_guests" required>
            <option value="">Please Select</option>
            <?php for ($i=1; $i <= 20; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php if(set_value('number_of_guests') == $i){ echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
            <?php } ?>
          </select>
        <div class="clear5"></div>

        <label for="address">Education Level</label>
         <select class="form-control" name="education_level" id="education_level" required>
            <option value="">Please Select</option>
            <option value="Graduate School" <?php if(set_value('education_level') == 'Graduate School'){ echo 'selected="selected"'; } ?> >Graduate School</option>
            <option value="Undergraduate School" <?php if(set_value('education_level') == 'Undergraduate School'){ echo 'selected="selected"'; } ?> >Undergraduate School</option>
          </select>
        <div class="clear5"></div>

        <div class="form-group">
          <label for="name">Year in School</label>
          <select class="form-control" name="year_in_school" id="year_in_school" required>
            <option value="">Please Select</option>
            <option value="Freshman" <?php if(set_value('year_in_school') == 'Freshman'){ echo 'selected="selected"'; } ?> >Freshman</option>
            <option value="Sophomore" <?php if(set_value('year_in_school') == 'Sophomore'){ echo 'selected="selected"'; } ?> >Sophomore</option>
            <option value="Junior" <?php if(set_value('year_in_school') == 'Junior'){ echo 'selected="selected"'; } ?> >Junior</option>
            <option value="Senior" <?php if(set_value('year_in_school') == 'Senior'){ echo 'selected="selected"'; } ?> >Senior</option>
            <option value="Masters" <?php if(set_value('year_in_school') == 'Masters'){ echo 'selected="selected"'; } ?> >Masters</option>
            <option value="Doctoral" <?php if(set_value('year_in_school') == 'Doctoral'){ echo 'selected="selected"'; } ?> >Doctoral</option>
          </select>
        </div>
		<div class="clear5"></div>

		<div class="form-group">
          <label for="name">Description</label>
          <textarea type="text" class="form-control" name="description" placeholder="Please describe your plans in 1-2 sentences to inform your Host of the purpose of your stay." rows="4"><?php echo set_value('plans'); ?></textarea>
        </div>
		<div class="clear5"></div>

		<div class="clear10"></div>
        <!-- <div class="form-group col-sm-12">
        <p style="color:#000;">I agree to The Bindel’s <span style="color:red;">Terms of Service</span>, <span style="color:red;">Privacy Policy</span>, <span style="color:red;">Refund Policy</span>, and <span style="color:red;">Guarantee Terms</span>.</p>
        </div> -->


     </div>
        <div class="col-sm-6">
			<table class="request_table" width="100%">
				<thead>
					<tr>
						<td>Month</td>
						<td>Cost</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Deposit (returned at end of stay*)</td>
						<td>$<?php echo number_format($deposit); ?></td>
					</tr>

					<?php $total = 0;
                $i = 0;
           foreach ($months_rent as $key => $value) {  $total+=$value; ?>
						<?php if($i == 0){ ?>
              <tr>
                <td><?php echo $key; ?> Month’s Rent (<span style="color:red;">pro-rated</span>)</td>
                <td>$<?php echo $value; ?></td>
             </tr>
            <?php }elseif(count($months_rent) == $i+1){  ?>
              <tr>
                <td><?php echo $key; ?> Month’s Rent (<span style="color:red;">pro-rated</span>)</td>
                <td>$<?php echo $value; ?></td>
             </tr>
            <?php  }else{ ?>
              <tr>
                <td><?php echo $key; ?> Month’s Rent</td>
                <td>$<?php echo number_format($value); ?></td>
             </tr>
            <?php  } ?>
            
					<?php $i++; } ?>

					<tr>
						<td><span class="bg_yellow">Payment Due Today (Deposit + First Month’s Rent)</span></td>
						<td><span class="bg_yellow">$<?php echo number_format($deposit + $months_rent['1st']); ?></span></td>
					</tr>
					
					<tr>
						<td><span class="bg_yellow">Total Amount Owedby End of Stay</span></td>
						<td><span class="bg_yellow">$<?php echo $total; ?></span></td>
					</tr>
				
				</tbody>
			</table>
      <div class="clear5"></div>
			<p> * Except for the month’s rent and deposit, payment will not be collected until the first day of each month. </p>
		</div>
    <input type="hidden" name="total_months" value="<?php echo count($months_rent);  ?>">
    <input type="hidden" name="total_amount" value="<?php echo $total;  ?>">
    <input type="hidden" name="deposit" value="<?php echo $deposit;  ?>">
    <input type="hidden" name="paid_amount" value="<?php echo $months_rent['1st'];  ?>">
      <div class="clear20"></div>
      <hr class="style7">
	  
	  <div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 pull-right padding0">
      <button class="btn btn-primary" type="submit"> <i class="fa fa-angle-double-right"></i> Next</button>
    </div>
	<div class="clear20"></div>
    <div class="col-sm-12 padding0">
      <!-- <label for="progress">Step 1 of 4</label>
        <progress id="progressbar" value="25" max="100"></progress> -->
    
    <!--- new progress bar -->
    <label for="progress" class="progress_steps">Step 1 of 2</label>
    <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
    </div>
  </div>

<!-- new progress bar end -->
      </div>  
    </form>
  </div>
<div class="clear10"></div>