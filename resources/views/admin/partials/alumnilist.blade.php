<table id="alumni-table" class="display" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Student ID</th>
              <th>Course</th>
              <th>Email Address</th>
              <th>Year</th>
              <th>Status</th>
              <th></th>
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Student ID</th>
              <th>Course</th>
              <th>Email Address</th>
              <th>Year</th>
              <th>Status</th>
              <th></th>
          </tr>
      </tfoot>
    <tbody>

       @php ($count = 1)
       @foreach( $Alumni as $record)

        <tr id="{{$record->id}}" class="data">
             <td>{{ $count++ }}</td>
              <td>{{ $record->First_Name }}</td>
              <td>{{ $record->Last_Name }}</td>
              <td>{{ $record->Alumni_ID_Number }}</td>              
              <td>{{ $record->Course }}</td>
              <td>{{ $record->Email }}</td>
              <td>{{ $record->Year_Graduated }}</td>
              <td>@if($record->Account) traced @else Not traced @endif</td>
     

             <td>
              <div class="row actions">


            <div class="btn-group" style="width: 125px">

                    <button type="button" id="{{ $record->id }}" class="btn btn-primary edit-alumni"><i class="fa fa-edit"></i></button> 

                     <button type="button" id="{{ $record->id }}" class="btn btn-primary details-alumni"><i class="fa fa-info-circle"></i></button> 

                    
                     <button type="button" id="{{ $record->id }}" class="btn btn-danger delete-user" ><i class="fa fa-ban"></i> </button>
                    



                </div>






             </td>    
       </tr>

        @endforeach
    </tbody>
</table>  