<style>
.dashboard-heading{
		  color:#5cb85c;
	  }
	  .progress_steps{
		  z-index:1;
	  }
	  .btn-primary{
		  font-size:13px !important;
	  }
</style>
  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">List Your Space</h3>
	<hr class="style7">
  <?php $this->load->view('errors'); ?>
    <div class="col-sm-12 loginbox">
      <h4 class="section-heading" style="text-align:left;"> <!-- <i class="fa fa-code-fork"></i> --> Stereotype Your Neighborhood</h4>
      <br>
      <form id="createPropertyThree" action="<?php echo base_url('properties/createPropertyStepThree').'/'.encode_url($property_data[0]['property_id']); ?>" method="post">
        <div class="form-group col-sm-4">
          <input type="checkbox" id="hipster" name="stereotype[]" value="Hipster/Artsy" <?php if($stereotype && in_array("Hipster/Artsy", $stereotype)){ echo 'checked="checked"'; } ?> >
          <label for="hipster">Hipster/Artsy</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="foodie" name="stereotype[]" value="Foodie Haven" <?php if($stereotype && in_array("Foodie Haven", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="foodie">Foodie Haven</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="launchpad" name="stereotype[]" value="Night Out Launch Pad" <?php if($stereotype && in_array("Night Out Launch Pad", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="launchpad">Night Out Launch Pad</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="downtown" name="stereotype[]" value="Downtown" <?php if($stereotype && in_array("Downtown", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="downtown">Downtown</label>
          <div class="clear20"></div>
          <!-- -->
          
          <input type="checkbox" id="yuppies" name="stereotype[]" value="Yuppies!" <?php if($stereotype && in_array("Yuppies!", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="yuppies">Yuppies!</label>
          <div class="clear20"></div>
          </div>
          
          <div class="form-group col-sm-4">
		<input type="checkbox" id="hippies" name="stereotype[]" value="Hippies" <?php if($stereotype && in_array("Hippies", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="hippies">Hippies</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="smfolk" name="stereotype[]" value="Small Town Folk" <?php if($stereotype && in_array("Small Town Folk", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="smfolk">Small Town Folk</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="metropolis" name="stereotype[]" value="Metropolis" <?php if($stereotype && in_array("Metropolis", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="metropolis">Metropolis</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="parks" name="stereotype[]" value="Parks and Rec" <?php if($stereotype && in_array("Parks and Rec", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="parks">Parks and Rec</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="suburbia" name="stereotype[]" value="Suburbia" <?php if($stereotype && in_array("Suburbia", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="suburbia">Suburbia</label>
          <!--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>-->
          <div class="clear20"></div>          
        </div>
		
		<div class="form-group col-sm-4">
		<input type="checkbox" id="vibes" name="stereotype[]" value="Main Street Vibes" <?php if($stereotype && in_array("Main Street Vibes", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="vibes">Main Street Vibes</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="gnarley" name="stereotype[]" value="Gnarley Waves" <?php if($stereotype && in_array("Gnarley Waves", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="gnarley">Gnarley Waves</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="bro" name="stereotype[]" value="Bro" <?php if($stereotype && in_array("Bro", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="bro">Bro</label>
          <!--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>-->
          <div class="clear20"></div>
          
          <input type="checkbox" id="mountain" name="stereotype[]" value="Mountain Vistas" <?php if($stereotype && in_array("Mountain Vistas", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="mountain">Mountain Vistas</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="gayborhood" name="stereotype[]" value="Gayborhood" <?php if($stereotype && in_array("Gayborhood", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="gayborhood">Gayborhood</label>
          <div class="clear20"></div>
		</div>
        <!-- <button type="submit" class="btn btn-danger">Register</button>-->
      
    </div>
     <div class="clear20"></div>
      <hr class="style7">
	  <div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 pull-right padding0">
      <button class="btn btn-primary" type="submit"> <i class="fa fa-angle-double-right"></i> Next</button>
      </form>
      <div class="clear10"></div>
      <a class="text-danger" href="<?php echo base_url('properties/createPropertyStepFour').'/'.encode_url($property_data[0]['property_id']); ?>">Skip</a>
      <div class="clear5"></div>
    </div>
	<div class="col-sm-2 col-lg-1 col-md-1 col-xs-4 padding0">
	<a href="<?php echo base_url('properties/createPropertyStepTow').'/'.encode_url($property_data[0]['property_id']); ?>" class="text-danger back-btn"> <i class="fa fa-angle-double-left"></i> Back</a>
	</div>
	<div class="clear20"></div>
      <div class="col-sm-12 padding0">
	  
      <label for="progress" class="progress_steps">Step 3 of 4</label>
      <div class="progress col-sm-12 padding0 pull-right col-xs-12">
	  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
	  </div>
	</div>
      </div>
      
  </div>