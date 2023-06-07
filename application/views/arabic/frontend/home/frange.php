<div class="clearfix"></div>
<div class="container p0 reg_main_mrg">
    <div class="col-sm-12 p0 range_content">
    <h3><img src="<?php echo base_url().'uploads/frange_c_image/'.$result_c[0]['frange_c_image'] ;?>"> <?php echo $result_c[0]['title'];?></h3>
        <?php echo $result_c[0]['description'];?>
    	
    </div>
</div>

<div class="container-fluid p0 category_cars range_cars" id="range_cars">
    <?php $o=0;?>
     <?php foreach($result as $value){?>
     <?php  if ($o % 2 == 0) {?>
        
    <div class="col-sm-6 p0"><img src="<?php echo base_url().'uploads/frange_image/'.$value['frange_image'] ;?>"></div>
    <div class="col-sm-6 p0">
        <div class="category_content_arabic">
            <h2>  <?php echo  $value['title'] ;?></h2>
            <p> <?php echo  $value['description'] ;?></p>
        </div>
    </div>
    <div class="clearfix"></div>
     <?php  }else {?>
    <div class="display_flex">
        <div class="col-sm-6 p0">
            <div class="category_content_arabic">
               <h2>  <?php echo  $value['title'] ;?></h2>
            <p> <?php echo  $value['description'] ;?></p>
            </div>
        </div>
        <div class="col-sm-6 p0"><img src="<?php echo base_url().'uploads/frange_image/'.$value['frange_image'] ;?>"></div>
    </div>
    <div class="clearfix"></div>
     <?php } ?>
     <?php $o++; ?>
     <?php } ?>
   
  <div class="pull-right">
         <?php echo $pagination; ?>
    </div>


</div>

 

