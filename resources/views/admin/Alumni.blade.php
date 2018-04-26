@extends('admin.layouts.app')

@section('content')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alumni
        <small> > Graduate</small>

                          <form class="form-group pull-right" method="GET" action="user/Update" id="FilterAlumniByYearForm">
                            {{ csrf_field() }}
                             <select class="form-control" id="Batch" name="Batch_Year">
                                <option value="ALL" selected="">ALL</option>
                                @foreach( $years as $year )
                                    <option value="{{$year}}">{{ $year }} BATCH</option>
                                @endforeach
                            </select>
                          </form>

                      <a href="#importExcel" class="btn btn-success pull-right importExcel" data-toggle="modal" data-target="#importModal">Import</a> 



                      <button class="btn btn-primary pull-right add-alumni-btn" data-toggle="modal" data-target="#AddAlumniAccountModal">Add Alumni</button>
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
                    
                       <div class="panel users-panel" id="panel-scrolling-demo">
                      <div class="panel-heading">
                       
                             <div class="panel-body" id="Alumni-List">
                                
                                @include("admin.partials.alumnilist")

                               </div>
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
