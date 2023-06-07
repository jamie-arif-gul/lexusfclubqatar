<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<style type="text/css">
.list-desc-main {
    font-size: 20px;
    font-weight: bold;
}
.graybox {
    background: #f5f5f5 none repeat scroll 0 0;
    float: left;
    width: 90%;
}
.clear10 {
    clear: both;
    height: 10px;
}

.request_table thead tr td {
  background: none repeat scroll 0 0 #214472;
  color: white;
  font-weight: bold;
  padding: 10px;
}
.request_table tbody tr td {
  padding: 10px;
  border-bottom:1px solid #ccc;
}
label{
  font-size:12px;
  font-weight:normal;
}

</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Request Detail
            </header>
            <?php if (isset($success)) {?>
        <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php print_r($success); ?>
        </div>
    <?php } ?>
    <?php if (isset($errors)) { ?>
        <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php print_r($errors); ?>
        </div>
    <?php } ?>
<div class="container">
  <div class="clear10"></div>
  <?php if($results){ $result = $results[0]; ?>

<div class="col-sm-12 col-xs-12 list-details2" id="listings">
          <div class="clear10"></div>
          <div class="col-sm-6 col-xs-12">
            <p class="list-desc-main">Dates Available: <?php echo date('m/d/y',$result['date_from']); ?>&nbsp;-&nbsp;<?php echo date('m/d/y',$result['date_to']); ?></p>
            <p class="list-desc-main" style="color:red;">Dates Guest Requested: <?php echo date('m/d/y',$result['check_in_date']); ?>&nbsp;-&nbsp;<?php echo date('m/d/y',$result['check_out_date']); ?></p>
            <div class="clear10"></div>
            <h4><strong>Property Name:&nbsp;</strong><?php echo $result['name']; ?></h4>
            <hr />
            <h4><strong>Sender Name:&nbsp;</strong><?php echo $result['sender_name']; ?></h4>
            <hr />
            <h4><strong>Receiver Name:&nbsp;</strong><?php echo $result['receiver_name']; ?></h4>
            <hr />
            <h4><strong>Requested On:&nbsp;</strong><?php echo date('m-d-Y', strtotime($result['created'])).' | '.date('h:i A', strtotime($result['created'])).' EST'; ?></h4>
            <hr />
            <h4><strong>Acceted On:&nbsp;</strong><?php echo (strtotime($result['modified']) > 0)? date('m-d-Y', strtotime($result['modified'])).' | '.date('h:i A', strtotime($result['modified'])).' EST' : '--------'; ?></h4>
            <hr />
            <h4><strong>Canceled On:&nbsp;</strong><?php echo (strtotime($result['cancel_on']) > 0)? date('m-d-Y', strtotime($result['cancel_on'])).' | '.date('h:i A', strtotime($result['cancel_on'])).' EST' : '--------'; ?></h4>
            <hr />
            <div class="clear10"></div>
          </div>
          <div class="col-sm-5 col-xs-12 padding0">
            <div class="graybox" style="padding:20px; margin-bottom:0;">
              <h5><strong>Number of Guests:&nbsp;</strong><?php echo $result['number_of_guests']; ?></h5>
              <hr />
              <h5><strong>Education Level:&nbsp;</strong><?php echo $result['education_level']; ?></h5>
              <hr />
              <h5><strong>Year in School:&nbsp;</strong><?php echo $result['year_in_school']; ?></h5>
              <hr />
              <h5><strong>Guest’s Purpose of Stay:&nbsp;</strong>
                <div class="clear10"></div>
                <p><?php echo ($result['description'] != "")? $result['description'] : '<div class="alert alert-danger">Purpose of stay not provided.</div>'; ?></p>
              </h5>
              <hr />
              <h5><strong>Phone:&nbsp;</strong><?php if($result['request_status'] == 1){ echo ($result['phone_number'] != "")? $result['phone_number'] : 'Not available';}else{ echo '***********'; } ?></h5>

            </div>
          </div>
          <div class="clear10"></div>
          <h4><strong>Payments:&nbsp;</strong></h4>
          <hr />
          <div class="col-sm-12 col-xs-12">
          <?php $payments = $this->comman_model->get('request_payments',array('request_id' => $result['request_id'])); ?>

<div class="col-sm-12 col-xs-12 graybox" style="margin-bottom:0; padding:0;">
            <table class="request_table" width="100%">
              <thead>
                <tr>
                  <td>Amount</td>
                  <td class="text-center">Due Date</td>
                  <td>Status</td>
                  <!-- <td>Paid On</td>
                  <td>Teansection Id</td> -->
                </tr>
              </thead>
              <tbody>
               <?php foreach ($payments as $payment){ ?>
                <tr>
                  <td><button 
                                    <?php if($payment['payment_status'] == 'panding'){ ?>
                                        onclick="accept_payment('<?php echo encode_url($payment['payment_id']); ?>');" 
                                        class="btn btn-info btn-md"
                                        title="Due Date : <?php echo date('m-d-Y',$payment['due_date']); ?>"> 
                                        <?php echo $payment['amount_due']; ?>
                                    <?php }else{ ?>
                                            class="btn btn-success btn-xs" 
                                            title="Paid Date : <?php echo date('m-d-Y',strtotime($payment['modified_on'])).' | '.date('h:i A',strtotime($payment['modified_on'])); ?>"> 
                                            <?php echo $payment['amount_due']; ?>
                                        <?php } ?>
                                    </button></td>
                  <td class="text-center"><?php echo date('m-d-Y',$payment['due_date']); ?></td>
                  <td><?php echo $payment['payment_status']; ?></td>
                  <!-- <td><?php //echo (strtotime($payment['modified_on']) > 0)? date('m-d-Y', strtotime($payment['modified_on'])).' | '.date('h:i A', strtotime($payment['modified_on'])).' EST' : '--------'; ?></td>
                  <td><?php //echo ($payment['teansection_id'] != '')?  $payment['teansection_id'] : '--------'; ?></td> -->
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

</div>
</div>



    <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No request detail found..';
        echo'</div>';
        } ?>
</div>

</section>
    <!-- page end-->
</section> 
</section>
<script type="text/javascript">
  function accept_payment(id){
        //alert(id);
        var c = window.confirm("Are you sure, you want to excute this transection?");
        if (c){
            window.location = '<?php echo base_url('administrator/acceptPayment'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }
</script>