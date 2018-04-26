@extends('admin.layouts.app')

@section('content')
 

    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

       <section class="content">


      <form action="/reports/filters" method="GET" id="Filter_Reports_Form">
        
        {{ csrf_field() }}

        <img src="{{ asset('/img/logo.jpeg') }}" style="display: none" id="logo"/>

        <div class="panel">
          <div class="panel-body">

      	      <div class="row" id="reports_filter">


                  <div class="col-md-12">

                    
                    <div class="form-group">
                         <span class="input-group-addon">Filter By</span>
                          <select class="form-control" name="filter_by" id="filter_by">
                            <option value="ALUMNI" selected="">ALUMNI</option>
                            <option value="USERS">USERS</option>
                          </select>
                    </div>

                    <div class="form-group filter_by_userrole_con">
                         <span class="input-group-addon">Filter By User Role</span>
                          <select class="form-control" name="filter_by_user_role" id="filter_by_user_role">
                            <option value="ALL" selected="">ALL</option>
                            <option value="2">ADMIN</option>
                            <option value="3">STAFF</option>
                            <option value="4">ALUMNI</option>
                          </select>
                    </div>

                    <div class="form-group filter_by_user_status_con">
                        <span class="input-group-addon">Filter By User Status</span>
                          <select class="form-control" name="filter_by_user_status" id="filter_by_user_status">
                            <option value="ALL" selected="">ALL</option>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="NOT ACTIVE">NOT ACTIVE</option>
                          </select>
                    </div>



                    <div class="form-group filter_alumni_by_con">
                         <span class="input-group-addon">Filter By Year</span>
                          <select class="form-control" name="filter_alumni_by_year" id="filter_alumni_by_year">
                            <option value="ALL" selected="">ALL</option>

                              @foreach( $years as $year )
                                  <option value="{{$year}}">{{ $year }}</option>
                              @endforeach

                          </select>
                    </div> 


                    <div class="form-group filter_by_alumni_con">
                         <span class="input-group-addon">Filter Alumni By</span>
                          <select class="form-control" name="filter_by_alumni" id="filter_by_alumni">
                            <option value="ALL" selected="">ALL</option>
                            <option value="TRACED">TRACED</option>
                            <option value="NOT TRACED">NOT TRACED</option>
                          </select>
                    </div> 


                    <div class="form-group filter_by_employment_con">
                         <span class="input-group-addon">Filter By Employment</span>
                          <select class="form-control" name="filter_by_employment" id="filter_by_employment">
                            <option value="ALL" selected="">ALL</option>
                            <option value="EMPLOYED">EMPLOYED</option>
                            <option value="NOT EMPLOYED">NOT EMPLOYED</option>
                          </select>
                    </div>  


                    <div class="form-group filter_by_job_relevance_con">
                         <span class="input-group-addon">Filter by Job Relevance</span>
                          <select class="form-control" name="filter_by_job_relevance" id="filter_by_job_relevance">
                            <option value="ALL" selected="">ALL</option>
                            <option value="RELATED">RELATED</option>
                            <option value="NOT RELATED">NOT RELATED</option>
                          </select>
                    </div>   



                    <div class="pull-right">
                         <button type="submit" class="btn btn-primary generate-report-btn">GENERATE</button>
                        
                    </div>   



                  </div>





      	     </div>
         </div>
       </div>

      </form>


        <div class="row">

          <div class="col-md-12">
          
             <div class="panel" id="panel-scrolling-demo">
                   <div class="panel-heading">
                   
                               <div class="panel-body"  id="QueryResultContainer">
                                  

                                 </div>
                    </div>
                </div>


            </div>

       </div>



	</section>
      




</div>

 @include('admin.footer.footer')
    <!-- /.content -->


@endsection
