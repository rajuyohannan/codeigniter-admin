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
          <a href="<?php echo base_url('admin/bdms/estimations/add'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-plus"></i> Assign Estimations
          </a>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Filter Estimations</h3>
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
                <label for="marketplace">Lead Source</label>
                <?php echo form_dropdown(
                  'marketplace', 
                  array('-1' => '- SELECT -') + $marketplace,
                  $_GET['marketplace'],
                  array(
                    'id'   => 'marketplace',
                    'class' => 'form-control', 
                    'maxlength' => 255,
                    )); ?>              
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                  <label for="type">Assigned by</label>
                    <?php echo form_dropdown(
                      'assignedBy', 
                      array('-1' => '- SELECT -') + $assignedby,
                      $_GET['assignedBy'],
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
                        <?php echo anchor('admin/bdms/estimations', 'Reset', array('class' => 'btn-block btn btn-danger btn-flat')); ?>
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
                        <th>Lead Source</th>
                        <th>Assigned By</th>
                        <th>Assigned To</th>
                        <th>Est. Completion</th>
                        <th>Aging</th>
                      </tr>
                      <?php if($estimations): ?>
                        <?php foreach($estimations as $estimation): ?>
                          <tr>
                            <td><?php echo $estimation->getTitle(); ?></td>
                            <td><?php echo $estimation->getMarketplace()->getTitle(); ?></td>
                            <td><?php echo $estimation->getAssignedBy()->getUserName(); ?></td>
                            <td>
                                <?php foreach ($estimation_users[$estimation->getId()] as $estuser): ?>
                                  <?php foreach ($estuser as $user): ?>
                                    <span class="label label-<?php echo $user['status']; ?>">
                                      <?php echo $user['user']; ?>
                                    </span>&nbsp;
                                  <?php endforeach; ?>
                                <?php endforeach; ?>
                            </td>

                            <td><?php echo $estimation->getSchduledOn()->format('m/d/Y'); ?></td>
                            <td>
                                <?php $interval = date_create(date('Y-m-d H:i:s'))->diff($estimation->getSchduledOn()); ?>
                                <span class="label label-<?php echo ($interval->format('%R%a') >= 0) ? 'success' : 'danger' ?>">
                                  <?php echo $interval->format('%R%a days'); ?>
                                </span>
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