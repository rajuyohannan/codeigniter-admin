<section class="content">
	  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?php echo $title; ?></h3>
    </div>
    <div id="member-list" class="box-body">
			
			<div class="box-body no-padding">
			  <ul class="users-list clearfix">
			    <?php foreach ($members as $member): ?>
			    <li>
			      <img alt="User Image" src="<?php echo base_url('assets/images/user1-128x128.jpg'); ?>">
			      <?php form_open(); ?>
			          <?php echo form_checkbox(array(
			            'name' => 'subscribed', 
			            'id'   => 'subscribed',
			            'class' => 'form-control input-sm',
			            'checked' => false, 
			            ), '1'); ?>
			      <?php form_close(); ?>
			      <a href="#" class="users-list-name"><?php echo $member->getUserName(); ?></a>
			      <span class="users-list-date">Today</span>
			    </li>
			    <?php endforeach; ?>
			  </ul><!-- /.users-list -->
			</div>

    </div>
  </div>
</section>