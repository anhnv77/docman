@extends('admin.layouts')
@section('title')
    Danh sách người dùng
@stop
@section('controller',$department->name)
@section('action', 'Nhân sự')

@section('content')

{!! Html::style('public/css/user.css') !!}

<div class="row">
    <div class="col-md-12">

        <div class="content-table"  style="min-height: 250px">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                    <tr> 
                        <th class="center" style="width: 4%" >STT.</th>
                        <th style="width: 22%">Họ và tên</th>
                        <th style="width: 16%" class="hidden-xs hidden-md hidden-sm">Tên đăng nhập</th>
                        <th style="width: 21%" class="hidden-xs hidden-md hidden-sm">Địa chỉ Email</th>
                        <th style="width: 15%">Chức vụ</th>
                        <th style="width: 14%" class="hidden-xs hidden-md hidden-sm">Số tài liệu</th>
                    </tr>
                </thead>

                <tbody id="needElements">
                    <?php
                        $dem = 1;
                        foreach($data as $ele){
                    ?>
                        <tr>    
                        <th class="center" ><?php echo $dem++; ?></th>
                        <th><?php if ($ele->fullname != null && $ele->fullname != "") echo $ele->fullname; else echo "---" ?></th>
                        <th>{{$ele->username}}</th>
                        <th><?php if ($ele->email != null && $ele->email != "") echo $ele->email; else echo "---" ?></th>
                        <th>{{$ele->role}}</th>
                        <th>{{$ele->numberDoc}}</th>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="modal fade" id="editUser" role="dialog">
    <div class="modal-dialog">
                    
        <div class="modal-content" style="border-radius: 0px">
            <div class="modal-header backgroundHere" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title headerModal">Sửa thông tin người dùng</h4>
            </div>

            <div class="modal-body" style="margin-bottom: 0px">
                <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Tên tài khoản </label>
                        <label class="col-md-5 control-label"> 
                            <span style="float: left" id="userNameEdit"></span> 
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Họ và tên </label>
                        <label class="col-md-5 control-label"> 
                            <span style="float: left" id="userFullNameEdit"></span> 
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Phòng trực thuộc </label>
                        <label class="col-md-5 control-label"> 
                            <span style="float: left" id="userDepartmentEdit"></span> 
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Quyền hiện tại </label>
                        <label class="col-md-5 control-label"> 
                            <span style="float: left" id="userValidationEdit"></span> 
                        </label>
                    </div>

                    <div class="form-group" style="margin-top: 30px">
                        <label class="col-md-4 control-label" for="editValidation">Sửa quyền hệ thống</label>
                        <div class="col-md-5">
                            <select class="form-control" id="editValidation">
                                <option value=1> Quản lý hệ thống </option>
                                <option value=2> Nhân viên </option>
                                <option value=3> Quản lý phòng</option>
                            </select>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="padding-bottom: 10px; padding-right: 5px">
                <div class="form-group">
                    <div class="col-md-4">
                        <button style="margin-bottom:5px" class="btn btn-primary pull-left" data-dismiss="modal">
                            <i class="fa fa-remove"></i> &nbspHủy bỏ
                        </button>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 col-md-offset-0" style="line-height:40px;">
                        <button style="margin-bottom:5px" class="btn btn-success pull-right" id="submitEditUser">
                            <i class="fa fa-check"></i> Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('manager/users')}}";
</script>
@stop