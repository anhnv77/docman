@extends('admin.layouts')
@section('controller' )
	{{ $document->title }}
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8 col-md-offset-1">
               <embed src="{{asset('documents/').'/'.$document->content}}" type="application/pdf" width="100%" height="500px">
            </div>
        </div>
    </div>
@stop