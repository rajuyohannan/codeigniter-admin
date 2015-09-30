<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/groups'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-angle-double-left"></i> Back to list
         </a>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-6">

      <?php if( null != validation_errors() ): ?>
        <div class="callout callout-danger">
          <h4>The following error prevented groups creation</h4>
          <ul>
            <?php echo validation_errors(); ?>
          </ul>
          <p>Group not created</p>
        </div>
      <?php endif; ?>

      <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>
        <div class="form-group">
          <label for="username">Group Name <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'title', 
            'id'   => 'title',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Group name',
            'maxlength' => 255,
            'value' => set_value('title') ? set_value('title') : $group->getTitle() ,
            )); ?>
          </div>

        <div class="form-group">
          <label for="email">Description</label>
          <?php echo form_textarea(array(
            'name' => 'description', 
            'id'   => 'description',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Enter blurb about the group being created',
            'value' => set_value('description') ? set_value('description') : $group->getDescription(),
            )); ?>
          </div>
        <div class="form-group">
          <label for="visibility">Group Visibility<i class="fa fa-asterisk form-required"></i></label>
          <br/>
          <?php echo form_radio(array(
            'name' => 'visibility', 
            'id'   => 'visibility',
            'class' => 'form-control input-lg',
            ), 'public', set_value('visibility') || $group->getVisibility() == 'public' ? TRUE : FALSE); ?>
          <?php echo form_label('Public', 'visibility'); ?>
          <?php echo form_radio(array(
            'name' => 'visibility', 
            'id'   => 'visibility',
            'class' => 'form-control input-lg',
            ), 'private', set_value('visibility') || $group->getVisibility() == 'private' ? TRUE : FALSE); ?>
          <?php echo form_label('Private', 'visibility'); ?>
          <p class="help-block">Groups with public visibility will be accessible to all user, whereas with private only allowed users can access.</p>
        </div>
        <div class="form-group">
          <label for="type">Group Types<i class="fa fa-asterisk form-required"></i></label>
          <br/>
          <?php echo form_radio(array(
            'name' => 'type', 
            'id'   => 'type',
            'class' => 'form-control input-lg',
            ), 'organic', set_value('type') || $group->getType() == 'organic' ? TRUE : FALSE); ?>
          <?php echo form_label('Organic Groups', 'type'); ?>
          <?php echo form_radio(array(
            'name' => 'type', 
            'id'   => 'type',
            'class' => 'form-control input-lg',
            ), 'project', set_value('type') || $group->getType() == 'project' ? TRUE : FALSE); ?>
          <?php echo form_label('Project Groups', 'type'); ?>
          <p class="help-block">Organic groups are social groups, whereas Project groups are for creating projects on the website.</p>
        </div>
        <div class="form-group">
          <?php echo form_checkbox(array(
            'name' => 'status', 
            'id'   => 'status',
            'class' => 'form-control input-lg',
            'checked' => $group->getStatus(), 
            ), '1'); ?>
            <?php echo form_label('Published', 'status'); ?>
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