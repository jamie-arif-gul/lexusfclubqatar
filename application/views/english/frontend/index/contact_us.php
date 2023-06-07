

<div class="container">

<div class="clear10"></div>
  <div class="box-main" style="margin-bottom:5%;">
    <h3 class="section-heading"> <i class="fa fa-comment-o"></i> Contact Us </h3>
    <div class="clear20"></div>
   <span>
                            <?php
                            if (isset($success)) {
                                echo '<div class="alert alert-success alert-dismissable"> ';
                                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                print_r($success);
                                echo'</div>';
                            }
                            ?>
                        </span>
                        <span>
                            <?php
                            if (isset($errors)) {
                                echo '<div class="alert alert-danger alert-dismissable">';
                                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                print_r($errors);
                                echo'</div>';
                            }
                            ?>
                        </span>

       <form id="contact_us" action="<?php echo base_url('contact_us'); ?>" method="post" accept-charset="utf-8">
      <div class="form-group loginbox col-sm-6">
	  <div class="col-sm-6">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="" placeholder="First">
		</div>
       <div class="col-sm-6">
        <label for="name">&nbsp;</label>
        <input type="text" class="form-control" name="lasr_name" id="last_name" value="" placeholder="Last">
		</div>
		<div class="clear10"></div>
        <div class="col-sm-12">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" value="">
		</div>
		<div class="clear10"></div>
		<div class="col-sm-12">
        <label for="phone">Phone Number</label>
        <input type="text" class="form-control" name="phone" id="phone" value="" placeholder="Optional">
		</div>
      </div>
      <div class="form-group loginbox col-sm-6">
        <label for="message">Leave Us A Message</label>
        <textarea class="form-control" name="message" id="message"></textarea>
		<button type="submit" class="btn btn-danger">Send</button>
      </div>
      
    </form>
  </div>
  <p style="font-size:18px;">Call Us Toll Free at: <strong>(800) 973-0554</strong></p>
<!--   <div class="col-sm-12 padding0"> 
    <div class="col-sm-6 padding0"> 
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  padding0">
            <div style="display:flex;" class="list padding0">
              <div class="col-sm-5 col-xs-12 padding0">
              <img height="150" alt="" class="list-thumb-search" src="images/rebecca_murday.png">
              </div>
              <div class="col-sm-7 col-xs-12">
                <div class="clear10"></div>
                 <p class="list-title-search">Rebecca Murday</p>
                 <p class="list-title-search">Founder TheBindel.com</p>
                 <p class="list-title-search">Harvard Law School</p>
                 <p class="list-title-search">Teach For America</p>
                 <p class="list-title-search">Loyola Marymount University</p>
                 <p class="list-title-search">University of Southern California</p>            
              </div>
            </div>
      </div>
    </div>
    
    <div class="col-sm-6"> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  padding0">
            <div style="display:flex;" class="list padding0">
              <div class="col-sm-5 col-xs-12 padding0">
              <img height="150" alt="" class="list-thumb-search" src="images/brett_cofman.png">
              </div>
              <div class="col-sm-7 col-xs-12"> 
                <div class="clear10"></div>
                 <p class="list-title-search">Brett Cofman</p>
                 <p class="list-title-search">Founder TheBindel.com</p>
                 <p class="list-title-search">Washington University Law in St. Louis</p>
                 <p class="list-title-search">Olin Business School at Washington University in St. Louis </p>
                 <p class="list-title-search">Indiana University </p>
                
                </div>
            </div>
      </div>
    </div>

  </div>
  <div class="clear50"></div> -->
</div>
