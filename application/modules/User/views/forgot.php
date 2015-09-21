<div class="login-box">

  <div class="login-logo">
    <b>MOBILOITTE</b>
  </div><!-- /.login-logo -->

  <?php if( isset( $disabled ) ): ?>
      <div class="callout callout-danger">
        <h4>Account Recovery is Disabled.</h4>
        <p>If you have exceeded the maximum login attempts, or exceeded
        the allowed number of password recovery attempts, account recovery 
        will be disabled for a short period of time. 
        Please wait <?php echo ( (int) config_item('seconds_on_hold') / 60 ); ?> 
        minutes, or contact us if you require assistance gaining access to your account.</p> 
      </div>
  <?php elseif( isset( $user_banned ) ): ?>
      <div class="callout callout-danger">
        <h4>Account Locked.</h4>
        <p>You have attempted to use the password recovery system using 
          an email address that belongs to an account that has been 
          purposely denied access to the authenticated areas of this website. 
          If you feel this is an error, you may contact us  
          to make an inquiry regarding the status of the account.</p>
      </div>  
  <?php elseif( isset( $confirmation ) ): ?>
      <div class="callout callout-success">
        <h4>Instruction sent</h4>
        <p>We have sent you an email with instructions on how 
        to recover your account. <!-- Because this email did not 
        really get sent, your link is shown below:</p>
        <p> <?php echo  $special_link; ?></p>   -->   
        <?php $show_form = true; ?> 
      </div>
  <?php elseif( isset( $no_match ) ): ?>
      <div class="callout callout-danger">
       <p class="feedback_header">Supplied email did not match any record.</p>
       <?php $show_form = true; ?>
      </div>
  <?php else: ?>
      <?php $show_form = true; ?>
  <?php endif; ?>


  <?php if( isset( $show_form ) ): ?>
  <div class="login-box-body">
    <p class="login-box-msg">
      Forgot your password? <br/>
      <span class="small">If you've forgotten your password and/or username, 
      enter the email address used for your account, 
      and we will send you an e-mail 
      with instructions on how to access your account.</span>
    </p>

    <?php echo form_open('user/password'); ?>
      <div class="form-group has-feedback">
        <?php echo form_input(array(
          'name' => 'user_email', 
          'id'    => 'user_email',
          'class' => 'form-control', 
          'placeholder' => 'email or username',
          'maxlength' => 255
        ) ); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <?php echo form_submit('submit', 'Send password reset email', array('type' => 'submit', 'class' => 'btn btn-primary btn-flat')); ?>
        </div><!-- /.col -->
      </div>
    <?php echo form_close(); ?>

    <a class="pull-right" href="<?php echo site_url('user/login'); ?>">Back to login</a><br>

  </div><!-- /.login-box-body -->
  <?php endif; ?>
</div><!-- /.login-box -->

