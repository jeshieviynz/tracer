
<!-- Modal Update User -->
    <div class="modal fade" id="UpdateUserProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">


                    <form class="update-form" method="POST" id="updateUserAccountForm" action="user/UpdateProfile" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="modal-header">
                        <div class="col-md-6">
                            <div class="pull-center">UPDATE USER ACCOUNT</div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right" data-dismiss="modal"><i class="fa fa-close"></i></div>
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                            <div class="row">
                               @if( !$errors->isEmpty() )
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <ul>
                                        @foreach( $errors->all() as $error )
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                     <!-- INPUT GROUPS -->
                                           <div class="input-group text-center user-picture-container">
                                                <img src="{{ asset('img/default.png') }}" onclick="document.getElementById('imgUpload').click();" id="UserPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                                <input type="file" id="imgUpload" name="avatar" value="{{ Session::get('avatar') }}"  accept="image/*" style="display: none;">
                                            </div>

                                           <input class="form-control" value="" placeholder="User ID" name="id" type="hidden" >

                                           <div class="row">
                                                <div class="col-md-4">
                                                    <label>First name</label>
                                                     <input class="form-control" value="" placeholder="First Name" name="firstname" type="text" required="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Last name</label>
                                                   <input class="form-control" value="" placeholder="Last name" name="lastname" type="text" required="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Middle name</label>
                                                  <input class="form-control" value="" placeholder="Middle name" name="middlename" type="text">
                                                </div>
                                            </div>

                                            <br>


                                           <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email Address</label>
                                                    <input class="form-control" placeholder="Email Address" name="email" type="text" required="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Username</label>
                                                    <input class="form-control" placeholder="Username" name="username" type="text" readonly required="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="checkbox pull-left">
                                                            <input type="checkbox" id="changepassword_checkbox" class="checkbox" autocomplete="off" name="changepassword_checkbox"> Change Password?
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row changepassword_container" id="changepassword_container">
                                                <div class="col-md-6">
                                                    <label>Password</label>
                                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Re-Type Password</label>
                                                    <input class="form-control" placeholder="Confirm Password" name="password_confirmation" type="password" >
                                                </div>
                                            </div>

                                            <br>

                                    <!-- END INPUT GROUPS -->
                                </div>

                            </div>
                        </div>


                        
                        </div><!-- end modal body-->
                        
                        <div class="content-footer clearfix text-center">
                            <button type="submit" class="btn btn-primary btn-md">&nbsp; &nbsp; &nbsp;SAVE CHANGES&nbsp;  &nbsp;</button>
                        </div>

                        <br/>
                    </form>

            </div> <!-- end modal content-->

        </div> <!-- end modal dialog-->
    
    </div> <!-- end modal-->