<table id="alumni-table-report" class="display" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>#</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Middlename</th>
              <th>Email</th>
              <th>Username</th>
              <th>Last Logged</th>
              <th>Status</th>
          </tr>
      </thead>
    <tbody>

       @php ($count = 1)
       @foreach( $users as $record)

        <tr id="{{$record->id}}" class="data">

              <td>{{ $count++ }}</td>
              <td>{{ $record->firstname }}</td>
              <td>{{ $record->lastname }}</td>
              <td>{{ $record->middlename }}</td>
              <td>{{ $record->email }}</td>
              <td>{{ $record->username }}</td>
              <td>{{ $record->lastLogged }}</td>
              <td>@if( $record->status == 1 ) Active @else Not Active @endif</td>
     

       </tr>

        @endforeach
    </tbody>
</table>  