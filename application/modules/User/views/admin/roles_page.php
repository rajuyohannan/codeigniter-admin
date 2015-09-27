<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div>
    <div class="box-body">
      <div class="col-md-6">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Role Name</th>
            <th>Actions</th>
          </tr>
          <?php foreach($roles as $key => $role): ?>
            <tr>
              <td><?php echo ucfirst($role); ?></td>
              <td><a href="<?php echo base_url('admin/users/manage/permission/'.$key); ?>" class="btn btn-primary">Permissions</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</section>