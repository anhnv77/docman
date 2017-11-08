function writeData(stt, ele) {
    var temp = '<tr class="elementDocument">';

    temp += ('<td class="center">' + stt + '</td>');
    temp += ('<td class="center"> <a href = "' + ele['link_download'] + '" title="Nhấn để tải tài liệu" class="linkNormal" target="_blank"> <img class="type_file_image" src="' + ele['type_file'] + '"></a></td>');
    temp += ('<td class="hidden-xs"><small>' + ele['sohieu'] + '</small> </td>');
    temp += ('<td class="hidden-xs hidden-md hidden-sm"><small>' + ele['date'] + '</small></td>');
    temp += ('<td> <a href = "javascript:void(0)" title="' + ele['title'] + '" class="linkNormal" data-id="' + ele['document_id'] + '"> ' + ele['title'] + '</a></td>');
    temp += ('<td class="hidden-xs hidden-sm"><small>' + ele['type_document'] + '</small></td>');
    temp += ('<td class="hidden-xs hidden-md hidden-sm"><small>' + ele['coquan'] + '</small></td>');
    temp += ('<td class="hidden-xs hidden-md hidden-sm"><small>' + ele['nguoiky'] + '</small></a></td>');

    // if (ele['can_modify'] == 1){
    //     temp += ('<th class="center"> <a href="javascript:void(0)" title="..." class="forDeleteOne deleteDocuments" data-id=' + ele['document_id'] + '><i class="fa fa-remove"></i></a>');
    //     temp += ('<input type="checkbox" class="forDeleteMany" id="check_'+stt+'" value = ' + ele['document_id'] + '></td>');
    //
    //     temp += ('<th class="center"> <a href="'+link+'/edit/'+ele['document_id']+'" title="..." class="editDocuments"><i class="fa fa-edit"></i></a></th>');
    // }else{
    //     temp += ('<th class="center" style="width:5.5%"> <a class="linkNormal" href="javascript:void(0)" title="..."><small>N/A</small></a></th>');
    //     temp += ('<th class="center" style="width:5.5%"> <a class="linkNormal" href="javascript:void(0)" title="..."><small>N/A</small></a></th>');
    // }


    temp += '</tr>';

    return temp;
}

var dayMinFilter = "";
var dayMaxFilter = "";
var nameFilter = "";
var numberPage;
var currentPage;
var advanceSearch;
var departmentFilter;
var listDocuments;
var seePreview;
var deleteType;
var textsearch;

function makeAllCheck(checkornot) {
    for (var i = (currentPage - 1) * perPage; i < listDocuments.length && i < currentPage * perPage; i++) {
        $('#check_' + (i + 1)).prop('checked', checkornot);
    }
}

function countChecked() {
    var listChecked = [];

    for (var i = (currentPage - 1) * perPage; i < listDocuments.length && i < currentPage * perPage; i++) {
        if ($('#check_' + (i + 1)).is(':checked')) {
            listChecked.push($('#check_' + (i + 1)).val());
        }
    }

    return listChecked;
}

function searchNameListDocument(id) {
    for (var i = 0; i < listDocuments.length; i++) {
        if (listDocuments[i]['document_id'] == id) {
            return listDocuments[i]['title'];
        }
    }
}

function setForDeleteMany() {
    makeAllCheck(false);

    $('#check_all').prop('checked', false);

    $('#check_all').on('click', function () {
        if ($(this).is(':checked')) {
            makeAllCheck(true);
        } else {
            makeAllCheck(false);
        }
    });

    $(document).off('click', '#exitDeleteMany').on('click', '#exitDeleteMany', function () {
        deleteType = 1;

        forInterface();
    });

    $(document).off('click', '#submitDeleteMany').on('click', '#submitDeleteMany', function () {
        var test = countChecked();

        if (test.length == 0) {
            alert("Bạn chưa chọn tài liệu tài liệu nào! Vui lòng chọn trước khi xác nhận xóa!");
        } else {
            // check before:

            for (var i = 0; i < test.length; i++) {
                var id = test[i];
                var val = -1;

                for (var j = 0; j < listDocuments.length; j++) {
                    if (listDocuments[j]['document_id'] == id) {
                        val = listDocuments[j]['can_modify'];
                    }
                }

                if (val == -1 || val === false) {
                    alert("Dữ liệu bạn lựa chọn không hợp lệ!");
                    window.location.reload();
                    return 1;
                }
            }

            // start delete:

            var allDep = "";
            for (var i = 0; i < test.length; i++) {
                allDep += ((i + 1) + ". " + searchNameListDocument(test[i]) + "\n");
            }

            var conf = confirm("Bạn có chắc chắn muốn xóa " + test.length + " tài liệu đã chọn không?\n\nLưu ý: Khi xóa tài liệu sẽ không thể phục hồi. \n\nCác tài liệu đã chọn: \n" + allDep);

            if (conf) {
                var token = $('#token').val();
                startLoading();

                $.post(link + '/deleteManyDocuments', {_token: token, list: JSON.stringify(test)}, function () {

                }).done(function (data) {
                    if (data != -1 && data > 0) {
                        alert("Xóa " + data + " tài liệu thành công!");

                        location.reload();
                    } else {
                        alert("Xóa tài liệu không thành công! Thử lại sau!");
                    }
                }).fail(function () {
                    alert("Xóa tài liệu không thành công! Thử lại sau!");
                }).always(function () {
                    endLoading();
                });
            }
        }
    });

    $(document).off('click', '.deleteUser').on('click', '.deleteUser', function () {
        // donothing
    });
}

function setForDeleteOne() {
    $(document).off('click', '#exitDeleteMany').on('click', '#exitDeleteMany', function () {
        // donothing
    });

    $(document).off('click', '#submitDeleteMany').on('click', '#submitDeleteMany', function () {
        // donothing
    });

    checkIfUserDoST();
}

function checkUserWantMany() {
    $(document).off('click', '#selectDeleteMany').on('click', '#selectDeleteMany', function () {

        var check_have_checkbox = false;
        for (var i = (currentPage - 1) * perPage; i < listDocuments.length && i < currentPage * perPage; i++) {
            if ($('#check_' + (i + 1)).length > 0) {
                check_have_checkbox = true;
                break;
            }
        }

        if (!check_have_checkbox) {
            alert("Không có tài liệu nào để xóa!");
            return;
        }

        deleteType = 2;

        forInterface();
    });
}

function forInterface() {
    if (deleteType == 1) {
        $('.forDeleteOne').css('display', 'unset');
        $('.forDeleteMany').css('display', 'none');
        $('.rowForDeleteMany').css('display', 'none');
        stopMakeSomeThingBlink('.elementDocument');

        setForDeleteOne();
    } else {
        $('.forDeleteOne').css('display', 'none');
        $('.forDeleteMany').css('display', 'unset');
        $('.rowForDeleteMany').css('display', 'table-row');
        makeSomeThingBlink('.elementDocument');

        setForDeleteMany();
    }

    checkUserWantMany();
}

function notForInterface() {
    $(document).off('click', '#selectDeleteMany').on('click', '#selectDeleteMany', function () {

    });

    $('.forDeleteOne').css('display', 'unset');
    $('.forDeleteMany').css('display', 'none');
    $('.rowForDeleteMany').css('display', 'none');
    stopMakeSomeThingBlink('.elementDocument');
}

function showData() {
    if (listDocuments.length == 0) {
        return;
    }

    $('#needElements').empty();
    for (var i = (currentPage - 1) * perPage; i < listDocuments.length && i < currentPage * perPage; i++) {
        $('#needElements').append(writeData(i + 1, listDocuments[i]));
    }

    forInterface();
}

function changeActiveButton() {
    $('.thatPage').removeClass('active');

    $('#page_' + currentPage).addClass('active');
}

function checkIfUserClickPageButton() {
    $(document).off('click', ".thatPage").on('click', ".thatPage", function () {
        var page = $(this).data('id');

        if (page == currentPage) {
            return;
        }

        currentPage = page;
        changeActiveButton();
        showData();
    });

    $(document).off('click', "#previousPage").on('click', "#previousPage", function () {
        var page = currentPage - 1;

        if (page == 0) {
            return;
        }

        currentPage = page;
        changeActiveButton();
        showData();
    });

    $(document).off('click', "#nextPage").on('click', "#nextPage", function () {
        var page = currentPage + 1;

        if (page == numberPage + 1) {
            return;
        }

        currentPage = page;
        changeActiveButton();
        showData();
    });
}

function showPagination() {
    $('.paginationPart').empty();

    if (listDocuments.length > 0) {
        $('.paginationPart').append('<li><a href="javascript:void(0)" id="previousPage">«</a></li>');

        for (var i = 1; i <= numberPage; i++) {
            $('.paginationPart').append('<li><a href="javascript:void(0)" class="thatPage ' + (i == 1 ? 'active' : '') + '" data-id="' + i + '" id="page_' + i + '">' + i + '</a></li>');
        }

        $('.paginationPart').append('<li><a href="javascript:void(0)" id="nextPage">»</a></li>');

        checkIfUserClickPageButton();
    } else {
        notForInterface();
    }
}

function startMakePagination() {
    var numberElement = listDocuments.length;

    if (numberElement > 0) {
        if (numberElement % perPage == 0) {
            numberPage = (numberElement / perPage);
        } else {
            numberPage = Math.floor(numberElement / perPage) + 1;
        }
    } else {
        numberPage = 1;
    }

    currentPage = 1;

    showPagination();
    showData();
}

function checkOutSeePreview(linkDownload, type) {
    if (seePreview == 0) {
        $('#viewInformation').css('width', '60%');

        $('.leftForInfor').removeClass('col-md-5');
        $('.leftForInfor').addClass('col-md-12');
        $('.leftForInfor').css('border-right', '0px');

        $('.rightForPreview').removeClass('col-md-7');
        $('.rightForPreview').hide();

        $('.seePreviewButton').html("Xem trước");
    } else if (seePreview == 1) {
        $('#viewInformation').css('width', '90%');

        $('.leftForInfor').removeClass('col-md-12');
        $('.leftForInfor').addClass('col-md-5');
        $('.leftForInfor').css('border-right', '1px solid #eee');

        $('.seePreviewButton').html("Tắt xem trước");

        $('.rightForPreview').addClass('col-md-7');
        if ($('#iframePreview').length == 0) {

            if (type != "pdf") {
                $('.rightForPreview').html('<iframe id="iframePreview" src="https://http://docs.google.com/gview?url=' + linkDownload + '&embedded=true"></iframe>');
            } else {
                $('.rightForPreview').html('<iframe id="iframePreview" src="' + linkDownload + '"></iframe>');
            }
        }

        $('.rightForPreview').show();
    } else {
        alert("Xem trước không khả dụng với loại file này! Chỉ áp dụng với file PDF.");
    }
}


function checkIfUserDoST() {
    $(document).off('click', '.deleteDocuments').on('click', '.deleteDocuments', function () {
        var id = $(this).data('id');

        var seeing;

        for (var i = (currentPage - 1) * perPage; i < listDocuments.length && i < currentPage * perPage; i++) {

            if (listDocuments[i]['document_id'] == id) {
                seeing = listDocuments[i];
                break;
            }
        }

        if (seeing['can_modify'] != 1) {
            alert("Dữ liệu không hợp lệ!");
            window.location.reload();
        }

        var conf = confirm("Vui lòng xác nhận xóa tài liệu " + seeing['title'] + "?");

        if (conf) {
            var token = $('#token').val();

            $.post(link + "/deleteDocumentWithID", {_token: token, id: id}, function (data) {
            }).done(function (data) {
                if (data == 1) {
                    alert("Đã xóa tài liệu thành công.");
                    getDataForDocumentList();
                } else {
                    alert("Thao tác không hợp lệ! Vui lòng thử lại sau.");
                    window.location.reload();
                }
            }).fail(function () {
                alert("Thao tác không hợp lệ! Vui lòng thử lại sau.");
                window.location.reload();
            }).always(function () {

            });
        }
    });

    $(document).off('click', '.seeDocumentDetail').on('click', '.seeDocumentDetail', function () {
        var id = $(this).data('id');
        var seeing;

        for (var i = (currentPage - 1) * perPage; i < listDocuments.length && i < currentPage * perPage; i++) {

            if (listDocuments[i]['document_id'] == id) {
                seeing = listDocuments[i];
                break;
            }
        }

        var token = $('#token').val();

        seePreview = 0;
        $('.rightForPreview').empty();

        checkOutSeePreview();

        $.post(link + "/getInfoDocumentForModal", {_token: token, id: id}, function (data) {
        }).done(function (data) {
            var hash = JSON.parse(data);

            if (hash == -1) {
                window.location.reload();
            }

            $('#viewInformation').modal('show');

            $('#nameDocumentInfo').html(seeing['title']);
            $('#detailDocumentInfo').html(hash['description']);
            $('#groupDocumentInfo').html(seeing['department_name']);
            $('#categoryDocumentInfo').html(seeing['type_document']);
            $('#typeDocumentInfo').html(hash['type']);
            $('#sizeDocumentInfo').html(hash['size']);
            $('#timeDocumentInfo').html(hash['time']);

            var linkDownload = hash['link'];

            if (hash['type'] == "pdf") {
                $('#seePreview').html('<a href="javascript:void(0)" class="seePreviewButton linkNormal">Xem trước </a>');
                $(document).off('click', '.seePreviewButton').on('click', '.seePreviewButton', function () {
                    if (hash['type'] != "pdf") {
                        seePreview = 2;
                    } else {
                        if (seePreview == 0) {
                            seePreview = 1;
                        } else {
                            seePreview = 0;
                        }
                    }

                    checkOutSeePreview(linkDownload, hash['type']);
                });
            } else {
                $('#seePreview').empty();
                $(document).off('click', '.seePreviewButton').on('click', '.seePreviewButton', function () {
                });
            }

            $('#linkDownload').html('<a target="blank" href="' + linkDownload + '" class="linkNormal downloadButton">Tải về </a>');
        }).fail(function () {
            window.location.reload();
        }).always(function () {

        });
    });
}

function notCheckIfUserDoST() {
    $(document).off('click', '.deleteDocuments').on('click', '.deleteDocuments', function () {
    });
    $(document).off('click', '.seeDocumentDetail').on('click', '.seeDocumentDetail', function () {
    });
}

function getDataForDocumentList() {
    var token = $('#token').val();
    startLoading();

    var href = window.location.href;
    $.post(link + "/getDocumentList", {
        _token: token,
        start: JSON.stringify(dayMinFilter),
        end: JSON.stringify(dayMaxFilter),
        key: nameFilter,
        department_ID: departmentFilter,
        text: textsearch
    }, function () {

    }).done(function (data) {
        listDocuments = JSON.parse(data);

        $('#needElements').empty();
        $('.error_not_ele').remove();

        if (listDocuments.length == 0) {
            startMakePagination();

            $('.content-table').append("<center class='error_not_ele'>Không có tài liệu nào được tìm thấy.</center>");
            $('#dataTables').hide();

            notCheckIfUserDoST();
        } else {
            startMakePagination();

            $('#dataTables').show();

            checkIfUserDoST();
        }
    }).fail(function (data) {
        alert("Không thể tải dữ liệu cho trang web. Vui lòng thử lại sau.");
    }).always(function () {
        endLoading();
    });
}

function captureFilterSearch() {
    var input = $('#nameFilter').val();
    var from = $('#fromDate').val();
    var to = $('#toDate').val();
    var scepture = false;

    if (checkAllSpace(input)) {
        if (nameFilter != "") {
            nameFilter = "";
            scepture = true;
        }

        $('#nameFilter').val("");
    } else if (!validInputName(input)) {
        alert("Dữ liệu tìm kiếm không hợp lệ! Vui lòng thử lại!");
        $('#nameFilter').focus();
        return "";
    } else {
        nameFilter = input;
    }

    if (from != "") {
        dayMinFilter = checkIfValidDate(from);
        if (dayMinFilter === false) {
            alert("Dữ liệu ngày không hợp lệ! Vui lòng thử lại!");
            $('#fromDate').focus();
            return "";
        }
    } else {
        dayMinFilter = "";
    }

    if (to != "") {
        dayMaxFilter = checkIfValidDate(to);
        if (dayMaxFilter === false) {
            alert("Dữ liệu ngày không hợp lệ! Vui lòng thử lại!");
            $('#toDate').focus();
            return "";
        }
    } else {
        dayMaxFilter = "";
    }

    if (!scepture && nameFilter == "" && dayMinFilter == "" && dayMaxFilter == "") {
        alert("Bạn chưa nhập dữ liệu tìm kiếm hoặc thời gian.");
    } else {

        if (checkIfVarIsArray(dayMinFilter) && checkIfVarIsArray(dayMaxFilter)) {
            var start = new Date(dayMinFilter[0], dayMinFilter[1] - 1, dayMinFilter[2]);
            var end = new Date(dayMaxFilter[0], dayMaxFilter[1] - 1, dayMaxFilter[2]);

            if (start >= end) {
                alert("Không thể tìm kiếm do ngày kết thúc không lớn hơn ngày bắt đầu! Vui lòng thử lại.");
                $('#toDate').focus();
                return "";
            }
        }

        getDataForDocumentList();
    }
}

function checkFilterBarDocument(skip) {
    $(document).off('keypress', '#nameFilter').on('keypress', '#nameFilter', function (e) {
        if (skip && (e.which == 10 || e.which == 13)) {
            captureFilterSearch();
            $('#nameFilter').blur();
        }
    });
}

function activeAdvanceSearch() {

    $(document).off('click', '#startAdvanceSearch').on('click', '#startAdvanceSearch', function () {
        // submit search:

        captureFilterSearch();
    });

    checkFilterBarDocument(true);
}

function notActiveAdvanceSearch() {
    $(document).off('click', '#startAdvanceSearch').on('click', '#startAdvanceSearch', function () {
        //donothing
    });

    checkFilterBarDocument(false);
}

function setForAdvanceSearch() {
    if (advanceSearch == 0) {
        nameFilter = "";
        dayMaxFilter = "";
        dayMinFilter = "";

        getDataForDocumentList();

        $('#nameFilter').val("");
        $('#fromDate').val("");
        $('#toDate').val("");

        $('#movationIcon').removeClass('caret-up');
        $('#titleButtonSearch').html("Tìm kiếm nâng cao");
        $('#filterWhenNeed').slideUp('medium');

        $('#initailPart').css('border-bottom', '1px dotted #eee');
        $('#filterWhenNeed').css('border-bottom', '0px');

        notActiveAdvanceSearch();
    } else {
        textsearch = "";
        if (nameFilter != "") {
            $('#nameFilter').val("");
            nameFilter = "";
        }

        $('#movationIcon').addClass('caret-up');
        $('#titleButtonSearch').html("Tắt tìm kiếm nâng cao");

        $('#filterWhenNeed').slideDown('medium');

        $('#initailPart').css('border-bottom', '0px');
        $('#filterWhenNeed').css('border-top', '1px dotted #eee');
        $('#filterWhenNeed').css('border-bottom', '1px dotted #eee');

        $('#fromDate').datepicker();
        $('#fromDate').datepicker("option", "dateFormat", "dd/mm/yy");

        $('#toDate').datepicker();
        $('#toDate').datepicker("option", "dateFormat", "dd/mm/yy");

        activeAdvanceSearch();
    }
}

function captureChooseAdvance() {
    $(document).off('click', '#chooseAdvanceSearch').on('click', '#chooseAdvanceSearch', function () {
        if (advanceSearch == 0) {
            advanceSearch = 1;
        } else {
            advanceSearch = 0;
        }
        setForAdvanceSearch();
    });
}

function captureChangeDepartment() {
    $(document).off('change', "#selectDepartment").on('change', "#selectDepartment", function () {
        departmentFilter = $(this).val();
        advanceSearch = 0;
        setForAdvanceSearch();
    });
}

function search() {
    $(document).off('click', '#textsearch').on('click', '#textsearch', function () {
        textsearch = $('#textsearchinput').val();
        getDataForDocumentList();
    });
}

function textEnter() {
    $("#textsearchinput").keyup(function (e) {
            if(e.keyCode == 13){
                textsearch = $('#textsearchinput').val();
                getDataForDocumentList();
            }
        }
    )
}


$(document).ready(function () {
    dayMinFilter = "";
    dayMaxFilter = "";
    nameFilter = "";
    numberPage = 0;
    currentPage = 0;
    advanceSearch = 0;
    departmentFilter = $("#selectDepartment").val();
    seePreview = 0;
    deleteType = 1;
    textsearch = "";
    textEnter();
    search();
    setForAdvanceSearch();
    captureChooseAdvance();
    captureChangeDepartment();

});