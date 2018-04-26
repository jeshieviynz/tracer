     
    <!-- Modal Update User -->
        <div class="modal fade" id="ElectOfficerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md-c">
                    <div class="modal-content">

                        <form class="update-form" method="POST" id="ElectOfficerForm" action="/alumni/officer/elect" enctype="multipart/form-data">

                            {{ csrf_field() }}
                    

                            <div class="modal-header">
                                <div class="col-md-6">
                                    <div class="pull-center modal-title-position">ELECT OFFICER</div>
                                    <input type="hidden" name="position_id" class="position_id">
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right" data-dismiss="modal"><i class="fa fa-close"></i></div>
                                </div>
                            </div>
                            <div class="modal-body">

                                <div class="container-fluid">

                                    <div class="row">

                                        <div class="col-md-12 Traced_Alumni_con">
                                           
                                            
                                        </div>

                                    </div>

                                </div>


                                
                            </div><!-- end modal body-->

                            <div class="modal-footer">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <small class="help-block with-errors form-error alumni_id"></small>
                                             <small class="help-block with-errors form-error position_id"></small>
                                            
                                        </div>
                                        <div class="col-md-6">
                                           

                                            <button class="btn btn-primary">SUBMIT</button>
                                            
                                        </div>

                                    </div>

                            </div>

                    </form>
                            

                </div> <!-- end modal content-->

            </div> <!-- end modal dialog-->
        
        </div> <!-- end modal-->