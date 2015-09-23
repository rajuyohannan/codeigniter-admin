<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('site_name'); ?> | <?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vendor.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.min.css'); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition 
               <?php echo $this->config->item('site_theme_color'); ?> 
               <?php echo $this->config->item('site_show_drawer') ? 'sidebar-mini' : '';  ?> 
    ">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Header Add -->
      <?php $this->load->view('partials/header'); ?>
      <!-- Sidebar Add -->
      <?php $this->load->view('partials/sidebar'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small><?php echo $description; ?></small>
          </h1>
        </section>

        <?php print $content; ?>

      </div><!-- /.content-wrapper -->
      <!-- Footer Add -->
      <?php $this->load->view('partials/footer'); ?>
    </div><!-- ./wrapper -->
    <script>
    var FileAPI = {
      debug: true, 
      staticPath: '<?php print base_url() . "assets/plugins/fileapi/"; ?>'
    };
    </script>   
    <script src="<?php echo base_url('assets/js/vendor/vendor.min.js'); ?>"></script>
    <script type="text/javascript">
      var baseurl = "<?php print base_url(); ?>";
    </script>    
    <script src="<?php echo base_url('assets/js/custom/build/custom.min.js'); ?>"></script>
  </body>
</html>
