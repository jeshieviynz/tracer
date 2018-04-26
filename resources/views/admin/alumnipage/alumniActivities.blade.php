@extends('admin.layouts.app')

@section('content')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alumni
        <small> > Activities</small>

        <button id="AddEventBtn" class="pull-right btn btn-primary">Add Activities</button>
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
                      <div class="col-md-12 user-list" id="event-list">
                        
                        <!--Table hover-->
                        <div class="panel users-panel" id="panel-scrolling-demo">
                          <div class="panel-body">
                            
                          

                            @include('admin.alumnipage.partials.event-list')



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


    @include('alumni.modals.updateEvent')
    @include('alumni.modals.createevent')


@endsection
 