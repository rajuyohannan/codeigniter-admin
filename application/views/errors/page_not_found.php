<!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <?php if($check_login->user_id): ?>
  <section class="content-header">
    <h1>
      404 Error Page
    </h1>
  </section>
  <?php endif; ?>
  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-yellow"> 404</h2>
      <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
          We could not find the page you were looking for.
          <?php if($check_login->user_id): ?>
           Meanwhile, you may <a href="<?php echo base_url(); ?>">return to dashboard</a>.
          <?php else: ?>
           Meanwhile, you may <a href="<?php echo base_url(); ?>">return to login page</a>.
          <?php endif; ?>
        </p>
      </div><!-- /.error-content -->
    </div><!-- /.error-page -->
  </section><!-- /.content -->
