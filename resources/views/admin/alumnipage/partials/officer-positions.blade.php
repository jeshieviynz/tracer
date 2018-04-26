  <table class="table no-margin position-table">
    <thead>
    <tr>
      <th>Position</th>
      <th>Officer Name</th>
      <th>Email</th>
      <th class="actions">Actions</th>

    </tr>
    </thead>
    <tbody>

    @foreach( $positions as $position )

      <tr>
        <td>{{ $position->position }}</td>
        <td><strong> 
          @if( empty( $position->alumni_id )  ) < no officer elected > 

          @else

          {{ $position->Last_Name }} , {{ $position->First_Name }} {{ $position->Middle_Name }}

          @endif</strong></td>

        <td>{{ $position->Email }}</td>

        <td class="actions">

          @if( empty( $position->alumni_id ) )
          <button type="button" id="{{$position->position_id}}" class="btn bg-orange btn-flat margin elect-officer-btn">Elect {{ $position->position }}</button>

          @else

          <button type="button" id="{{$position->position_id}}" class="btn bg-olive btn-flat margin change-officer-btn">Change {{ $position->position }}</button>

          @endif

        </td>
      </tr>

    @endforeach

    </tbody>
  </table>