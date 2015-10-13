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
          <h4>The following error prevented user account creation</h4>
          <ul>
            <?php echo validation_errors(); ?>
          </ul>
          <p>Articles not updated</p>
        </div>
      <?php endif; ?>



      <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>
        <div class="form-group">
          <label for="username">Articles Name <i class="fa fa-asterisk form-required"></i></label>
		  
          <?php echo form_input(array(
            'name' => 'title', 
            'id'   => 'title',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Articles name',
            'maxlength' => 255,
            'value' => set_value('title') ? set_value('title') : $article->getTitle() ,
            )); ?>
          </div>

        <div class="form-group">
          <label for="email">Description</label>
          <?php echo form_textarea(array(
            'name' => 'description', 
            'id'   => 'description',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Enter blurb about the article being created',
            'value' => set_value('description') ? set_value('description') : $article->getBody(),
            )); ?>
          </div>

		  
      	  <div class="form-group">
          <label for="type">Group Types<i class="fa fa-asterisk form-required"></i></label>
          <br/>
          <?php echo form_radio(array(
            'name' => 'type', 
            'id'   => 'type',
            'class' => 'form-control input-lg',
            ), 'organic', set_value('type') == 'organic' ? TRUE : FALSE); ?>
          <?php echo form_label('Publish', 'type'); ?>
          <?php echo form_radio(array(
            'name' => 'type', 
            'id'   => 'type',
            'class' => 'form-control input-lg',
            ), 'project', set_value('type') == 'project' ? TRUE : FALSE); ?>
          <?php echo form_label('Unpublish', 'type'); ?>
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
              <?php echo form_submit('submit', 'Update articles', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>