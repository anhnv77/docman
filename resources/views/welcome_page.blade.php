@extends('admin.layouts')
@section('title')
    {{ trans('layouts.layouts.title') }}
@stop

@section('content')

    {!! Html::style('public/css/welcome_page.css') !!}
    {!! Html::style('css/welcome_page.css') !!}

    <div class="row" style="{{ Auth::guest() ? 'margin-top: 60px' : ''}}">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('layouts.welcome') }}</div>
                <div class="panel-body" id="welcome-home">

                    {{ Html::image('/public/images/dms-banner.jpg', null, ['class' => 'img-responsive']) }}

                    <div class="row">
                        <div class="col-md-4">  
                            @if (Auth::guest())
                            <a href="{{ url('/login') }}">
                                <button class="btn-lg btn-primary login-button"> 
                                    {{ trans('layouts.login') }}
                                </button>
                            </a>
                            @endif
                        </div>
                        <div class="col-md-3"> </div>
                        <div class="col-md-5"> 
                            <a class="pull-right" href="{{ url('/hdsd') }}" target="_blank">
                                <button class="btn-lg btn-danger login-button"> 
                                    Hướng dẫn sử dụng
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($needInfo) && $needInfo == 1)
        @include('layouts.modal-add-user-info', array('departmentList' => $departmentList, 'oldName' => $oldName, 'oldEmail' => $oldEmail, 'oldDepartment' => $oldDepartment))
    @endif
@endsection
