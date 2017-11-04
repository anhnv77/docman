function notAllowClose(){
    $('#addUserInfo').on('hidden.bs.modal', function (e) {
        alert("Vui lòng hoàn thành cập nhật thông tin cá nhân!");
        $('#addUserInfo').modal('show');
    });
}

function validInputUserName(inputtxt, type)  
{  
    if (inputtxt.length == 0)   return false;
    var patt;
    if (type==2){ // full name
        patt = /^[a-zA-Z\săâêôơưáàảãạăắặằẳẵâấầẩẫậÁÀẢÃẠĂẮẶẰẲẴÂẤẦẨẪẬđĐéèẻẽẹêếềểễệÉÈẺẼẸÊẾỀỂỄỆíìỉĩịÍÌỈĨỊóòỏõọôốồổỗộơớờởỡợÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢúùủũụưứừửữựÚÙỦŨỤƯỨỪỬỮỰýỳỷỹỵÝỲỶỸỴ\s]+$/;
    }else if (type==3){ // email
        patt = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    }

    return patt.test(inputtxt);
}  

function checkFullNameNewUser(input){
    if (input=="" || checkAllSpace(input)){
        return 1;
    }else if (!validInputUserName(input, 2)){
        return 2;
    }else{
        return 0;
    }
}

function checkEmailNewUser(input){
    if (input=="" || checkAllSpace(input)){
        return 1;
    }else if (!validInputUserName(input, 3)){
        return 2;
    }else{
        return 0;
    }
}

function checkSubmitInfo(){
    $(document).off('click', '#submitAddingInfoUser').on('click', '#submitAddingInfoUser', function(){
        var fullname = $('#FullNameNewUser').val();
        var email = $('#EmailNewUser').val();
        var department = $("#DepartmentNewUser").val();

        var cFNNU = checkFullNameNewUser(fullname);
        if (cFNNU == 1){
            alert("Vui lòng nhập Họ và tên trước khi xác nhận.");
            $('#FullNameNewUser').focus();
            return;
        }else if (cFNNU == 2){
            alert("Họ và tên không hợp lệ. Vui lòng thử lại.");
            $('#FullNameNewUser').focus();
            return;
        }

        var cENU = checkEmailNewUser(email);
        if (cENU == 1){
            alert("Vui lòng nhập địa chỉ Email trước khi xác nhận.");
            $('#EmailNewUser').focus();
            return;
        }else if (cENU == 2){
            alert("Địa chỉ Email không hợp lệ. Vui lòng thử lại.");
            $('#EmailNewUser').focus();
            return;
        }

        if (department<=0){
            alert("Dữ liệu không hợp lệ.");
            window.location.reload();
        }

        var token = $('#token').val();
        startLoading();

        $.post('submitAddInfo', {_token: token, name: fullname, email: email, department: department}, function(){
            
        }).done(function(data){
            if (data==1){
                alert("Đã thêm thông tin của bạn thành công!");
                location.reload();
            }else{
                alert("Lỗi không thể cập nhật thông tin! Vui lòng thử lại sau!");
            }
        }).fail(function(){
            alert("Lỗi không thể cập nhật thông tin! Vui lòng thử lại sau!");
        }).always(function(){
            endLoading();
        });
    });
}

$(document).ready(function(){
    $("#addUserInfo").modal('show');

    alert("Chào mừng đến với hệ thống Quản lý tài liệu dùng chung UET DMS!!! \n\nĐể sử dụng hệ thống hiệu quả, bạn vui lòng cập nhật thông tin cá nhân..");

    notAllowClose();
    checkSubmitInfo();
});