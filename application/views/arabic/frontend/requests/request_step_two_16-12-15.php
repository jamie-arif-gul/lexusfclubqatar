
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
</style> 

  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">Request to Rent</h3>
	<hr class="style7">
  
<form action="<?php echo base_url('requests/request_step_two').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<?php $this->load->view('errors'); ?>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="credit_card">Credit Card</label>
        <input type="text" class="form-control" name="credit_card" placeholder="Enter credit card number" value="<?php echo set_value('credit_card'); ?>" required>
    </div>
    <div class="clear5"></div>
    
    <div class="form-group">
       <div class="col-sm-12 padding0">
        <label for="credit_card">Expiry Date</label>
        </div>
        <div class="col-sm-2" style="padding-left: 0px;">
          <input type="text" class="form-control" name="expiry_month" placeholder="MM" value="<?php echo set_value('expiry_month'); ?>" required>
        </div>
        <div class="col-sm-2" style="padding-left: 0px;">
        <input type="text" class="form-control" name="expiry_year" placeholder="YY" value="<?php echo set_value('expiry_year'); ?>" required>
        </div>
    </div>
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
        <label for="terms_of_service" class="pull-left col-sm-11 col-xs-11">By clicking “Submit” you acknowledge that you agree to TheBindel.com’s Terms of Service and Guest Refund [ <a href="javascript:void(0)" class="policy" data-toggle="tooltip" data-placement="left" title="<b>Comment[BC1]:</b> The User then needs to be Notified via email and the site once their request is accepted"> Policy </a> ].</label>

     </div>

    <div class="col-sm-6">
		
    </div>


      <div class="clear20"></div>
      <hr class="style7">
	  
	  <div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 pull-right padding0">
      <button class="btn btn-primary" type="submit"> <i class="fa fa-angle-double-right"></i> Submit</button>
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
    if(p%1 === 0){
      if(p.length == 10){
         var p1 = p.substring(0, 3);
         var p2 = p.substring(3, 6);
         var p3 = p.substring(6, 10);
         $('#phone_number').val('('+p1+')'+' '+p2+' '+p3);
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
