@extends('alumni.alumni-app')

@section('content')

<div class="content-wrapper alumni-con">

    <!-- Main content -->
    <section class="content">

        <div class="nav-tabs-custom">

          
            <div class="tab-content">


                <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Alumni Officers</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding batchmates-con">
                  <ul class="users-list clearfix">


                    @foreach( $positions as $positions )

                    <li>
                      <img src="@if( empty( $positions->avatar) ) /storage/users/default.jpg @else {{$positions->avatar}}@endif" alt="User Image">
                      <a class="users-list-name" href="#">
                      	@if( !empty($positions->alumni_id) )
                      	{{$positions->Last_Name}} , {{$positions->First_Name }} {{ $positions->Middle_Name}}</a>
                      	@else
                      		< no officer elected >
                      	@endif
                      <span class="users-list-date">{{$positions->position}}</span>
                    </li>


                    @endforeach


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
            <!-- /.tab-content -->
        </div>

    </section>

</div>


@include('admin.footer.footer')

 @endsection