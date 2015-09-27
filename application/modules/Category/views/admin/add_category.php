<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/categories/manage'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-angle-double-left"></i> Back to list
         </a>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-6">

      <?php if( null != validation_errors() ): ?>
        <div class="callout callout-danger">
          <h4>The following error prevented user account creation</h4>
          <ul>
            <?php echo validation_errors(); ?>
          </ul>
          <p>Category not created</p>
        </div>
      <?php endif; ?>



      <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>
        <div class="form-group">
          <label for="username">Category Name <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'title', 
            'id'   => 'title',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Categroy name',
            'maxlength' => 255,
            'value' => set_value('title'),
            )); ?>
          </div>

        <div class="form-group">
          <label for="email">Description</label>
          <?php echo form_textarea(array(
            'name' => 'description', 
            'id'   => 'description',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Enter blurb about the category being created',
            'value' => set_value('description'),
            )); ?>
          </div>

        <div class="form-group">
          <?php echo form_checkbox(array(
            'name' => 'status', 
            'id'   => 'status',
            'class' => 'form-control input-lg',
            'checked' => true, 
            ), '1'); ?>
            Published
          </div>

          <div class="row">

           <div class="col-xs-8">
          </div><!-- /.col -->         
            <div class="col-xs-4">
              <?php echo form_submit('submit', 'Add Category', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>