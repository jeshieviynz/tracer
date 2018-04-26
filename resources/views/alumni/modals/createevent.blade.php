

<!-- Modal createEvent  -->

<div class="modal fade" id="createeventModal" tabindex="-2" >
    <div class="modal-dialog modal-md createEvent">
        <div class="modal-content delete-modal">
            <div class="modal-header modal-primary creatEventsModal">
                   <div class="pull-left">Create events</div>
                   <div class="pull-right" data-dismiss="modal"><i class="fa fa-close"></i></div>
            </div>
             <form class="form-group" method="POST" id="createEventForm" action="/events/create" enctype="multipart/form-data">
                <div class="modal-body ">

                   <div class="row">
                        

                     <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label >Start Date</label>
                             <input type="text" name="start" data-date-end-date="0d" class="eventdatepicker form-control" value="03/12/2017" />
                             <small class="help-block with-errors form-error start"></small>
                        </div>

                    </div>

                    <div class="col-md-6 text-center">
                       <div class="form-group">
                                <label >End Date</label>
                                 <input type="text" name="end" data-date-end-date="0d" class="eventdatepicker form-control" value="03/12/2017" />
                                 <small class="help-block with-errors form-error end"></small>
                            </div>
                    </div>


                    </div>




                    <div class="row">
                                <div class="col-md-5 text-center">
                                    <label >Event title</label>
                                  <input class="form-control" type="text" name="title">
                                   <small class="form-text form-error title"></small>
                                </div>

                                <div class="col-md-4 text-center">
                                    <label>Venue</label>
                                        <input class="form-control" type="text" name="venue">
                                         <small class="form-text form-error venue"></small>
                                </div>

                                <div class="col-md-3 text-center">
                                    <label style="width:100%" >Batch</label>
                                    <select class="form-control" name="eventBatch[]" id="eventBatch" class="eventBatch" multiple="multiple">
                                        
                                            @foreach( $years as $year )
                                                <option value="{{$year}}">{{ $year }}</option>
                                            @endforeach

                                    </select>
                                     <br/>
                                    <small class="form-text form-error eventBatch"></small>
                                </div>
                    </div>

                    <div class="row">
                        <div class=" col-md-12 text-center">
                             <div class="form-group">
                                <label for="contents">Description</label>
                                    <textarea class="summernote" name="description"></textarea>
                             </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class=" col-md-12 text-center">
                               {{ csrf_field() }}
                             <button type="submit" class="btn btn-primary">CREATE</button>
                        </div>
                    </div>


            </div> 

        </form>
        </div>
    </div>
</div>


<!--  End Modal -->