@extends('admin.layouts')
@section('title')
    {{ trans('typedocument.edit_typedoc') }}
@stop
@section('controller','Sửa Loại Tài Liệu')
@section('action','Edit')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px;">
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                @include('errors.errors')
                {!! Form::model($typeDocument, ['method' => 'PATCH', 'route' => ['admin.typedocuments.update', $typeDocument->id]]) !!}
                {{ Form::label('name', trans('typedocument.name_typedoc')) }}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('typedocument.enter_name_typedoc')]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('typedocument.edit_typedoc'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {{ Form::button('<i class="fa fa-refresh"></i> ' . trans('typedocument.reset'), ['type' => 'reset', 'class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>
</div>
@stop