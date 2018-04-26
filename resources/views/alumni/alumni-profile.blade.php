@extends('alumni.alumni-app')

@section('content')
	   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alumni Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="form-group">
                <span>
                  <img class="profile-user-img img-responsive img-profile" src="{{ Auth::user()->avatar }}" alt="User profile picture">
                </span>
                 <a href="">
                  <i class="fa fa-camera bg-purple"></i>
                  <input type="file" accept="image/*" capture="camera">
                 </a>
                <h3 class="profile-username text-center">
                	<span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                </h3>
              </div>
              <p class="text-muted text-center">{{ Auth::user()->job_title }}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
              
                <!-- Post -->
                <div class="post">
          
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
              </div>


              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  
                  <div class="row">
                    <div class="col-md-6">

                         
                          <div class="form-group">
                             <span class="input-group-addon" >About me</span>
                             <input type="text" name="title" class="form-control"/>
                             <small class="help-block with-errors form-error title"></small>
                          </div>

                          <div class="form-group">
                             <span class="input-group-addon" >Title</span>
                             <input type="text" name="title" class="form-control"/>
                             <small class="help-block with-errors form-error title"></small>
                          </div>

                    </div>

                    <div class="col-md-6">
                          <div class="form-group">
                             <span class="input-group-addon" >Title</span>
                             <input type="text" name="title" class="form-control"/>
                             <small class="help-block with-errors form-error title"></small>
                          </div>

                          <div class="form-group">
                             <span class="input-group-addon" >Title</span>
                             <input type="text" name="title" class="form-control"/>
                             <small class="help-block with-errors form-error title"></small>
                          </div>
                    </div>

                  </div>

                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

    @include('admin.footer.footer')



@endsection
 