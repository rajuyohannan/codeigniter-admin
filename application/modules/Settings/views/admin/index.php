<section class="content">
	  <!-- Default box -->
	<div class="row">
		<?php $count = 1; ?>
		<?php $categoryList = array('0' => '- SELECT -') + $categoryList; ?>
		<?php foreach($categories as $key => $category):?>
			<div class="col-md-6">
			  <div class="info-box small-box <?php print $this->config->item('site_palette_disabled'); ?>">
			    <span class="info-box-icon"><i class="fa fa-<?php echo $category['icon']; ?>"></i></span>
			    <div class="info-box-content">
			      <span class="info-box-text"><?php print ucfirst($category['name']); ?></span>
				  <?php if(!$category['catid']): ?>
			      <?php $hidden = array('category' => $key); ?>
			      <?php echo form_open('', '', $hidden); ?>
			     		<div class="col-md-6">
					      	<div class="form-group">
								<?php echo form_dropdown(
									'categoryId', 
									$categoryList, 
									'', 
									array('class' => 'form-control categoriesSelect'
								)); ?>
					      	</div>
			     		</div>
			      <?php echo form_close(); ?>
				  <?php endif; ?>
			    </div><!-- /.info-box-content -->
			  <?php if($category['catid']): ?>
				<a class="small-box-footer" href="<?php echo base_url('admin/terms/'.$category['catid']); ?>">
				  Manage Terms <i class="fa fa-arrow-circle-right"></i>
				</a>
			  <?php endif; ?>
			  </div><!-- /.info-box -->
			</div>
			<?php $count++; ?>
		<?php endforeach; ?>
	</div>

</section>