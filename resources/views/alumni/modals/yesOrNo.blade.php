
<!-- Modal choose User -->
<div class="modal fade" id="yesOrNoModal" tabindex="-2" >
    <div class="modal-dialog modal-md">
        <div class="modal-content delete-modal">
            <div class="modal-header modal-danger">
                   <div class="pull-left title"></div>
                   <div class="pull-right" data-dismiss="modal"><i class="fa fa-close"></i></div>
            </div>
            <div class="modal-body ">
                    <div class="row">
                         <p class="text-center message">Are you sure you want to Delete this event ?</p>
                    </div>
            </div>
            <div class="modal-footer">
                
                <form method="POST" action="" id="yesOrNoForm" class="pull-right">
                    {{ csrf_field() }}
                   <input class="form-control" type="hidden" name="id">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-danger btn-simple">YES</button>
                </form>
            </div>
        </div>
    </div>
</div>