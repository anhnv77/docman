@extends('admin.layouts')
@section('title')
    {{ trans('typedocument.list_typedoc') }}
@stop
@section('controller','Danh Sách Loại Tài Liệu')
@section('content')

{!! Html::style('public/css/typeofdocuments.css') !!}

<div class="row">
    <div class="col-lg-12">
        
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
           
            <thead>
                <tr>
                    <th class="center" style="width: 10%">STT.</th>
                    <th style="width: 35%">{{ trans('typedocument.name_typedoc') }}</th>
                    <th style="width: 35%">{{ trans('typedocument.number_doc') }}</th>

                    <th class="center" style="width: 10%">Sửa</th>
                    <th class="center" style="width: 10%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $dem = 0;
                ?>
                @foreach ($typedocuments as $item)
	            <tr>
	                <th class="center">{{ ++$dem }}</th>
	                <th>{{ $item['name'] }}</th>
                    <th>{{ $item['number_doc'] }}</th>

	                <th class="center">
	                    <a href = "javascript:void(0)" class = "editType" data-id = "{{ $item['id'] }}">
                            <i class="fa fa-edit"></i>
                        </a>
	                </th>
	                <th class="center">
                        @if ($item['number_doc'] == 0)
                        <a href = "javascript:void(0)" class = "deleteType" data-id = "{{ $item['id'] }}" data-name = "{{ $item['name'] }}"> 
                            <i class="fa fa-remove"></i>
                        </a>
                        @else
                        <a href = "javascript:void(0)" class = "linkNormal">
                            <small>N/A</small>
                        </a>
                        @endif
	                </th>
	            </tr>
	            @endforeach
	       </tbody>
        </table>

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="modal fade" id="editType" role="dialog">
    <div class="modal-dialog">
                    
        <div class="modal-content" style="border-radius: 0px">
            <div class="modal-header backgroundHere" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title headerModal">Sửa loại tài liệu</h4>
            </div>

            <div class="modal-body" style="margin-bottom: 0px">
                <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Tên loại tài liệu </label>
                        <label class="col-md-5 control-label"> 
                            <span style="float: left" id="typeNameEdit"></span> 
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Số tài liệu hiện có </label>
                        <label class="col-md-5 control-label"> 
                            <span style="float: left" id="numberDocEdit"></span> 
                        </label>
                    </div>

                    <div class="form-group" style="margin-top: 30px">
                        <label class="col-md-4 control-label" for="editTypeDoc">Sửa tên loại </label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="editTypeDoc">
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
                        <button style="margin-bottom:5px" class="btn btn-success pull-right" id="submitEditType">
                            <i class="fa fa-check"></i> Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/listTypeDocument.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('admin/typedocuments')}}";
</script>
@stop