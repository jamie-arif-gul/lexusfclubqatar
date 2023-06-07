<div class="col-sm-12 p0">
    <div class="container p0 reg_main_mrg">
        <div class="" id="accessories_eng">
            <?php $this->load->view('errors');?>
            <h3>SPARE PARTS & ACCESSORIES QUOTE</h3>
            <p class="accessories_desc">Every part has been engineered specifically for your Lexus and fitted by one of our skilled and trained technicians. You will always pay a competitive price too and with a wide variety of components in stock, those needed for your Lexus will almost certainly be available.
                <br>On top of the parts needed for maintenance work, we also offer a range of quality accessories designed to enhance your Lexus' practicality, styling and comfort.</p>
            <form class="form-horizontal" id="accessories_form" method="post" action="<?php echo base_url('accessories') ?>">
            <p class="form_heading">Please, fill the below fields to register.</p>
            <div class="col-sm-12 p0">
                <label>Personal Information <span> (*Required fields)</span></label>
                <div class="clearfix"></div>
                <div class="col-sm-3 padd_left input_mob_padd">
                    <input type="text" class="form-control" name="name" placeholder="Full Name*" value="<?php echo set_value('name'); ?>" required>
                    <div class="error"><?php echo form_error('name'); ?></div>
                </div>
                <div class="col-sm-3 input_mob_padd">
                    <input type="number" class="form-control" name="phone_number" placeholder="Phone Number*" value="<?php echo set_value('phone_number'); ?>" required>
                    <div class="error"><?php echo form_error('phone_number'); ?></div>
                </div>
                <div class="col-sm-3 input_mob_padd">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" >
                    <div class="error"><?php echo form_error('email'); ?></div>
                </div>

                <div class="clear10"></div>

                <label>Vehicle Details <span> (*Required fields)</span></label>

                <div class="clearfix"></div>

                <div class="col-sm-3 padd_left input_mob_padd">
                    <select id="car_brand" name="model" class="form-control">
                        <option value="">Model*</option>
                        <option value="IS 350 F SPORT" <?php echo set_select('model', 'IS 350 F SPORT'); ?>>IS 350 F SPORT</option>
                        <option value="IS 200t F SPORT" <?php echo set_select('model', 'IS 200t F SPORT'); ?>>IS 200t F SPORT</option>
                        <option value="GS350 F SPORT" <?php echo set_select('model', 'GS350 F SPORT'); ?>>GS350 F SPORT</option>
                        <option value="RC200t F SPORT" <?php echo set_select('model', 'RC200t F SPORT'); ?>>RC200t F SPORT</option>
                        <option value="RC350 F SPORT" <?php echo set_select('model', 'RC350 F SPORT'); ?>>RC350 F SPORT</option>
                        <option value="RC F" <?php echo set_select('model', 'RC F'); ?>>RC F</option>
                        <option value="GS F" <?php echo set_select('model', 'GS F'); ?>>GS F</option>
                        <option value="IS F" <?php echo set_select('model', 'IS F'); ?>>IS F</option>
                        <option value="LFA" <?php echo set_select('model', 'LFA'); ?>>LFA</option>
                        <option value="LC500" <?php echo set_select('model', 'LC500'); ?>>LC500</option>
                        <option value="LC500h" <?php echo set_select('model', 'LC500h'); ?>>LC500h</option>
                    </select>
                    <div class="error"><?php echo form_error('model'); ?></div>
                </div>
                <div class="col-sm-3 input_mob_padd">
                    <input type="text" class="form-control" name="chassis_number" placeholder="Chassis Number*" value="<?php echo set_value('chassis_number'); ?>" required>
                    <div class="error"><?php echo form_error('chassis_number'); ?></div>
                </div>

                <div class="clear10"></div>

                <label>Part Information<span> (*Required fields)</span></label>
                <div class="clearfix"></div>
                <div class="col-sm-6 padd_left input_mob_padd">
                    <textarea class="form-control textarea-contact" rows="5" id="comment" name="part_description" placeholder="Part Description*" required><?php echo set_value('drive_time'); ?></textarea>
                    <div class="error"><?php echo form_error('part_description'); ?></div>
                </div>

                <div class="clear10"></div>

                <div class="col-sm-3 padd_left input_mob_padd">
                    <input type="number" class="form-control" name="part_number" placeholder="Part Number" value="<?php echo set_value('part_number'); ?>">
                </div>

                <div class="clear20"></div>

                <div class="col-sm-3 padd_left input_mob_padd">
                    <button type="submit" class="btn btn-lg btn_submit pull-left">SUBMIT</button>
                </div>

            </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>