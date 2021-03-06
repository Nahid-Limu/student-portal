<?php
$url=request()->route()->getName();
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('dashbord')}}" class="site_title"><i class="fa fa-paw"></i> <span>CMS</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('images/profileImg.jpg') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>&nbsp</span>
                <h2>{{strtoupper(Auth::user()->name)}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                {{--  <h3>General</h3>  --}}
                <ul class="nav side-menu">
                    <li @if($url === 'dashboard') class="active" @endif ><a href="{{route('dashbord')}}">
                        <i class="fa fa-home"></i> Dashbord <span class="fa fa-chevron-down"></span>
                        </a>
                    </li>

                    <li><a><i class="fa fa-user"></i> Teacher <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            
                            {{--  <li><a href="index3.html">Dashboard3</a></li>  --}}
                            <li @if($url === 'teacher_view') class="active" @endif ><a href="{{route('teacher_view')}}">All Teachers</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-users"></i> Student <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            
                            <li @if($url === 'student_view') class="active" @endif><a href="{{route('student_view')}}">All Student</a></li>
                        </ul>
                    </li>

                     <li><a><i class="fa fa-file"></i> Assign Course <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            
                            <li @if($url === 'courseTeacher_view') class="active" @endif><a href="{{route('courseTeacher_view')}}">Course Assign To Teacher</a></li>
                            {{--  <li ><a href="">Course Assign To Student</a></li>  --}}
                        </ul>
                    </li>

                    <li><a><i class="fa fa-cogs"></i> Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            
                            <li @if($url === 'department_view') class="active" @endif><a href="{{route('department_view')}}">Depeartment</a></li>
                            <li @if($url === 'course_view') class="active" @endif><a href="{{route('course_view')}}">Course</a></li>
    
                        </ul>
                    </li> 
                    
                </ul>
            </div>
            {{-- <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                    
                    <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#level1_1">Level One</a>
                            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="level2.html">Level Two</a>
                                    </li>
                                    <li><a href="#level2_1">Level Two</a>
                                    </li>
                                    <li><a href="#level2_2">Level Two</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#level1_2">Level One</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div> --}}

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>