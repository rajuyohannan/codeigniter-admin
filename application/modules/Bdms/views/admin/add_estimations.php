<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/bdms/estimations'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-angle-double-left"></i> Back to list
         </a>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-6">

      <?php if( null != validation_errors() ): ?>
        <div class="callout callout-danger">
          <h4>The following error prevented estimation assignment</h4>
          <ul>
            <?php echo validation_errors(); ?>
          </ul>
          <p>Estimation not assigned</p>
        </div>
      <?php endif; ?>

      <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>

      <div class="form-group">
        <label for="leadsource">Lead Source<i class="fa fa-asterisk form-required"></i></label>
        <?php echo form_dropdown(
          'leadsource', 
          array('-1' => ' - Select - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
          set_value('leadsource'),
          array(
            'id'   => 'leadsource',
            'class' => 'form-control input-lg', 
            )); ?>              
          </div>

        <div class="form-group">
          <label for="title">Title <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'title', 
            'id'   => 'title',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Estimation title',
            'maxlength' => 255,
            'value' => set_value('title'),
            )); ?>
          </div>

        <div class="form-group">
          <label for="email">Description<i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_textarea(array(
            'name' => 'description', 
            'id'   => 'description',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Enter description about the estimation being created',
            'value' => set_value('description'),
            )); ?>
          </div>

        <div class="form-group">
          <label for="files"><i class="fa fa-file-o">&nbsp;</i>Add Files</label>
          <?php echo form_upload(array(
            'name' => 'files', 
            'id'   => 'files',
            'class' => 'form-control input-lg', 
            'multiple' => 'multiple',
            'value' => set_value('files'),
            )); ?>
          </div>


          <div class="form-group">
            <label for="scheduledOn">Scheduled Completion<i class="fa fa-asterisk form-required"></i></label>
           <div class='input-group date' id='datetimepicker-scheduled'>
           <?php echo form_input(array(
                'name' => 'scheduledOn',
                'id'   => 'scheduledOn',
                'class' => 'form-control input-lg',
                'placeholder' => 'mm/dd/yyyy hh:mm',
                'value' => set_value('scheduledOn'),
                'autocomplete' => false,
              ));
            ?>
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
              </div>
          </div>

          <div class="row">
           <div class="col-xs-8">
          </div><!-- /.col -->         
            <div class="col-xs-4">
              <?php echo form_submit('submit', 'Assign', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>