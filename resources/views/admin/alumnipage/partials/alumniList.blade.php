<table id="TracedAlumniTable" class="display" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th></th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Student ID</th>
              <th>Course</th>
              <th>Email Address</th>
          </tr>
      </thead>
    <tbody>

       @foreach( $Alumni as $record)

        <tr id="{{$record->alumni_id}}" class="data">

              <td><input name="alumni_id" value="{{$record->alumni_id}}" checked="" type="radio"></td>
              <td>{{ $record->First_Name }}</td>
              <td>{{ $record->Last_Name }}</td>
              <td>{{ $record->Alumni_ID_Number }}</td>              
              <td>{{ $record->Course }}</td>
              <td>{{ $record->Email }}</td>  
       </tr>

        @endforeach
    </tbody>
</table>  