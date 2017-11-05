@extends('admin.layouts')
@section('title')
    Danh sách người dùng hệ thống
@stop
@section('controller',"Danh sách người dùng")

@section('content')

{!! Html::style('public/css/user.css') !!}

<div class="row">
    <div class="col-md-12">

        <div class="content-search" >
            
            <div class="row" id="initailPart">
                <div class="col-md-3 not-padding">
                    <small>Tìm kiếm</small><br>
                     
                    <input id="nameFilter" type="text" class="form-control input-sm" placeholder="Tên | Tên đăng nhập">
                </div>
                <div class="col-md-6">
                </div>

                <br>
            </div>
        </div>

        <div class="content-table"  style="min-height: 250px">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                    <tr> 
                        <th class="center" style="width: 4%" >STT.</th>
                        <th style="width: 20%">Họ và tên</th>
                        <th style="width: 14%" class="hidden-xs hidden-md hidden-sm">Tên đăng nhập</th>
                        <th style="width: 19%" class="hidden-xs hidden-md hidden-sm">Địa chỉ Email</th>

                        <th class="center" style="width: 5.5%">Sửa</th>
                    </tr>
                </thead>

                <tbody id="needElements">
                    
                </tbody>
            </table>
        </div>

        <div class="content-pagination pull-right">
            <ul class="pagination paginationPart">
                
            </ul>
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
                        <label class="col-md-4 control-label" for="editDepartment">Sửa phòng </label>
                        <div class="col-md-5">
                            <select class="form-control" id="editDepartment">
                                <?php
                                    for ($i=0; $i<count($department); $i++){
                                        echo "<option value = ".$department[$i]->id." selected> ".$department[$i]->alias."</option>";
                                    }
                                ?>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group" style="margin-top: 30px">
                        <label class="col-md-4 control-label" for="editValidation">Sửa quyền hệ thống</label>
                        <div class="col-md-5">
                            <select class="form-control" id="editValidation">
                                <option value=1> Quản lý hệ thống </option>
                                <option value=2> Quản lý phòng </option>
                                <option value=3> Nhân viên</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group ifSystemUser" style="margin-top: 40px">
                        <label class="col-md-4 control-label">Đặt lại mật khẩu:</label>
                        <div class="col-md-5" style="margin-left: 20px">
                            <label class="checkbox pull-left">
                                <input type="checkbox" id="clickToSetPass" value="2"><span>&nbsp&nbspCheck để đặt lại mật khẩu</span></input>
                            </label>
                        </div>
                        <div class="col-md-4"></div>

                    </div>    

                    <div class="form-group formSetPassUser needHiding">
                        <div class="col-md-1"></div>
                        <label class="col-md-4 control-label">Nhập mật khẩu:</label>
                            <!--<div class="col-md-1"></div>-->
                        <div class="col-md-4">
                            <input class="form-control" data-val="true" id="PasswordToReset" name="Password" type="password">
                        </div>

                    </div>    

                    <div class="form-group formSetPassUser needHiding">
                        <div class="col-md-1"></div>
                        <label class="col-md-4 control-label">Xác nhận mật khẩu:</label>
                            <!--<div class="col-md-1"></div>-->
                        <div class="col-md-4">
                            <input class="form-control" data-val="true" id="ConfirmPasswordToReset" name="Password" type="password">
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

<script type="text/javascript" src="{{ URL::asset('public/js/userList.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('admin/users')}}";
    var listDepartment = "{{ $department }}";
</script>
@stop