@extends('layouts.master')
@section('title', 'Course Teacher List')

@section('extra_css')
@endsection

@section('page_content')
<!-- page content -->
<div class="right_col" role="main">

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div class="row">
        <div class="page-title" style="font-size: 30px;">
            <i class="fa fa-list"></i>
            Course Teacher
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{route('dashbord')}}">Home</a>&nbsp;&nbsp;<i
                    class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Course Teacher</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">List</li>
        </ol>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bars"></i>  List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <div class="col-md-6" style="text-align: right;">
                            <a href="" class="add-new-modal btn btn-success btn-round btn-xs" data-toggle="modal"
                                data-target="#courseTeacher"> <i class="fa fa-plus"></i> Add New</a>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </div>
                        {{--  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>  --}}
                        {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li> --}}
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content table-responsive">

                    <table id="courseTeacher_list" class="table table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Teacher</th>
                                <th>Courses</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>
        <!-- Modal Start -->
        @include('backend.assign_course_teacher.modal.create')
        @include('backend.assign_course_teacher.modal.edit')
        <!-- Modal End -->
    </div>
</div>
<!-- /page content -->
@endsection

@section('extra_js')
<script>
    $(document).ready(function(){
            //get teacher start
            $.ajax({
                url:"{{route('ajax.get_teacher')}}",
                method:"get",
                success:function (response) {
                    console.log(response);
                    $('#teacher_id').html(response);
                }
            });
            //get teacher end

            //get course start
            $.ajax({
                url:"{{route('ajax.get_course')}}",
                method:"get",
                success:function (response) {
                    console.log(response);
                    $('#course_id').html(response);
                }
            });
            //get course end

            //$('#department_list').DataTable();
            //lode department_list
            $('#courseTeacher_list').DataTable({
                processing: true,
                serverSide: true,
                "order": [[ 0, "desc" ]],
                ajax:{
                url: "{{ route('courseTeacher_view') }}",
                },
                columns:[
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex' 
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'courses',
                    name: 'courses'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
                ]
            });

            //add course
            $( "#assign" ).click(function() {
                var _token = '{{ csrf_token() }}';
                var myData = $('#create_courseTeacher_modal_form').serialize();
                alert(_token);
                $.ajax({
                    url:"{{route('assign_courseTeacher')}}",
                    method:"post",
                    data: myData,
                    success:function (response) {
                        console.log(response);
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
                        if(response.success)
                        {
                        swal(response.success, "", "success");
                        $('#create_courseTeacher_modal_form')[0].reset();
                        $('#courseTeacher_list').DataTable().ajax.reload();
                        $('#courseTeacher').modal('hide');
                        }
                        
                    }
                });
            });

            //Edit course
            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                //alert(id);
                //$('#form_result').html('');
                $.ajax({
                type: "GET",
                url:"{{url('course_edit')}}"+"/"+id,
                dataType:"json",
                success:function(response){
                    //console.log(response);
                    $('#edit_course_name').val(response.course_name);
                    $('#edit_course_code').val(response.course_code);
                    $('#edit_remarks').val(response.remarks);
                    $('#id').val(response.id);
                  
                    $("#status option[value=" + response.status + "]").prop('selected', true);
                }
                })
            });

            //update course
            $( "#update" ).click(function() {
                var _token = '{{ csrf_token() }}';
                //alert(_token);
                var editData = $('#edit_course_modal_form').serialize();
                //alert(department_name);
                    $.ajax({
                        url:"{{route('update_course')}}",
                        method:"post",
                        data: editData,
                        success:function (response) {
                            //console.log(response);
                            var html = '';
                            if(response.errors)
                            {
                            html = '<div class="alert alert-danger">';
                            
                            html += '<p>' + response.errors + '</p>';
                            
                            html += '</div>';
                            $('#edit_form_result').html(html);
                            }
                            if(response.warning)
                            {
                                swal(response.warning, "", "warning");
                            }
                            if(response.falied)
                            {
                                swal(response.falied, "", "error");
                            }
                            if(response.success)
                            {
                                swal(response.success, "", "success");
                                $('#edit_form_result').hide();
                                $('#edit_course_modal_form')[0].reset();
                                $('#course_list').DataTable().ajax.reload();
                                $('#editCourse').modal('hide');
                            }
                        }
                    });
                });

                $("#teacher_id").select2({
                    placeholder: "Select Teacher"
                });
                $("#course_id").select2({
                    placeholder: "Select Course"
                });

        });
</script>
@endsection