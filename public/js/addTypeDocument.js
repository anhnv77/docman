function checkAdd(){
    $(document).off('click','.submitAddType').on('click','.submitAddType', function(){
        var token = $("#token").val();
        var name = $('#name').val();

        if (checkAllSpace(name)){
            alert("Bạn chưa nhập tên tài liệu. Vui lòng thử lại.");
            return;
        }

        startLoading();
        $.post(link+"/submitAddType", {_token: token, name: name}, function(){

        }).done(function(data){
            if (data == -1){
                alert("Dữ liệu không hợp lệ.");
                window.location.reload();
                return;
            }else if(data == 1){
                alert("Thêm loại tài liệu thành công.");
                window.location.href = link;
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
        
}

$(document).ready(function(){
    checkAdd();
});