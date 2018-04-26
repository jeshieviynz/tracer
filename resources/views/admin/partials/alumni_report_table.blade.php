<table id="alumni-table-report" class="display" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>#</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Bithday</th>
              <th>ID</th>
              <th>Email</th>
              <th>Contact#</th>
              <th>Graduated</th>
              <th>Status</th>
              <th>Employment</th>
              <th>Company</th>
              <th>Job Title</th>
          </tr>
      </thead>
    <tbody>

       @php ($count = 1)
       @foreach( $alumni as $record)

        <tr id="{{$record->id}}" class="data">
             <td>{{ $count++ }}</td>
              <td>{{ $record->First_Name }}</td>
              <td>{{ $record->Last_Name }}</td>
              <td>{{ $record->Birthdate }}</td>
              <td>{{ $record->Alumni_ID_Number }}</td>
              <td>{{ $record->Email }}</td>
              <td>{{ $record->Mobile_Phone }}</td>
              <td>{{ $record->Year_Graduated }}</td>
              <td>@if($record->Account) traced @else Not traced @endif</td>
              <td>{{ $record->Employment }}</td>
              <td>{{ $record->Company_connected }}</td>
              <td>{{ $record->job_title }}</td>

     

       </tr>

        @endforeach
    </tbody>
</table>  