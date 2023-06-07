<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>

  <div class="dashboardbox container">
  <h3 class="dashboard-heading text-left">Edit Your Space</h3>
	<hr class="style7">
  <?php $this->load->view('errors'); ?>
    <div class="col-sm-12 loginbox">
      <h4 class="section-heading" style="text-align:left;"> <i class="fa fa-code-fork"></i> Stereotype Your Neighborhood</h4>
      <br>
      <form id="createPropertyThree" action="<?php echo base_url('properties/editPropertyStepThree').'/'.$uri.'/'.encode_url($property_data[0]['property_id']); ?>" method="post">
        <div class="form-group col-sm-6">
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
          
          <input type="checkbox" id="hippies" name="stereotype[]" value="Hippies" <?php if($stereotype && in_array("Hippies", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="hippies">Hippies</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="smfolk" name="stereotype[]" value="Small Town Folk" <?php if($stereotype && in_array("Small Town Folk", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="smfolk">Small Town Folk</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="metropolis" name="stereotype[]" value="Metropolis" <?php if($stereotype && in_array("Metropolis", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="metropolis">Metropolis</label>
          <div class="clear20"></div>
          </div>
          
          <div class="form-group col-sm-6">          
          <input type="checkbox" id="parks" name="stereotype[]" value="Parks and Rec" <?php if($stereotype && in_array("Parks and Rec", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="parks">Parks and Rec</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="suburbia" name="stereotype[]" value="Suburbia" <?php if($stereotype && in_array("Suburbia", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="suburbia">Suburbia</label>
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>
          <div class="clear20"></div>
          
          <input type="checkbox" id="vibes" name="stereotype[]" value="Main Street Vibes" <?php if($stereotype && in_array("Main Street Vibes", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="vibes">Main Street Vibes</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="gnarley" name="stereotype[]" value="Gnarley Waves" <?php if($stereotype && in_array("Gnarley Waves", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="gnarley">Gnarley Waves</label>
          <div class="clear20"></div>
          
          <input type="checkbox" id="bro" name="stereotype[]" value="Bro" <?php if($stereotype && in_array("Bro", $stereotype)){ echo 'checked="checked"'; } ?>>
          <label for="bro">Bro</label>
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Information goes here"></i>
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
      <div class="col-sm-8">
      <label for="progress">50% Completed</label>
      	<progress id="progressbar" value="50" max="100"></progress>
      </div>
      <div class="col-sm-2 col-lg-1 col-md-2 col-xs-4 pull-right padding0">
      <button class="btn btn-primary" type="submit"> <i class="fa fa-angle-double-right"></i> Next</button>
      </form>
      <div class="clear10"></div>
      <a class="btn btn-danger" href="<?php echo base_url('properties/editPropertyStepFour').'/'.$uri.'/'.encode_url($property_data[0]['property_id']); ?>"> <i class="fa fa-stop"></i> Skip</a>
    </div>
  </div>