@extends('admin.layouts')
@section('title')
    {{ trans('users.list_users') }}
@stop
@section('controller')
    {{ 'Thành viên ' . $department->name }}
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('users.title_table_users') }}
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <!-- /.col-lg-12 -->
                    <div class = "col-lg-12">
                        @include('errors.success')
                    </div>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Chức vụ</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.departments.users.delete',$user->id]]) !!}
                                {{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . 'Delete', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure to delete ?')"]) }}
                                {!! Form::close() !!}
                            </td>
                            
                        </tr>
                      @endforeach()
                    </tbody>
                </table>
                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

@endsection()