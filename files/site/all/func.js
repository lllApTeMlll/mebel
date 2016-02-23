$(function(){
   // console.log('ff');
    $('input,textarea').focus(
    function(){
        $('.rt.error').remove();
        $("input").removeClass("has-error").removeClass("has-success");
        $("input").closest(".form-group").removeClass("has-success").removeClass("has-error");
    });
   // console.log('ff');
});		


function valid(par,except){
    $('.rt.error').remove();
    $("input").removeClass("has-error");
    $("input").removeClass("valid");
    var excep = except || addExcept;
    var i=0;
    var result= true;
    par.find('input,textarea').each(function(){
        switch($(this).attr('data_type')){
            case 'email':
                if($(this).val().match(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/) === null){
                    excep('не корректный email',$(this));
                    result = false;
                }
            break;
            case 'phone':
                if($(this).val().length < 4){
                    excep('не корректное значение',$(this));
                    result = false;
                }else{
                    if($(this).val().match(/^[+0-9,. ()-]+$/) === null){
                        excep('не корректное значение',$(this));
                        result = false;
                    }
                }
            break;
            case 'required':
                //console.log($(this).closest("form-group"));
                if ($(this).attr('type')=='checkbox'){
                    if(! $(this).is(':checked') ){
                        excep('поле обязательно для заполнения',$(this));
                        result = false;
                    }
                }else{
                    if($(this).val()==""){
                        excep('поле обязательно для заполнения',$(this));
                        result = false;
                    }
                }
            break;
        }
        i++;
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


function addExcept(text,element){ 
   element.closest(".form-group").addClass("has-error");
   if (element.closest(".form-group").find("label").length){
       $.growl.error({ message: "Не корректно заполнено поле - "+element.closest(".form-group").find("label").text()});
   }
    element.after("<div for='email_inp' generated='true' class='error rt'>"+text+"</div>");
}

 function floorN(x, n)
{
	var mult = Math.pow(10, n);
	return Math.floor(x*mult)/mult;
}

