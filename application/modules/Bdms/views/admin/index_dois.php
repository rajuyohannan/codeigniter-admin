<section class="content">

  <!-- Default box -->
  <div class="box">

    <?php if($this->session->flashdata('warning')): ?>          
      <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <?php echo $this->session->flashdata('warning'); ?>
      </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('success')): ?>          
      <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <?php echo $this->session->flashdata('success'); ?>
      </div>
    <?php endif; ?>


    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools">
        <div class="box-tools pull-right">
          <a href="<?php echo base_url('admin/bdms/doi/add'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-plus"></i> Add DOI
          </a>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Fi  lter Estimations</h3>
      </div>
      <div class="panel-body">
        <?php echo form_open('', array('method' => 'GET')); ?>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="title">Estimation Title</label>
              <?php echo form_input(array(
                'name' => 'title', 
                'id'   => 'title',
                'class' => 'form-control', 
                'placeholder' => 'Search by Estimation title',
                'autocomplete' => 'off',
                'maxlength' => 255,
                'value' => $_GET['title'],
                )); ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="visibility">Assigned By</label>
                <?php echo form_dropdown(
                  'visibility', 
                  array('-1' => ' - Select - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                  $_GET['visibility'],
                  array(
                    'id'   => 'visibility',
                    'class' => 'form-control', 
                    'maxlength' => 255,
                    )); ?>              
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                  <label for="type">Assigned to</label>
                    <?php echo form_dropdown(
                      'type', 
                      array('-1' => ' - Select  - ', 'organic' => 'Organic Groups', 'project' => 'Project Groups'),
                      $_GET['type'],
                      array(
                        'id'   => 'type',
                        'class' => 'form-control', 
                        'maxlength' => 255,
                        )); ?>              
                      </div>
                    </div>

                <div class="col-md-3">
                  <div class="form-group">
                  <label for="type">Assigned by</label>
                    <?php echo form_dropdown(
                      'type', 
                      array('-1' => ' - Select  - ', 'organic' => 'Organic Groups', 'project' => 'Project Groups'),
                      $_GET['type'],
                      array(
                        'id'   => 'type',
                        'class' => 'form-control', 
                        'maxlength' => 255,
                        )); ?>              
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                      <?php echo form_submit(
                        'submit', 
                        'Filter', 
                        array('class' => 'btn-block btn btn-primary btn-flat')
                        ); ?>
                      </div>
                      <div class="col-md-2">
                        <?php echo anchor('admin/groups', 'Reset', array('class' => 'btn-block btn btn-danger btn-flat')); ?>
                      </div>
                    </div>
                    <?php form_close(); ?>
                  </div>
                </div>

                <div class="box-body">
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        <th>Title</th>
                        <th>Marketplace</th>
                        <th>Assigned By</th>
                        <th>Est. Completion</th>
                        <th>Aging</th>
                        <th>Actions</th>
                      </tr>
                      <?php if($estimations): ?>
                        <?php foreach($estimations as $estimation): ?>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              <a class="btn btn-info" href="<?php echo base_url('admin/groups/edit/'); ?>">
                                <i class="fa fa-edit"></i>&nbsp;Edit
                              </a> 
                              <a  data-toggle="modal" 
                                  data-target="#Modal"
                                  data-title="Are you sure, you want to delete this record?"
                                  data-body="The action can not be undone. The deleted groups will be removed from persistent storage." 
                                  data-button="Delete" 
                                  data-class="modal-danger" 
                                  data-action="<?php echo base_url('admin/groups/delete/'); ?>" 
                              class="btn btn-danger" href="#">
                              <i class="fa fa-trash"></i>&nbsp;Delete
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr><td colspan="4"><h3>No records found.</h3></td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <?php echo $this->pagination->create_links(); ?>
              </div><!-- /.box-footer -->
            </div><!-- /.box -->
          </section>

          <?php $this->load->view('partials/modal'); ?>