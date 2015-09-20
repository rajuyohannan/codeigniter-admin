<div class="login-box">

  <div class="login-logo">
    <b>MOBILOITTE</b>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
      Forgot your password? <br/>
      <span class="small">Enter your email id or username below</span>
    </p>

    <?php echo form_open('user/password'); ?>
      <div class="form-group has-feedback">
        <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'email or username') ); ?>
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
</div><!-- /.login-box -->

