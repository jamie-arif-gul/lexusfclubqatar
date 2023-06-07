<div class="container">
  <div class="clear10"></div>
  <div class="graybox" <?php echo ($this->uri->segment(2) == 'about-us')? 'style="margin-bottom:5%;"' :''; ?> >
    <h1 class="section-heading"><?php echo $page_data[0]['page_title'];?></h1>
    <?php echo $page_data[0]['content'];?>
  </div>


<?php if($this->uri->segment(2) == 'about-us'){ ?>
<div class="col-sm-12 padding0"> 
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
  <div class="clear50"></div>
<?php } ?>
</div>