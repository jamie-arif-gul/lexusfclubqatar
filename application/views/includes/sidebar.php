<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!--sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a <?php if ($page == "dashboard") echo 'class="active"'; ?> href="<?php echo base_url('administrator/dashboard'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a <?php if ($page == "manage_users") echo 'class="active"'; ?> href="<?php echo base_url('administrator/manage_users'); ?>">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a <?php if ($page == "manage_events") echo 'class="active"'; ?> href="<?php echo base_url('administrator/manage_events'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Events</span>
                </a>
            </li>
            <li>
                <a <?php if ($page == "manage_news") echo 'class="active"'; ?> href="<?php echo base_url('administrator/manage_news'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>News</span>
                </a>
            </li>
            <li>
                <a <?php if ($page == "manage_frange") echo 'class="active"'; ?> href="<?php echo base_url('administrator/manage_frange'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Frange</span>
                </a>
            </li>
            
            <li>
                <a <?php if ($page == "manage_offers") echo 'class="active"'; ?> href="<?php echo base_url('administrator/manage_offers'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Offers</span>
                </a>
            </li>
            <li>
                <a <?php if ($page == "manage_bookings") echo 'class="active"'; ?> href="<?php echo base_url('administrator/manage_bookings'); ?>">
                    <i class="fa fa-ticket"></i>
                    <span>Bookings</span>
                </a>
            </li>
            <li>
                <a <?php if ($page == "manage_accessories") echo 'class="active"'; ?> href="<?php echo base_url('administrator/manage_accessories'); ?>">
                    <i class="fa fa-ticket"></i>
                    <span>Accessories</span>
                </a>
            </li>
<!--            <li>-->
<!--                <a --><?php //if ($page == "manage_gallery") echo 'class="active"'; ?><!-- href="--><?php //echo base_url('administrator/manage_gallery'); ?><!--">-->
<!--                    <i class="fa fa-ticket"></i>-->
<!--                    <span>Gallery</span>-->
<!--                </a>-->
<!--            </li>-->

            
            <!--multi level menu end-->

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
