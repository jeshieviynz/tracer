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

                    @if( ( $event->status != "finished" ) && ( $event->status != "ongoing" ) )


                  <button type="submit" class="btn btn-primary btn-sm updateEventShowModal" id="{{$event->id}}"><i class="fa fa-external-link" aria-hidden="true"></i></button>
                     
                     @if( $event->status == "upcoming")
                        <button class="btn btn-danger btn-sm deleteEvent" id="{{$event->id}}">
                          <i class="fa fa-trash" aria-hidden="true"></i></button>
                      @else
                        <button class="btn btn-success btn-sm resetEvent" id="{{$event->id}}">
                      <i class="fa fa-undo" aria-hidden="true"></i></button>
                      @endif

                    @endif
                  
                   <button type="button" id="{{ $event->id }} " class="btn btn-primary btn-sm view-activities"><i class="fa fa-info-circle"></i></button>

              </div>

            </td>

        </tr>

        @endif    
        @endforeach

    </tbody>
</table>