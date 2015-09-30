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
			<h3 class="box-title"><?php echo $title; ?> Terms</h3>
			<div class="box-tools">
				<div class="box-tools pull-right">
					<a href="<?php echo base_url('admin/terms/add/'.$cid); ?>" class="btn btn-block btn-success btn-social">
						<i class="fa fa-plus"></i> Add Term
					</a>
				</div>
			</div>
		</div>
    <div class="box-body">
     <table class="table table-striped">
      <thead>
       <tr>
        <th style="width:30%;">Term Name</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody <?php if($terms): ?>id="sortable"<?php endif; ?>>
      <?php if($terms): ?>
        <?php foreach($terms as $term): ?>
         <tr class="ui-state-default">
          <td><?php echo $term->getTitle(); ?></td>
          <td><?php echo $term->getStatus() ? 'Published' : 'Unpublished'; ?></td>
          <td>
            <a class="btn btn-info" href="<?php echo base_url('admin/terms/edit/'.$term->getId()); ?>">
             <i class="fa fa-edit"></i>&nbsp;Edit
           </a> 
           <a  data-toggle="modal" 
               data-target="#Modal"
               data-title="Are you sure, you want to delete this record?"
               data-body="The action can not be undone. The deleted category will be removed from persistent storage." 
               data-button="Delete" 
               data-class="modal-danger" 
               data-action="<?php echo base_url('admin/terms/delete/'.$term->getId()); ?>" 
               class="btn btn-danger" href="#">
            <i class="fa fa-trash"></i>&nbsp;Delete
          </a>
      </td>
    </tr>
  <?php endforeach; ?>
<?php else: ?>
  <tr><td colspan="3"><h3>No records found.</h3></td></tr>
<?php endif; ?>
</tbody>
</table>
</div><!-- /.box-body -->
<div class="box-footer">
  <?php //echo $this->pagination->create_links(); ?>
</div><!-- /.box-footer -->
</div><!-- /.box -->
</section>

<?php $this->load->view('partials/modal'); ?>