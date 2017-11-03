var editProfile = 0;
var editPassword = 0;

function checkIfUserChooseUpdate(){
    $(document).off('click','.buttonChangeProfile').on('click', '.buttonChangeProfile', function(){
        if (editProfile == 0){
            editProfile = 1;
        }else{
            editProfile = 0;
        }

        editPassword = 0;

        setForUpdate();
    });

    $(document).off('click','.buttonChangePassword').on('click', '.buttonChangePassword', function(){
        editProfile = 0;

        if (editPassword == 0){
            editPassword = 1;
        }else{
            editPassword = 0;
        }

        setForUpdate();
    });
}

var file_avt;

function checkFileInput(){
    $(document).off('change', '#avatar').on('change', '#avatar', function(){
        
        var file= this.files[0];

        if (file!=null){
            var type= file.type;
            // image/jpeg
            // image/png
            if (type.indexOf('image') == -1){
                alert("Bạn chỉ được thêm file ảnh");
                $('#avatar').replaceWith($('#avatar').val('').clone(true));
                file_avt = 0;

            }else{
                file_avt = 1;
            }
        }else{
            $('#avatar').replaceWith($('#avatar').val('').clone(true));
            file_avt = 0;
        }
    });
}

function completeHandler(e){
    if (e==1){
        alert("Cập nhật thông tin thành công!");
        location.reload();
    }else{
        alert("Cập nhật thông tin không thành công!");
    }
    endLoading();
}
function errorHandler(e){    
    alert("Không thể cập nhật thông tin vào lúc này");
    endLoading();
}

function progressHandlingFunction(){

}

function checkEditProfile(){
    effectedInput('#name');
    $('#avatar').replaceWith($('#avatar').val('').clone(true));
    $('#name').val(old_name);
    $('#email').val(old_email);
    file_avt = 0;

    checkFileInput();

    $(document).off('click','.buttonSubmitEditProfile').on('click', '.buttonSubmitEditProfile', function(){

        var newName;
        var newEmail;

        if (checkAllSpace($('#name').val())){
            alert("Bạn chưa nhập họ tên.");
            $('#name').focus();
            return;
        }else if (!validInputUserName($('#name').val(), 2)){
            alert("Họ tên người dùng không hợp lệ.");
            $('#name').focus();
            return;
        }else{
            newName = $('#name').val();
        }

        if (checkAllSpace($('#email').val())){
            alert("Bạn chưa nhập địa chỉ email.");
            $('#email').focus();
            return;
        }else if (!validInputUserName($('#email').val(), 3)){
            alert("Địa chỉ email không hợp lệ.");
            $('#email').focus();
            return;
        }else{
            newEmail = $('#email').val();
        }

        if (newEmail == old_email && newName == old_name && file_avt == 0){
            alert("Bạn chưa thay đổi nội dung gì. Vui lòng thay đổi trước khi xác nhận.");
        }else{

            var token = $('#token').val();
            var formDataa;

            if (file_avt){
                formDataa = new FormData($('.formUpdateProfile')[0]);
            }else{
                formDataa = new FormData();
            }
            
            formDataa.append('_token', token);
            formDataa.append('email', newEmail);
            formDataa.append('name', newName);

            $.ajax({
                url: link+'/submitProfile',  //Server script to process data
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
                success: completeHandler,
                error: errorHandler,
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

function notCheckEditProfile(){
    $('#avatar').replaceWith($('#avatar').val('').clone(true));
    $('#name').val(old_name);
    $('#email').val(old_email);
    $(document).off('change', '#avatar').on('change', '#avatar', function(){
    });
    $(document).off('click','.buttonSubmitEditProfile').on('click', '.buttonSubmitEditProfile', function(){
    });
}

function checkEditPassword(){
    $('#old_password').val("");
    $('#password').val("");
    $('#password_confirmation').val("");
    
    $(document).off('click','.buttonSubmiteEditPassword').on('click', '.buttonSubmiteEditPassword', function(){
        var oldP = $('#old_password').val();
        var newP = $('#password').val();
        var confirmP = $('#password_confirmation').val();

        if (checkAllSpace(oldP)){
            alert("Bạn chưa nhập mật khẩu cũ.");
            $('#old_password').focus();
            return;
        }else if (!validInputUserName(oldP, 4)){
            alert("Mật khẩu cũ không hợp lệ.");
            $('#old_password').focus();
            return;
        }

        if (checkAllSpace(newP)){
            alert("Bạn chưa nhập mật khẩu mới.");
            $('#password').focus();
            return;
        }else if (!validInputUserName(newP, 4)){
            alert("Mật khẩu mới không hợp lệ.");
            $('#password').focus();
            return;
        }

        if (checkAllSpace(confirmP)){
            alert("Bạn chưa nhập mật khẩu xác nhận.");
            $('#password_confirmation').focus();
            return;
        }else if (!validInputUserName(confirmP, 4)){
            alert("Mật khẩu xác nhận không hợp lệ.");
            $('#password_confirmation').focus();
            return;
        }else if (confirmP != newP){
            alert("Mật khẩu xác nhận không trùng khớp.");
            $('#password_confirmation').focus();
            return;
        }

        var token = $('#token').val();
        var formDataa = new FormData();

        formDataa.append('_token', token);
        formDataa.append('pass', oldP);
        formDataa.append('new_pass', newP);

        $.ajax({
            url: link+'/submitPassword',  //Server script to process data
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
            success: function(e){
                if (e==-2){
                    alert("Mật khẩu cũ không chính xác. Vui lòng thử lại sau.");
                }else if (e==1){
                    alert("Cập nhật mật khẩu mới thành công.");

                    window.location.reload();
                }else{
                    alert("Dữ liệu không hợp lệ! Vui lòng thử lại sau.");
                }
            },
            error: function(){
                alert("Không thể thực hiện thao tác lúc này. Vui lòng thử lại sau.");
            },
            // Form data
            data: formDataa,
            //Options to tell jQuery not to process data or worry about content-type.
            cache: false,
            contentType: false,
            processData: false,
            mimeType: "multipart/form-data"
        });
    });
}

function notCheckEditPassword(){
    $('#old_password').val("");
    $('#password').val("");
    $('#password_confirmation').val("");

    $(document).off('click','.buttonSubmiteEditPassword').on('click', '.buttonSubmiteEditPassword', function(){
    });
}

function setForUpdate(){
    if (editProfile == 1){
        $('.formUpdateProfile').slideDown("slow");
        $('.buttonChangeProfile').addClass('btn-success');
        $('.buttonChangeProfile').removeClass('btn-primary');
        checkEditProfile();

    }else {
        $('.formUpdateProfile').slideUp("slow");
        $('.buttonChangeProfile').removeClass('btn-success');
        $('.buttonChangeProfile').addClass('btn-primary');
        notCheckEditProfile();
    }

    if (editPassword == 1){
        $('.formUpdatePassword').slideDown("slow");
        $('.buttonChangePassword').addClass('btn-success');
        $('.buttonChangePassword').removeClass('btn-primary');
        checkEditPassword();
    }else{
        $('.formUpdatePassword').slideUp("slow");
        $('.buttonChangePassword').removeClass('btn-success');
        $('.buttonChangePassword').addClass('btn-primary');
        notCheckEditPassword();
    }
}

var old_email;
var old_name;

$(document).ready(function(){
    old_email = $('#email').val();
    old_name = $('#name').val();

    setForUpdate();
    checkIfUserChooseUpdate();
});