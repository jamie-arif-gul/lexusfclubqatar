
<div class="container">
    	<a href="<?php echo base_url(); ?>"><img class="img-responsive logo-lg" src="images/logo.png" alt="the bindel" /></a>
        <div class="clear10"></div>
        <div class="search-home">
         <div class="col-md-9 col-sm-12 col-xs-12 search_loader"><img src="images/ajax_loader.gif" height="30"></div>
        	<form id="search">
               
            	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fgroup">
                	<input type="text" name="address" id="autocomplete" class="form-control" placeholder="Where To? Let The Bindel Begin! Ex:  City, State" required>
                </div>
                <div class="hidden-lg hidden-md clear20"></div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fgroup">
                	<input type="text" name="check-in" class="form-control" placeholder="Check In" id="check-in"  >
                </div>
                <div class="hidden-lg hidden-md clear20"></div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fgroup">
                	<input type="text" name="check-out" class="form-control" placeholder="Check Out" id="check-out" >
                </div>
                <div class="hidden-lg hidden-md clear20"></div>
                <input type="hidden" name="city" id="locality">
                <input type="hidden" name="state" id="administrative_area_level_1">
                <input type="hidden" name="country" id="country">
                <input type="hidden" name="gps" id="gps" value="">
            </form>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 fgroup">
                    <button id="search_property" class="btn btn-primary">search</button>
            </div>
        </div>
        <div class="clear20"></div>
        <div class="cdescription">
        <?php
            $site_title = get('settings',array('st_alias' => 'site_title'),'st_content');
            echo $site_title[0]['st_content']; 
        ?>
        </div>
    </div>
    <div class="clear20"></div>