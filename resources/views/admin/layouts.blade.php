<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Nguyen Manh Duy">

    <link rel="shortcut icon" type="image/jpg" href="{{ URL::asset('public/images/cn.jpg') }}" />

    <title>@yield('title')</title>

    <!-- MetisMenu CSS -->
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.2/metisMenu.min.css') !!}

    <!-- Custom Fonts -->
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') !!}
    {!! Html::style('https://fonts.googleapis.com/css?family=Lato:100,300,400,700') !!}

    <!-- DataTables CSS -->
    {!! Html::style('https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css') !!}


    <!-- Styles -->
    {!! Html::style('public/css/app.css') !!}
    @yield(('style'))

    <!-- jQuery -->
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js') !!}

    <!-- JavaScripts -->
    {!! Html::script('public/js/app.js') !!}
</head>

<body id="page-top" class="index">
    <div class="myModal">
        
    </div>

    <div id="wrapper">

        <!-- Navigation Bar -->
        @include('admin.navbar')
        
        <!-- Page Content -->
        <div id="page-wrapper" style="{{ Auth::guest() ? 'margin-left: 0px' : '' }}">
            <div class="container-fluid beforeFooter">
                <div>
                    @if (!Auth::guest())
                    <h1 class="page-header">@yield('controller')
                        <small>@yield('action')</small>
                    </h1>
                    @endif
                    <!-- đây là nơi chứa nội dung -->
                    @yield('content')
                    <!-- end nội dung -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

            @include('layouts.footer', array('eplist'=>'1'))
        </div>

        <input type="hidden" id="token" name="_token" value="{!! csrf_token() !!}">
        
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @yield('script')

    
    <!-- Metis Menu Plugin JavaScript -->
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.2/metisMenu.min.js') !!}

    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js') !!}
    <!-- Custom Theme JavaScript -->
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7+1/js/sb-admin-2.js') !!}
    
</body>
</html>