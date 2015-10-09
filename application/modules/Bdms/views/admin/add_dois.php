<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/bdms/doi'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-angle-double-left"></i> Back to list
         </a>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-8">

      <?php if( null != validation_errors() ): ?>
        <div class="callout callout-danger">
          <h4>The following error prevented DOI creation</h4>
          <ul>
            <?php echo validation_errors(); ?>
          </ul>
          <p>DOI not created</p>
        </div>
      <?php endif; ?>

      <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-pencil"></i>
            <h3 class="panel-title">Lead / Estimation Details</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-pencil"></i>
            <h3 class="panel-title">Project Details</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-pencil"></i>
            <h3 class="panel-title">Project Budget</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-pencil"></i>
            <h3 class="panel-title">Project Timeline</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-pencil"></i>
            <h3 class="panel-title">Client Details</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>
          <div class="row">
           <div class="col-xs-8">
          </div><!-- /.col -->         
            <div class="col-xs-4">
              <?php echo form_submit('submit', 'Submit DOI  ', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>