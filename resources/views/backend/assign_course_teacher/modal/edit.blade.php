<div id="editCourse" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true"
    class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-responsive-label" class="modal-title">Edit Course</h4>
            </div>
            <form id="edit_course_modal_form">
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
                                <label for="edit_course_name" class="pull-left">
                                    <h5>Edit Course Name:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="text" name="edit_course_name"
                                        id="edit_course_name" required>
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_course_code" class="pull-left">
                                    <h5>Edit Course Code:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="text" name="edit_course_code"
                                        id="edit_course_code" required>
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="edit_remarks" class="pull-left">
                                    <h5>Remarks:</h5>
                                </label>
                                <div>
                                    <textarea name="edit_remarks" id="edit_remarks" cols="10" rows="3" style="width: 100%;"></textarea>
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
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