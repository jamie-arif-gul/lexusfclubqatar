<section id="main-content">
    <section class="wrapper">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value">
                        <h1 class="count">
                            0                            
                        </h1>
                        <p>Total Users</p>
                    </div>
                </section>   
            </div>
<!--            <div class="col-lg-3 col-sm-6">-->
<!--                <section class="panel">-->
<!--                    <div class="symbol red">-->
<!--                        <i class="fa fa-male"></i>-->
<!--                    </div>-->
<!--                    <div class="value">-->
<!--                        <h1 class=" count2">-->
<!--                            0-->
<!--                        </h1>-->
<!--                        <p>Male</p>-->
<!--                    </div>-->
<!--                </section>   -->
<!--            </div>-->
<!--            <div class="col-lg-3 col-sm-6">-->
<!--                <section class="panel">-->
<!--                    <div class="symbol yellow">-->
<!--                        <i class="fa fa-female"></i>-->
<!--                    </div>-->
<!--                    <div class="value">-->
<!--                        <h1 class=" count3">-->
<!--                            0-->
<!--                        </h1>-->
<!--                        <p>Female</p>-->
<!--                    </div>-->
<!--                </section> -->
<!--            </div>-->
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4">
                            0
                        </h1>
                        <p>Active accounts</p>
                    </div>
                </section>  
            </div>
        </div>
        <!--state overview end-->

        <div class="row">
            <div class="col-lg-12">
                <div class="border-head col-lg-12">
                    <h3>User Graph</h3>
                </div>
                <span>
                    <?php
                    if (isset($errors)) {
                        echo '<div class="clearfix">&nbsp;</div>';
                        echo '<div class="alert alert-danger alert-dismissable">';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        print_r($errors);
                        echo'</div>';
                        echo '<div class="clearfix">&nbsp;</div>';
                    }
                    ?>
                </span>
                <div class="col-lg-12">
                    <div class="col-lg-4 pull-left"></div>
                    <div class="col-lg-8 pull-right">
                        <form method="post" action="<?php base_url('administrator/dashboard'); ?>">
                            <input class="form-control filter pull-right" style="display: inline-block; width: 240px;" type="submit" value="Filter"/>
                            <input class="form-control filter pull-right" style="display: inline-block; width: 240px;" type="text" name="year" id="year" value="<?php echo $year; ?>"/>
                        </form>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div id="my_chart" class="col-lg-12" style="width: 100%; height: 400px; margin: 0 auto;"></div>
            </div>
        </div>
    </section> 
</section>
<?php //echo "<pre>"; print_r($users_by_date); ?>
<script>
    $(document).ready(function(){
        $('#year').datepicker({
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            onClose: function (dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, 1));
            }
        });
        $("#year").focus(function () {
            $(".ui-datepicker-month").hide();
        });
    });

$(function() {
    $('#year').datepicker({
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        onClose: function(dateText, inst) {
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
        }
    });
	$("#year").focus(function () {
            $(".ui-datepicker-month").hide();
    });
});

    $(function () {
        $('#my_chart').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Club Qatar.com User Statistics'
            },
            subtitle: {
                text: 'Monthly statistics of registered users'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'User Count'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Total Users',
                    data: [<?php echo $users_by_date; ?>]

                }]
        });
    });
    $(window).load(function(){
        $('text[y="395"]').html('');
    });
</script>
<style>
    .ui-datepicker-calendar { display: none; }
</style>