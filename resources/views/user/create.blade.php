@extends('admin.layouts')
@section('title')
    {{ trans('documents.add_document') }}
@stop
@section('controller',trans('documents.add_document'))
@section('content')

{!! Html::style('public/css/document.css') !!}

<div class="col-lg-7" style="padding-bottom:120px;  ">
    <div class="form-group">

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                {{ Form::label('title', trans('documents.name_document')) }}
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('documents.enter_name_document')]) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                
        		{{ Form::label('typedoc_id', trans('documents.name_typedocument')) }}
        		{!! Form::select('typedoc_id', $typedocument, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                <form class="form-group" enctype="multipart/form-data" id="formUploadDocument">
                    {{ Form::label('content', trans('documents.content')) }}
            		{{ Form::file('content', null) }}
                </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                {{ Form::label('description', trans('documents.description')) }}
            	{{ Form::textarea('description', null, ['class' => 'field form-control addDocumentTA']) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
	                <label>Trạng thái tài liệu:</label>
	                <label class="radio-inline">
	                    <input name="is_public" class="is_private" value="0" type="radio" checked>Nội bộ
	                </label>
	                <label class="radio-inline">
	                    <input name="is_public" class="is_public" value="1"  type="radio">Công khai
	                </label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('documents.add_document'), ['type' => 'button', 'class' => 'btn btn-primary submitAddDocument']) }}
        {{ Form::button('<i class="fa fa-refresh"></i> ' . trans('departments.reset'), ['type' => 'reset', 'class' => 'btn btn-danger pull-right']) }}
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/addDocument.js') }}"></script>
@stop