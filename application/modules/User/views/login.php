<div class="login-box">

  <div class="login-logo">
    <b>MOBILOITTE</b>
  </div><!-- /.login-logo -->
<?php if( ! isset( $on_hold_message ) ): ?>
  <?php if( isset( $login_error_mesg ) ): ?>
    <div class="callout callout-danger">
      <h4>Oops!</h4>
        <ul>
          <li>Login Error: Invalid Username, Email Address, or Password.</li>
          <li>Username, email address and password are all case sensitive.</li>
        </ul>
    </div>
  <?php endif; ?>

  <?php if( $this->input->get('logout') ): ?>
      <div class="callout callout-success">
        <p> You have successfully logged out.</p>
      </div>
  <?php endif; ?>

  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    
    <?php echo form_open($login_url, array( 'class' => 'std-form' )); ?>
      <div class="form-group has-feedback">
        <?php echo form_input(array(
          'name' => 'login_string', 
          'id'   => 'login_string',
          'class' => 'form-control', 
          'placeholder' => 'email or username',
          'autocomplete' => 'off',
          'maxlength' => 255,
          )); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_password(array(
          'name' => 'login_pass', 
          'id' => 'login_pass',
          'class' => 'form-control', 
          'placeholder' => 'password',
          'autocomplete' => 'off',
          'maxlength' => config_item('max_chars_for_password'),

        ) ); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        <?php if( config_item('allow_remember_me') ): ?>
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" id="remember_me" name="remember_me" value="yes" />Remember me
            </label>
          </div>
        <?php endif; ?>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <?php echo form_submit('submit', 'Sign In', array('class' => 'btn-block btn btn-primary btn-flat')); ?>
        </div><!-- /.col -->
      </div>    
    <?php echo form_close(); ?>


    <a href="<?php echo site_url('user/password'); ?>">I forgot my password</a><br>

  </div><!-- /.login-box-body -->
  <?php else: ?>
    <div class="callout callout-danger">
      <h4>Excessive Login Attempts!!</h4>
        <p>
          You have exceeded the maximum number of failed login attempts that this website will allow.
        </p>
        <p>Your access to login and account recovery has been blocked for 
          <?php echo ( (int) config_item('seconds_on_hold') / 60 ); ?> minutes.
        </p>
        <p>
          Please use the <?php echo secure_anchor('user/password','Account Recovery'); ?> 
          after <?php echo ( (int) config_item('seconds_on_hold') / 60 ); ?> minutes has passed,
          or contact us if you require assistance gaining access to your account.
        </p>
    </div>
  <?php endif; ?>
</div><!-- /.login-box -->

