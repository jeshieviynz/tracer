
<!-- Modal Delete User -->
<div class="modal fade" id="DeleteAlumniModal" tabindex="-2" >
    <div class="modal-dialog modal-md">
        <div class="modal-content delete-modal">
            <div class="modal-header modal-danger">
                   <div class="pull-left">Disable users</div>
                   <div class="pull-right" data-dismiss="modal"><i class="fa fa-close"></i></div>
            </div>
            <div class="modal-body ">
                    <div class="row">
                         <p class="text-center">Are you sure you want to disable this user ?</p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">CANCEL</button>
                <form method="POST" action="" id="deleteForm" class="pull-right">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-simple">DISABLE</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->