 @extends('admin.layouts.app')

@section('content')


<div id="wrapper">
			<div class="chart">
				<h2>Skillset</h2>
				<table id="data-table" border="1" cellpadding="10" cellspacing="0" summary="skillset">
					<thead>
						<tr>
							<td>&nbsp;</td>
							<th scope="col">CSS</th>
							<th scope="col">SEO</th>
							<th scope="col">Design</th>
							<th scope="col">HTML</th>
							<th scope="col">CMS</th>
						</tr>
					</thead>
					<tbody>
						<tr>		
							<td>50</td>
							<td>50</td>
							<td>80</td>
							<td>95</td>
              <td>80</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		


@endsection