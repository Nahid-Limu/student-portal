<div id="courseTeacher"  role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true"
    class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-responsive-label" class="modal-title">Add New Course</h4>
            </div>
            <form id="create_courseTeacher_modal_form">
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
                            <div class="col-md-6">
                                <label for="teacher_id" class="pull-left"><h5>Select Teacher<span class='require'>*</span></h5></label>
                                <div>
                                    <select id="teacher_id" name="teacher_id"  class="form-control" style="width: 100%">
                                        <option value="">Select Teacher</option>
                                    </select>
                                    <b class="form-text text-danger pull-left" id="studentError"></b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="course_id" class="pull-left"><h5>Select Course<span class='require'>*</span></h5></label>
                                <div>
                                    <select id="course_id" name="course_id[]" multiple="multiple" class="form-control" style="width: 100%">
                                        <option value="">Select Course</option>
                                    </select>
                                    <b class="form-text text-danger pull-left" id="studentError"></b>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info pull-right" id="assign"><i class="fa fa-plus"></i>
                        Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>