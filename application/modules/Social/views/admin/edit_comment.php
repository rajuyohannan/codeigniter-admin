<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/comments'); ?>" class="btn btn-block btn-success btn-social">
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
          <p>Comments not updated</p>
        </div>
      <?php endif; ?>



        <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>
        <div class="form-group">
          <label for="username">Comments<i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'body', 
            'id'   => 'body',
            'class' => 'form-control input-lg', 
            'placeholder' => 'comment',
            'maxlength' => 255,
            'value' => set_value('body') ? set_value('body') : $comment->getBody() ,
            )); ?>
          </div>

		  
      	 <div class="form-group">
          <?php echo form_checkbox(array(
            'name' => 'status', 
            'id'   => 'status',
            'class' => 'form-control input-lg',
            'checked' => true, 
            ), '1'); ?>
            <?php echo form_label('Published', 'status'); ?>
          </div>

          <div class="row">

           <div class="col-xs-8">
          </div><!-- /.col -->         
            <div class="col-xs-4">
              <?php echo form_submit('submit', 'Update articles', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>