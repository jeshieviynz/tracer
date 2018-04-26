@extends('admin.layouts.app')

@section('content')
 

    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

       <section class="content">

	      <div class="row">
	        <div class="col-md-9">

            <div class="row">
              <div class="col-md-6">
                <strong>Dashboard</strong>
              </div>
               <div class="col-md-4">
            
                <form  method="GET" id="FilterAlumniGraphByYearForm">
                    {{ csrf_field() }}

                    <div class="input-group">
                           <span class="input-group-addon">SELECT BATCH :</span>
                          <select class="form-control" id="GraphYear" name="year">
                              <option value="ALL" selected="selected">ALL</option>
                              @foreach( $years as $year )
                                  <option value="{{$year}}">{{ $year }}</option>
                              @endforeach
                          </select>
                   </div>
                  </form>

              </div>


              <div class="col-md-2">
                 <a href="/print/graph" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
               </div>

              <div class="col-md-12" id="grap-container" style="height:460px; width: 96%; margin: 15px 0 0 0;">
              </div>


            </div>

	        </div>
          <div class="col-md-3">
            <div class="row" id="tracer_percentage_table">


                                <div class="info-box">
                                  <span class="info-box-icon bg-graduates"><i class="fa fa-graduation-cap"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">GRADUATES</span>
                                    <span class="count_graduates"></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                             
                                <div class="info-box">
                                  <span class="info-box-icon bg-green"><i class="fa fa-search"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">TRACED</span>
                                    <span class="count_traced_p"></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              
                                <div class="info-box">
                                  <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">NOT TRACED</span>
                                    <span class="count_untraced_p"></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              
                                <div class="info-box">
                                  <span class="info-box-icon bg-yellow"><i class="fa fa-briefcase"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">EMPLOYED</span>
                                    <span class="count_employed_p"></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>


                                <div class="info-box">
                                  <span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">NOT EMPLOYED</span>
                                    <span class="count_unemployed_p"></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>


                                <div class="info-box">
                                  <span class="info-box-icon bg-yellow"><i class="fa fa-briefcase"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">RELATED</span>
                                    <span class="count_related_p"></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>


                                <div class="info-box">
                                  <span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">NOT RELATED</span>
                                    <span class="count_unrelated_p"></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>

            </div>
        </div>

	</section>
      




</div>

 @include('admin.footer.footer')
    <!-- /.content -->


@endsection
