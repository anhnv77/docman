@extends('admin.layouts')

@section('title')
    {{ trans('users.profile') }}
@stop

{!! Html::style('public/css/profile.css') !!}

@section('content')
    
<div class="row" style="padding-left: 15px; padding-right: 15px">

    <div class="col-md-4 leftForAvt">

        {{ Html::image($user->avatar, $user->name, ['class' => 'img-responsive']) }}

        <br>

        <table class="table table-striped table-info">
            <tbody>
            <tr>
                <td style="width: 35%"><i class="fa fa-user"></i> &nbsp&nbsp&nbsp<strong>Họ tên:</strong></td>
                <td> {{ $user->name }}</td>
            </tr>
            <tr>
                <td style="width: 35%"><i class="fa fa-envelope"></i> &nbsp&nbsp<strong>Email:</strong></td>
                <td> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
            </tr>

            </tbody>
        </table>

    </div>

    <div class="col-md-4">
    </div>

    <!-- change profile -->
    <div class="col-md-4 rightForUpdate">
        <br>
        <button class="buttonChangeProfile linkNormal btn btn-primary">
            Thay đổi thông tin cá nhân
        </button>

        <br><br>
        {!! Form::model($user, ['class' => 'form-horizontal needHide formUpdateProfile', 'files' => true]) !!}

        {!! Form::label('name', "Họ và tên") !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}

        <br>
        
        {!! Form::label('email', "Địa chỉ Email") !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
        
        <br>

        {!! Form::label('avatar', "Ảnh đại diện") !!}
        {!! Form::file('avatar') !!}

        <br><br>

        {!! Form::button('<i class="fa fa-check"></i> ' . "Xác nhận", ['type' => 'button', 'class' => 'btn btn-success buttonSubmitEditProfile']) !!}

        {!! Form::close() !!}

        <hr>
        <br>
        @if ($user->type == 0)

        <button class="buttonChangePassword linkNormal btn btn-primary">
            Thay đổi mật khẩu
        </button>

        <br/><br>

        {!! Form::open(['class' => 'form-horizontal needHide formUpdatePassword' ]) !!}

        {!! Form::label('old_password', "Mật khẩu cũ") !!}
        {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => "Nhập mật khẩu cũ"]) !!}
        
        <br>
        
        {!! Form::label('password', "Mật khẩu mới") !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Nhập mật khẩu mới"]) !!}
        
        <br>

        {!! Form::label('password_confirmation', "Xác nhận mật khẩu mới") !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => "Nhập mật khẩu mới"]) !!}

        <br><br>

        {!! Form::button('<i class="fa fa-check"></i> ' . "Xác nhận", ['type' => 'button', 'class' => 'btn btn-success buttonSubmiteEditPassword']) !!}

        {!! Form::close() !!}

        @endif
    </div>

</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/profile.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('users/profile')}}";
</script>

@stop
