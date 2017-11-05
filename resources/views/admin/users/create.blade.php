@extends('admin.layouts')
@section('title')
    {{ trans('users.add_users') }}
@stop
@section('controller','Thêm Nhân Viên')
@section('content')

{!! Html::style('public/css/user.css') !!}

<div class="col-lg-7" style="padding-bottom:120px;">
    <div class="form-group">
        <div class="row">
            <div class="col-md-9 ">
                <div class="form-group">
                {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal']) !!}
                {{ Form::label('username', trans('users.username')) }}
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => trans('users.enter_username')]) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9 ">
                <div class="form-group">
                {{ Form::label('name', trans('users.name')) }}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('users.enter_name')]) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9 ">
                <div class="form-group">
                {{ Form::label('password', trans('users.password')) }}
                <input type="text" name="password" id="password" placeholder="{{trans('users.enter_password')}}" class="form-control">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-9 ">
                <div class="form-group">
                    <label class="col-md-4 control-label" style="margin-left: -15px;">Quyền</label>
                    <select class="form-control" name="role" id="chooseValidation">
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" >{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 ">
            <div class="form-group">
                {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('users.add_users'), ['type' => 'button', 'class' => 'btn btn-primary submitAddUser']) }}
                {{ Form::button('<i class="fa fa-refresh"></i> ' . trans('departments.reset'), ['type' => 'reset', 'class' => 'btn btn-danger pull-right']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/addUser.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('admin/users')}}";
</script>
@endsection()