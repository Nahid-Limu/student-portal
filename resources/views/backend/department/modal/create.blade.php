<div id="createDepartment" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true"
    class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-responsive-label" class="modal-title">Add Department</h4>
            </div>
            <form id="create_department_modal_form">
                @csrf
                <div class="modal-body">
                    <!-- Error list Start -->
                    <span id="form_result"></span>
                    @if ($errors->any())
                    <div id="alert_message" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Error list End -->
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="pull-left">
                                    <h5>Department Name:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="text" name="department_name"
                                        id="department_name">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="address" class="pull-left">
                                    <h5>Remarks:</h5>
                                </label>
                                <div>
                                    <textarea name="remarks" id="remarks" cols="10" rows="3" style="width: 100%;"></textarea>
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info pull-right" id="create"><i class="fa fa-plus"></i>
                        Create</button>
                </div>
            </form>
        </div>
    </div>
</div>