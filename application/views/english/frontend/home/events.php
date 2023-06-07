<div class="col-sm-12 p0">
    <div class="container p0 reg_main_mrg">
        <h3 class="events_heading">UP COMING EVENTS</h3>
        <div class="registration_bg" id="events_main">
            <?php foreach($result as $key => $value){    ?>
                <div class="col-sm-12 p0 news_detail">
                    <div class="col-sm-2 events_padd_left event_goal">
                        <img src="<?php echo base_url().'uploads/event_image/'.$value['event_image'] ?>">
                    </div>
                    <div class="col-sm-8 event_mob_padd name_of_event">
                        <h3><?php echo $value['name']; ?></h3>
                        <p><?php echo $value['description']; ?></p>
                    </div>
                    <div class="col-sm-2 events_padd_right authorize_english">
                        <h3 style="margin-bottom: 0px;"><?php echo strtoupper(date('d F Y', strtotime($value['event_date']))); ?></h3>
                        <span><?php echo $value['event_time']; ?></span>
                        <div class="clearfix"></div>
                        <span><?php echo $value['location']; ?></span>
                        <div class="clearfix"></div>
                            <span>
                                <div class="form-group">
                                    <div class="checkbox checbox-switch">
                                        <label >
                                            Going &nbsp; &nbsp;
                                            Yes
                                            <input id="going_<?php echo $value['id'] ?>" type="checkbox" name="going_<?php echo $value['id'] ?>" onclick="goingStatus('<?php echo $value['id']; ?>');" <?php if(!in_array($value['id'], $join_status)) echo "checked" ?> />
                                            <span></span>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </span>
                    </div>
                </div>
            <?php } ?>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script>
   function goingStatus(event_id){
       $.ajax({
           type: "POST",
           url:'<?php echo $this->config->base_url(); ?>site/home_controller/eventStatus',
           data: {event_id: event_id},
//           cache: false,
           success: function(html) {
//               alert(html);
               return true;
           }
       });

   }
</script>