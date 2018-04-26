

<!-- Create Alumni account -->
<div class="modal fade" id="accountAlumniModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-account">
				<button class="close " data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center account-text">Account setup</h4>
			</div>
			<div class="modal-body">
				<form action="/createaccount" method="POST" id="accountUser">

					{{ csrf_field() }}	
					<div class="register-box-body">
					    <form>
					      <div class="form-group has-feedback">
					        <input  class="form-control account-user" readonly name="username"  type="text" placeholder="User name">
					        <span class="glyphicon glyphicon-user form-control-feedback "></span>
                               <small class="form-text form-error username"></small>
					      </div>
					      <div class="form-group has-feedback">
					        <input  class="form-control account-user" type="email" name="email" placeholder="Email">
					        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					        <small class="form-text form-error email"></small>
					      </div>
					      <div class="form-group has-feedback">
					        <input class="form-control account-user" type="password" name="password" placeholder="Password">
					        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
					        <small class="form-text form-error password"></small>
					      </div>
					      <div class="form-group has-feedback">
					        <input  class="form-control account-user" type="password" name="password_confirmation"" placeholder="Confirm Password">
					        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
					        <small class="form-text form-error password_confirmation"></small>
					      </div>
					        <div class="text-center ">
					          <button type="submit" id="createAcount" class="btn btn-primary btn-block btn-flat">Create</button>
					        </div>
					    </form>
					  </div>
				</form>
			</div>
		</div>
	</div>
</div>