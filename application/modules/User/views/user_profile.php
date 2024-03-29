<?php print smiley_js(); ?>
<section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
            <div >
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header <?php echo $this->config->item('site_palette_active'); ?>">
                  <div class="widget-user-image">

                    <form name="userpic" class="upload">
                      <div id="preview" class="upload__preview"></div>
                      <img alt="User Avatar" width="128" src="<?php echo base_url('assets/images/default-male.jpg'); ?>" class="img-circle">
                      <div class="upload__progress">Uploading&hellip;</div>

                      <div class="upload__link hidden">
                        <a class="upload-link js-fileapi-wrapper">
                          <span class="upload-link__txt ">UPLOAD</span>
                          <input class="upload-link__inp" name="photo" type="file" accept=".jpg,.jpeg,.gif" />
                        </a>
                      </div>
                    </form>

                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username">
                    <?php echo $user_profile['name'] ? $user_profile['name'] : $user_profile['user']['userName']; ?>
                  </h3>
                  <h5 class="widget-user-desc"><?php print ucfirst($auth_role); ?></h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="#">Active Projects <span class="pull-right badge bg-blue">31</span></a></li>
                    <li><a href="#">Open Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                    <li><a href="#">Alerts <span class="pull-right badge bg-green">12</span></a></li>
                    <li><a href="#">Open Bugs <span class="pull-right badge bg-red">8</span></a></li>
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div>

              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                  <strong><i class="fa fa-envelope margin-r-5"></i>Email Id</strong>
                  <p class="text-muted">
                    <?php echo $user_profile['user']['userEmail']; ?>
                  </p>
                  <hr>

                  <strong><i class="fa fa-phone margin-r-5"></i>Contact Number</strong>
                  <p class="text-muted">
                    <?php echo  $user_profile['contactNumber']; ?>
                  </p>

                  <hr>
                  <strong><i class="fa fa-calendar margin-r-5"></i>Date of Birth</strong>
                  <p class="text-muted">
                    <?php if($user_profile['dob']): ?>
                      <?php echo $user_profile['dob']->format('m/d/Y'); ?>
                    <?php endif; ?>
                  </p>

                  <hr>
                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted"><?php echo $user_profile['address']; ?></p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                  <p>
                    <?php foreach($userSkills as $key => $id): ?>
                      <span class="label label-primary"><?php echo $key; ?></span>
                    <?php endforeach; ?>                    
                  </p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-9">

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

              <?php if($this->session->flashdata('error')): ?>          
                <div class="callout callout-danger">
                  <h4>The following error prevented password updation</h4>
                  <ul>
                    <?php echo $this->session->flashdata('error'); ?>
                  </ul>
                </div>
              <?php endif; ?>

              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#activity">Latest Masti</a></li>
                  <li><a data-toggle="tab" href="#profile">Profile</a></li>
                  <li><a data-toggle="tab" href="#password">Change Password</a></li>
                </ul>
                <div class="tab-content">
                  <div id="activity" class="active tab-pane">
                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img alt="user image" src="<?php echo base_url('assets/images/user1-128x128.jpg'); ?>" class="img-circle img-bordered-sm">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                      </div><!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>
                      <ul class="list-inline">
                        <li><a class="link-black text-sm" href="#"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                        <li><a class="link-black text-sm" href="#"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
                        <li class="pull-right"><a class="link-black text-sm" href="#"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
                      </ul>
                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" placeholder="Press enter to post comment" id="comments" class="form-control input-sm comments">
                            <div class="input-group-addon emoji-show">
                              <i class="fa fa-smile-o"></i>
                            </div>
                          </div>

                        <ul class="emoji-list hidden">
                        <?php foreach($smiley_table as $key => $smilies): ?>
                          <?php foreach($smilies as $smily): ?>
                            <li>
                              <?php print $smily; ?>
                            </li>
                          <?php endforeach; ?>
                        <?php endforeach; ?>
                        </ul>
                      </div>
                    </div><!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img alt="user image" src="<?php echo base_url('assets/images/user7-128x128.jpg'); ?>" class="img-circle img-bordered-sm">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div><!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="form-group margin-bottom-none">
                          <div class="col-sm-9">
                            <input placeholder="Response" class="form-control input-sm">
                          </div>                          
                          <div class="col-sm-3">
                            <button class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                          </div>                          
                        </div>                        
                      </form>
                    </div><!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img alt="user image" src="<?php echo base_url('assets/images/user6-128x128.jpg'); ?>" class="img-circle img-bordered-sm">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Posted 5 photos - 5 days ago</span>
                      </div><!-- /.user-block -->
                      <div class="row margin-bottom">
                        <div class="col-sm-6">
                          <img alt="Photo" src="<?php echo base_url('assets/images/photo1.png'); ?>" class="img-responsive">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-6">
                              <img alt="Photo" src="<?php echo base_url('assets/images/photo2.png'); ?>" class="img-responsive">
                              <br>
                              <img alt="Photo" src="<?php echo base_url('assets/images/photo3.jpg'); ?>" class="img-responsive">
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                              <img alt="Photo" src="<?php echo base_url('assets/images/photo4.jpg'); ?>" class="img-responsive">
                              <br>
                              <img alt="Photo" src="<?php echo base_url('assets/images/photo1.png'); ?>" class="img-responsive">
                            </div><!-- /.col -->
                          </div><!-- /.row -->
                        </div><!-- /.col -->
                      </div><!-- /.row -->

                      <ul class="list-inline">
                        <li><a class="link-black text-sm" href="#"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                        <li><a class="link-black text-sm" href="#"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
                        <li class="pull-right"><a class="link-black text-sm" href="#"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
                      </ul>

                      <input type="text" placeholder="Type a comment" class="form-control input-sm">
                    </div><!-- /.post -->
                  </div><!-- /.tab-pane -->

                  <div id="profile" class="tab-pane">
                    <?php echo form_open('user/profile/update', array('class' => 'form-horizontal')); ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">Name</label>
                        <div class="col-sm-10">
                          <?php echo form_input(array(
                                'name' => 'name', 
                                'id'   => 'name',
                                'class' => 'form-control', 
                                'placeholder' => 'Full name',
                                'autocomplete' => 'off',
                                'maxlength' => 255,
                                'value' => $user_profile['name'],
                          )); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="email">Email</label>
                        <div class="col-sm-10">
                          <?php echo form_input(array(
                                'name' => 'email', 
                                'id'   => 'email',
                                'class' => 'form-control', 
                                'placeholder' => 'Email id',
                                'autocomplete' => 'off',
                                'maxlength' => 255,
                                'value' => $user_profile['user']['userEmail'],
                                'disabled' => 'disabled'
                          )); ?>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="contact">Contact Number</label>
                        <div class="col-sm-10">
                          <?php echo form_input(array(
                                'name' => 'contact', 
                                'id'   => 'contact',
                                'class' => 'form-control', 
                                'autocomplete' => 'off',
                                'placeholder'=> 'Contact number',
                                'maxlength' => 255,
                                'value' => $user_profile['contactNumber']
                          )); ?>
                        </div>
                      </div>
                   <div class="form-group">
                        <label class="col-sm-2 control-label" for="address">Address</label>
                        <div class="col-sm-10">
                          <?php echo form_textarea(array(
                                'name' => 'address', 
                                'id'   => 'address',
                                'class' => 'form-control', 
                                'rows'  => 2,
                                'value' => $user_profile['address'],
                          )); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Date of Birth</label>
                        <div class="col-sm-10">
                          <?php echo form_input(array(
                                'name' => 'dob', 
                                'id'   => 'dob',
                                'class' => 'form-control', 
                                'placeholder' => 'mm/dd/yyyy',
                                'autocomplete' => 'off',
                                'maxlength' => 255,
                                'value' => $user_profile['dob'] ? $user_profile['dob']->format('m/d/Y') : ''
                          )); ?>
                        </div>
                      </div>  
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="skills">Skills</label>
                        <div class="col-sm-10">
                        
                         <?php echo form_multiselect(
                            'skills[]', 
                            $skills,
                            $userSkills,
                            array(
                            'id'   => 'skills',
                            'class' => 'form-control', 
                            "multiple" => "multiple",
                            "style" => 'width:100%',
                          )); ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <?php echo form_submit('submit', 'Update Profile', array('class' => 'btn btn-danger btn-flat')); ?>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->

                  <div id="password" class="tab-pane">
                    <?php echo form_open('user/profile/password', array('class' => 'form-horizontal')); ?>
                      <div class="form-group">
                        <?php echo form_label('Current Password', 'currentPassword', array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-8">
                          <?php echo form_password(
                            'currentPassword',
                            '',
                            array(
                              'id' => 'currentPassword',
                              'class' => 'form-control',
                              'placeholder' => 'Current Password'
                            )
                          ); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <?php echo form_label('New Password', 'password', array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-8">
                          <?php echo form_password(
                            'password',
                            '',
                            array(
                              'id' => 'password',
                              'class' => 'form-control',
                              'placeholder' => 'New Password'
                            )
                          ); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <?php echo form_label('Confirm Password', 'confirmPassword', array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-8">
                          <?php echo form_password(
                            'confirmPassword',
                            '',
                            array(
                              'id' => 'confirmPassword',
                              'class' => 'form-control',
                              'placeholder' => 'Confirm new password'
                            )
                          ); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <?php echo form_submit('submit', 'Update Password', array('class' => 'btn btn-danger btn-flat')); ?>
                        </div>
                      </div>
                    <?php echo form_close(); ?>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->



        </section>