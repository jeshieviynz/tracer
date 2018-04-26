@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small> > Add User</small>
      </h1>
    </section>





    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">

             <!--OVERVIEW-->
                      @if(session()->has('message'))
                      <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{ session()->get('message') }}
                      </div>
                      @endif

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading align-center">New user</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                                            {{ csrf_field() }}
                                            
                                             <div class="row" >        
                                                <div class="col-md-12">
                                                    
                                                    <div class="text-center user-picture-container">
                                                            <img src="{{ asset('img/default.png') }}" onclick="document.getElementById('imgUpload').click();" id="UserPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                                            <input type="file" id="imgUpload" name="avatar"  accept="image/*" style="display: none;">
                                                    </div>

                                                </div>
                                                


                                            </div>
                                                
                                              

                                              
                                                 
                                            <div class="row" > 

                                                <div class="col-md-3">

                                                    <select class="form-control" name="userrole">
                                                        
                                                            @if( Auth::user()->role_id == '1')
                                                                <option value="2">Admin</option>
                                                                <option value="3">Staff</option>
                                                            @elseif( Auth::user()->role_id == '2' )
                                                                <option value="3">Staff</option>
                                                            @endif


                                                    </select> 

                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                                        <input id="firstname" type="text" class="form-control text-center" placeholder="First name" name="firstname" value="{{ old('firstname') }}" required autofocus>
                                                        
                                                        @if ($errors->has('firstname'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('firstname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                  <div class="col-md-3">
                                                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                                        <input id="lastname" type="text" class="form-control text-center " name="lastname" placeholder="Last name" value="{{ old('lastname') }}" required autofocus>

                                                        @if ($errors->has('lastname'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('lastname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                           

                                        
                                            <div class="col-md-3">
                                                <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                                                        <input id="middlename" type="text" class="form-control text-center" name="middlename" placeholder="M.i" value="{{ old('middlename') }}" autofocus>
                                                        @if ($errors->has('middlename'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('middlename') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            </div>
                                         </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 align-center">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <input id="email" type="email" class="form-control text-center form-email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 align-center">
                                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                                    <input id="username" type="text" class="form-control text-center" name="username" placeholder="ID Number" value="{{ old('username') }}" required>
                                                    @if ($errors->has('username'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <input id="password" type="password" class="form-control text-center" placeholder="Password" name="password" required>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input id="password-confirm" type="password" class="form-control text-center" placeholder="Confirm pasword" name="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="form-group">
                                                <div class="col-md-10 col-md-offset-5">
                                                    <button type="submit" class="btn btn-primary">
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
          </div>

    </section>


</div>
<!-- /.row (main row) -->








        @include('admin.footer.footer')


        

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




@endsection
 















