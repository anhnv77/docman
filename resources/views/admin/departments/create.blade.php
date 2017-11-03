@extends('admin.layouts')
@section('title')
    {{ trans('departments.department_add') }}
@stop
@section('controller','Thêm Phòng Ban')
@section('content')

{!! Html::style('public/css/department.css') !!}


<div class="col-lg-7" style="padding-bottom:120px;">
    <div class="form-group">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="form-group">
                        {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal']) !!}
                        {{ Form::label('name', trans('departments.name_department')) }}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('departments.enter_name_department')]) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ">
                        <div class="form-group">
                        {{ Form::label('alias', trans('departments.alias')) }}
                        {!! Form::text('alias', null, ['class' => 'form-control', 'placeholder' => trans('departments.enter_alias')]) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ">
                        <div class="form-group">
                        {{ Form::label('address', trans('departments.address')) }}
                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => trans('departments.enter_address')]) !!}
                        </div>
                    </div>
                </div>
    </div>

    <div class="form-group">
        {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('departments.department_add'), ['type' => 'button', 'class' => 'btn btn-primary submitAddDepartment']) }}
        {{ Form::button('<i class="fa fa-refresh"></i> ' . trans('departments.reset'), ['type' => 'reset', 'class' => 'btn btn-danger pull-right']) }}
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/addDepartment.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('admin/departments')}}";
</script>
@endsection()