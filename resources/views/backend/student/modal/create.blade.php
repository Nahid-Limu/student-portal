<div id="createStudent" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true"
    class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-responsive-label" class="modal-title">Add Student</h4>
            </div>
            <form id="create_teacher_modal_form">
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
                                <label for="name" class="pull-left">
                                    <h5>Name:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="text" name="name"
                                        id="name">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="pull-left">
                                    <h5>Email:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="email" name="email"
                                        id="email">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="phone" class="pull-left">
                                    <h5>Pnone:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="tel" name="phone"
                                        id="phone">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="pull-left">
                                    <h5>Designation:</h5>
                                </label>
                                <div>
                                    <input class="form-control select2Style" type="text" name="designation"
                                        id="address">
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="address" class="pull-left">
                                    <h5>Address:</h5>
                                </label>
                                <div>
                                    <textarea name="address" id="address" cols="10" rows="3" style="width: 100%;"></textarea>
                                    <b class="form-text text-danger pull-left" id="transportationError"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info pull-right" id="add"><i class="fa fa-plus"></i>
                        Add</button>
                </div>
            </form>
        </div>
    </div>
</div>