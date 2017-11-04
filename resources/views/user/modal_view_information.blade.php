<div class="modal fade" id="viewInformation" role="dialog">
    <div class="modal-dialog">         
         <!-- Modal content-->
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header backgroundHere">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title headerModal">Thông tin tài liệu</h4>
            </div>

            <div class="modal-body row">
                <div class="leftForInfor col-md-12">
                    @include('widgets.information', array('top'=>'5px', 'title'=>'Tên tài liệu: ', 'id'=>'nameDocumentInfo'))
                    @include('widgets.information', array('top'=>'15px', 'title'=>'Mô tả tài liệu: ', 'id'=>'detailDocumentInfo'))
                    @include('widgets.information', array('top'=>'15px', 'title'=>'Đăng tải bởi: ', 'id'=>'groupDocumentInfo'))
                    @include('widgets.information', array('top'=>'15px', 'title'=>'Loại tài liệu: ', 'id'=>'categoryDocumentInfo'))
                    @include('widgets.information', array('top'=>'15px', 'title'=>'Định dạng file: ', 'id'=>'typeDocumentInfo'))
                    @include('widgets.information', array('top'=>'15px', 'title'=>'Kích thước file: ', 'id'=>'sizeDocumentInfo'))
                    @include('widgets.information', array('top'=>'15px', 'title'=>'Thời gian đăng tải: ', 'id'=>'timeDocumentInfo')) 
                    
                    <div id="seePreview">
                    </div> 

                    <div id="linkDownload">
                    </div>   
                </div>     

                <div class="rightForPreview">
                    
                </div>
            </div>

            <div class="modal-footer" style="padding-bottom: 10px; padding-right: 5px">
                <div class="form-group">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 col-md-offset-0" style="line-height:40px;">
                        <button style="margin-bottom:5px" class="btn btn-danger pull-right" data-dismiss="modal">
                            <i class="fa fa-remove"></i> Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>