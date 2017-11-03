function checkEdit(){
    $(document).off('click','.editType').on('click','.editType', function(){
        var id = $(this).data('id');

        var token = $('#token').val();
        startLoading();
        $.post(link+"/getInfoEdit", {_token: token, id: id}, function(){

        }).done(function(data){
            if(data == -1){
                alert("Dữ liệu không hợp lệ.");
                window.location.reload();
                return;
            }

            var jq = JSON.parse(data);

            $('#typeNameEdit').html(jq[0]);
            $('#numberDocEdit').html(jq[1]);
            $('#editTypeDoc').val(jq[0]);

            $('#editType').modal("show");

            $(document).off('click','#submitEditType').on('click','#submitEditType', function(){
                var newName = $('#editTypeDoc').val();

                if (newName == jq[0]){
                    alert("Bạn chưa thay đổi tên của loại tài liệu. Vui lòng thay đổi trước khi xác nhận.");
                    return;
                }else if (checkAllSpace(newName)){
                    alert("Bạn chưa nhập tên tài liệu. Vui lòng thử lại.");
                    return;
                }

                startLoading();
                $.post(link+"/submitInfoEdit", {_token: token, id: id, name: newName}, function(){

                }).done(function(data){
                    if (data == -1){
                        alert("Dữ liệu không hợp lệ.");
                        window.location.reload();
                        return;
                    }else if(data == 1){
                        alert("Cập nhật thông tin thành công.");
                        window.location.reload();
                        return;
                    }else{
                        alert("Không thể kết nối đến hệ thống. Vui lòng thử lại sau.");
                        window.location.reload();
                        return;
                    }
                }).fail(function(){
                    alert("Không thể kết nối đến hệ thống. Vui lòng thử lại sau.");
                    window.location.reload();
                    return;
                }).always(function(){
                    endLoading();
                });
            });
        }).fail(function(){
            alert("Không thể kết nối đến hệ thống.");
            window.location.reload();
            return;
        }).always(function(){
            endLoading();
        });
    });
}

function checkDelete(){
    $(document).off('click','.deleteType').on('click','.deleteType', function(){
        var id = $(this).data('id');

        var conf = confirm('Bạn có chắc chắn muốn xóa loại tài liệu '+$(this).data('name')+" không?");
        
        if(conf){
            var token = $('#token').val();
            startLoading();
            $.post(link+"/deleteType", {_token: token, id: id}, function(){

            }).done(function(data){
                if(data == -1){
                    alert("Dữ liệu không hợp lệ.");
                    window.location.reload();
                    return;
                }else if (data==1){
                    alert("Xóa loại tài liệu thành công.");
                    window.location.reload();
                    return;
                }else{
                    alert("Không thể kết nối đến hệ thống.");
                    window.location.reload();
                    return;
                }
            }).fail(function(){
                alert("Không thể kết nối đến hệ thống.");
                window.location.reload();
                return;
            }).always(function(){
                endLoading();
            });
        }
    });
}
$(document).ready(function(){
    checkEdit();
    checkDelete();
});