@extends('layouts.master')
@section('title', 'Student List')

@section('extra_css')
@endsection

@section('page_content')
<!-- page content -->
<div class="right_col" role="main">

    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div class="row">
        <div class="page-title" style="font-size: 30px;">
            <i class="fa fa-list"></i>
            Student
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{route('dashbord')}}">Home</a>&nbsp;&nbsp;<i
                    class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Student</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Student List</li>
        </ol>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Student List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <div class="col-md-6" style="text-align: right;">
                            <a href="" class="add-new-modal btn btn-success btn-round btn-xs" data-toggle="modal"
                                data-target="#createStudent"> <i class="fa fa-plus"></i> Add New</a>
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

                    <table id="teacher_list" class="table table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>
        <!-- Modal Start -->
        @include('backend.student.modal.create')
        @include('backend.student.modal.edit')
        <!-- Modal End -->
    </div>
</div>
<!-- /page content -->
@endsection

@section('extra_js')
<script>
    $(document).ready(function(){
            //$('#teacher_list').DataTable();
            //lode teachers list
            $('#teacher_list').DataTable({
                processing: true,
                serverSide: true,
                "order": [[ 0, "desc" ]],
                ajax:{
                url: "{{ route('teacher_view') }}",
                },
                columns:[
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'designation',
                    name: 'designation'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, full, meta){
                        return data == '1' ? '<span style="color:green">Active</span>' : '<span style="color:red">InActive</span>'
                    },
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
                ]
            });

            //add teacher
            $( "#add" ).click(function() {
                var _token = '{{ csrf_token() }}';
                var myData = $('#create_teacher_modal_form').serialize();
                //alert(_token);
                $.ajax({
                    url:"{{route('create_teacher')}}",
                    method:"post",
                    data: myData,
                    success:function (response) {
    
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
                        $('#create_teacher_modal_form')[0].reset();
                        $('#teacher_list').DataTable().ajax.reload();
                        $('#createTeacher').modal('hide');
                        }
                        
                    }
                });
            });

            //Edit Teacher
            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                //alert(id);
                //$('#form_result').html('');
                $.ajax({
                type: "GET",
                url:"{{url('teachers_edit')}}"+"/"+id,
                dataType:"json",
                success:function(response){
                    //console.log(response);
                    $('#edit_name').val(response.name);
                    $('#edit_phone').val(response.phone);
                    $('#edit_designation').val(response.designation);
                    $('#id').val(response.id);
                  
                    $("#status option[value=" + response.status + "]").prop('selected', true);
                }
                })
            });

            //update Teacher
            $( "#update" ).click(function() {
                var _token = '{{ csrf_token() }}';
                var editData = $('#edit_teacher_modal_form').serialize();
                //alert(department_name);
                    $.ajax({
                        url:"{{route('update_teacher')}}",
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
                            if(response.falied)
                            {
                                swal(response.falied, "", "warning");
                            }
                            if(response.success)
                            {
                                swal(response.success, "", "success");
                                $('#edit_form_result').hide();
                                $('#edit_teacher_modal_form')[0].reset();
                                $('#teacher_list').DataTable().ajax.reload();
                                $('#editTeacher').modal('hide');
                            }
                        }
                    });
                });

        });
</script>
@endsection