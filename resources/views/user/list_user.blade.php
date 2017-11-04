@extends('admin.layouts')
@section('title')
    Danh sách nhân viên
@stop
@section('controller','Danh Sách Nhân Viên')
@section('action','List')
@section('content')
<div class="row">
    <div class="col-md-12">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr> 
                    <th>ID</th>
                    <th>Phòng Ban</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Chức vụ</th>
                </tr>
            </thead>
            <tbody>
               @foreach($users as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->department->name }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role->name }}</td>
                </tr>
                @endforeach()
                
            </tbody>
        </table>
        <!-- pagination -->
        <div class="pagination pull-right">
            
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
@stop