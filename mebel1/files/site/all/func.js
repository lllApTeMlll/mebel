$(function(){
   // console.log('ff');
    $('input,textarea').focus(
    function(){
        $('.rt.error').remove();
        $("input").removeClass("error").removeClass("valid");
        $("input").closest(".form-group").removeClass("valid").removeClass("has-error");
    });
   // console.log('ff');
});		


function valid(par,nom){
    $('.rt.error').remove();
    $("input").removeClass("error");
    $("input").removeClass("valid");
    var nomm=(nom || 100);
    var i=0;
    var result= true;
    par.find('input,textarea').each(function(){
        switch($(this).attr('data_type')){
            case 'email':
                if($(this).val().match(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/) === null){
                    $(this).closest(".form-group").addClass("has-error");
                    $(this).after( addExcept('не коректный email') );
                    result = false;
                }
            break;
            case 'phone':
                if($(this).val().length < 4){
                    $(this).closest(".form-group").addClass("has-error");
                    $(this).after( addExcept('число должно быть длинее 3 символов') );
                    result = false;
                }else{
                    if($(this).val().match(/^[+0-9,. ()-]+$/) === null){
                        $(this).closest(".form-group").addClass("has-error");
                        $(this).after( addExcept('не корректный номер телефона') );
                        result = false;
                    }
                }
            break;
            case 'required':
                if ($(this).attr('type')=='checkbox'){
                    if(! $(this).is(':checked') ){
                        $(this).closest(".form-group").addClass("has-error");
                        $(this).after( addExcept('это поле обязательно для заполнения') );
                        result = false;
                    }
                }else{
                    if($(this).val()==""){
                        //console.log($(this).closest("form-group"));
                        $(this).closest(".form-group").addClass("has-error");
                        $(this).after( addExcept('это поле обязательно для заполнения') );
                        result = false;
                    }
                }
            break;
        }
        i++;
        if (i==nomm) return result;
    });
    return result;
}

 function sklonen(n,s1,s2,s3){
    var m = n % 10; 
    var j = n % 100;
    if(m==0 || m>=5 || (j>=10 && j<=20)) return n+' '+s3;
    if(m>=2 && m<=4) return  n+' '+s2;
    return n+' '+s1;
}

function addExcept(text){ 
    return "<div for='email_inp' generated='true' class='error rt'>"+text+"</div>";
}

 function floorN(x, n)
{
	var mult = Math.pow(10, n);
	return Math.floor(x*mult)/mult;
}

