<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-angle-double-left"></i> Back to list
         </a>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-6">

      <?php if( null != validation_errors() ): ?>
        <div class="callout callout-danger">
          <h4>The following error prevented user account creation</h4>
          <ul>
            <?php echo validation_errors(); ?>
          </ul>
          <p>User account not created</p>
        </div>
      <?php endif; ?>


      <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>
        <div class="form-group">
          <label for="username">Username <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'username', 
            'id'   => 'username',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Username',
            'autocomplete' => 'off',
            'maxlength' => 255,
            'value' => set_value('username') ? set_value('username') : $user->getUserName(),
            )); ?>
          </div>

        <div class="form-group">
          <label for="email">Email Address <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'email', 
            'id'   => 'email',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Email id',
            'autocomplete' => 'off',
            'maxlength' => 255,
            'value' => set_value('email') ? set_value('email') : $user->getUserEmail(),
            )); ?>
          </div>

        <div class="form-group">
          <label for="email">Password</label>
          <?php echo form_password(array(
            'name' => 'password', 
            'id'   => 'password',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Password',
            'autocomplete' => 'off',
            'maxlength' => 255,
            )); ?>
            <p class="help-block">Leave blank if you don't wish to update password.</p>
          </div>

        <div class="form-group">
          <label for="email">Confirm Password</label>
          <?php echo form_password(array(
            'name' => 'confirm_pass', 
            'id'   => 'confirm_pass',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Confirm Password',
            'autocomplete' => 'off',
            'maxlength' => 255,
            )); ?>
          </div>

        <div class="form-group">
          <label for="email">Select User Role <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_dropdown(
            'role', 
            $this->config->item('levels_and_roles'),
            set_value('role') ? set_value('role') : $user->getUserLevel(),
            array(
            'id'   => 'role',
            'class' => 'form-control input-lg', 
            'maxlength' => 255,
            )); ?>
          </div>

          <div class="row">

           <div class="col-xs-8">
          </div><!-- /.col -->         
            <div class="col-xs-4">
              <?php echo form_submit('submit', 'Update User', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>