@extends('alumni.alumni-app')

@section('content')

<div class="content-wrapper alumni-con">

    <!-- Main content -->
    <section class="content">

        <div class="nav-tabs-custom">

          
            <div class="tab-content">


                <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Batch {{$batchmates[0]->Year_Graduated}} </h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">{{ count( $batchmates ) }}</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding batchmates-con">
                  <ul class="users-list clearfix">


                    @foreach( $batchmates as $batchmate )

                    <li>
                      <img src="@if( empty( $batchmate->avatar) ) /storage/users/default.jpg @else {{$batchmate->avatar}}@endif" alt="User Image">
                      <a class="users-list-name" href="#">{{$batchmate->Last_Name}} , {{$batchmate->First_Name }} {{ $batchmate->Middle_Name}}</a>
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