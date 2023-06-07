<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading"> Edit User</header>
            <div class="panel-body">
                <span>
                    <?php if (isset($success)) {
                      echo '<div class="alert alert-success alert-dismissable"> ';
                      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                      print_r($success);
                      echo '</span>';
                      echo'</div>';
                    } ?>
                </span>
                <span>
                <?php if (isset($errors)) {
                      echo '<div class="alert alert-danger alert-dismissable"> ';
                      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                      print_r($errors);
                      echo '</span>';
                      echo'</div>';
                } ?>
                </span>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <div class="col-md-7">
                        <?php //$number = explode(',', $user['number']); ?>
                        <form method="post" role="form" id="edit_user" action="<?php echo $user['user_id']; ?>">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" value="<?php echo $user['name']; ?>" class="form-control" id="first_name" name="first_name" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" value="<?php echo $user['last_name']; ?>" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            
<!--                            <div class="form-group">-->
<!--                              <label for="school">School/Employment</label>-->
<!--                              <input type="text" value="--><?php //echo $user['school']; ?><!--" class="form-control" id="school" name="school" placeholder="School or Employment" required>-->
<!--                            </div>-->
<!---->
<!--                            <div class="form-group">-->
<!--                              <label for="dob">Birth Date</label>-->
<!--                              <input type="text" class="form-control" id="dob" name="dob" value="--><?php //echo $user['dob']; ?><!--" required>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                              <label for="gender">Gender</label>-->
<!--                              <select class="form-control" name="gender" id="gender" required>-->
<!--                                <option value="">Select Gender</option>-->
<!--                                <option value="Male" --><?php //echo ($user['gender'] == 'Male')? 'selected="selected"' : ''; ?><!-- >Male</option>-->
<!--                                <option value="Female">Female</option>-->
<!--                            --><?php //echo ($user['gender'] == 'Female')? 'selected="selected"' : ''; ?>
<!--                                <option value="I prefer not to disclose my gender" --><?php //echo ($user['gender'] == 'I prefer not to disclose my gender')? 'selected="selected"' : ''; ?><!-->
<!--                              </select>-->
<!--                            I prefer not to disclose my gender</option>-->
<!--                            </div>-->

                            <!-- <div class="form-group">
                              <label for="number">Phone Number</label>
                              <div style="width:100%;">
                              <input type="text" class="form-control" id="number1" name="number1" value="<?php echo (isset($number[0])) ? $number[0]: ''; ?>" style="display:inline; width:10%" maxlength="3" required> 
                              <input type="text" class="form-control" id="number2" name="number2" value="<?php echo (isset($number[1])) ? $number[1]: ''; ?>" style="display:inline; width:10%" maxlength="3" required> - 
                              <input type="text" class="form-control" id="number3" name="number3" value="<?php echo (isset($number[2])) ? $number[2]: ''; ?>" style="display:inline; width:20%" maxlength="4" required>
                              </div>
                            </div> -->
                            
                            <!-- <div class="form-group">
                              <label for="description">Description</label>
                              <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required><?php echo $user['description']; ?></textarea>
                            </div> -->
                            
                            <input type="submit" value="Uddate" class="btn btn-shadow btn-primary"/>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>   

</section>
</section>




