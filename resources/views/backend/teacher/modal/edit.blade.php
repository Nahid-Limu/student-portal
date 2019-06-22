<div id="editTeacher" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true"
    class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-responsive-label" class="modal-title">Edit Teacher</h4>
            </div>
            <form id="edit_teacher_modal_form">
                @csrf
                <div class="modal-body">
                    <!-- Error list Start -->
                    <span id="edit_form_result"></span>
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
                            <div class="col-md-6">
                                <label for="edit_name" class="pull-left">
                                    <h5>Name:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="text" name="edit_name"
                                        id="edit_name">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_phone" class="pull-left">
                                    <h5>Pnone:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="tel" name="edit_phone"
                                        id="edit_phone">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="edit_designation" class="pull-left">
                                    <h5>Designation:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="text" name="edit_designation"
                                        id="edit_designation">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="pull-left">
                                    <h5>Status:</h5>
                                </label>
                                <div>
                                        <select class="form-control" name="status" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                                
                                            </select>
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info pull-right" id="update"><i class="fa fa-refresh"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>
</div>