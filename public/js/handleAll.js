var perPage = 25;

function effectedInput(id){
    $(id).bind('input propertychange', function(){
        var input = $(id).val();

        if (input.length ==1){
            if (input == " "){
                $(id).val("");
            }else{
                input = input[0].toUpperCase();
                $(id).val(input);
            }
        }else if(input[input.length-2] == " "){
            input=input.substr(0, input.length-2) + " "+input[input.length-1].toUpperCase();
            $(id).val(input);
        }
    });
}

function makeAsThing(stt, div){
    if (stt==0){
        $(div).removeClass('fa fa-toggle-on');
        $(div).addClass('fa fa-toggle-off');
        
        $(div).removeClass('active');
        $(div).addClass('blackDeactive');
    }else{
        $(div).removeClass('fa fa-toggle-off');
        $(div).addClass('fa fa-toggle-on');
        
        $(div).removeClass('blackDeactive');
        $(div).addClass('active');
    }
}

function makeSomeThingBlink(ele){
    $(document).off('click',ele).on('click',ele, function(){
        $(this).fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    });
}

function checkIfValidDate(text){
    var comp = text.split('/');
    var d = parseInt(comp[0], 10);
    var m = parseInt(comp[1], 10);
    var y = parseInt(comp[2], 10);

    var date = new Date(y,m-1,d);
    
    if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
        return [ y , m , d];
    } else {
        return false;
    }
}

function checkIfValidHour(text){
    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])?$/.test(text);

    if (!isValid){
        return false;
    }

    var comp = text.split(':');
    var h = parseInt(comp[0], 10);
    var m = parseInt(comp[1], 10);

    return [h,m];
}

function returnDate(text){
    var comp = text.split('/');
    var d = parseInt(comp[0], 10);
    var m = parseInt(comp[1], 10);
    var y = parseInt(comp[2], 10);

    var date = new Date(y,m-1,d);

    return date;
}

function checkIfVarIsArray(someVar){
    return Object.prototype.toString.call( someVar ) === '[object Array]';
}

function stopMakeSomeThingBlink(ele){
    $(document).off('click',ele).on('click',ele, function(){
        //donothing
    });
}

function getNotTag(html){
    var div = document.createElement("div");
    div.innerHTML = html;
    return div.innerText;
}

function startLoading(){
    $(".index").addClass("loading");
}

function endLoading(){
    $(".index").removeClass("loading");
}

function checkAllSpace(inputtxt){
    if (inputtxt.length==0)
        return true;

    for (var i=0; i<inputtxt.length; i++){
        if (inputtxt[i] != " "){
            return false;
        }
    }

    return true;
}

function goToBottom(){
    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
}

function validInputName(inputtxt)  
{  
    if (inputtxt.length == 0)   return false;

    var patt = /^[{(),_/\}0-9a-zA-Z\s-ăâêôơưáàảãạăắặằẳẵâấầẩẫậÁÀẢÃẠĂẮẶẰẲẴÂẤẦẨẪẬđĐéèẻẽẹêếềểễệÉÈẺẼẸÊẾỀỂỄỆíìỉĩịÍÌỈĨỊóòỏõọôốồổỗộơớờởỡợÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢúùủũụưứừửữựÚÙỦŨỤƯỨỪỬỮỰýỳỷỹỵÝỲỶỸỴ\s]+$/;
    
    return patt.test(inputtxt);
} 

function validInputUserName(inputtxt, type)  
{  
    if (inputtxt.length == 0)   return false;
    var patt;
    if (type==1){ // username
        patt = /^[0-9a-zA-Z_]+$/;
    }else if (type==2){ // full name
        patt = /^[a-zA-Z\săâêôơưáàảãạăắặằẳẵâấầẩẫậÁÀẢÃẠĂẮẶẰẲẴÂẤẦẨẪẬđĐéèẻẽẹêếềểễệÉÈẺẼẸÊẾỀỂỄỆíìỉĩịÍÌỈĨỊóòỏõọôốồổỗộơớờởỡợÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢúùủũụưứừửữựÚÙỦŨỤƯỨỪỬỮỰýỳỷỹỵÝỲỶỸỴ\s]+$/;
    }else if (type==3){ // email
        patt = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    }else{ // password
        patt = /^[0-9a-zA-Z]+$/;
    }

    return patt.test(inputtxt);
}  

$(document).ready(function(){
    
});