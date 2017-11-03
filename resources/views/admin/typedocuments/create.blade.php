@extends('admin.layouts')
@section('title')
    {{ trans('typedocument.add_typedoc') }}
@stop
@section('controller','Thêm Loại Tài Liệu')

{!! Html::style('public/css/typeofdocuments.css') !!}

@section('content')
<div class="row">
    <div class="col-md-7" style="padding-bottom:120px;">
        <div class="form-group">
            <div class="row">
                <div class="col-md-9 ">
                    <div class="form-group">
                    {!! Form::open(['class' => 'form-horizontal']) !!}
                    {{ Form::label('name', trans('typedocument.name_typedoc')) }}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('typedocument.enter_name_typedoc')]) !!}
                    </div>
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-9 ">
                <div class="form-group" style="margin-top: 50px">
                    {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('typedocument.typedoc_add'), ['type' => 'button', 'class' => 'btn btn-primary submitAddType']) }}
                    {{ Form::button('<i class="fa fa-refresh"></i> ' . trans('typedocument.reset'), ['type' => 'reset', 'class' => 'btn btn-danger pull-right']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/addTypeDocument.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('admin/typedocuments')}}";
</script>
@stop