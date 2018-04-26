
<!-- Modal Delete User -->
<div class="modal fade" id="activeAlumniModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header modal-danger">
                   <div class="pull-left">Active Alumni</div>
                   <div class="pull-right" data-dismiss="modal"><i class="fa fa-close"></i></div>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="user-picture-container">
                                    <img src="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p>Are you sure you want to set this user to active ?</p>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default btn-simple" data-dismiss="modal">NO</button>
                <form method="POST" action="" id="activeForm" class="pull-right">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-sm btn-primary btn-simple">YES</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->