<!-- Navigation -->

{!! Html::style('public/css/navbar.css') !!}

<nav id="mainNav" class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{URL('')}}" style="padding: 15px 3px;">
            <img src="{{URL::asset('public/images/cn.jpg')}}" class="avatarPage"> &nbsp
            {{ trans('layouts.layouts.title') }}
        </a>
    </div>

    <!-- /.navbar-header -->

    @if (!Auth::guest())


        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user fa-fw"></i>
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{ URL('users/profile') }}">
                            <i class="fa fa-user fa-fw"></i>
                            {{ trans('layouts.layouts.user_profile') }}
                        </a>
                    </li>

                    {{--<li>--}}
                    {{--<a href="{{ URL('mydocuments') }}">--}}
                    {{--<i class="fa fa-gear fa-fw"></i>--}}
                    {{--{{ trans('layouts.layouts.mydocument') }}--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    <li class="divider">

                    </li>
                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out fa-fw"></i>
                            {{ trans('layouts.layouts.logout') }}
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    @endif

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

            @if (auth()->check() && Auth::user()->hasRole('admin'))
                <!-- Dashboard -->
                    <li>
                        <a class="{{ Request::is('admin/dashboard') ? 'seeing-li active' : ''}}"
                           href="{{ url('admin/dashboard') }}">
                            <i class="fa fa-dashboard"></i> &nbsp{{ trans('layouts.dashboard') }}
                        </a>
                    </li>

                    <!-- Quản lý User -->
                    <li>
                        <a class="{{ Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/users/*')? 'seeing-li active' : ''}}"
                           href="#">
                            <i class="fa fa-user"></i> &nbsp&nbsp
                            {{ trans('layouts.user') }}
                            <span class="fa arrow"></span>
                        </a>

                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ url('admin/users') }}">
                                    <i class="fa fa-server fa-fw"></i> &nbsp
                                    Danh sách người dùng
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/users/create') }}">
                                    <i class="fa fa-plus-circle fa-fw"></i> &nbsp
                                    Thêm người dùng mới
                                </a>
                            </li>
                        </ul>
                    </li>

            @endif

            @if (auth()->check())

                <!-- Quản lý Tài Liệu -->
                    <li>
                        <a class="{{ Request::is('document') || Request::is('document/*') || Request::is('document/create') || Request::is('document/edit/*') ? 'seeing-li active' : ''}}"
                           href="#">
                            <i class="fa fa-book" aria-hidden="true"></i> &nbsp
                            {{ trans('layouts.document') }}
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ url('document') }}">
                                    <i class="fa fa-server fa-fw"></i> &nbsp
                                    {{ trans('documents.list_document') }}
                                </a>
                            </li>

                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{ url('document',['key'=>4]) }}">
                                        <i class="fa fa-bank fa-fw"></i> &nbsp
                                        Văn bản đi
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('document',['key'=>5]) }}">
                                        <i class="fa fa-bank fa-fw"></i> &nbsp
                                        Văn bản đến
                                    </a>
                                </li>
                            </ul>


                            @if (auth()->check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')))
                                <li>
                                    <a href="{{ url('document/create') }}">
                                        <i class="fa fa-upload fa-fw"></i> &nbsp
                                        {{ trans('documents.add_document') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
            @endif

            <!-- Quản lý phòng ban -->
                @if (auth()->check() && Auth::user()->hasRole('admin'))
                    {{--<li>--}}
                    {{--<a class="{{ Request::is('admin/departments') || Request::is('admin/departments/create') || Request::is('admin/departments/edit/*') ? 'seeing-li active' : ''}}"--}}
                    {{--href="#">--}}
                    {{--<i class="fa fa-users" aria-hidden="true"></i> &nbsp--}}
                    {{--{{ trans('layouts.department') }}--}}
                    {{--<span class="fa arrow"></span>--}}
                    {{--</a>--}}

                    {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                    {{--<a href="{{ url('admin/departments') }}">--}}
                    {{--<i class="fa fa-bank fa-fw"></i> &nbsp--}}
                    {{--{{ trans('departments.list_department') }}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ url('admin/departments/create') }}">--}}
                    {{--<i class="fa fa-plus-circle fa-fw"></i> &nbsp--}}
                    {{--{{ trans('departments.add_department') }}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a class="{{ Request::is('admin/typedocuments') || Request::is('admin/typedocuments/create') ? 'seeing-li active' : ''}}"--}}
                    {{--href="#">--}}
                    {{--<i class="fa fa-book" aria-hidden="true"></i> &nbsp--}}
                    {{--{{ trans('layouts.typedocument') }}--}}
                    {{--<span class="fa arrow"></span>--}}
                    {{--</a>--}}

                    {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                    {{--<a href="{{ url('admin/typedocuments') }}">--}}
                    {{--<i class="fa fa-server fa-fw"></i> &nbsp--}}
                    {{--{{ trans('typedocument.list_typedoc') }}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ url('admin/typedocuments/create') }}">--}}
                    {{--<i class="fa fa-plus-circle fa-fw"></i> &nbsp--}}
                    {{--{{ trans('typedocument.add_typedoc') }}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}

                    <li>
                        <a class="{{ Request::is('admin/logs') ? 'seeing-li active' : ''}}"
                           href="{{URL('admin/logs')}}">
                            <i class="fa fa-clock-o"></i> &nbsp
                            Lịch sử hệ thống
                        </a>
                    </li>
                @endif

            <!-- Quản lý phòng bởi trưởng phòng -->
                {{--@if (auth()->check() && Auth::user()->hasRole('manager'))--}}
                {{--<li>--}}
                {{--<a class="{{ Request::is('manager/users') || Request::is('manager/documents') ? 'seeing-li active' : ''}}"--}}
                {{--href="#">--}}
                {{--<i class="fa fa-institution" aria-hidden="true"></i> &nbsp--}}
                {{--Quản lý phòng--}}
                {{--<span class="fa arrow"></span>--}}
                {{--</a>--}}

                {{--<ul class="nav nav-second-level">--}}
                {{--<li>--}}
                {{--<a href="{{ url('manager/users') }}">--}}
                {{--<i class="fa fa-user fa-fw"></i> &nbsp--}}
                {{--Danh sách nhân viên--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="{{ url('manager/documents') }}">--}}
                {{--<i class="fa fa-book fa-fw"></i> &nbsp--}}
                {{--Danh sách tài liệu--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--@endif--}}
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>