<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/articles'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-angle-double-left"></i> Back to list
         </a>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-6">

      <?php if( null != validation_errors() ): ?>
        <div class="callout callout-danger">
          <h4>The following error prevented article creation</h4>
          <ul>
            <?php echo validation_errors(); ?>
          </ul>
          <p>Article not created</p>
        </div>
      <?php endif; ?>

     

      <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>
        <div class="form-group">
          <label for="username">Article Name <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'title', 
            'id'   => 'title',
            'class' => 'form-control input-lg', 
            'placeholder' => 'article name',
            'maxlength' => 255,
            'value' => set_value('title'),
            )); ?>
          </div>


        <div class="form-group">
          <label for="groupRef">Group Type <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_dropdown(
             'groupRef', 
             array('-1' => ' - SELECT - ') + $groups,
             set_value('groupRef'),
            array(
              'id'   => 'type',
              'class' => 'form-control', 
              'maxlength' => 255,
              'maxlength' => 255,
          )); ?>              
        </div>
 
        <div class="form-group">
          <label for="email">Description <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_textarea(array(
            'name' => 'description', 
            'id'   => 'description',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Enter blurb about the article being created',
            'value' => set_value('description'),
            )); ?>
          </div>

		  <div class="form-group">
          <label for="type">Status<i class="fa fa-asterisk form-required"></i></label>
          <br/>
          <?php echo form_radio(array(
            'name' => 'type', 
            'id'   => 'type',
            'class' => 'form-control input-lg',
            ), 'organic', set_value('type') == 'organic' ? TRUE : FALSE); ?>
          <?php echo form_label('Publish', 'type'); ?>
          <br/>
          <?php echo form_radio(array(
            'name' => 'type', 
            'id'   => 'type',
            'class' => 'form-control input-lg',
            ), 'project', set_value('type') == 'project' ? TRUE : FALSE); ?>
          <?php echo form_label('Unpublish', 'type'); ?>
          <br/>
		  <?php echo form_radio(array(
            'name' => 'type', 
            'id'   => 'type',
            'class' => 'form-control input-lg',
            ), 'project', set_value('type') == 'project' ? TRUE : FALSE); ?>
          <?php echo form_label('Sticky', 'type'); ?>
        </div>
		  

          <div class="row">

           <div class="col-xs-8">
          </div><!-- /.col -->         
            <div class="col-xs-4">
              <?php echo form_submit('submit', 'Add article', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>