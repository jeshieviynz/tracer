
<!-- Modal Update User -->
    <div class="modal fade" id="UpdateAlumniAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">


                    <form class="update-form" method="POST" id="updateAlumniForm" action="alumni/Update" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    

                    <div class="modal-header">
                        <div class="col-md-6">
                            <div class="pull-center">UPDATE ALUMNI DETAILS</div>
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
                                    <div class="col-md-6">
                                         <!-- INPUT GROUPS -->
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input class="form-control" value="" placeholder="User ID" name="id" type="hidden" >
                                                     <input class="form-control" value="" placeholder="Username" name="username" type="text" required="">
                                                </div>

                                                     <small class="help-block with-errors form-error username"></small>
                                    </div>

                                    <div class="col-md-6">

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    <input class="form-control" value="" placeholder="Email Address" name="email" type="text" required="">
                                                </div>

                                                    <small class="help-block with-errors form-error email"></small>
                                                    
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="col-md-4">
                                        <label>FIrstname</label>
                                        <input class="form-control" value="" placeholder="First Name" name="firstname" type="text" required="">
                                        <small class="help-block with-errors form-error firstname"></small>
                                    </div>
                                     <div class="col-md-4">
                                         <label>Lastname</label>
                                        <input class="form-control" value="" placeholder="Last name" name="lastname" type="text" required="">
                                        <small class="help-block with-errors form-error lastname"></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Middlename</label>
                                        <input class="form-control" value="" placeholder="Middle name" name="middlename" type="text">
                                        <small class="help-block with-errors form-error middlename"></small>
                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="col-md-4">
                                        <label>Birthday</label>
                                        <input class="form-control" value="" placeholder="Birthday" name="Birthday" type="date" required="">
                                        <small class="help-block with-errors form-error Birthday"></small>
                                    </div>
                                    

                                    <div class="col-md-4">
                                        <label>Year Graduated</label>
                                        <input class="form-control" value="" placeholder="Year Graduated" name="year_graduated" type="text" required="">
                                        <small class="help-block with-errors form-error year_graduated"></small>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Course</label>
                                        <select class="form-control" name="course">
                                            <option value="BSBA - OM" >BSBA - OM</option>
                                            <option value="BSBA - MM" >BSBA - MM</option>
                                        </select>
                                        <small class="help-block with-errors form-error course"></small>
                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control" value="" placeholder="Address" name="address" type="text" required="">
                                        <small class="help-block with-errors form-error address"></small>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Home Phone</label>
                                        <input class="form-control" value="" placeholder="Home Phone" name="homephone" type="text" required="">
                                        <small class="help-block with-errors form-error homephone"></small>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label>Phone Number</label>
                                        <input class="form-control" value="" placeholder="Phone Number" name="mobilephone" type="text" required="">
                                        <small class="help-block with-errors form-error mobilephone"></small>
                                    </div>

                                </div>



                            </div>
                            <br/>
                             <div class="content-footer clearfix text-center">
                            <button type="submit" class="btn btn-primary btn-md">&nbsp; &nbsp; &nbsp;SAVE CHANGES&nbsp;  &nbsp;</button>
                        </div>
                        </div>


                        
                        </div><!-- end modal body-->
                        
                       
                    </form>

            </div> <!-- end modal content-->

        </div> <!-- end modal dialog-->
    
    </div> <!-- end modal-->