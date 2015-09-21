<div class="login-box">

  <div class="login-logo">
    <b>MOBILOITTE</b>
  </div><!-- /.login-logo -->
  <?php $showform = 1; ?>
  <?php if( isset( $validation_errors ) ): ?>
    <div class="callout callout-danger">
      <h4>The following error occurred while changing your password</h4>
      <ul>
        <?php echo $validation_errors; ?>
      </ul>
      <p>Password not updated</p>
    </div>
  <?php else: ?>
    <?php $display_instructions = 1; ?>
  <?php endif; ?>

  <?php if( isset( $validation_passed ) ): ?>
    <div class="callout callout-success">
      <h4>Password updated</h4>
      <p>You have successfully changed your password. 
        You can now <?php echo secure_anchor(LOGIN_PAGE, 'login'); ?>
      </p>
    </div>
    <?php $showform = 0; ?>
  <?php endif; ?>

  <?php if( isset( $recovery_error ) ): ?>
    <div class="callout callout-danger">
      <h4>No usable data for account recovery</h4>
      <p>Account recovery links expire after 
        <?php echo ( (int) config_item('recovery_code_expiration') / ( 60 * 60 ) ); ?>  
        hours.<br />
        You will need to use the <?php echo secure_anchor('user/password','Account Recovery'); ?>
        form to send yourself a new link.
      </p>
    </div>
    <?php $showform = 0; ?>
  <?php endif; ?>

  <?php if( isset( $disabled ) ): ?>
    <div class="callout callout-danger">
      <h4>Account recovery is disabled</h4>
      <p>You have exceeded the maximum login attempts or exceeded the 
        allowed number of password recovery attempts. 
        Please wait <?php echo ( (int) config_item('seconds_on_hold') / 60 ); ?> 
        minutes, or contact us if you require assistance gaining access to your account.</p>
      </div>
      <?php $showform = 0; ?>
    <?php endif; ?>

    <?php if( $showform == 1 ): ?>
      <?php if( isset( $recovery_code, $user_id ) ): ?>
        <div class="login-box-body">
          <p class="login-box-msg">
            Update password <br/>
            <?php if( isset( $display_instructions ) ): ?>
              <span class="small">
                <?php if( isset( $user_name ) ): ?>
                  <p>Your login user name is <i><?php echo $user_name; ?></i><br />
                  Please write this down, and change your password now:</p>
                <?php else: ?>
                  <p><p>Please change your password now:</p></p>
                <?php endif; ?>
              </span>
            <?php endif; ?>
          </p>

          <?php echo form_open( '' ); ?>
          <div class="form-group has-feedback">
            <?php echo form_password(array(
              'class' => 'form-control', 
              'placeholder' => 'New Password',
              'autocomplete' => 'off',
              'name'       => 'user_pass_confirm',
              'id'         => 'user_pass_confirm',
              'max_length' => config_item('max_chars_for_password')

              ) ); ?>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
              <?php echo form_password(array(
                'class' => 'form-control', 
                'placeholder' => 'Confirm New Password',
                'autocomplete' => 'off',
                'name'       => 'user_pass',
                'id'         => 'user_pass',
                'max_length' => config_item('max_chars_for_password')

                ) ); ?>

                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <?php echo form_hidden('recovery_code', $recovery_code); ?>
              <?php echo form_hidden('user_identification', $user_id); ?>
              <div class="row">
                <div class="col-xs-6">
                  <?php echo form_submit('submit', 'Update password', array('type' => 'submit', 'class' => 'btn btn-primary btn-flat')); ?>
                </div><!-- /.col -->
              </div>
              <?php echo form_close(); ?>



            </div><!-- /.login-box-body -->
          <?php endif; ?>
        <?php endif; ?>
</div><!-- /.login-box -->