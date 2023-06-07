<div class="col-sm-12 p0">
    <div class="container p0 reg_main_mrg">
        <div class="col-sm-12 " id="accessories_form_arabic">
            <?php $this->load->view('errors');?>
            <h3 class="arabic_h3 font_gess_light" id="">قطع الغيار والإكسسوارات</h3>
            <p class="access_para_arabic" id="">
                سيتم تصميم كل جزء خصيصًا لسيارة لكزس الخاصة بك ومزودًا بواحد من الفنيين المدربين من قِبل الشركة المصنعة . ستدفع دائمًا سعر تنافسي مع وجود مجموعة متنوعة من المكونات في المخزن ، كل ما تحتاجه سيارتك من لكزس سيكون متاحاً بالتأكيد. إضافة إلى الأجزاء المطلوبة لأعمال الصيانة ، نبيع أيضًا مجموعة من الإكسسوارات ذات الجودة العالية المصممة لتبرز التصميم العصري والمريح في لكزس.
            </p>

            <div class="clearfix"></div>

            <p class="form_heading_arabic">: دوّن المعلومات التالية</p>
            <form  class="form-horizontal" id="accessories_form" method="post" action="<?php echo base_url('accessories') ?>" dir="rtl">
                <!--    <form class="form-horizontal" id="registration">-->
                <div class="col-sm-12 p0 font_gess_light">
                    <label style="font-family: 'gesslight' !important; ">المعلومات الشخصية <span style="font-family: 'gesslight' !important; ">&nbsp;(*البيانات الإلزامية)</span></label>
                    <div class="clearfix"></div>
                    <div class="col-sm-3"></div>
                    <div class="flex_display">
                        <div class="col-sm-3 arabic_form_control arabic_input_mob" style="font-family: 'gesslight' !important; ">
                            <input type="email" class="form-control" name="email" placeholder="البريد الإلكتروني"value="<?php echo set_value('email'); ?>">
                            <div class="error_arabic"><?php echo form_error('email'); ?></div>
                        </div>
                        <div class="col-sm-3 arabic_input_mob">
                            <input type="number" class="form-control" name="phone_number" value="<?php echo set_value('phone_number'); ?>"  placeholder="رقم الهاتف*">
                            <div class="error_arabic"><?php echo form_error('phone_number'); ?></div>
                        </div>
                        <div class="col-sm-3 arabic_input_mob">
                            <input type="text" class="form-control" name="name" placeholder="الاسم*"value="<?php echo set_value('name'); ?>" >
                            <div class="error_arabic"><?php echo form_error('name'); ?></div>
                        </div>
                        <!--        <p>-->
                        <!--</p>-->
                    </div>

                    <div class="clear10"></div>

                    <label>تسجيل الدخول <span style="font-family: 'gesslight' !important; "> &nbsp;(*البيانات الإلزامية)</span></label>

                    <div class="clearfix"></div>
                    <div class="flex_display">

                        <div class="col-sm-6"></div>
                        <div class="col-sm-3 input_mob_padd">
                            <input type="text" class="form-control" name="chassis_number"  placeholder="رقم الشاسيه"
                                     value="<?php echo set_value('chassis_number'); ?>" >
                            <div class="error_arabic"><?php echo form_error('chassis_number'); ?></div>
                        </div>
                        <div class="col-sm-3 input_mob_padd">
                            <select name="model" class="form-control select_arabic">
                                <option value="">الموديل*</option>
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
                            <div class="error_arabic"><?php echo form_error('model'); ?></div>
                        </div>
                    </div>
                    <div class="clear10"></div>



                    <label>مقاس التيشرت <span style="font-family: 'gesslight' !important; "> &nbsp;(إختر مقاس التيشرت المجانية)</span></label>
                    <div class="clearfix"></div>

                    <div class="col-sm-6 "></div>
                    <div class="col-sm-6 arabic_input_mob">
                        <textarea class="form-control textarea-contact" rows="5" id="comment" name="part_description" placeholder="رقم القطعة" ><?php echo set_value('drive_time'); ?></textarea>
                        <div class="error_arabic"><?php echo form_error('part_description'); ?></div>
                    </div>
                    <div class="clear10"></div>
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3 arabic_input_mob">
                        <input type="number" class="form-control" name="part_number" value="<?php echo set_value('part_number'); ?>" placeholder="وصف القطعة">
                        <div class="error_arabic"></div>
                    </div>

                    <div class="clear20"></div>

                    <div class="col-sm-9"></div>
                    <div class="col-sm-3 input_mob_padd btn_arabic">
                        <button type="submit" class="btn btn-lg btn_submit" style="font-family: 'gesslight' !important; ">ارسل</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>