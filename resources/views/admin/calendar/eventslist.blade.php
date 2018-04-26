@extends('admin.layouts.app')

@section('content')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calendar
        <small> > Events list</small>
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
                            
                            <div class="panel-body">




                          <table id="event-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Event title</th>
                                        <th>Venue</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Event title</th>
                                        <th>Venue</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                  @php ($count = 1)
                                   @foreach( $events as $event)
                                   @if($event->date != 1)

                                    <tr id="{{$event->id}}" class="data">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->venue }}</td>
                                        <td>{{ $event->date }}</td>
                                        <td>{{ $event->time }}</td>
                                        <td>
                                        <span class="label @if($event->status == "cancelled")  label-danger @else  label-info @endif">{{$event->status}}</span>
                                        </td>

                                        <td>

                                          <div class="btn-group">

                                              <button type="submit" class="btn btn-primary btn-sm updateEventShowModal" id="{{$event->id}}">
                                                <i class="fa fa-external-link" aria-hidden="true"></i></button>
                                                @if( ( $event->status != "finished" ) && ( $event->status != "ongoing" ) )
                                                 
                                                 @if( $event->status == "upcoming")
                                                    <button class="btn btn-danger btn-sm cancelEventBtn" id="{{$event->id}}">
                                                      <i class="fa fa-trash" aria-hidden="true"></i></button>
                                                  @else
                                                    <button class="btn btn-success btn-sm resumeEventBtn" id="{{$event->id}}">
                                                  <i class="fa fa-undo" aria-hidden="true"></i></button>
                                                  @endif

                                                @endif
                                              

                                          </div>

                                        </td>

                                    </tr>
                                    @endif    
                                    @endforeach
                                </tbody>
                            </table>  




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
 