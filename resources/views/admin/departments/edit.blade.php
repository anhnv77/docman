@extends('admin.layouts')
@section('controller','Sửa Phòng Ban')
@section('content')

{!! Html::style('public/css/department.css') !!}

<div class="col-lg-7" style="padding-bottom:120px;">
   <div class="form-group">
        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                {!! Form::model($department) !!}
                {{ Form::label('name', trans('departments.name_department')) }}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
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
        <a href = "{{URL('admin/departments')}}">    
            {{ Form::button('<i class="fa fa-mail-reply"></i> ' . trans('documents.back'), ['type' => 'button', 'class' => 'btn btn-danger']) }}
        </a>

        {{ Form::button('<i class="fa fa-check"></i> Cập nhật', ['type' => 'button', 'class' => 'btn btn-primary pull-right submitEditDepartment']) }}
        
        {!! Form::close() !!}
    </div>

    <input type="hidden" id="ID_Edit" value = "{{ $department->id }}">
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/editDepartment.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('admin/departments')}}";
</script>
@endsection()