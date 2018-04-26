
<!-- Import excel -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
        	 <form action="/postexcel" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="modal-header">
                        <div class="col-md-6">
                            <div class="pull-center">IMPORT EXCEL</div>
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
                        </div>
								<div class="form-group import-form">
									<input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="alumni">
									
								</div>  

                        <div class="content-footer clearfix text-center">
                            <button type="submit" value="Import" class="btn btn-primary btn-md">IMPORT</button>
                        </div>

                        </div>
                        
                    </form>
        </div>
    </div>
</div>