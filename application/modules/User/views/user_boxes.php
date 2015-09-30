<div class="box-body no-padding">
  <ul class="users-list clearfix">
    <?php foreach($users as $user): ?>
    <li>
      <img alt="User Image" src="<?php echo base_url('assets/images/user1-128x128.jpg'); ?>">
      <a href="#" class="users-list-name">Alexander Pierce</a>
      <span class="users-list-date">Today</span>
    </li>
    <?php endforeach; ?>
  </ul><!-- /.users-list -->
</div>