@extends('admin.layouts.app-login')

@section('content')
<div class="container login">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-login"> 
                <div class="panel-heading login-heading">Login <a class="btn btn-link pull-right" data-toggle="modal" data-target="#loginModal">
                                    don't have acount yet?
                                </a></div>

                <div class="panel-body">

                     @if ($errors->has('username'))

                        <div class="alert alert-danger" role="alert">
                            <div class="container">
                                {{ $errors->first('username') }}
                            </div>
                        </div>

                     @endif

                      @if ($errors->has('status'))

                        <div class="alert alert-danger" role="alert">
                            <div class="container">
                                {{ $errors->first('status') }}
                            </div>
                        </div>

                     @endif

                    <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}




                        <div class="input-group margin">
                            <div class="input-group-btn">
                              <button type="button" class="btn btn-warning"><i class="fa fa-user fa-icon"></i></button>
                            </div>
                            
                            <!-- /btn-group -->
                            <input id="username" type="text" placeholder="ID Number" class="form-control input-txt" name="username" value="{{ old('username') }}" required autofocus>

                          </div>



                        <div class="input-group margin">
                            <div class="input-group-btn">
                              <button type="button" class="btn btn-warning"><i class="fa fa-lock fa-icon"></i></button>
                            </div>
                            <!-- /btn-group -->
                             <input id="password" type="password" class="form-control input-txt " placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                          </div>




                        <div class="form-group">

                            <div class="row">


                                <div class="row">
                                    <div class="col-md-12 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </div>
                                <div class="col-md-6">
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                            </a>
                                </div>
                            </div>

                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('alumni.modals.login')
@include('alumni.modals.error')
@endsection
