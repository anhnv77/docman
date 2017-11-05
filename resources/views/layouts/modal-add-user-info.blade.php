
{!! Html::style('public/css/modal_add_user_info.css') !!}

<div class="modal fade" id="addUserInfo" role="dialog" style="font-family: sans-serif;" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog">
                        
        <div class="modal-content">
            <div class="modal-header backgroundHere">
                <h4 class="modal-title">Thêm thông tin người dùng mới</h4>
            </div>

            <div class="modal-body">    
                <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="FullNameNewUser">Họ và tên (*)</label>
                        
                        <div class="col-md-6">
                            <input class="form-control" id="FullNameNewUser" value="{{$oldName}}" type="text">
                        </div>
                    
                        </label>    
                    </div> 

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="EmailNewUser">Địa chỉ Email (*)</label>
                        <div class="col-md-6">
                            <input class="form-control" id="EmailNewUser" value="{{$oldEmail}}" type="email">
                        </div>
                    </div>     


               
                </div>

            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <div class="col-md-6"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4 col-md-offset-0" style="line-height:40px;">
                        <button style="margin-bottom:5px" id="submitAddingInfoUser" class="btn btn-success pull-right">
                            <i class="fa fa-check"></i> &nbsp&nbspCập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script src="{{ URL::asset('public/js/addUserInfo.js') }}"></script>