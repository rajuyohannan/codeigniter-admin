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
        <?php $hidden = array('fileIds'=>''); ?>
        <?php echo form_open('','',$hidden); ?>
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
                'class' => 'form-control',
                ), '1', set_value('selfestimated')); ?>
                <?php echo form_label('Self Estimation', 'existing'); ?>
              </div>

              <div class="<?php echo form_error('EstimationRefernce') ? 'has-error' : ''; ?> form-group estimationRef <?php echo !$show_estimation_block ? '' : 'hidden'; ?>">
                <label for="EstimationRefernce">Estimation Reference<i class="fa fa-asterisk form-required"></i></label>
                <?php echo form_dropdown(
                  'EstimationRefernce', 
                  array('-1' => ' - SELECT - ', 'self' => '=SELF ESTIMATION=') + array(),
                  set_value('EstimationRefernce'),
                  array(
                    'id'   => 'EstimationRefernce',
                    'class' => 'form-control', 
                    )); ?>  
                  <?php if(form_error('EstimationRefernce')): ?>
                    <label for="inputError" class="control-label">
                      <i class="fa fa-times-circle-o"></i><?php echo form_error('EstimationRefernce'); ?>
                    </label>
                  <?php endif; ?>            
              </div>


              <div class="add-more_container <?php echo $show_estimation_block ? '' : 'hidden'; ?>">
                
                <div class="">
                  <div class="form-group <?php echo form_error('leadsource') ? 'has-error' : ''; ?>">
                    <label for="leadsource">Lead Source<i class="fa fa-asterisk form-required"></i></label>
                    <?php echo form_dropdown(
                      'leadsource', 
                      array('-1' => ' - SELECT - ') + $options['leadsource'],
                      set_value('leadsource'),
                      array(
                        'id'   => 'leadsource',
                        'class' => 'form-control', 
                        )); ?>          

                        <?php if(form_error('leadsource')): ?>
                          <label for="inputError" class="control-label">
                            <i class="fa fa-times-circle-o"></i><?php echo form_error('leadsource'); ?>
                          </label>
                        <?php endif; ?>
                            
                      </div>
                </div>
                <div class="row">
                  <div class="col-md-7">

                  <div class="form-group <?php echo form_error('department[]') ? 'has-error' : ''; ?>">
                        <?php if(form_error('department[]')): ?>
                          <label for="inputError" class="control-label">
                            <i class="fa fa-times-circle-o"></i><?php echo form_error('department[]'); ?>
                          </label>
                        <?php endif; ?>  
                        <?php echo form_input(array(
                          'name' => 'department[]', 
                          'class' => 'form-control', 
                          'placeholder' => 'Tasks',
                          'maxlength' => 255,
                          ), set_value('department[0]')); ?>
                  </div>
                  </div>
                  <div class="col-md-4 form-group <?php echo form_error('effort[]') ? 'has-error' : ''; ?>">
                    <?php if(form_error('effort[]')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('effort[]'); ?>
                      </label>
                    <?php endif; ?>
                    <div class="input-group ">
                      <?php echo form_input(array(
                        'name' => 'effort[]', 
                        'class' => 'form-control',
                        'placeholder' => 'Estimated efforts', 
                        'maxlength' => 255,
                        ), set_value('effort[0]')); ?>
                        <span class="input-group-addon">Hours</span>
                    </div>
                </div>
                </div>
                <?php if($estimation_rows): ?>
                  <?php for($i=1; $i < $estimation_rows; $i++): ?>
                  <div class="row">
                  <div class="col-md-7">
                    <div class="form-group  <?php echo form_error('department[]') ? 'has-error' : ''; ?>">
                      <?php echo form_input(array(
                      'name' => 'department[]', 
                      'class' => 'form-control', 
                      'placeholder' => 'Department',
                      'maxlength' => 255,
                      ), set_value("department[$i]")); ?>
                    </div>
                  </div>
                  <div class="col-md-4 form-group <?php echo form_error('effort[]') ? 'has-error' : ''; ?>">
                    <div class="input-group">
                      <?php echo form_input(array(
                      'name' => 'effort[]', 
                      'class' => 'form-control',
                      'placeholder' => 'Estimated efforts', 
                      'maxlength' => 255,
                      ), set_value("effort[$i]")); ?>
                    <span class="input-group-addon">Hours</span> 
                  </div>
                  </div>
                  <div class="col-md-1">
                    <span class="remove-rows label label-danger"><i class="fa fa-trash"></i></span>
                  </div>
                  </div>
                  <?php endfor; ?>
                <?php endif; ?>
              
            </div>
            <p class="addmore <?php echo $show_estimation_block ? '' : 'hidden'; ?> text-right"><a href="#">
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
                <div class="form-group <?php echo form_error('projectType') ? 'has-error' : ''; ?>">
                  <label for="projectType">Project Type<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'projectType', 
                    array('-1' => ' - SELECT - ') + $options['projecttype'],
                    set_value('projectType'),
                    array(
                      'class' => 'form-control', 
                      )); ?>    
                    <?php if(form_error('projectType')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('projectType'); ?>
                      </label>
                    <?php endif; ?>          
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group <?php echo form_error('projectTech[]') ? 'has-error' : ''; ?>">
                  <label for="projectTech">Technologies<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'projectTech[]', 
                    $options['technologies'],
                    set_value('projectTech'),
                    array(
                      'class' => 'form-control', 
                      'id' => 'projectTech',
                      'multiple' => 'multiple',
                      )); ?>  
                    <?php if(form_error('projectTech[]')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('projectTech[]'); ?>
                      </label>
                    <?php endif; ?>             
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group <?php echo form_error('projectStage') ? 'has-error' : ''; ?>">
                  <label for="projectStage">Project Stage<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'projectStage', 
                    array('-1' => ' - SELECT - ') + $options['project stage'],
                    set_value('projectStage'),
                    array(
                      'class' => 'form-control', 
                      )); ?> 
                    <?php if(form_error('projectStage')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('projectStage'); ?>
                      </label>
                    <?php endif; ?>              
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group <?php echo form_error('projectCodebase') ? 'has-error' : ''; ?>">
                  <label for="projectCodebase">Codebase<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'projectCodebase', 
                    array('-1' => ' - SELECT - ') + $options['codebase'],
                    set_value('projectCodebase'),
                    array(
                      'class' => 'form-control', 
                      )); ?>  
                    <?php if(form_error('projectCodebase')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('projectCodebase'); ?>
                      </label>
                    <?php endif; ?>                 
                </div>
              </div>
            </div>             

            <div class="form-group">
              <label>Risk Identified</label>
                <?php echo form_textarea(array(
                  'name' => 'risk', 
                  'id'   => 'risk',
                  'class' => 'form-control', 
                  'rows'  => '4',
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
                <div class="form-group <?php echo form_error('projectCurrency') ? 'has-error' : ''; ?>">
                  <label for="projectCurrency">Currency <i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'projectCurrency', 
                    array('-1' => ' - SELECT - ') + $options['currency'],
                    set_value('projectCurrency'),
                    array(
                      'class' => 'form-control', 
                      )); ?>  
                    <?php if(form_error('projectCurrency')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('projectCurrency'); ?>
                      </label>
                    <?php endif; ?>              
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group <?php echo form_error('orderValue') ? 'has-error' : ''; ?>">
                <label for="orderValue">Order Value<i class="fa fa-asterisk form-required"></i></label>
                <div class="input-group ">
                    <?php echo form_input(array(
                      'name' => 'orderValue', 
                      'id'   => 'orderValue',
                      'class' => 'form-control', 
                      'maxlength' => 255,
                      'value' => set_value('orderValue'),
                      )); ?>
                      <span class="input-group-addon">.00</span>         
                </div>
                    <?php if(form_error('orderValue')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('orderValue'); ?>
                      </label>
                    <?php endif; ?>     
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <?php echo form_label('Marketplace fees Included?', 'marketfee'); ?>
                  <br/>
                  <?php echo form_checkbox(array(
                    'name' => 'marketfee', 
                    'id'   => 'marketfee',
                    'class' => 'form-control input-lg',
                    'checked' => true, 
                    ), '1'); ?> Yes
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group <?php echo form_error('advanceAmount') ? 'has-error' : ''; ?>">
                <label for="advanceAmount">Advance Amount<i class="fa fa-asterisk form-required"></i></label>
                <div class="input-group">
                  <?php echo form_input(
                    array(
                      'name' => 'advanceAmount',
                      'class' => 'form-control', 
                      )); ?> 
                      <span class="input-group-addon">.00</span>
                </div>
                <?php if(form_error('advanceAmount')): ?>
                  <label for="inputError" class="control-label">
                    <i class="fa fa-times-circle-o"></i><?php echo form_error('advanceAmount'); ?>
                  </label>
                <?php endif; ?> 
              </div>
            </div>
              <div class="col-md-6">
                <label for="receivedOn">Received On</label>
                <div class="input-group" id='datetimepicker-received'>
                   <?php echo form_input(array(
                        'name' => 'receivedOn',
                        'id'   => 'receivedOn',
                        'class' => 'form-control',
                        'placeholder' => 'mm/dd/yyyy',
                        'value' => set_value('receivedOn'),
                        'autocomplete' => false,
                      ));
                    ?>  
                  <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                  </span>         
                </div>
              </div>
            </div>
            <div>
            <h4 class="distribution-tech <?php echo $show_label ? '' : 'hidden'; ?>">Domain wise distribution of value</h4>
            <?php foreach($options['technologies'] as $id => $tech):?>

                <div style="<?php echo ${"show_" . $id} == true ? "" : "display:none;"?>" class="row row-<?php echo $id; ?>">
                  <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_input(array(
                          'name' => "domain[$id]", 
                          'class' => 'form-control', 
                          'maxlength' => 255,
                          'disabled'  => 'disabled',
                          'value' => $tech,
                          )); ?>
                    </div>
                  </div>
                  <div class="col-md-6 form-group <?php echo form_error("distribution[$id]") ? 'has-error' : ''; ?>">
                    <div class="input-group">
                        <?php echo form_input(array(
                          'name' => "distribution[$id]", 
                          'placeholder' => 'Value for domain',
                          'class' => 'form-control', 
                          'maxlength' => 255,
                          ), set_value("distribution[$id]")); ?>
                          <span class="input-group-addon">.00</span>
                    </div>
                    
                    <?php if(form_error("distribution[$id]")): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error("distribution[$id]"); ?>
                      </label>
                    <?php endif; ?>   

                  </div>
                </div>
              <?php endforeach; ?>
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
                ), '1', set_value('existingclient')); ?>
                <?php echo form_label('Existing Client', 'existing'); ?>
              </div>
              
              <div class="existingClientBlock <?php echo $show_existing ? '' : 'hidden'; ?>">
                <div class="form-group <?php echo form_error('clientId') ? 'has-error' : ''; ?>">
                  <label for="clientId">Select Client<i class="fa fa-asterisk form-required"></i></label>
                  <?php echo form_dropdown(
                    'clientId', 
                    array('-1' => ' - Select - ', 'add-client' => ' = ADD CLIENT = '),
                    set_value('clientId'),
                    array(
                      'id'   => 'clientId',
                      'class' => 'form-control', 
                      )); ?>   
                    <?php if(form_error('clientId')): ?>
                      <label for="inputError" class="control-label">
                        <i class="fa fa-times-circle-o"></i><?php echo form_error('clientId'); ?>
                      </label>
                    <?php endif; ?>            
                </div>
              </div>

              <div class="newClientBlock <?php echo !$show_existing ? '' : 'hidden'; ?>">
                <div class="form-group <?php echo form_error('clientName') ? 'has-error' : ''; ?>">
                  <label>Name <i class="fa fa-asterisk form-required"></i></label>
                      <?php echo form_input(array(
                        'name' => 'clientName', 
                        'id' => 'clientName', 
                        'class' => 'form-control', 
                        'maxlength' => 255,
                        'value' => set_value('clientName'),
                        )); ?>
                      <?php if(form_error('clientName')): ?>
                        <label for="inputError" class="control-label">
                          <i class="fa fa-times-circle-o"></i><?php echo form_error('clientName'); ?>
                        </label>
                      <?php endif; ?>   
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group <?php echo form_error('clientEmail') ? 'has-error' : ''; ?>">
                      <label for="clientEmail">Email <i class="fa fa-asterisk form-required"></i></label>
                          <?php echo form_input(array(
                            'name' => 'clientEmail', 
                            'id' => 'clientEmail',
                            'class' => 'form-control', 
                            'maxlength' => 255,
                            'value' => set_value('clientEmail'),
                            )); ?>
                      <?php if(form_error('clientEmail')): ?>
                        <label for="inputError" class="control-label">
                          <i class="fa fa-times-circle-o"></i><?php echo form_error('clientEmail'); ?>
                        </label>
                      <?php endif; ?>   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group <?php echo form_error('clientPhone') ? 'has-error' : ''; ?>">
                      <label for="clientPhone">Phone Number <i class="fa fa-asterisk form-required"></i></label>
                          <?php echo form_input(array(
                            'name' => 'clientPhone',
                            'id' => 'clientPhone', 
                            'class' => 'form-control', 
                            'maxlength' => 255,
                            'value' => set_value('clientPhone'),
                            )); ?>
                        <?php if(form_error('clientPhone')): ?>
                          <label for="inputError" class="control-label">
                            <i class="fa fa-times-circle-o"></i><?php echo form_error('clientPhone'); ?>
                          </label>
                        <?php endif; ?>   
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="clientIm">IM</label>
                          <?php echo form_input(array(
                            'name' => 'clientIm', 
                            'id' => 'clientIm',
                            'class' => 'form-control', 
                            'maxlength' => 255,
                            'value' => set_value('clientIm'),
                            )); ?>
                      <p class="help-block">
                        example: skype:clientskypid
                      </p>

                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Timezone</label>
                        <?php echo timezone_menu('UM8', 'form-control', 'clientTimezone'); ?>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Address</label>
                      <?php echo form_textarea(array(
                        'name' => 'address', 
                        'class' => 'form-control', 
                        'rows' => 2,
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
                        'rows' => 4,
                        'value' => set_value('overview'),
                        )); ?>
                </div>

                <div class="form-group">
                  <label>Additional Notes</label>
                      <?php echo form_textarea(array(
                        'name' => 'notes', 
                        'class' => 'form-control', 
                        'rows' => 4,
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