<div class="col-sm-12 p0 gallery_main">
    <div class="container p0 reg_main_mrg">
        <h3>GALLERY</h3>
        <div class="popup-gallery" id="gallery_english">
            <?php  $count = 0; for($i = 1; $i <= ceil(sizeof($result)/11); $i++){ ?>
                <div class="clear10"></div>
            <div class="col-sm-6 gallery_padd_right">
                <div class="col-sm-12 p0">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 0){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_552' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
                <div class="clear10"></div>
                <div class="col-sm-6 gallery_small">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 1){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
                <div class="col-sm-6 gallery_small_right">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 2){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
            </div>
            <div class="col-sm-6 gallery_padd_left">
                <div class="col-sm-6 gallery_small">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 3){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
                <div class="col-sm-6 gallery_small_right">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 4){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>

                <div class="clear10 display_none"></div>

                <div class="col-sm-12 p0">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 5){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_552' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
            </div>

            <div class="clear10"></div>

            <div class="col-sm-3 gallery_bottom_left">
                <div class="col-sm-12 p0">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 6){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>

                <div class="clear10"></div>

                <div class="col-sm-12 p0">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 7){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
            </div>
            <div class="col-sm-6 gallery_bottom_main">
                <div class="col-sm-12 p0">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 8){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_552' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
            </div>
            <div class="col-sm-3 gallery_bottom_right">
                <div class="col-sm-12 p0">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 9){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>

                <div class="clear10"></div>

                <div class="col-sm-12 p0">
                    <?php if(isset($result[$count]["frange_image"]) && $count%11 == 10){
                        echo "<a href='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."' title='".$result[$count]["title"]."' alt='".$result[$count]["description"]."'>
                        <img class='wd_266' src='".base_url('uploads')."/frange_image/".$result[$count]["frange_image"]."'>
                        </a>"; $count++;
                    }?>
                </div>
            </div>

            <div class="clearfix"></div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + "<small>"+item.el.attr('alt')+"</small>";
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.image-link').magnificPopup({type:'image'});
    });
</script>