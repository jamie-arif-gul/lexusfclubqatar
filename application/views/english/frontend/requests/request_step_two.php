
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
  #map {
        height: 300px;
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
    .billing_address{
      padding: 5px;
      border: 1px solid #d1d1d1;
    }
</style> 

  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">Request to Rent</h3>
	<hr class="style7">
  
<form action="<?php echo base_url('requests/request_step_two').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
    <div class="col-sm-6">
    
    <div class="form-group">
          <label for="type">Card Type</label>
          <select class="form-control" name="card_type" id="type" required>
            <option value="">Please Select</option>
            <option value="American Express" <?php echo set_select('card_type', 'American Express'); ?> >American Express</option>          
            <option value="Discover" <?php echo set_select('card_type', 'Discover'); ?>>Discover</option>
            <option value="Mastercard" <?php echo set_select('card_type', 'Mastercard'); ?>>Mastercard</option>
            <option value="Visa" <?php echo set_select('card_type', 'Visa'); ?>>Visa</option>
          </select>
        </div>
<div class="clear5"></div>

    <div class="form-group">
        <label for="credit_card">Credit Card</label>
        <input type="text" class="form-control" name="credit_card" placeholder="Enter credit card number" value="<?php echo set_value('credit_card'); ?>" required>
    </div>
    <div class="clear5"></div>
    
    <div class="form-group">
       <div class="col-sm-12 padding0">
        <label for="credit_card">Expiration Date</label>
        </div>
        <div class="col-sm-2" style="padding-left: 0px;">
          <input type="text" class="form-control" name="expiry_month" placeholder="MM" value="<?php echo set_value('expiry_month'); ?>" maxlength="2" required>
        </div>
        <div class="col-sm-2" style="padding-left: 0px;">
        <input type="text" class="form-control" name="expiry_year" placeholder="YYYY" value="<?php echo set_value('expiry_year'); ?>" maxlength="4" required>
        </div>
    </div>
    <div class="clear10"></div>
    
    <!-- <div class="form-group">
        <label for="billing_address">Billing Address</label>
        <input type="text" class="form-control" name="billing_address" placeholder="Name on Card, Address, City, State, Zip, Country" value="<?php echo set_value('billing_address'); ?>" required>
    </div> -->
   
    <label for="billing_address">Billing Information</label>
    <div class="billing_address">
      
        <div class="col-sm-6 form-group">
          <label for="card_first_name">Name on Card</label>
          <input type="text" class="form-control" id="card_first_name" placeholder="First" name="card_first_name" value="<?php echo set_value('card_first_name'); ?>" required>
        </div>
        <div class="col-sm-6 form-group">
          <label for="card_last_name">&nbsp;</label>
          <input type="text" class="form-control" id="card_last_name" placeholder="Last" name="card_last_name" value="<?php echo set_value('card_last_name'); ?>" required>
        </div>
        <div class="clear10"></div>

        <div class="col-sm-12 form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo set_value('address'); ?>" required>
        </div>
        <div class="clear10"></div>
        
        <div class="col-sm-6 form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" id="City" placeholder="City" name="city" value="<?php echo set_value('city'); ?>" required>
        </div>

        <div class="col-sm-6 form-group">
          <label for="state">State</label>
          <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo set_value('state'); ?>" required>
        </div>        
        <div class="clear10"></div>

        <div class="col-sm-6 form-group">
          <label for="country">Country</label>
          <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="<?php echo set_value('country'); ?>" required>
        </div>
        
        <div class="col-sm-6 form-group">
          <label for="zip">Zip</label>
          <input type="text" class="form-control" id="zip_code" placeholder="Zip" name="zip_code" value="<?php echo set_value('zip_code'); ?>" required>
        </div>
        <div class="clear10"></div>
    
    </div>
    <div class="clear10"></div>
   
    <div class="clear5"></div>

      <input type="checkbox" id="allow_phone" name="allow_phone" onclick="show_number_field()">
      <label for="allow_phone">I agree to allow the Host to contact me by phone.</label>
    <div class="clear5"></div>
    <div class="form-group" id="phone_number_field" style="display:none;">
        <label for="phone_number">Phone (optional)</label>
        <input type="text" class="form-control" name="phone_number" onblur="phone_format()" value="<?php echo set_value('phone_number'); ?>" id="phone_number">
    </div>
        <div class="clear5"></div>
        <input type="checkbox" class="pull-left" id="terms_of_service" name="terms_of_service" required>
        <!-- <label for="terms_of_service" class="pull-left col-sm-11 col-xs-11">By clicking “Submit” you acknowledge that you agree to TheBindel.com’s Terms of Service and Guest Refund [ <a href="javascript:void(0)" class="policy" data-toggle="tooltip" data-placement="left" title="<b>Comment[BC1]:</b> The User then needs to be Notified via email and the site once their request is accepted"> Policy </a> ].</label> -->
        <label for="terms_of_service" class="pull-left col-sm-11 col-xs-11 padding0">
         &nbsp;By clicking “Purchase” you acknowledge that you agree to TheBindel.com’s <a href="<?php echo base_url('pages/terms-and-conditions'); ?>">Terms and Conditions</a>, <a href="<?php echo base_url('pages/host-guarantee-terms'); ?>">Host Guarantee Terms</a>, <a href="<?php echo base_url('pages/privacy-policy'); ?>">Privacy Policy</a>, <a href="<?php echo base_url('pages/guest-refund-policy'); ?>">Guest Refund Policy</a>, and <a href="<?php echo base_url('pages/other-policies'); ?>">Other Policies</a>
        </label>
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
            <td>Deposit*</td>
            <td>$<?php echo number_format($deposit); ?></td>
          </tr>

          <?php $total = 0;
                $i = 1;
           foreach ($months_rent as $key => $value) {  $total+=$value; 
            if($i == 1){
              $serial = $i.'<span style="font-size:12px;">st</span>';
            }
            elseif($i == 2){
              $serial = $i.'<span style="font-size:12px;">nd</span>';
            }
            elseif($i == 3){
              $serial = $i.'<span style="font-size:12px;">rd</span>';
            }
            else{
              $serial = $i.'<span style="font-size:12px;">th</span>';
            }
            ?>
            <?php if($i == 1){ ?>
              <tr>
                <td><?php echo $serial; ?> Month’s Rent (<span style="color:red;">pro-rated</span>)</td>
                <td>$<?php echo $value; ?></td>
             </tr>
            <?php }elseif(count($months_rent) == $i){  ?>
              <tr>
                <td><?php echo $serial; ?> Month’s Rent (<span style="color:red;">pro-rated</span>)</td>
                <td>$<?php echo $value; ?></td>
             </tr>
            <?php  }else{ ?>
              <tr>
                <td><?php echo $serial; ?> Month’s Rent</td>
                <td>$<?php echo number_format($value); ?></td>
             </tr>
            <?php  } ?>
            
          <?php $i++; } ?>

          <tr>
            <td><span class="bg_yellow">Payment Due Today (Deposit + First Month’s Rent)</span></td>
            <td><span class="bg_yellow">$<?php echo ($deposit + $months_rent['1st']); ?></span></td>
          </tr>
          
          <tr>
            <td><span class="bg_yellow">Total Amount Paid by End of Stay</span></td>
            <td><span class="bg_yellow">$<?php echo $total; ?></span></td>
          </tr>
        
        </tbody>
      </table>
      <div class="clear5"></div>
      <p> * The full deposit will be refunded if no damage is incurred.</p>
      <p> * Only the 1st Month’s Rent and Deposit are due today.  All future payments due will be collected on the first day of each month.</p>
      <p> * If the Host does not accept your Request to Rent, any payment collected will be returned.</p>


    </div>

      <div class="clear20"></div>
      <hr class="style7">
	<div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 padding0">
  <a href="<?php echo base_url('requests/request_step_one').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" class="text-danger back-btn"> <i class="fa fa-angle-double-left"></i> Back</a>
  </div>

	  <div class="pull-right padding0">
      <button class="btn btn-primary" type="submit"> <i class="fa fa-angle-double-right"></i> Purchase</button>
    </div>
	<div class="clear20"></div>
    <div class="col-sm-12 padding0">
      <!-- <label for="progress">Step 1 of 4</label>
        <progress id="progressbar" value="25" max="100"></progress> -->
    
    <!--- new progress bar -->
    <label for="progress" class="progress_steps">Step 2 of 2</label>
    <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    </div>
  </div>

<!-- new progress bar end -->
      </div>
      <input type="hidden" name="total_months" value="<?php echo count($months_rent);  ?>"> 
    </form>
  </div>
<div class="clear10"></div>



 <script type="text/javascript">
 $(function(){
	 $('[data-toggle="tooltip"]').tooltip({
    content: function () {
              return $(this).prop('title');
          }
   });
 })

</script>


<script type="text/javascript">
function phone_format(){
  var p = $('#phone_number').val();
  if(p != ''){
      p = p.replace("(", "");
      p = p.replace(") ", "");
      p = p.replace(" ", "");
      p = p.replace("-", "");
    if(p%1 === 0){
      if(p.length == 10){
         var p1 = p.substring(0, 3);
         var p2 = p.substring(3, 6);
         var p3 = p.substring(6, 10);
         $('#phone_number').val('('+p1+')'+' '+p2+'-'+p3);
      }else{
        alert('phone number length 10.');
      }
    }else{
      alert('phone number must be an integer.');
    }
  }
}

function show_number_field(){
  if ($('#allow_phone').prop('checked')==true){ 
        $('#phone_number_field').show();
  }else{
    $('#phone_number_field').hide();
  }
}
</script>
