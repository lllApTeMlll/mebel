$(function () {
    $(document).on("click", ".moda", function (e) {
        riv("#" + $(this).attr("dataModal"));
        return false;
    });
    $(document).on("click", ".close1,.reveal-modal-bg,.fonn", function (e) {
        if ($(e.target).hasClass("fonn") || $(e.target).hasClass("close1")) {
            colssAll();
        }
        return true;
    });
});

function sendMesseg(header, txte) {
    $('#messM .hed').html(header);
    $('#messM .texxt').html(txte);
    riv('#messM');
}

function riv(param) {
    //$(param).find(".close").css({'display': 'none'});
    $("body").css("overflow", "hidden");
    $('.fonn').removeClass("act");
    //console.log(param);
    $(param).closest('.fonn').addClass("act");
    $('.rt.error').remove();
    if ($('.modal.active').length) {
        $('.modal.active').addClass("animated").addClass("bounceOutLeft").addClass("active");
        setTimeout(function () {
            $('.modal.active').removeClass("animated").removeClass("bounceOutLeft").removeClass("active");
            $(param).addClass("active");
            show(param);
        }, 500);
    }else{
        show(param);
    }
    
}

function show(param){
    $(param).addClass("animated").addClass("bounceInRight").addClass("active");
    setTimeout(function () {
        $(param).removeClass("animated").removeClass("bounceInRight");
        $(param).find(".close").css({'display': 'none'}).fadeIn("slow");
    }, 800);
}

function colssAll() {
    if ($('.modal.active').length) {
        $('.modal.active').find(".close").css({'display': 'block'}).fadeOut(400);
        //$('.reveal-modal-bg').css({'display': 'block'}).fadeOut(390);
        $('.modal.active').addClass("animated").addClass("bounceOutLeft").addClass("active");
        $("body").css("overflow", "auto");
        setTimeout(function () {
            $('.modal.active').removeClass("animated").removeClass("bounceOutLeft").removeClass("active");
            $('.fonn').removeClass("act");
        }, 700);
    }
}


