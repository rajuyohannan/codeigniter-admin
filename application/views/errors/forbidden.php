<!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <?php if($check_login->user_id): ?>
  <section class="content-header">
    <h1>
      403 Error Page
    </h1>
  </section>
  <?php endif; ?>
  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-yellow"> 403</h2>
      <div class="error-content">
        <h3><i class="fa fa-ban text-yellow"></i> Oops! Access Denied.</h3>
        <p>
         You are not authorized to access the page .
          <br/><br/>
          <?php if($check_login->user_id): ?>
            You may <a href="<?php echo base_url(); ?>">return to dashboard</a>.
          <?php else: ?>
           Meanwhile, you may <a href="<?php echo base_url(); ?>">return to login page</a>.
          <?php endif; ?>
        </p>
      </div><!-- /.error-content -->
    </div><!-- /.error-page -->
  </section><!-- /.content -->
