<?php $uri = 0;
if($this->uri->segment(3) != '')
  $uri = $this->uri->segment(3);
?>
<div class="container">
  <div class="clear10"></div>
  <div class="dashboardbox container"> 
    <?php $this->load->view('frontend/includes/profile_sidebar'); ?>
    <div class="col-sm-9 dashboard-content padding0">
      <h3 class="dashboard-heading text-left"> Saved Searches </h3>
      <hr class="style7">
      <div class="tbl_base">
      <?php $this->load->view('errors'); ?>
      <?php if($results) { ?>
      <table class="mypropertytbl" width="100%">
        <thead>
          <tr>
            <td>Title</td>
            <td>Created</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result) { ?>
          <tr>
            <td><a href="<?php echo $result['search']; ?>"><?php echo $result['name']; ?></a></td>
            <td><?php echo $result['created']; ?></td>
            <td><a class="action" href="javascript:void(0)" onclick="delete_object('<?php echo encode_url($result['search_id']); ?>');">Remove</a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="clear10"></div>
      <div class="col-sm-12"><?php echo $pagination; ?></div>
      <?php }else{
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo 'No Searches Found.';
        echo'</div>';
        } ?>
      </div>
    </div>
   </div>
  </div>

<script>
    function delete_object(id){
        var c = window.confirm("Are you sure, you want to remove search?");
        if (c){
            window.location = '<?php echo base_url('properties/removeSearch'); ?>/<?php echo $uri; ?>/'+ id;
        }
    }
</script>