<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/bdms/estimations'); ?>" class="btn btn-block btn-success btn-social">
            <i class="fa fa-angle-double-left"></i> Back to list
         </a>
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-6">

      <?php if( null != validation_errors() ): ?>
        <div class="callout callout-danger">
          <h4>The following error prevented estimation assignment.</h4>
        </div>
      <?php endif; ?>
      <?php $hidden = array('fileIds' => ''); ?>
      <?php echo form_open('','',$hidden); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>

      <div class="form-group <?php echo form_error('leadsource') ? 'has-error' : ''; ?>">
        <label for="leadsource">Lead Source<i class="fa fa-asterisk form-required"></i></label>
        <?php echo form_dropdown(
          'leadsource', 
          $leadsource,
          set_value('leadsource'),
          array(
            'id'   => 'leadsource',
            'class' => 'form-control input-lg', 
            )); ?>          

            <?php if(form_error('leadsource')): ?>
              <label for="inputError" class="control-label">
                <i class="fa fa-times-circle-o"></i><?php echo form_error('leadsource'); ?>
              </label>
            <?php endif; ?>
                
          </div>

        <div class="form-group  <?php echo form_error('title') ? 'has-error' : ''; ?>">
          <label for="title">Title <i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_input(array(
            'name' => 'title', 
            'id'   => 'title',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Estimation title',
            'maxlength' => 255,
            'value' => set_value('title'),
            )); ?>
            <?php if(form_error('title')): ?>
              <label for="inputError" class="control-label">
                <i class="fa fa-times-circle-o"></i><?php echo form_error('title'); ?>
              </label>
            <?php endif; ?>
          </div>

        <div class="form-group <?php echo form_error('description') ? 'has-error' : ''; ?>">
          <label for="email">Description<i class="fa fa-asterisk form-required"></i></label>
          <?php echo form_textarea(array(
            'name' => 'description', 
            'id'   => 'description',
            'class' => 'form-control input-lg', 
            'placeholder' => 'Enter description about the estimation being created',
            'value' => set_value('description'),
            )); ?>
            <?php if(form_error('description')): ?>
              <label for="inputError" class="control-label">
                <i class="fa fa-times-circle-o"></i><?php echo form_error('description'); ?>
              </label>
            <?php endif; ?>
          </div>
          
          <div class="form-group">
            <div class="b-button js-fileapi-wrapper btn btn-primary btn-flat">
              <div class="b-button__text"> <i class="fa fa-file"></i> Attach files</div>
              <?php echo form_upload(array(
                'name' => 'files', 
                'id'   => 'files',
                'class' => 'b-button__input', 
                'multiple' => 'multiple',
                'value' => set_value('files'),
                )); ?>
              </div>


              <div id="preview" style="margin-top: 30px"></div>

              <script id="b-file-ejs" type="text/ejs">
                <div id="file-<%=FileAPI.uid(file)%>" class="js-file b-file b-file_<%=file.type.split('/')[0]%>">
                  <div class="js-left b-file__left">
                    <img src="<%=icon[file.type.split('/')[0]]||icon.def%>" width="32" height="32" style="margin: 2px 0 0 3px"/>
                  </div>
                  <div class="b-file__right">
                    <div><a class="js-name b-file__name"><%=file.name%></a></div>
                    <div class="js-info b-file__info">size: <%=(file.size/FileAPI.KB).toFixed(2)%> KB</div>
                    <div class="js-progress b-file__bar" style="display: none">
                      <div class="b-progress"><div class="js-bar b-progress__bar"></div></div>
                    </div>
                  </div>
                  <i class="js-abort b-file__abort" title="abort">&times;</i>
                </div>
              </script>
              <script id="b-layer-ejs" type="text/ejs">
                <div class="b-layer">
                  <div class="b-layer__h1"><%=file.name%></div>
                  <div class="js-img b-layer__img"></div>
                  <div class="b-layer__info">
                    <%
                    FileAPI.each(info, function(val, key){
                      if( Object.prototype.toString.call(val) == '[object Object]' ){
                        var sub = '';
                        FileAPI.each(val, function (val, key){ sub += '<div>'+key+': '+val+'</div>'; });
                        if( sub ){
                          %><%=key%><div style="margin: 0 0 5px 20px;"><%=sub%></div><%
                        }
                      } else {
                    %>
                      <div><%=key%>: <%=val%></div>
                    <%
                      }
                    });
                    %>
                  </div>
                </div>
              </script>
            </div>
         <div class="form-group <?php echo form_error('assignTo[]') ? 'has-error' : ''; ?>">
          <label for="assignTo">Select Assignee<i class="fa fa-asterisk form-required"></i></label>
             <?php echo form_multiselect(
                'assignTo[]', 
                '',
                set_value('assignTo'),
                array(
                'id'   => 'assignTo',
                'class' => 'form-control', 
                "multiple" => "multiple",
                "style" => 'width:100%',
              )); ?>
              <?php if(form_error('assignTo[]')): ?>
                <label for="inputError" class="control-label">
                  <i class="fa fa-times-circle-o"></i><?php echo form_error('assignTo[]'); ?>
                </label>
              <?php endif; ?>
         </div>
         <div class="form-group <?php echo form_error('scheduledOn') ? 'has-error' : ''; ?>">
           <label for="scheduledOn">Scheduled Completion<i class="fa fa-asterisk form-required"></i></label>
           <div class='input-group date' id='datetimepicker-scheduled'>
           <?php echo form_input(array(
                'name' => 'scheduledOn',
                'id'   => 'scheduledOn',
                'class' => 'form-control input-lg',
                'placeholder' => 'mm/dd/yyyy hh:mm',
                'value' => set_value('scheduledOn'),
                'autocomplete' => false,
              ));
            ?>
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
              </div>
              <?php if(form_error('scheduledOn')): ?>
                <label for="inputError" class="control-label">
                  <i class="fa fa-times-circle-o"></i><?php echo form_error('scheduledOn'); ?>
                </label>
              <?php endif; ?>
          </div>

          <div class="row">
           <div class="col-xs-8">
          </div><!-- /.col -->         
            <div class="col-xs-4">
              <?php echo form_submit('submit', 'Assign', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
            </div><!-- /.col -->
          </div>
      <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>