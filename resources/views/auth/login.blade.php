@extends('admin.layouts')

@section('title', "Đăng nhập hệ thống")

@section('content')

    {!! Html::style('public/css/login.css') !!}

    <div class="row" style="{{ Auth::guest() ? 'margin-top: 60px' : ''}}">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('login.login') }}</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">{{ trans('login.username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="Tài khoản ctmail.vnu.edu.vn">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('login.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn-primary login-button">
                                    <i class="fa fa-btn fa-sign-in"></i> &nbsp&nbsp&nbsp 
                                    {{ trans('login.login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (Session::get('message') == "1")
        <script> alert("Vui lòng nhập tên đăng nhập và mật khẩu trước khi xác nhận."); </script>
    @elseif (Session::get('message') == "2")
        <script> alert("Tên đăng nhập hoặc mật khẩu không hợp lệ."); </script>
    @elseif (Session::get('message') == "3")
        <script> alert("Tài khoản của bạn đã bị khóa. Vui lòng liên hệ ADMIN để biết thêm thông tin chi tiết."); </script>    
    @endif
@endsection
