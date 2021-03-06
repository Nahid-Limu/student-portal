@extends('layouts.master')
@section('title', 'Student Profile')

@section('extra_css')
<style>
    .form-group {
        padding: 13px;
        padding-bottom: 0px;
    }
</style>
@endsection

@section('page_content')
<!-- page content -->
<div class="right_col" role="main">

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div class="row">
        <div class="page-title" style="font-size: 30px;">
            <i class="fa fa-user"></i>
            Profile
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{route('dashbord')}}">Home</a>&nbsp;&nbsp;<i
                    class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Teacher</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Student Profile</li>
        </ol>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->

    <!--Flash Message Start-->
    @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
    @endif
    @if(Session::has('error'))
        <p id="alert_message" class="alert alert-error">{{ Session::get('error') }}</p>
    @endif
    @if(Session::has('delete'))
        <p id="alert_message" class="alert alert-danger">{{ Session::get('delete') }}</p>
    @endif
    <!--Flash Message End-->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Student Profile</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                @if ($student->image)
                                <img class="img-responsive avatar-view" src="{{asset('student_images').'/'.$student->image }}"
                                alt="Avatar" title="Change the avatar" style="width: 180px; height: 220px;">
                                @else
                                <img class="img-responsive avatar-view" src="{{ asset('images/noProfilePic.jpg') }}"
                                alt="Avatar" title="Change the avatar" style="width: 180px; height: 220px;">
                                @endif
                                
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <a class="btn btn-xs btn-success" data-toggle="modal"
                                        data-target="#changePassword"><i class="fa fa-edit m-right-xs"></i>Password</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-xs btn-success" data-toggle="modal"
                                    data-target="#changeImage"><i class="fa fa-edit m-right-xs"></i>Photo</a>
                                </div>
                            </div>
                        </div>
                        <br />
                        <h3></h3>

                        <ul class="list-unstyled user_data">
                            <li>
                                <p><strong>CMS ID:</strong></p>
                                <p style="margin-top: 5px;"> <span><i class="fa fa-user user-profile-icon"></i>
                                    {{$student->cms_id}}</span> </p>
                            </li>

                            <li style="margin-top: 10px;">
                                <p><strong>Student Name:</strong></p>
                                <p style="margin-top: 5px;"> <span><i class="fa fa-briefcase user-profile-icon"></i>
                                    {{$student->name}} </span> </p>

                            </li>

                            <li style="margin-top: 10px;">
                                <p><strong>Department:</strong></p>
                                <p style="margin-top: 5px;"> <span><i class="fa fa-briefcase user-profile-icon"></i>
                                    {{$student->department_name}} </span> </p>

                            </li>
                        </ul>

                        <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                        data-toggle="tab" aria-expanded="true">Profile</a>
                                </li>

                                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2"
                                        data-toggle="tab" aria-expanded="false">Course Info</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                    aria-labelledby="home-tab">

                                    <!-- start profile activity -->
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2><i class="fa fa-info-circle"></i> General Info</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <div class="col-md-6" style="text-align: right;">
                                                            <a href=""
                                                                class="add-new-modal btn btn-success btn-round btn-xs"
                                                                data-toggle="modal" data-target="#createTeacher"
                                                                title="Edit Profile"> <i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="col-md-6" style="text-align: right;">
                                                            <a class="collapse-link"><i
                                                                    class="fa fa-chevron-up"></i></a>
                                                        </div>

                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content table-responsive">
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="col-md-5 col-sm-4 col-xs-5 control-label">Name:
                                                                </label>
                                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                                    {{$student->name}} &nbsp
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="col-md-5 col-sm-4 col-xs-5 control-label">Phone:
                                                                </label>
                                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                                    {{$student->phone}} &nbsp
                                                                </div>

                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="col-md-5 col-sm-4 col-xs-5 control-label">Email:
                                                                </label>
                                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                                    {{$student->email}} &nbsp
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="col-md-5 col-sm-4 col-xs-5 control-label">Blood Group:
                                                                </label>
                                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                                    {{$student->email}} &nbsp
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="col-md-5 col-sm-4 col-xs-5 control-label">Address:
                                                                </label>
                                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                                    {{$student->address}} &nbsp
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="col-md-5 col-sm-4 col-xs-5 control-label">Department:
                                                                </label>
                                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                                    {{$student->department_name}} &nbsp
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>

                                        </div>
                                    </div>

                                    <!-- end profile activity -->

                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab_content3"
                                    aria-labelledby="profile-tab">

                                    <!-- start course activity -->
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2><i class="fa fa-info-circle"></i> Course Info</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        
                                                        <div class="col-md-6" style="text-align: right;">
                                                            <a class="collapse-link"><i
                                                                    class="fa fa-chevron-up"></i></a>
                                                        </div>

                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content table-responsive">
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="col-md-5 col-sm-4 col-xs-5 control-label">Course List:
                                                                </label>
                                                                <div class="col-md-7 col-sm-8 col-xs-7">
                                                                    CSE-111, CSE-121 &nbsp
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="clearfix"></div>

                                        </div>
                                    </div>

                                    <!-- end course activity -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Modal Start -->
        @include('backend.student.modal.change_password')
        @include('backend.student.modal.change_photo')
        <!-- Modal End -->
    </div>
    <!-- /page content -->
    @endsection

    @section('extra_js')
    <script>
        $(document).ready(function(){

            //show password
            $('#show').click(function(){
                if($("#new_password").val() != '' ){
                    
                    $("#new_password").attr("type","text");
                    $("#confirm_password").attr("type","text");
                }
                
            });

            //update passeord
            $( "#changePass" ).click(function() {
                var _token = '{{ csrf_token() }}';
                var updatePassword = $('#change_password').serialize();
                //alert(_token);
                    $.ajax({
                        url:"{{route('change_password')}}",
                        method:"post",
                        data: updatePassword,
                        success:function (response) {
                            //console.log(response);
                            var html = '';
                            if(response.errors)
                            {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < response.errors.length; count++)
                            {
                            html += '<p>' + response.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#password_form_result').html(html);
                            }
                            if(response.falied)
                            {
                                swal(response.falied, "", "warning");
                            }
                            if(response.success)
                            {
                                swal(response.success, "", "success");
                                $('#password_form_result').hide();
                                $('#change_password')[0].reset();
                                //$('#teacher_list').DataTable().ajax.reload();
                                $('#changePassword').modal('hide');
                            }
                        }
                    });
                });

                //Change Profile picture
            $('#changePhoto_modal_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                url:"{{ route('student_update_photo') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    var html = '';
                    if(response.errors)
                    {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < response.errors.length; count++)
                    {
                    html += '<p>' + response.errors[count] + '</p>';
                    }
                    html += '</div>';
                    $('#form_result').html(html);
                    }
                    if(response.error)
                    {
                    swal(response.error, "", "error");
                    $('#changePhoto_modal_form')[0].reset();
                    $('#changeImage').modal('hide');
                    }
                    if(response.success)
                    {
                    swal(response.success, "", "success");
                    $("#crop-avatar").load(" #crop-avatar");
                    $('#changePhoto_modal_form')[0].reset();
                    $('#changeImage').modal('hide');
                    }
                },
                error: function(jqXHR, exception) {
                    if (jqXHR.status === 0) {
                        console.log('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        console.log('Requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        console.log('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        console.log('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        console.log('Time out error.');
                    } else if (exception === 'abort') {
                        console.log('Ajax request aborted.');
                    } else {
                        console.log('Uncaught Error.\n' + jqXHR.responseText);
                    }
                }
                
                })
            });

        });
    </script>
    @endsection