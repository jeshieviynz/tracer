     
    <!-- Modal Update User -->
        <div class="modal fade" id="ViewUserAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xs">
                    <div class="modal-content">


                        <div class="modal-header">
                            <div class="col-md-6">
                                <div class="pull-center">USER INFORMATION</div>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right" data-dismiss="modal"><i class="fa fa-close"></i></div>
                            </div>
                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">

                                <div class="row">
                                    
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset('img/default.png') }}" id="UserPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                    </div>


                                    <br/>

                                    <br/>

                                    <div class="col-md-12">
                                       
                                        
                                        <div class="row">

                                             <div class="col-md-4 text-center">
                                               <strong>Last name</strong>
                                               <p id="lastname"></p>
                                             </div>


                                             <div class="col-md-4 text-center">
                                                <strong>First name</strong>
                                                 <p id="firstname"></p>
                                            </div>

                                            <div class="col-md-4 text-center">
                                               <strong>Middlename</strong>
                                               <p id="middlename">  </p>
                                             </div>


                                        </div>

                                        <div class="row">
                                            
                                             <div class="col-md-4 text-center">
                                               <strong>Email address</strong>
                                               <p id="email"></p>
                                             </div>


                                             <div class="col-md-4 text-center">
                                               <strong>ID number</strong>
                                               <p id="username"></p>
                                             </div>

                                            <div class="col-md-4 text-center">
                                               <strong>Status</strong>
                                               <p id="Status">  </p>
                                             </div>


                                        </div>


                                         <div class="row">
                                            
                                             <div class="col-md-12 text-center">
                                               <strong>Last Log in</strong>
                                               <p id="lastloggedin"></p>
                                             </div>



                                        </div>

                                       


                                    </div>




                                </div>
                            </div>


                            
                            </div><!-- end modal body-->
                            

                </div> <!-- end modal content-->

            </div> <!-- end modal dialog-->
        
        </div> <!-- end modal-->