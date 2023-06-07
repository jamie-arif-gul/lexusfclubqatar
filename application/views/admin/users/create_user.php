<style>
    .datepicker{
        width: 240px;
    }
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading"> Create User</header>
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
                        <form method="post" role="form" id="create_user" action="administrator/create_user">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" value="<?php echo set_value('first_name') ?>" class="form-control" id="name" name="first_name" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" value="<?php echo set_value('last_name') ?>" class="form-control" id="last_name" name="last_name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo set_value('email'); ?>" class="form-control"  id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="form-group">
                                <label for="repate_password">Repeat Password</label>
                                <input type="password" class="form-control"  name="password_confirm" required>
                            </div>
                            
                            <div class="form-group">
                              <label for="school">School/Employment</label>
                              <input type="text" class="form-control" id="school" name="school"  value="<?php echo set_value('school'); ?>" required>
                            </div>

                            <div class="form-group">
                              <label for="dob">Birth Date</label>
                              <input type="text" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob'); ?>" required>
                            </div>

                            <div class="form-group">
                              <label for="gender">Gender</label>
                              <select class="form-control" name="gender" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="I prefer not to disclose my gender">I prefer not to disclose my gender</option>
                              </select>
                            </div>

                            <!-- <div class="form-group">
                              <label for="number">Phone Number</label>
                              <div style="width:100%;">
                              <input type="text" class="form-control" id="number1" name="number1" value="<?php echo set_value('number1'); ?>" style="display:inline; width:10%" maxlength="3" required>
                              <input type="text" class="form-control" id="number2" name="number2" value="<?php echo set_value('number3'); ?>" style="display:inline; width:10%" maxlength="3" required> -
                              <input type="text" class="form-control" id="number3" name="number3" value="<?php echo set_value('number3'); ?>" style="display:inline; width:20%" maxlength="4" required>
                              </div>
                            </div> -->

                            <!-- <div class="form-group">
                              <label for="description">Description</label>
                              <textarea type="text" class="form-control" id="description" name="description" required><?php echo set_value('description'); ?></textarea>
                            </div> -->

                            <input type="submit" value="Create" class="btn btn-shadow btn-primary"/>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>   

</section>
</section>




