<!--Login modal for alumni users-->
<div class="modal fade" id="loginModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header  modal-login">
				<button class="close login-text" data-dismiss="modal">&times;</button>
				<h4 class="modal-title login-text">Please input the required filled!</h4>
			</div>
			<div class="modal-body">
				<form action="/proceed" method="POST" id="alumniSearch">

					{{ csrf_field() }}
					<div class="form-group">
						<label >First name</label>
						<input class="form-control" placeholder="firstname" type="text" name="first_name">
						<label >Last name</label>
						<input class="form-control" placeholder="lastname" type="text" name="last_name">
						<label >Middle name</label>
						<input class="form-control" placeholder="middlename" type="text" name="middle_name">
						<label >Birthdate</label>
						<input class="form-control" type="date" name="bday" value="1990-01-02"><br>
						<date-util format="yyyy/MM/dd"></date-util>
					</div>	
					<button class="btn btn-primary" id="alumniSearchbtn"  type="Submit"> Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>