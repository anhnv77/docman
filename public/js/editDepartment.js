function progressHandlingFunction(){

}

function completeHandlerUpload(e){
    endLoading();
    
    if (e!=1){
        alert("Cập nhật thông tin phòng thất bại! Vui lòng thử lại sau!");
    }else{
        alert("Cập nhật thông tin phòng thành công!");
        window.location.href = link;
    }
}

function errorHandlerUpload(e){
    endLoading();
    alert("Cập nhật thông tin phòng thất bại! Vui lòng thử lại sau!");
}

function checkSubmit(){

    $(document).off('click', '.submitEditDepartment').on('click', '.submitEditDepartment', function(){
        var name = false;
        var alias = false;
        var address = false;

        if (checkAllSpace($('#name').val())){
            alert("Bạn chưa nhập tên của phòng.");
            $('#name').focus();
            return;
        }else{
            name = $('#name').val();
        }

        if (checkAllSpace($('#alias').val())){
            alert("Bạn chưa nhập tên viết tắt của phòng.");
            $('#alias').focus();
            return;
        }else{
            alias = $('#alias').val();
        }

        if (checkAllSpace($('#address').val())){
            alert("Bạn chưa nhập địa chỉ của phòng.");
            $('#address').focus();
            return;
        }else{
            address = $('#address').val();
        }

        if (name !== false && alias !== false && address !== false){
            // upload:
            var id = $('#ID_Edit').val();
            var token = $('#token').val();
            var formDataa = new FormData();
            formDataa.append('_token', token);

            formDataa.append('name', name);
            formDataa.append('id', id);

            formDataa.append('alias', alias);
            formDataa.append('address', address);

            startLoading();

            $.ajax({
                url: 'startEditDepartment',  //Server script to process data
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
    checkSubmit();
});