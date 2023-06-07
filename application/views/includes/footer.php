      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              &COPY; All Rights Reserved
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
     </section>   

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url().'resources/admin'; ?>/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url().'resources/admin'; ?>/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url().'resources/admin'; ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url().'resources/admin'; ?>/js/respond.min.js" ></script>

    
    <!--custom switch-->
  <script src="<?php echo base_url().'resources/admin'; ?>/js/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="<?php echo base_url().'resources/admin'; ?>/js/jquery.tagsinput.js"></script>
  <!--custom checkbox & radio-->
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/js/ga.js"></script>
  
  <!-- form validation script file -->
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/js/form-validation-script.js"></script>
    
  
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?php //echo ASSETS_URL.'resources/admin'; ?>/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url().'resources/admin'; ?>/js/form-component.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/data-tables/DT_bootstrap.js"></script>
    <!--common script for all pages-->
    <script src="<?php echo base_url().'resources/admin'; ?>/js/common-scripts.js"></script>
    
    <script src="<?php echo base_url().'resources/admin/assets/nestable'; ?>/jquery.nestable.js"></script>
    <script src="<?php echo base_url().'resources/admin'; ?>/js/nestable.js"></script>
    
    <!-- JS file for multi selection -->
    <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'resources/admin'; ?>/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    
    
    
        <!-- Date picker Js -->
            <script>
            //date picker start

    if (top.location != location) {
        top.location.href = document.location.href ;
    }
    $(function(){
        window.prettyPrint && prettyPrint();
        $('.default-date-picker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.dpYears').datepicker();
        $('.dpMonths').datepicker();


        var startDate = new Date(2012,1,20);
        var endDate = new Date(2012,1,25);
        $('.dp4').datepicker()
            .on('changeDate', function(ev){
                if (ev.date.valueOf() > endDate.valueOf()){
                    $('.alert').show().find('strong').text('The start date can not be greater then the end date');
                } else {
                    $('.alert').hide();
                    startDate = new Date(ev.date);
                    $('#startDate').text($('.dp4').data('date'));
                }
                $('.dp4').datepicker('hide');
            });
        $('.dp5').datepicker()
            .on('changeDate', function(ev){
                if (ev.date.valueOf() < startDate.valueOf()){
                    $('.alert').show().find('strong').text('The end date can not be less then the start date');
                } else {
                    $('.alert').hide();
                    endDate = new Date(ev.date);
                    $('.endDate').text($('.dp5').data('date'));
                }
                $('.dp5').datepicker('hide');
            });

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('.dpd1').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('.dpd2')[0].focus();
            }).data('datepicker');
        var checkout = $('.dpd2').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
                checkout.hide();
            }).data('datepicker');
    });

//date picker end
            </script>    
            
 <script type="text/javascript">
  $('#dob').datetimepicker({
    timepicker:false,
    format:'d/m/Y',
    formatDate:'Y/m/d',
    maxDate:'+1965/01/01',
    defaultDate:'+1965/01/01',
  });
  </script>           
<!--------------------------------------------------------------------------------------->            
<!--JS for the chart only include for dashboard -->
<script src="<?php echo base_url().'resources/admin'; ?>/js/sparkline-chart.js"></script>
<script src="<?php echo base_url().'resources/admin'; ?>/js/easy-pie-chart.js"></script>
<script src="<?php echo base_url().'resources/admin'; ?>/js/count_user.js.php"></script>

<!-- JS FOR HICHARTS - USER STATISTICS -->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<!-- END HERE HICHARTS - USER STATISTICS -->
<script>

    //owl carousel

    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: true

        });
    });

    //custom select box

    $(function() {
        $('select.styled').customSelect();
    });

</script>

<script>
        function get_male(){
           return <?php echo $male ;?>;
        }
        function get_female(){
            
			 return <?php echo $female; ?>
        }
        function all_user(){
            return <?php echo $all_user[0]['total'] ;?>            
        }
        function active_account(){
            return <?php echo $active_account ;?>
        }
        
</script>
<!-------------------------------------------------------------------------------------->
      <!-- Include external JS libs. -->
<!--      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<!--      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>-->
<!--      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>-->

      <!-- Include Editor JS files. -->
<!--      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/js/froala_editor.pkgd.min.js"></script>-->

      <!-- Initialize the editor. -->
<!--      <script> $(function() { $('textarea').froalaEditor() }); </script>-->

      <script type="text/javascript" src="resources/admin/simditor/site/assets/scripts/jquery.min.js"></script>
      <script type="text/javascript" src="resources/admin/simditor/site/assets/scripts/module.js"></script>
      <script type="text/javascript" src="resources/admin/simditor/site/assets/scripts/hotkeys.js"></script>
      <script type="text/javascript" src="resources/admin/simditor/site/assets/scripts/uploader.js"></script>
      <script type="text/javascript" src="resources/admin/simditor/site/assets/scripts/simditor.js"></script>
      <script>
          var editor = new Simditor({
              textarea: $('#description_en')
              //optional options
          });
          var editor = new Simditor({
              textarea: $('#description_ar')
              //optional options
          });
      </script>
      </body>
</html>
