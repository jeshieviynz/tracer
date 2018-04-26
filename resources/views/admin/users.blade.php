@extends('admin.layouts.app')

@section('content')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <a href="register" class="btn btn-primary pull-right">
                          ADD USER <i class="fa fa-plus-circle"></i>
                        </a>
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

                     @if( !empty( $message ) )
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> {{ $message }}
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
                  <div class="col-md-12 user-list" id="user-list">
                    
                    <!--Table hover-->
                    <div class="panel users-panel" id="panel-scrolling-demo"> 
                        <!--Panel Body-->
                        <div class="panel-body">




                          <table id="users-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>
                                        <th>Role ID</th>
                                        <th>User logs</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>
                                        <th>Role ID</th>
                                        <th>User logs</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                 

                                   @php ($count = 1)
                                   @foreach( $users as $user)
                                    @if($user->role_id != 1)
                                      @if( Auth::user()->role_id != 2 )

                                        <tr id="{{$user->id}}" class="data">
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $user->firstname }}</td>
                                            <td>{{ $user->lastname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>@if($user->role_id == 2) Admin @elseif($user->role_id == 3) Staff @else Alumni @endif</td>
                                            <td>{{ $user->lastLogged }}</td>
                                            <td>

                                                @if( $user->status)
                                                <span class="label label-success">active</span>
                                                 @else
                                                <span class="label label-danger">not active</span>
                                                @endif

                                            </td>

                                             <td>
                                               
                                              <div class="row actions">


                                               <div class="btn-group">

                                                
                                              @if( Auth::user()->role_id != '3')  

                                                <button type="button" id="{{ $user->id }}" class="btn btn-primary edit-user"><i class="fa fa-edit"></i></button> 

                                              @endif

                                                 <button type="button" id="{{ $user->id }}" class="btn btn-primary view-user"><i class="fa fa-info-circle"></i></button> 

                                              @if( Auth::user()->role_id != '3')

                                                @if( $user->status)
                                                
                                                 <button type="button" id="{{ $user->id }}" class="btn btn-danger delete-user" ><i class="fa fa-ban"></i> </button>
                                                @else

                                                 <button type="button" id="{{ $user->id }}" class="btn btn-success active-user" ><i class="fa fa-undo"></i></button>

                                                @endif


                                              @endif

                                            </div>

                                            </div>
                                            
                                             </td>    

                                          </tr>


                                        @endif  
                                    @endif  
                                    @endforeach
                                </tbody>
                            </table>  




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
 