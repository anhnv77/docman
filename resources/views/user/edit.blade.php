@extends('admin.layouts')
@section('title')
    {{ trans('documents.edit_document') }}
@stop
@section('controller', trans('documents.edit_document'))
@section('action',trans('documents.form_edit_document'))
@section('content')

{!! Html::style('public/css/document.css') !!}

<div class="col-lg-7" style="padding-bottom:120px;  ">
    <div class="form-group">

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                {!! Form::model($document) !!}
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
                {{ Form::label('description', trans('documents.description')) }}
            	{{ Form::textarea('description', null, ['class' => 'field form-control']) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
	                <label>Trạng thái tài liệu:</label>
                    <label class="radio-inline">
                        <input name="is_public" class="is_private" value="0" type="radio"
                        @if($document['is_public'] == 0){
                            checked="checked"
                        }
                        @endif
                        > Nội bộ
                    </label>
                    <label class="radio-inline" style="margin-left: 20px;">
                        <input name="is_public" class="is_public" value="1" type="radio"
                        @if($document['is_public'] == 1){
                            checked="checked"
                        }
                        @endif
                        >Công khai
                    </label>
                </div>
            </div>
        </div>


    </div>

    <div class="form-group">
        <a href = "{{URL('document')}}">    
            {{ Form::button('<i class="fa fa-mail-reply"></i> ' . trans('documents.back'), ['type' => 'button', 'class' => 'btn btn-danger']) }}
        </a>
        

        {{ Form::button('<i class="fa fa-check"></i> ' . trans('documents.document_edit'), ['type' => 'button', 'class' => 'btn btn-primary submitEditDocument pull-right']) }}

    </div>

    <input type="hidden" id="ID_Edit" value = "{{ $document->id }}">
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/editDocument.js') }}"></script>


@stop