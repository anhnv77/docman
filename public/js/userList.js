function writeData(stt,ele){
    var temp = '<tr>'; 
    
    temp += ('<th class="center">' + stt + '</th>');
    temp += ('<th>'+(ele['fullname']!= null && ele['fullname']!= "" ? ele['fullname'] : "---" ) +'</th>');
    temp += ('<th class="hidden-xs hidden-md hidden-sm">'+ele['username']+'</th>');
    temp += ('<th class="hidden-xs hidden-md hidden-sm"><small>'+(ele['email']!= null && ele['email']!= "" ? ele['email'] : "---" )+'</small></th>');
    // temp += ('<th ><a class="linkNormal" title="'+ele['department_name']+'">'+ele['department_alias']+'</a></th>');
    // temp += ('<th ><small>'+ele['user_role']+'</small></th>');
    // temp += ('<th class="hidden-xs hidden-md hidden-sm">'+ele['number_document']+'</th>');
    if (ele['can_modify'] == 1){
        temp += ('<th class="center"><a class="editUsers" data-id="'+ele['id_user']+'" href = "javascript:void(0)" > <i class="fa fa-edit"></i></a><a class="deleteUser" data-id="'+ele['id_user']+'" href = "javascript:void(0)" > <i class="fa fa-remove"></i></a></th>');
    } else{
        temp += ('<th class="center"><small>N/A</small></th>');
    }
    
    temp += '</tr>';

    return temp;
}

var nameFilter = "";
var numberPage;
var currentPage;
var departmentFilter;
var listUsers;

function showData(){
    if (listUsers.length == 0){
        return;
    }

    $('#needElements').empty();
    for (var i=(currentPage-1)*perPage; i<listUsers.length && i<currentPage*perPage; i++){
        $('#needElements').append(writeData(i+1, listUsers[i]));
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
    var numberElement = listUsers.length;

    if (numberElement > 0){
        if (numberElement % perPage == 0){
            numberPage = (numberElement / perPage);
        }else{
            numberPage = Math.floor(numberElement / perPage) + 1;
        }
    }else{
        numberPage = 1;
    }

    currentPage = 1;

    showPagination();
    showData();
}

function forResetPassword(val){
    if (val == 1){
        $('#clickToSetPass').prop("checked", true);
        $('.formSetPassUser').slideDown('slow');
    }else{
        $('#clickToSetPass').prop("checked", false);
        $('.formSetPassUser').slideUp('slow');
    }

    $("#PasswordToReset").val("");
    $("#ConfirmPasswordToReset").val("");
}

function checkIfUserDoST(){
    $(document).off('click', '.editUsers').on('click', '.editUsers', function(){
        var id = $(this).data('id');

        var seeing;

        for (var i=(currentPage-1)*perPage; i<listUsers.length && i<currentPage*perPage; i++){

            if (listUsers[i]['id_user'] == id){
                seeing = listUsers[i];
                break;
            }
        }

        if (seeing['can_modify'] != 1 ){
            alert("Dữ liệu không hợp lệ!");
            window.location.reload();
        }

        $('#editUser').modal('toggle');

        $('#editDepartment').val(seeing['department_id']);
        var oldRole;

        if (seeing['user_role'] == "Đăng tài liệu"){
            oldRole = 2;            
        }else{
            oldRole = 3;
        }

        $('#editValidation').val(oldRole);

        $('#userNameEdit').html(seeing['username']);
        $('#userFullNameEdit').html( (seeing['fullname']!= null && seeing['fullname']!= "" ? seeing['fullname'] : '---') );
        $('#userDepartmentEdit').html(seeing['department_name']);
        $('#userValidationEdit').html(seeing['user_role']);

        var setPass = 0;

        forResetPassword(setPass);

        if (seeing['type'] == 1){
            $('.ifSystemUser').hide();
            $(document).off('click', '#clickToSetPass').on('click', '#clickToSetPass', function(){
            });
        }else{
            $('.ifSystemUser').show();

            $(document).off('click', '#clickToSetPass').on('click', '#clickToSetPass', function(){
                if (setPass == 1){
                    setPass = 0;
                }else{
                    setPass = 1;
                }

                forResetPassword(setPass);
            });
        }

        $(document).off('click', '#submitEditUser').on('click', '#submitEditUser', function(){
            var newRole = $('#editValidation').val();
            var newDepartment = $('#editDepartment').val();

            if ((newRole != 2 && newRole != 3 && newRole != 1) || (newDepartment < 0)){
                alert("Dữ liệu không hợp lệ.");
                return;
            }

            if (newRole == oldRole && newDepartment == seeing['department_id'] && setPass==0){
                alert("Bạn chưa thay đổi thông tin người dùng. Vui lòng thay đổi trước khi xác nhận.");
                return;
            }

            var newPass = "";

            if (setPass == 1){
                var newP = $('#PasswordToReset').val();
                var conP = $('#ConfirmPasswordToReset').val();

                if (checkAllSpace(newP) || checkAllSpace(conP)){
                    alert("Vui lòng nhập đủ hai trường mật khẩu trước khi xác nhận.");
                    return;
                }else if (newP != conP){
                    alert("Mật khẩu và xác nhận mật khẩu không trùng khớp.");
                    return;
                }

                newPass = newP;
            }

            var conf = confirm("Bạn có chắc chắn muốn xác nhận những thay đổi với người dùng này?");

            if (conf){
                var token = $('#token').val();
                startLoading(); 

                $.post(link+"/changeRoleUser", {_token: token, id: id, newRole: newRole, newDepartment: newDepartment, newPass: newPass}, function(){

                }).done(function(data){
                    if (data != 1){
                        alert( "Không thể thực hiện thao tác này. Vui lòng thử lại sau." );
                        return;
                    }

                    alert( "Đã thay đổi thông tin người dùng thành công." );
                    $("#editUser").modal('toggle');
                    getDataForUserList();
                }).fail(function(data){
                    alert( "Không thể thực hiện thao tác này. Vui lòng thử lại sau." );
                }).always(function(){
                    endLoading();
                });       
            }
        });
    });
}

function notCheckIfUserDoST(){
    $(document).off('click', '.editUsers').on('click', '.editUsers', function(){
    });
}

function deleteUser() {
    $(document).off('click', '.deleteUser').on('click', '.deleteUser', function(){
        var id = $(this).data('id');

        var seeing;

        for (var i=(currentPage-1)*perPage; i<listUsers.length && i<currentPage*perPage; i++){

            if (listUsers[i]['id_user'] == id){
                seeing = listUsers[i];
                break;
            }
        }

        if (seeing['can_modify'] != 1 ){
            alert("Dữ liệu không hợp lệ!");
            window.location.reload();
        }

        var confirm1 = confirm("Bạn có chắc chắn muốn xóa?");
        if(confirm1){
            var token = $('#token').val();
            $.post(link+"/deleteUser",{_token: token,id:id})
                .done(function (data) {
                    if(data.success){
                        alert("Đã xóa tài khoản");
                        window.location.reload();
                    }
                })
                .fail(function (data) {
                    alert("Có lỗi xảy ra, Không thể xóa tài khoản");
                })
        }

    });
}

function getDataForUserList(){
    var token = $('#token').val();
    startLoading(); 

    $.post(link+"/getUsersList", {_token: token, key: nameFilter, department_ID: departmentFilter}, function(){

    }).done(function(data){

        if (data == -1){
            alert( "Không thể tải dữ liệu cho trang web. Vui lòng thử lại sau." );
            return;
        }

        listUsers = JSON.parse(data);

        $('#needElements').empty();
        $('.error_not_ele').remove();

        if (listUsers.length == 0){
            startMakePagination();

            $('.content-table').append("<center class='error_not_ele'>Không có người dùng nào được tìm thấy.</center>");
            $('#dataTables').hide();

            notCheckIfUserDoST();
        }else{
            startMakePagination();

            $('#dataTables').show();

            checkIfUserDoST();
        }
    }).fail(function(data){
        $('.hello').html(JSON.stringify(data));
        alert( "Không thể tải dữ liệu cho trang web. Vui lòng thử lại sau." );
    }).always(function(){
        endLoading();
    });
}

function captureFilterSearch(){
    var input=$('#nameFilter').val();
    
    if (checkAllSpace(input)){
        if (nameFilter!=""){
            nameFilter="";
        }

        $('#nameFilter').val("");
    }else if (!validInputName(input)){
        alert("Dữ liệu tìm kiếm không hợp lệ! Vui lòng thử lại!");
        $('#nameFilter').focus();
        return "";
    }else{
        nameFilter = input;
    }

    getDataForUserList();
}

function checkFilterBarUser(){
    $(document).off('keypress', '#nameFilter').on('keypress', '#nameFilter', function(e){
        if (e.which==10 || e.which==13){
            captureFilterSearch();
            $('#nameFilter').blur();
        }
    });
}

function captureChangeDepartment(){
    $(document).off('change',"#selectDepartment").on('change',"#selectDepartment", function(){
        departmentFilter = $(this).val();
        nameFilter = "";
        $('#nameFilter').val(nameFilter);

        getDataForUserList();
    });
}


$(document).ready(function(){
    nameFilter = "";
    numberPage = 0;
    currentPage = 0;
    departmentFilter = $("#selectDepartment").val();

    deleteUser();
    getDataForUserList();
    captureChangeDepartment();
    checkFilterBarUser();
});