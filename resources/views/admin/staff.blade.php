@extends('admin.layouts.app')

@section('content')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staff
      </h1>
    </section>

      <!-- Main content -->
      <section class="content">

        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12">

            <div class="row">
              <div class="col-md-12">
                @if( !$errors->isEmpty() )
                      <div class="alert alert-danger">
                          <ul>
                              @foreach( $errors->all() as $error )
                              <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                      @endif
              </div>
            </div>

              <div class="row">
                <div class="col-md-12">

                  @if(session()->has('message'))
                          <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {{ session()->get('message') }}
                          </div>
                          @endif

                </div>
              </div>


            <div class="row user-container">

               <!--OVERVIEW-->

                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">GRADUATE'S</span>
                                  <span class="info-box-number">90<small>%</small></span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-search"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">TRACE</span>
                                  <span class="info-box-number">41,410</span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">UNTRACED</span>
                                  <span class="info-box-number">2,000</span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                             <!-- /.col -->
                            <!-- fix for small devices only -->
                            <div class="clearfix visible-sm-block"></div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-briefcase"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">JOB</span>
                                  <span class="info-box-number">760</span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                          </div>




                          <div class="col-md-4 user-list" id="user-list">
                                <!--Table hover-->
                                <div class="box box-danger">
                    
                                      <!-- /.box-header -->
                                      <div class="box-body no-padding">
                                        <ul class="users-list clearfix">
                                          <li>
                                            <img src="{{Auth::user()->avatar}}" alt="User Image">
                                              <a class="users-list-name" href="#">{{ Auth::user()->firstname }}</a>
                                            <span class="users-list-date">Today</span>
                                          </li>
                                          <li>
                                            <img src="dist/img/user8-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Norman</a>
                                            <span class="users-list-date">Yesterday</span>
                                          </li>
                                          <li>
                                            <img src="dist/img/user7-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Jane</a>
                                            <span class="users-list-date">12 Jan</span>
                                          </li>
                                          <li>
                                            <img src="dist/img/user6-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">John</a>
                                            <span class="users-list-date">12 Jan</span>
                                          </li>
                                          <li>
                                            <img src="dist/img/user2-160x160.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Alexander</a>
                                            <span class="users-list-date">13 Jan</span>
                                          </li>
                                          <li>
                                            <img src="dist/img/user5-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Sarah</a>
                                            <span class="users-list-date">14 Jan</span>
                                          </li>
                                          <li>
                                            <img src="dist/img/user4-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Nora</a>
                                            <span class="users-list-date">15 Jan</span>
                                          </li>
                                          <li>
                                            <img src="dist/img/user3-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Nadia</a>
                                            <span class="users-list-date">15 Jan</span>
                                          </li>
                                        </ul>
                                        <!-- /.users-list -->
                                      </div>
                                      <!-- /.box-body -->
                                      <div class="box-footer text-center">
                                        <a href="javascript:void(0)" class="uppercase">View All Users</a>
                                      </div>
                                      <!-- /.box-footer -->
                                    </div>
                               
                            </div>


                              <div class="col-md-8 user-list" id="user-list">

                                   <div class="box">
                                    <div class="box-header">
                                      <h3 class="box-title">Note</h3>
                                      <div class="addNote pull-right">
                                        <button type="button" class="btn btn-block btn-primary">ADD NOTE</button>
                                      </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                      <table id="event-table" class="display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Task</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                       
                                        </tbody>
                                    </table>
                                    </div>
                                    <!-- /.box-body -->
                                  </div>

                              </div>



                          
            </div>


            </div>





          </section>


      </div>
      <!-- /.row (main row) -->








        @include('admin.footer.footer')


        





@endsection
 