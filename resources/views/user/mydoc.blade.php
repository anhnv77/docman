@extends('admin.layouts')
@section('title')
    Tài liệu của tôi
@stop
@section('controller', "Danh sách tài liệu đã đăng tải")

@section('content')

{!! Html::style('public/css/document.css') !!}

<div class="row">
    <div class="col-md-12">

        <div class="content-search" >
            
            <div class="row" id="initailPart">
                <div class="col-md-4 not-padding">
                    <button class="pull-left btn btn-sm btn-primary" id="chooseAdvanceSearch">
                        &nbsp <span id="titleButtonSearch"> {{ trans('documents.search') }} </span>
                        &nbsp<span class="caret " id="movationIcon"></span>
                    </button>
                </div>
                <div class="col-md-6">
                    
                </div>

                <div class="col-md-2 not-padding" id="chooseType">
                    <select class='form-control input-sm pull-right' id="selectType">

                        <option value=0 <?php if ($select == 0) echo "selected"; ?>> 
                            - Tất cả loại tài liệu - 
                        </option>

                        <?php
                            for ($i=0; $i<count($data); $i++){
                                if ($data[$i]->id != $select){
                                    echo "<option value = ".$data[$i]->id."> ".$data[$i]->name."</option>";
                                }else{
                                    echo "<option value = ".$data[$i]->id." selected> ".$data[$i]->name."</option>";
                                }
                            }
                        ?>
                    </select>   
                </div>
                <br>

            </div>

            <div class="row" id="filterWhenNeed" style="display: none">
                <div class="col-md-2 not-padding">
                    <small>{{ trans('documents.search_by_name') }}</small><br>
                     
                    <input id="nameFilter" type="text" class="form-control input-sm" placeholder="Tài liệu A">
                </div>

                <div class="col-md-1" style="width: 30px"></div>

                <div class="col-md-2">
                    <small>{{ trans('documents.filter_from') }} </small><br>
                    <input type="text" id="fromDate" class="form-control input-sm" placeholder="dd/mm/yyyy">
                </div>

                <div class="col-md-1" style="width: 30px"></div>

                <div class="col-md-2">
                    <small>{{ trans('documents.filter_to') }} </small><br>
                    <input type="text" id="toDate" class="form-control input-sm" placeholder="dd/mm/yyyy">
                </div>

                <div class="col-md-1" style="width: 30px"></div>

                <div class="col-md-1">
                    <br>
                    <a id="startAdvanceSearch" class="btn btn-primary btn-sm pull-left" href="javascript:void(0)" role="button">
                        <i class="fa fa-search"> </i> 
                    </a>
                </div>

            </div>
        </div>

        <div class="content-table">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                    <tr> 
                        <th class="center" style="width: 4%" >{{ trans('documents.no') }}</th>
                        <th class="center" style="width: 5%">{{ trans('documents.file') }}</th>
                        <th style="width: 23%">{{ trans('documents.title') }}</th>
                        <th style="width: 10%" class="hidden-xs">{{ trans('documents.department') }}</th>
                        <th style="width: 19%" class="hidden-xs hidden-sm">{{ trans('documents.type') }}</th>
                        <th style="width: 14%" class="hidden-xs hidden-md hidden-sm">{{ trans('documents.status') }}</th>
                        <th style="width: 14%" class="hidden-xs hidden-md hidden-sm">{{ trans('documents.date') }}</th>
                        
                        <th class="center" style="width: 5.5%">{{ trans('documents.delete') }}</th>
                        <th class="center" style="width: 5.5%">{{ trans('documents.edit') }}</th>
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

@include('user.modal_view_information')

<link rel="stylesheet" href="{{ URL::asset('public/js/jquery-ui/jquery-ui.css') }}">

<script type="text/javascript" src="{{ URL::asset('public/js/jquery-ui/jquery-ui.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/handleAll.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('public/js/myDocumentList.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('document')}}";
    var actual_link = "{{ URL('mydocuments')}}";

</script>
@stop