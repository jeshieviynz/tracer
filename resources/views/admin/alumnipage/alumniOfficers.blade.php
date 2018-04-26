@extends('admin.layouts.app')

@section('content')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alumni
        <small> > Officers</small>
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
                      <div class="col-md-12 user-list" id="user-list">
                        
                        <!--Table hover-->
                        <div class="panel users-panel" id="panel-scrolling-demo">
                          <div class="panel-heading">
                            <div class="row">

                              <div class="table-responsive position-table">

                                  <table class="table no-margin">
                                    <thead>
                                    <tr>
                                      <th>Position</th>
                                      <th>Officer Name</th>
                                      <th>Email</th>
                                      <th class="actions">Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach( $positions as $position )

                                      <tr>
                                        <td>{{ $position->position }}</td>
                                        <td><strong> 
                                          @if( empty( $position->alumni_id )  ) < no officer elected > 

                                          @else

                                          {{ $position->Last_Name }} , {{ $position->First_Name }} {{ $position->Middle_Name }}

                                          @endif</strong></td>

                                        <td>{{ $position->Email }}</td>

                                        <td class="actions">

                                          @if( empty( $position->alumni_id ) )
                                          <button type="button" id="{{$position->position_id}}" class="btn bg-orange btn-flat margin elect-officer-btn">Elect {{ $position->position }}</button>

                                          @else

                                          <button type="button" id="{{$position->position_id}}" class="btn bg-olive btn-flat margin change-officer-btn">Change {{ $position->position }}</button>

                                          @endif

                                        </td>
                                      </tr>

                                    @endforeach

                                    </tbody>
                                  </table>
                                </div>

                            </div>
                          </div>
                        </div>  
                            <!--Panel Body-->
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
 