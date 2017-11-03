function writeData(stt, ele){
    var temp="<tr>";

    temp+= ("<th class='center'>" +stt+"</th>");
    temp+= ("<th><small>" +ele['content']+"</small></th>");
    temp+= ("<th><small>" +ele['IP']+"</small></th>");
    temp+= ("<th><small>" +ele['time']+"</small></th>");
    temp+="</tr>";

    return temp;
}

var numberPage=0;
var currentPage=1;
var dayMaxFilter;
var dayMinFilter;

var listLog;

function showData(){
    if (listLog.length == 0){
        return;
    }

    $('#needElements').empty();
    for (var i=(currentPage-1)*perPage; i<listLog.length && i<currentPage*perPage; i++){
        $('#needElements').append(writeData(i+1, listLog[i]));
    }
}

function changeActiveButton(){
    $('.thatPage').removeClass('active');

    $('#page_'+currentPage).addClass('active');
}

function checkIfUserClickPageButton(){
    $(document).off('click', ".thatPage").on('click', ".thatPage", function(){
        var page = $(this).data('id');
        
        if (page == currentPage){
            return;
        }

        currentPage = page;
        changeActiveButton();
        showData();
    });

    $(document).off('click', "#previousPage").on('click', "#previousPage", function(){
        var page = currentPage-1;

        if (page == 0){
            return;
        }

        currentPage = page;
        changeActiveButton();
        showData();
    });

    $(document).off('click', "#nextPage").on('click', "#nextPage", function(){
        var page = currentPage+1;

        if (page == numberPage+1){
            return;
        }

        currentPage = page;
        changeActiveButton();
        showData();
    });
}

function showPagination(){
    $('.paginationPart').empty();

    $('.paginationPart').append('<li><a href="javascript:void(0)" id="previousPage">«</a></li>');

    for (var i=1; i<=numberPage; i++){
        $('.paginationPart').append('<li><a href="javascript:void(0)" class="thatPage ' + (i==1?'active':'') +'" data-id="'+i+'" id="page_'+i+'">'+i+'</a></li>');
    }

    $('.paginationPart').append('<li><a href="javascript:void(0)" id="nextPage">»</a></li>');

    checkIfUserClickPageButton();
}

function startMakePagination(){
    var numberElement = listLog.length;

    if (numberElement > 0){
        if (numberElement % perPage == 0){
            numberPage = (numberElement / perPage);
        }else{
            numberPage = Math.floor(numberElement / perPage) + 1;
        }

        captureChooseAdvance();
        currentPage = 1;

        showPagination();
        showData();
    }else{
        numberPage = 1;

        notCaptureChooseAdvance();
    }
}

function captureFilterDelete(){
	var from = $('#fromDate').val();

	if (from=="" || checkAllSpace(from)){
		from = "";
	}else{
		if (checkIfValidDate(from) === false){
			alert("Dữ liệu ngày không hợp lệ!");
			$('#fromDate').focus();
			return "";
		}

		from = checkIfValidDate(from);
	}

	var to = $('#toDate').val();

	if (to=="" || checkAllSpace(to)){
		to = "";
	}else{
		if (checkIfValidDate(to) === false){
			alert("Dữ liệu ngày không hợp lệ!");
			$('#toDate').focus();
			return "";
		}

		to = checkIfValidDate(to);
	}

	if (from == "" && to == ""){
		alert("Bạn chưa chọn ngày để xóa dữ liệu!");
		return "";
	}

	var start = new Date(from[0], from[1]-1, from[2]);
	var end = new Date(to[0], to[1]-1, to[2]);

	if (start > end){
		alert("Không thể xóa do ngày kết thúc không lớn hơn ngày bắt đầu! Vui lòng thử lại.");
		$('#toDate').focus();
		return "";
	}

	var token=$('#token').val();

	var stt = "Bạn có chắc chắn muốn xóa lịch sử hệ thống";

	if (from!="") {
		stt += " từ ngày " + $('#fromDate').val();
	} 

	if (to!="") {
		stt += " đến ngày " + $('#toDate').val();
	}

	stt += " không?";

	var conf = confirm(stt);
	if (conf){
		startLoading();

		$.post(link+'/deleteLogFromTo', {_token: token, from: JSON.stringify(from), to: JSON.stringify(to)}, function(){

		}).done(function(data){
			if (data == 1){
				alert("Xóa lịch sử hệ thống thành công!");
				location.reload();
			}else if (data == -1){
				alert("Dữ liệu ngày không hợp lệ!");
			}else{
				alert("Bạn không có quyền này!");
				location.reload();
			}
		}).fail(function(){
			alert("Xóa lịch sử hệ thống không thành công!");
		}).always(function(){
			endLoading();
		});
	}
}

function activeAdvanceDelete(){
	
	$(document).off('click','#startAdvanceDelete').on('click','#startAdvanceDelete', function(){
		captureFilterDelete();
	});

	$(document).off('click','#deleteAllTheLog').on('click','#deleteAllTheLog', function(){

		var conf = confirm("Bạn có chắc chắn muốn xóa toàn bộ lịch sử hệ thống không?");
		if (conf){
			var token=$('#token').val();
			startLoading();

			$.post(link+'/deleteAllLog', {_token: token}, function(){

			}).done(function(data){
				if (data == 1){
					alert("Xóa lịch sử hệ thống thành công!");
					location.reload();
				}else{
					alert("Bạn không có quyền này!");
					location.reload();
				}
			}).fail(function(){
				alert("Xóa lịch sử hệ thống không thành công!");
			}).always(function(){
				endLoading();
			});
		}
	});
}

function notActiveAdvanceDelete(){
	$(document).off('click','#startAdvanceDelete').on('click','#startAdvanceDelete', function(){
		//donothing
	});

	$(document).off('click','#deleteAllTheLog').on('click','#deleteAllTheLog', function(){
		//donothing
	});
}

var advanceDelete = 0;

function setForAdvanceDelete(){
	if (advanceDelete <= 0){
		
		dayMaxFilter= "";
		dayMinFilter= "";
		
		$('#fromDate').val("");
		$('#toDate').val("");

		$('#movationIcon').removeClass('caret-up');
		$('#titleButtonDelete').html("Xóa lịch sử");
		$('#filterWhenNeed').slideUp('medium');

		$('#initailPart').css('border-bottom', '1px dotted #eee');
		$('#filterWhenNeed').css('border-bottom', '0px');

		notActiveAdvanceDelete();
	}else{
		
		$('#movationIcon').addClass('caret-up');
		$('#titleButtonDelete').html("Tắt xóa lịch sử");

		$('#filterWhenNeed').slideDown('medium');
		
		$('#initailPart').css('border-bottom', '0px');
		$('#filterWhenNeed').css('border-top', '1px dotted #eee');
		$('#filterWhenNeed').css('border-bottom', '1px dotted #eee');
		$('#fromDate').datepicker();
		$('#fromDate').datepicker("option", "dateFormat", "dd/mm/yy");
		$('#toDate').datepicker();
		$('#toDate').datepicker("option", "dateFormat", "dd/mm/yy");

		activeAdvanceDelete();
	}
}

function captureChooseAdvance(){
	$(document).off('click','#chooseAdvanceDelete').on('click','#chooseAdvanceDelete', function(){
		if (advanceDelete ==0){
			advanceDelete=1;
		}else{
			advanceDelete=0;
		}
		setForAdvanceDelete();
	});
}

function notCaptureChooseAdvance(){
    $(document).off('click','#chooseAdvanceDelete').on('click','#chooseAdvanceDelete', function(){
        
    });
}

function notCaptureChooseAdvance(){
	$(document).off('click','#chooseAdvanceDelete').on('click','#chooseAdvanceDelete', function(){
		
	});
}

function getDataForLogPage(){
	var token=$('#token').val();
	startLoading();

	$.post(link+'/getDataForLogPage', {_token: token}, function(){

	}).done(function(data){
        if (data == -1){
            alert( "Không thể tải dữ liệu cho trang web. Vui lòng thử lại sau." );
            return;
        }

		listLog = JSON.parse(data);

        $('#needElements').empty();
        $('.error_not_ele').remove();

        if (listLog.length == 0){
            startMakePagination();

            $('.content-table').append("<center class='error_not_ele'>Không có dữ liệu lịch sử hệ thống nào.</center>");
            $('#dataTables').hide();

        }else{
            startMakePagination();

            $('#dataTables').show();
        }

	}).fail(function(){
		alert("Không thể tải dữ liệu.");
		
	}).always(function(){
		endLoading();
	});
}

$(document).ready(function(){
	getDataForLogPage();
});