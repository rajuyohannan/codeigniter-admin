<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <a href="<?php echo base_url('admin/bdms/doi'); ?>" class="btn btn-block btn-success btn-social">
          <i class="fa fa-angle-double-left"></i> Back to list
        </a>
      </div>
    </div>

    <div class="box-body">
      <div class="col-md-8">
        <?php if( null != validation_errors() ): ?>
          <div class="callout callout-danger">
            <h4>Validation error prevented DOI creation</h4>
            <p>DOI not created</p>
          </div>
        <?php endif; ?>
        <?php echo form_open(); ?>
        <p>Fields marked with <i class="fa fa-asterisk form-required"></i> are required.</p>
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-list-alt"></i>
            <h3 class="panel-title">Lead / Estimation Details</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <?php echo form_checkbox(array(
                'name' => 'selfestimated', 
                'id'   => 'selfestimated',
                'class' => 'form-control input-lg',
                'checked' => false, 
                ), '1'); ?>
                <?php echo form_label('Self Estimation', 'self'); ?>
              </div>
              <div class="form-group estimationRef">
                <label for="leadsource">Estimation Reference<i class="fa fa-asterisk form-required"></i></label>
                <?php echo form_dropdown(
                  'EstimationRefernce', 
                  array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                  set_value('estimation'),
                  array(
                    'id'   => 'estimation',
                    'class' => 'form-control', 
                    )); ?>              
              </div>
              <div class="add-more_container hidden">
              <div class="row">
                <div class="col-md-7">
                <div class="form-group">
                      <?php echo form_input(array(
                        'name' => 'department[]', 
                        'class' => 'form-control', 
                        'placeholder' => 'Department',
                        'maxlength' => 255,
                        'value' => set_value('department'),
                        )); ?>
                </div>
                </div>
                <div class="col-md-5">
                  <div class="input-group">
                    <?php echo form_input(array(
                      'name' => 'effort[]', 
                      'class' => 'form-control',
                      'placeholder' => 'Estimated efforts', 
                      'maxlength' => 255,
                      'value' => set_value('effort'),
                      )); ?>
                      <span class="input-group-addon">Hours</span>
                  </div>
              </div>
            </div>
            </div>
            <p class="addmore hidden text-right"><a href="#">
              <i class="fa fa-plus"></i> Add More</a>
            </p>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-newspaper-o"></i>
            <h3 class="panel-title">Project Details</h3>
          </div>
          <div class="panel-body">

           <div class="row">
            <div class="col-md-6">
              <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                <label for="title">Project Name<i class="fa fa-asterisk form-required"></i></label>
                    <?php echo form_input(array(
                      'name' => 'title', 
                      'id'   => 'title',
                      'class' => 'form-control', 
                      'maxlength' => 255,
                      'value' => set_value('title'),
                      )); ?>
                      <?php if(form_error('title')): ?>
                        <label for="inputError" class="control-label">
                          <i class="fa fa-times-circle-o"></i><?php echo form_error('title'); ?>
                        </label>
                      <?php endif; ?>
                      
              </div>            
            </div>
            <div class="col-md-6">
              <label>Project Timeline</label>
              <div class="input-group adjPad">
                    <?php echo form_input(array(
                      'name' => 'timeline', 
                      'id'   => 'timeline',
                      'class' => 'form-control', 
                      'maxlength' => 255,
                      'value' => set_value('timeline'),
                      )); ?>
                      <span class="input-group-addon">
                          <select>
                            <option>Days</option>
                            <option>Hours</option>
                          </select>
                      </span>
              </div> 
            </div>
           </div>



            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="leadsource">Project Type<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'type', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'class' => 'form-control', 
                      )); ?>              
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="leadsource">Technologies<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'type', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'class' => 'form-control', 
                      )); ?>              
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="leadsource">Project Stage<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'type', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'class' => 'form-control', 
                      )); ?>              
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="leadsource">Codebase<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'type', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'class' => 'form-control', 
                      )); ?>              
                </div>
              </div>
            </div>             

            <div class="form-group">
              <label>Risk Identified</label>
                <?php echo form_textarea(array(
                  'name' => 'risk', 
                  'id'   => 'risk',
                  'class' => 'form-control', 
                  'maxlength' => 255,
                  'value' => set_value('risk'),
                  )); ?>
            </div>


          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-dollar"></i>
            <h3 class="panel-title">Project Budget</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="leadsource">Currency <i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'type', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'class' => 'form-control', 
                      )); ?>              
                </div>
              </div>
              <div class="col-md-4">
                <label for="leadsource">Order Value<i class="fa fa-asterisk form-required"></i></label>
                <div class="input-group">
                    <?php echo form_input(array(
                      'name' => 'value', 
                      'id'   => 'value',
                      'class' => 'form-control', 
                      'maxlength' => 255,
                      'value' => set_value('value'),
                      )); ?>
                      <span class="input-group-addon">.00</span>         
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <?php echo form_label('Marketplace fees Included?', 'self'); ?>
                  <br/>
                  <?php echo form_checkbox(array(
                    'name' => 'selfestimated', 
                    'id'   => 'selfestimated',
                    'class' => 'form-control input-lg',
                    'checked' => true, 
                    ), '1'); ?> Yes
                    
                </div>



              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="leadsource">Advance Amount<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'type', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'class' => 'form-control', 
                      )); ?>              
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="leadsource">Received On<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'type', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'class' => 'form-control', 
                      )); ?>              
                </div>
              </div>
            </div>

            <h4>Domain wise distribution of value</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <?php echo form_input(array(
                      'name' => 'distribution[]', 
                      'class' => 'form-control', 
                      'maxlength' => 255,
                      'disabled'  => 'disabled',
                      'value' => 'iOS',
                      )); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                    <?php echo form_input(array(
                      'name' => 'domain[]', 
                      'placeholder' => 'Value for domain',
                      'class' => 'form-control', 
                      'maxlength' => 255,
                      )); ?>
                      <span class="input-group-addon">.00</span>
                </div>
              </div>
            </div>
            
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-user-plus"></i>
            <h3 class="panel-title">Client Details</h3>
          </div>
          <div class="panel-body">

            <div class="form-group">
              <?php echo form_checkbox(array(
                'name' => 'existingclient', 
                'id'   => 'existingclient',
                'class' => 'form-control input-lg',
                'checked' => false, 
                ), '1'); ?>
                <?php echo form_label('Existing Client', 'existing'); ?>
              </div>
              
              <div class="existingClientBlock hidden">

                <div class="form-group">
                  <label for="leadsource">Select Client<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'EstimationRefernce', 
                    array('-1' => ' - Select - ', 'self' => ' - SELF ESTIMATION - ', 'public' => 'Public Groups', 'private' => 'Private Groups'),
                    set_value('estimation'),
                    array(
                      'id'   => 'estimation',
                      'class' => 'form-control', 
                      )); ?>              
                </div>

              </div>

              <div class="newClientBlock">
                <div class="form-group">
                  <label>Name</label>
                      <?php echo form_input(array(
                        'name' => 'clientName', 
                        'class' => 'form-control', 
                        'maxlength' => 255,
                        'value' => set_value('clientName'),
                        )); ?>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                          <?php echo form_input(array(
                            'name' => 'email', 
                            'class' => 'form-control', 
                            'maxlength' => 255,
                            'value' => set_value('email'),
                            )); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                          <?php echo form_input(array(
                            'name' => 'phone', 
                            'class' => 'form-control', 
                            'maxlength' => 255,
                            'value' => set_value('phone'),
                            )); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>IM</label>
                          <?php echo form_input(array(
                            'name' => 'im', 
                            'class' => 'form-control', 
                            'maxlength' => 255,
                            'value' => set_value('im'),
                            )); ?>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Timezone</label>
                            <?php echo form_input(array(
                              'name' => 'timezone', 
                              'class' => 'form-control', 
                              'maxlength' => 255,
                              'value' => set_value('timezone'),
                              )); ?>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Address</label>
                      <?php echo form_textarea(array(
                        'name' => 'address', 
                        'class' => 'form-control', 
                        'maxlength' => 255,
                        'value' => set_value('address'),
                        )); ?>
                </div>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="icon fa fa-info-circle"></i>
            <h3 class="panel-title">Additional Information</h3>
          </div>
          <div class="panel-body">


                <div class="form-group">
                  <label>Project Overview</label>
                      <?php echo form_textarea(array(
                        'name' => 'overview', 
                        'class' => 'form-control', 
                        'maxlength' => 255,
                        'value' => set_value('overview'),
                        )); ?>
                </div>

                <div class="form-group">
                  <label>Additional Notes</label>
                      <?php echo form_textarea(array(
                        'name' => 'notes', 
                        'class' => 'form-control', 
                        'maxlength' => 255,
                        'value' => set_value('notes'),
                        )); ?>
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
          </div>
        </div>


        <div class="row">
          <div class="col-xs-8">
          </div><!-- /.col -->         
          <div class="col-xs-4">
            <?php echo form_submit('submit', 'Submit DOI  ', array('class' => 'input-lg btn-block btn btn-primary btn-flat')); ?>
          </div><!-- /.col -->
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</section>