function progressHandlingFunction(){

}

function completeHandlerUpload(e){
    endLoading();
    
    if (e=="UN founded"){
        alert("Tên đăng nhập đã tồn tại trong hệ thống! Vui lòng thử lại.");
        return;
    }

    if (e!=1){
        alert("Thêm người dùng mới thất bại! Vui lòng thử lại sau!");
        
    }else{
        alert("Thêm người dùng mới thành công!");
        window.location.href = link;
    }
}

function errorHandlerUpload(e){
    endLoading();
    alert("Thêm người dùng mới thất bại! Vui lòng thử lại sau!");
}

function checkSubmit(){

    $(document).off('click', '.submitAddUser').on('click', '.submitAddUser', function(){
        var username = false;
        var name = false;
        var password = false;
        var id_department = false;
        var id_role = false;

        if (checkAllSpace($('#username').val())){
            alert("Bạn chưa nhập tên đăng nhập của người dùng.");
            $('#username').focus();
            return;
        }else if (!validInputUserName($('#username').val(), 1)){
            alert("Tên đăng nhập không hợp lệ.");
            $('#username').focus();
            return;
        }else{
            username = $('#username').val();
        }

        if (checkAllSpace($('#name').val())){
            alert("Bạn chưa nhập họ tên của người dùng.");
            $('#name').focus();
            return;
        }else if (!validInputUserName($('#name').val(), 2)){
            alert("Họ tên người dùng không hợp lệ.");
            $('#name').focus();
            return;
        }else{
            name = $('#name').val();
        }

        if (checkAllSpace($('#password').val())){
            alert("Bạn chưa nhập mật khẩu đăng nhập của người dùng.");
            $('#password').focus();
            return;
        }else if (!validInputUserName($('#password').val(), 4)){
            alert("Mật khẩu đăng nhập không hợp lệ.");
            $('#password').focus();
            return;
        }else{
            password = $('#password').val();
        }

        if ($('#chooseDepartment').val() <= 0){
            alert("Bạn chưa chọn phòng trực thuộc của người dùng");

            return;
        }else{
            id_department = $('#chooseDepartment').val();
        }

        if ($('#chooseValidation').val() <= 0){
            alert("Dữ liệu không hợp lệ!");
            window.location.reload();

            return;
        }else{
            id_role = $('#chooseValidation').val();
        }

        if (username !== false && name !== false && password !== false && id_department !== false && id_role !== false){
            // upload:

            var token = $('#token').val();
            var formDataa = new FormData();
            formDataa.append('_token', token);

            formDataa.append('username', username);
            formDataa.append('name', name);
            formDataa.append('password', password);
            formDataa.append('id_role', id_role);
            formDataa.append('id_department', id_department);

            startLoading();

            $.ajax({
                url: 'startAddUser',  //Server script to process data
                type: 'POST',
                xhr: function() {  // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){ // Check if upload property exists
                        myXhr.upload.addEventListener('#progress',progressHandlingFunction, false); // For handling the progress of the upload
                    }
                    return myXhr;
                },
                //Ajax events
                //beforeSend: beforeSendHandler,
                success: completeHandlerUpload,
                error: errorHandlerUpload,
                // Form data
                data: formDataa,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false,
                mimeType: "multipart/form-data"
            });
        }
    });
}

$(document).ready(function(){

    effectedInput("#name")
    checkSubmit();
});