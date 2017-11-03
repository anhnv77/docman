function checkFileInput(){
    $(document).on('change', '#content', function(){
        
        var file= this.files[0];

        if (file != null){
            var validType= ["application/pdf", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];

            var type= file.type;
            var size= file.size;

            if (type=="" || validType.indexOf(type) == -1){
                alert("Chỉ được tải lên file pdf, word hoặc excel!");
                $('#content').replaceWith($('#content').val('').clone(true));
                
            }else if (size> 8000000){
                alert("Dung lượng file không được lớn hơn 8Mb!");
                $('#content').replaceWith($('#content').val('').clone(true));
            }
        }
    });
}

function progressHandlingFunction(){

}

function completeHandlerUpload(e){
    endLoading();
    
    if (e!=1){
        alert("Thêm tài liệu thất bại! Vui lòng thử lại sau!");
    }else{
        alert("Thêm tài liệu thành công!");
        window.location.href = '../document';
    }
}

function errorHandlerUpload(e){
    endLoading();
    alert("Thêm tài liệu thất bại! Vui lòng thử lại sau!");
}

function checkSubmit(){

    $(document).off('click', '.submitAddDocument').on('click', '.submitAddDocument', function(){
        var secure = -1;
        var name = false;
        var discription = false;
        var content = false;
        var id_type = -1;

        if ($('.is_public').is(':checked') || $('.is_private').is(':checked')){
            $('.is_public').is(':checked') ? secure = 1 : secure = 0;
        }else{
            alert("Bạn chưa lựa chọn chế độ đăng tài liệu (Công khai | Nội bộ)");
            return;
        }

        var file=$('#content').val();

        if (file != null && file != false && file != ""){
            content=true;
        }else{
            alert("Bạn chưa chọn file tài liệu!");

            return;
        }

        if (checkAllSpace($('#title').val())){
            alert("Bạn chưa nhập tiêu đề tài liệu.");

            return;
        }else{
            name = $('#title').val();
        }

        if (checkAllSpace($('#description').val())){
            alert("Bạn chưa nhập mô tả nội dung tài liệu.");

            return;
        }else{
            description = $('#description').val();
        }

        id_type = $('#typedoc_id').val();

        if (id_type < 0){
            alert("Dữ liệu không hợp lệ!");

            window.location.reload();
        }

        if (secure >=0 && name !== false && description !== false && content === true && id_type >=0){
            // upload:

            var token = $('#token').val();
            var formDataa = new FormData($('#formUploadDocument')[0]);
            formDataa.append('_token', token);

            formDataa.append('typedoc_id', id_type);
            formDataa.append('secure', secure);
            formDataa.append('title', name);
            formDataa.append('description', description);

            startLoading();

            $.ajax({
                url: 'startUploadDocument',  //Server script to process data
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
    checkFileInput();
    checkSubmit();
});