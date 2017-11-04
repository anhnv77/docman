@extends('admin.layouts')
@section('title')
    {{ trans('departments.list_department') }}
@stop
@section('controller','Danh Sách Phòng Ban')
@section('content')

{!! Html::style('public/css/department.css') !!}

<div class="row">
    <div class="col-lg-12">
        
        <div class="content-table">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                
                <thead>
                    <tr>
                        <th style="width: 4%">{{ trans('departments.STT') }}</th>
                        <th style="width: 25%">{{ trans('departments.name_department') }}</th>
                        <th style="width: 16%" class="hidden-xs hidden-md hidden-sm">{{ trans('departments.alias') }}</th>
                        <th style="width: 22%" class="hidden-xs hidden-md">{{ trans('departments.address') }}</th>
                        <th style="width: 13%" class="hidden-xs hidden-md hidden-sm">{{ trans('departments.number_users') }}</th>
                        <th style="width: 13%" >{{ trans('departments.number_documents') }}</th>
                        <th style="width: 7%" class="center">{{ trans('departments.edit') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $dem = 0; ?>
                    @foreach($departments as $item)
                    <tr>
                        <th class="center">{{ ++$dem }}</th>
                        <th><a class="linkNormal"><b>{{ $item['name'] }}</b></a></th>
                        <th class="hidden-xs hidden-md hidden-sm">{{ $item['alias'] }}</th>
                        <th class="hidden-xs hidden-md">{{ $item['address'] }}</th>
                        <th class="hidden-xs hidden-md hidden-sm">
                            @if ($item['number_users'] > 0)
                                <a href= "{{ URL('admin/users/'.$item->id) }}" title="Nhấn để xem danh sách nhân viên">{{ $item['number_users']}}</a>
                            @else
                                {{ $item['number_users']}}
                            @endif
                        </th>
                        <th>
                            @if ($item['number_documents'] > 0)
                                <a href= "{{ URL('document/'.$item->id) }}" title="Nhấn để xem danh sách tài liệu">{{ $item['number_documents']}}</a>
                            @else
                                {{ $item['number_users']}}
                            @endif
                        </th>

                        <th class="center">
                            <a href = "{{ URL('admin/departments/edit/'.$item->id)}}" title = "Nhấn để sửa thông tin phòng ban"> <i class="fa fa-edit"></i></a>
                        </th>
                        
                    </tr>
                    @endforeach()
                </tbody>
            </table>
            
        </div>
        
    </div>
    <!-- /.col-lg-12 -->
</div>

@endsection()