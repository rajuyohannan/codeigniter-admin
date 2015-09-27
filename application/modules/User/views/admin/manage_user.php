<section class="content">

  <!-- Default box -->
  <div class="box">

    <?php if($this->session->flashdata('warning')): ?>          
      <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <?php echo $this->session->flashdata('warning'); ?>
      </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('success')): ?>          
      <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <?php echo $this->session->flashdata('success'); ?>
      </div>
    <?php endif; ?>


    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools">
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/users/user/add'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-plus"></i> Add User
         </a>
      </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Filter Users</h3>
      </div>
      <div class="panel-body">
        <?php echo form_open('', array('method' => 'GET')); ?>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="username">Username</label>
              <?php echo form_input(array(
                'name' => 'userName', 
                'id'   => 'userName',
                'class' => 'form-control', 
                'placeholder' => 'Username',
                'autocomplete' => 'off',
                'maxlength' => 255,
                'value' => $_GET['userName'],
                )); ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="email">Email</label>
              <?php echo form_input(array(
                'name' => 'userEmail', 
                'id'   => 'userEmail',
                'class' => 'form-control', 
                'placeholder' => 'Email id',
                'autocomplete' => 'off',
                'maxlength' => 255,
                'value' => $_GET['userEmail'],
                )); ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="status">Status</label>
              <?php echo form_dropdown(
                'userBanned', 
                 array('-1' => ' - Select Status - ', '0' => 'Active', '1' => 'Banned'),
                 $_GET['userBanned'],
                array(
                  'id'   => 'userBanned',
                  'class' => 'form-control', 
                  'maxlength' => 255,
              )); ?>              
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="role">Role</label>
              <?php echo form_dropdown(
                'userLevel', 
                 array('-1' => ' - Select Role - ') + $this->config->item('levels_and_roles'),
                 $_GET['userLevel'],
                array(
                  'id'   => 'userLevel',
                  'class' => 'form-control', 
                  'maxlength' => 255,
              )); ?>
            </div>
          </div>
        </div>
      
      <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-2">
          <?php echo form_submit(
            'submit', 
            'Filter', 
            array('class' => 'btn-block btn btn-primary btn-flat')
          ); ?>
        </div>
        <div class="col-md-2">
          <?php echo anchor('admin/users', 'Reset', array('class' => 'btn-block btn btn-danger btn-flat')); ?>
        </div>
      </div>
    <?php form_close(); ?>
    </div>
  </div>

    <div class="box-body">
      <table class="table table-striped">
      	<tbody>
      		<tr>
      			<th>Username</th>
            <th>Role</th>
            <th>Status</th>
      			<th>Created On</th>
      			<th>Last Login</th>
      			<th>Actions</th>
      		</tr>
      		<?php if($users): ?>
      		<?php foreach($users as $user): ?>
      		<tr>
    				<td><?php echo $user->getUsername(); ?><br>
    				<i><?php echo $user->getUserEmail(); ?></i></td>
            <td><?php echo ucfirst($roles[$user->getUserLevel()]); ?></td>
            <td><?php echo $user->getUserBanned() == 0 ? "Active" : "Banned"; ?></td>
    				<td><?php echo $user->getUserDate()->format('l, dS F Y'); ?></td>
    				<td>
              <?php if($user->getUserLastLogin()):?>
                <?php echo $user->getUserLastLogin()->format('l, dS F Y'); ?>
              <?php else: ?>
                Not logged in yet.
              <?php endif; ?>
            </td>
    				<td>
    					<a class="btn btn-info" href="<?php echo base_url('admin/users/user/edit/'.$user->getUserId()); ?>">
                <i class="fa fa-edit"></i>Edit
              </a> 
    					<a data-toggle="modal" 
                data-target="#Modal"
                data-title="Are you sure, you want to delete this record?"
                data-body="The action can not be undone. The deleted user will be removed from persistent storage." 
                data-button="Delete" 
                data-class="modal-danger" 
                data-action="<?php echo base_url('admin/users/user/delete/'.$user->getUserId()); ?>" 
                class="btn btn-danger" href="#">
                <i class="fa fa-trash"></i>Delete
              </a>
              <?php if(!$user->getUserBanned()): ?>
    					<a data-toggle="modal" 
                data-target="#Modal"
                data-title="Are you sure, you want to ban this user?"
                data-body="The banned user will not have access to any of the resources on the website." 
                data-button="Ban User" 
                data-class="modal-warning" 
                data-action="<?php echo base_url('admin/users/user/status_change/'.$user->getUserId() . '/1'); ?>" 
              class="btn btn-warning" href="#">
                <i class="fa fa-ban"></i>Ban
              </a>
            <?php else: ?>
              <a data-toggle="modal" 
                data-target="#Modal"
                data-title="Are you sure, you want to allow access to this user?"
                data-body="Once the user have been allowed access to the website, they will have access to the allowed resources on the website."  
                data-button="Admit User" 
                data-class="modal-primary" 
                data-action="<?php echo base_url('admin/users/user/status_change/'.$user->getUserId().'/0'); ?>" 
              class="btn btn-primary" href="#">
                <i class="fa fa-check"></i>Admit
              </a>          
            <?php endif; ?>
    				</td>
          </tr>
      		<?php endforeach; ?>
      		<?php else: ?>
            <tr><td colspan="6"><h3>No records found.</h3></td></tr>
          <?php endif; ?>
      	</tbody>
      </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
      <?php echo $this->pagination->create_links(); ?>
    </div><!-- /.box-footer-->
  </div><!-- /.box -->
</section>


<?php $this->load->view('partials/modal'); ?>