@extends('admin.layouts')
@section('title')
    {{ trans('documents.list_document') }}
@stop
@section('controller',trans('documents.list_document'))

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
                <div class="col-md-5">
                    
                </div>

                <div class="col-md-3 not-padding" id="chooseDepartment">
                    <select class='form-control input-sm pull-right' id="selectDepartment">

                        <option value=0 <?php if ($select == 0) echo "selected"; ?>> 
                            - {{ trans('documents.all_department') }} - 
                        </option>

                        <?php
                            for ($i=0; $i<count($data); $i++){
                                if ($data[$i]->id != $select){
                                    echo "<option value = ".$data[$i]->id."> ".$data[$i]->alias."</option>";
                                }else{
                                    echo "<option value = ".$data[$i]->id." selected> ".$data[$i]->alias."</option>";
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
                        <th style="width: 19%">{{ trans('documents.title') }}</th>
                        <th style="width: 10%" class="hidden-xs">{{ trans('documents.department') }}</th>
                        <th style="width: 16%" class="hidden-xs hidden-md hidden-sm">{{ trans('documents.user') }}</th>
                        <th style="width: 15%" class="hidden-xs hidden-sm">{{ trans('documents.type') }}</th>
                        <th style="width: 10%" class="hidden-xs hidden-md hidden-sm">{{ trans('documents.status') }}</th>
                        <th style="width: 10%" class="hidden-xs hidden-md hidden-sm">{{ trans('documents.date') }}</th>
                        
                        <th style="width: 12%" id="option" class="center" colspan="2">
                                        
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="linkNormal dropdown-toggle" data-toggle="dropdown" style="color: black!important; font-size: 12px">
                                    Tùy chọn <span class="caret"></span>
                                </a>
                                    
                                <ul class="dropdown-menu ulLeft">
                                    <li>
                                        <a href="javascript:void(0)" id="selectDeleteMany">Xóa nhiều tài liệu</a>
                                    </li>
                                </ul>
                            </div>
                        </th>
                    </tr>

                    <tr class="rowForDeleteMany">
                        <th class="center"></th>
                        <th class="center"></th>
                        <th></th>
                        <th class="hidden-xs"></th>
                        <th class="hidden-xs hidden-md hidden-sm"> </th>
                        <th class="hidden-xs hidden-sm"></th>
                        <th class="hidden-xs hidden-md hidden-sm"></th>
                        <th class="hidden-xs hidden-md hidden-sm"></th>
                        <td style="width: 5.5%" class="center">
                            <input type="checkbox" id="check_all" title="Nhấn để chọn tất cả">
                        </td>
                        <td style="width: 5.5%"></td>

                    </tr>
                </thead>

                <tbody id="needElements">
                    
                </tbody>
            </table>
        </div>

        <div class="row forDeleteMany">
            <div class="col-md-4 col-md-offset-8" style="border: 1px dotted #ddd; padding: 10px 2px">
                <a id="exitDeleteMany" class="btn btn-primary btn-sm pull-left" href="javascript:void(0)" role="button">
                    <i class="fa fa-mail-reply"> </i> 
                    &nbspHủy xóa
                </a>

                <a id="submitDeleteMany" class="btn btn-primary btn-sm pull-right" href="javascript:void(0)" role="button">
                    <i class="fa fa-trash-o"> </i> 
                    &nbspBắt đầu xóa
                </a>
            </div>
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

<script type="text/javascript" src="{{ URL::asset('public/js/documentList.js') }}"></script>

<script type="text/javascript">
    var link = "{{ URL('document')}}";
</script>
@stop