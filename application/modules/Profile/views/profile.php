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
                      <img alt="User Avatar" src="<?php echo base_url('assets/images/user7-128x128.jpg'); ?>" class="img-circle">
                      <div class="upload__progress">Uploading&hellip;</div>

                      <div class="upload__link hidden">
                        <a class="upload-link js-fileapi-wrapper">
                          <span class="upload-link__txt ">UPLOAD</span>
                          <input class="upload-link__inp" name="photo" type="file" accept=".jpg,.jpeg,.gif" />
                        </a>
                      </div>
                    </form>

                    
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username"><?php echo $auth_user_name; ?></h3>
                  <h5 class="widget-user-desc">Lead Developer</h5>
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
                  <strong><i class="fa fa-book margin-r-5"></i>  Education</strong>
                  <p class="text-muted">
                    B.S. in Computer Science from the University of Tennessee at Knoxville
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted">Malibu, California</p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                  <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Node.js</span>
                  </p>

                  <hr>

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#activity">Activity</a></li>
                  <li><a data-toggle="tab" href="#timeline">Notifications</a></li>
                  <li><a data-toggle="tab" href="#settings">Profile</a></li>
                  <li><a data-toggle="tab" href="#account">Account settings</a></li>
                  <li><a data-toggle="tab" href="#password">Change Password</a></li>
                </ul>
                <div class="tab-content">
                  <div id="activity" class="active tab-pane">
                    <!-- Post -->
                    <div class="post">
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

                      <input type="text" placeholder="Type a comment" class="form-control input-sm">
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
                  <div id="timeline" class="tab-pane">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs">Read more</a>
                            <a class="btn btn-danger btn-xs">Delete</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                          <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-comments bg-yellow"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-camera bg-purple"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                          <div class="timeline-body">
                            <img class="margin" alt="..." src="http://placehold.it/150x100">
                            <img class="margin" alt="..." src="http://placehold.it/150x100">
                            <img class="margin" alt="..." src="http://placehold.it/150x100">
                            <img class="margin" alt="..." src="http://placehold.it/150x100">
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div><!-- /.tab-pane -->

                  <div id="settings" class="tab-pane">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Name</label>
                        <div class="col-sm-10">
                          <input type="email" placeholder="Name" id="inputName" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail">Email</label>
                        <div class="col-sm-10">
                          <input type="email" placeholder="Email" id="inputEmail" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Name</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Name" id="inputName" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputExperience">Experience</label>
                        <div class="col-sm-10">
                          <textarea placeholder="Experience" id="inputExperience" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputSkills">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Skills" id="inputSkills" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button class="btn btn-danger" type="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->

                  <div id="account" class="tab-pane">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Name</label>
                        <div class="col-sm-10">
                          <input type="email" placeholder="Name" id="inputName" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail">Email</label>
                        <div class="col-sm-10">
                          <input type="email" placeholder="Email" id="inputEmail" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Name</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Name" id="inputName" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputExperience">Experience</label>
                        <div class="col-sm-10">
                          <textarea placeholder="Experience" id="inputExperience" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputSkills">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Skills" id="inputSkills" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button class="btn btn-danger" type="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->

                  <div id="password" class="tab-pane">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Name</label>
                        <div class="col-sm-10">
                          <input type="email" placeholder="Name" id="inputName" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail">Email</label>
                        <div class="col-sm-10">
                          <input type="email" placeholder="Email" id="inputEmail" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Name</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Name" id="inputName" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputExperience">Experience</label>
                        <div class="col-sm-10">
                          <textarea placeholder="Experience" id="inputExperience" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputSkills">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Skills" id="inputSkills" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button class="btn btn-danger" type="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->



        </section>