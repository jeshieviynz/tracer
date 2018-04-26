@extends('admin.layouts.app')

@section('content')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

              <section class="content-header">
                    <h1>
                    <button class="btn btn-primary pull-right add-alumni-btn" data-toggle="modal" data-target="#AddnotableModal">Notable Alumni</button>
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


              <div class="panel users-panel">

                 <!--OVERVIEW-->

                          <br/>
                      <div class="col-md-12 user-list">
                        
                        <div class="row">

                            @foreach( $Alumni as $alumni )


                                <div class="col-md-4  text-center">
                                  
                                        <img class="notable-alumni-img details-alumni" id="{{$alumni->id}}" src="{{ $alumni->avatar }}" >
                                      <div class="row">
                                        
                                        <div class="col-md-12">
                                          <span class="username">
                                              <a id="{{$alumni->id}}" class="details-alumni">{{$alumni->Last_Name}} , {{ $alumni->First_Name }} {{$alumni->Middle_Name }}</a>
                                            </span>
                                            <br/>
                                           <p>Address : {{$alumni->Address }}<br/>
                                              Position : {{$alumni->job_title }}<br/>
                                              Company : {{$alumni->Company_connected }}</p>
                                        </div>
                                      </div>
                                 
                              </div>



                              @endforeach


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
 