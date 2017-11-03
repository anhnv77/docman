@extends('admin.layouts')
@section('title')
    Lịch sử hệ thống
@stop
@section('controller','Bảng lịch sử hệ thống')
@section('content')

{!! Html::style('public/css/typeofdocuments.css') !!}

<div class="row">

    <div class="col-md-12">
        <div class="row" id="initailPart">
            <div class="col-md-4 not-padding">
                <button class="pull-left btn btn-sm btn-primary" id="chooseAdvanceDelete">
                    &nbsp <span id="titleButtonDelete"> Xóa lịch sử </span>&nbsp<span class="caret " id="movationIcon"></span>
                </button>
            </div>
            <div class="col-md-5">
                
            </div>

            <br>
        </div>

        <div class="row" id="filterWhenNeed" style="display: none">
            <div class="col-md-2 not-padding">
                <small>Xóa từ ngày </small><br>
                <input type="text" id="fromDate" class="form-control input-sm" placeholder="dd/mm/yyyy">
            </div>

            <div class="col-md-1" style="width: 30px"></div>

            <div class="col-md-2">
                <small>Đến ngày </small><br>
                <input type="text" id="toDate" class="form-control input-sm" placeholder="dd/mm/yyyy">
            </div>

            <div class="col-md-1" style="width: 30px"></div>

            <div class="col-md-1">
                <br>
                <a id="startAdvanceDelete" class="btn btn-primary btn-sm needspin pull-left" href="javascript:void(0)" role="button" style="border-radius: 0px; background-color: #5882FA">
                    Xóa
                </a>
            </div>
            
            <div class="col-md-1" style="width: 70px"></div>

            <div class="col-md-3">
                <br>
                <a id="deleteAllTheLog" class="btn btn-primary btn-sm needspin pull-left" href="javascript:void(0)" role="button" style="background-color: #5882FA">
                    Xóa tất cả
                </a>
            </div>

        </div>

        <div class="content-table" style="min-height: 250px">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                    <tr>
                        <th class="center" style="width: 5%">STT.</th>
                        <th style="width: 58%">Nội dung</th>
                        <th style="width: 17%">Địa chỉ IP</th>
                        <th style="width: 20%">Thời gian</th>
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

<link rel="stylesheet" href="{{ URL::asset('public/js/jquery-ui/jquery-ui.css') }}">

<script type="text/javascript" src="{{ URL::asset('public/js/jquery-ui/jquery-ui.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/logHandle.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('admin/logs')}}";
</script>
@stop