<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('assets/images/default-male.jpg'); ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $auth_user_name; ?></p>
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="<?php echo base_url('dashboard'); ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs"></i>
          <span>Site Administration</span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#"><i class="fa fa-users"></i>User Management<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-users"></i>Users</a></li>
              <li><a href="<?php echo base_url('admin/users/manage/role'); ?>"><i class="fa fa-user-secret"></i>Roles</a></li>
              <li><a href="<?php echo base_url('admin/users/manage/permission'); ?>"><i class="fa fa-lock"></i>Permissions</a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url('admin/categories/manage'); ?>"><i class="fa fa-list"></i> Manage Categories</a></li>
          <li><a href="<?php echo base_url('admin/groups'); ?>"><i class="fa fa-folder-open"></i> Manage Groups</a></li>
        </ul>
      </li>

      <li class="header">NOTIFICATIONS</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span>
      <small class="label pull-right bg-red">30</small>
      </a></li>
      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span>
      <small class="label pull-right bg-yellow">23</small>
      </a></li>
      <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span>
      <small class="label pull-right bg-aqua">17</small>
      </a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>