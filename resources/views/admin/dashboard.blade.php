@extends('admin.layouts')
@section('title')
    {{ trans('users.dashboard') }}
@stop
@section('controller',trans('users.dashboard'))
@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                Bảng thống kê hệ thống
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" style="overflow: auto">
                <table width="100%" class="table table-striped table-bordered table-hover" class="min-width: 200px">

                    <thead>
                        <tr>
                            <th>Tổng số tài liệu</th>
                            
                            @foreach($allDepartment as $item)
                                <th style="width: auto">    
                                    <a class="linkNormal" href="javascript:void(0)" title="{{ $item->name }}">
                                        {{ $item->alias }}
                                    </a>
                                </th>
                            @endforeach()
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                        	<td><a href="{{ URL('document') }}">{{ $allDoc->count() }}</a></td>
                        	
                            @foreach($allDepartment as $item)

                                @if ($item->countDoc > 0)
                                	<td>
                                        <a href="{{ URL('document/'.$item->id) }}">
                                        {{ $item->countDoc }}
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        {{ $item->countDoc }}
                                    </td>
                                @endif
                            @endforeach()
                        </tr>
                     
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    
@stop