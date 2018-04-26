
<!-- Modal Update User -->
    <div class="modal fade" id="InputNAmeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">


                    <form class="update-form" method="POST" id="inputNameForm" action="user/Update" enctype="multipart/form-data">

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


                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <div class="col-md-6">
                                                <input class="form-control" value="" placeholder="User ID" name="id" type="text" >
                                                </div>
                                                 <div class="col-md-6">
                                                 <input class="form-control" value="" placeholder="Username" name="username" type="text" required="">
                                                </div>
                                            </div>
                                            <br>
                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                               
                                                    <div class="col-md-4">
                                                        <input class="form-control" value="" placeholder="First Name" name="firstname" type="text" required="">
                                                    </div>
                                                     <div class="col-md-4">
                                                        <input class="form-control" value="" placeholder="Last name" name="lastname" type="text" required="">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-control" value="" placeholder="Middle name" name="middlename" type="text" required="">
                                                    </div>
                                                
                                            </div>
                                            <br>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input class="form-control" placeholder="Password" name="password" type="password" required>
                                                <input class="form-control" placeholder="Confirm Password" name="password_confirmation" type="password" required>
                                            </div>
                                            <br>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input class="form-control" value="" placeholder="Email Address" name="email" type="text" required="">
                                            </div>
                                            <br>

                                           <div class="row">
                                                <div class="col-md-6">
                                                    <label>User Role</label>
                                                    <select class="form-control" name="userrole">
                                                        <option value="1">Admin</option>
                                                        <option value="2">Staff</option>
                                                        <option value="3">Alumni</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>User Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">NotActive</option>
                                                    </select>
                                                </div>
                                            </div>
                                    <!-- END INPUT GROUPS -->
                                </div>

                            </div>
                        </div>


                        
                        </div><!-- end modal body-->
                        
                        <div class="content-footer clearfix text-center">
                            <button type="submit" class="btn btn-primary btn-md">&nbsp; &nbsp; &nbsp;SAVE CHANGES&nbsp;  &nbsp;</button>
                        </div>
                    </form>

            </div> <!-- end modal content-->

        </div> <!-- end modal dialog-->
    
    </div> <!-- end modal-->