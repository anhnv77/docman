function checkSubmit(){

    $(document).off('click', '.submitEditDocument').on('click', '.submitEditDocument', function(){
        var secure = -1;
        var name = false;
        var discription = false;
        var id_type = -1;

        if ($('.is_public').is(':checked') || $('.is_private').is(':checked')){
            $('.is_public').is(':checked') ? secure = 1 : secure = 0;
        }else{
            alert("Bạn chưa lựa chọn chế độ đăng tài liệu (Công khai | Nội bộ)");
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

        if (secure >=0 && name !== false && description !== false && id_type >=0){
            // upload:

            var token = $('#token').val();
            startLoading();

            var id = $('#ID_Edit').val();
            $.post("../editDocumentWithID", {_token:token, id: id, secure: secure, title: name, description: description, typedoc_id: id_type}, function(data){
            }).done(function(data){
                if (data==1){
                    alert("Cập nhật thông tin tài liệu thành công.");
                    window.location.href = '../../document';
                }else{
                    alert("Thao tác không hợp lệ! Vui lòng thử lại sau.");
                    window.location.reload();
                }
            }).fail(function(){
                alert("Thao tác không hợp lệ! Vui lòng thử lại sau.");
                window.location.reload();
            }).always(function(){
                endLoading();
            });
        }
    });
}

$(document).ready(function(){
    checkSubmit();
});