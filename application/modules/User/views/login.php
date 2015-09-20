<div class="login-box">

  <div class="login-logo">
    <b>MOBILOITTE</b>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    
    <?php echo form_open('user/login'); ?>
      <div class="form-group has-feedback">
        <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'email or username') ); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_password(array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'password') ); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <?php echo form_submit('submit', 'Sign In', array('class' => 'btn-block btn btn-primary btn-flat')); ?>
        </div><!-- /.col -->
      </div>    
    <?php echo form_close(); ?>


    <a href="<?php echo site_url('user/password'); ?>">I forgot my password</a><br>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

