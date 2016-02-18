// JavaScript Document



var isIE = $.browser.msie;
var isOpera = $.browser.opera;


$(window).load(function () {
    getMap();
});


$(document).ready(function () {

    var h = $(".catalog-content").css('height');
    $(".catalog-sidebar").css('min-height', h);

    var $body_width = isIE ? document.body.clientWidth : window.innerWidth;

    $.fn.slideFadeToggle = function (speed, easing, callback) {
        return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
    };

    if ($(window).height() >= 768) {

        $(".header-main").height($(window).height());
        $(".main-gallery__slider-item").css('height', $(window).height() - 60)
    } else {
        $(".header-main").height(768);
        $(".main-gallery__slider-item").css('height', 768 - 60)
    }

    var slider = $('.js-main-gallery').bxSlider({
        mode: 'fade',
        pagerCustom: '#main-gallery__pager',
        controls: false,
        speed: 1100,
        auto: true,
        pause: 6000

    });

    $('a[href^="#"], a[href^="."]').click(function () { // если в href начинается с # или ., то ловим клик

        var scroll_el = $(this).attr('href'); // возьмем содержимое атрибута href
        var $anchor_number = parseInt(scroll_el.charAt(scroll_el.length - 1), 10);
        if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
            $('html, body').animate({scrollTop: $(scroll_el).offset().top}, $anchor_number * 1000); // анимируем скроолинг к элементу scroll_el
        }
        return false; // выключаем стандартное действие
    });


    $('#js-cart-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        prevText: "",
        nextText: "",
        start: function (slider) {
            $('body').removeClass('loading');
        }
    });


    if ($body_width > 1280) {
        var item_mar = 16;
    }
    if ($body_width <= 1280) {
        var item_mar = 7;
    }
    if ($body_width <= 1174) {
        var item_mar = 36;
    }

    $(".thumbnail-slider > .slides > .cart-slider__item").css('margin-right', item_mar);

    $('#js-cart-slider-thumbnail').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 120,
        itemMargin: item_mar,
        prevText: "",
        nextText: "",
        asNavFor: '#js-cart-slider'
    });

    $('#js-cart-faces-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 120,
        itemMargin: item_mar,
        prevText: "",
        nextText: ""
    });

    $('#js-cart-color-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 120,
        itemMargin: item_mar,
        prevText: "",
        nextText: ""
    });

    $('.projects-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        prevText: "",
        nextText: "",
        start: function (slider) {
            $('body').removeClass('loading');
        }
    });

    $(document).on("click", ".popup-show", function (e) {
        $(".popup").height($(document).height());
        $(".catalog-popup").hide();
        $(".popup").show();
        var marg = $(window).height() - 600;
        $(".popup-form").css('margin-top', $(window).scrollTop() + marg / 2);
    });


    //$(".catalog-popup-show").on('click', function () {
    $(document).on("click", ".catalog-popup-show", function () {
        var id = $(this).data(id);
        console.log("/catalog/getInfo/" + id.id + "/");
        $.ajax({type: "POST", url: "/catalog/getInfo/" + id.id + "/", data: "",
            success: function (data) {
                //console.log(data);
                try {
                    //var mas = JSON.parse(data);
                    $(".catalog-popup").html(data);
                    $(".catalog-popup").height($(document).height());
                    $(".catalog-popup").show();

                    $('#js-catalog-slider').flexslider({
                        animation: "slide",
                        controlNav: false,
                        animationLoop: false,
                        slideshow: false,
                        prevText: "",
                        nextText: "",
                        start: function (slider) {
                            $('body').removeClass('loading');
                        }
                    });

                    if ($body_width > 1280) {
                        var item_marg = 16;
                    }
                    if ($body_width <= 1280) {
                        var item_marg = 16;
                    }
                    if ($body_width <= 1174) {
                        var item_marg = 45;
                    }

                    $(".popup-form-slider > .thumbnail-slider > .slides > .cart-slider__item").css('margin-right', item_marg);

                    $('#js-catalog-slider-thumbnail').flexslider({
                        animation: "slide",
                        controlNav: false,
                        animationLoop: false,
                        slideshow: false,
                        itemWidth: 88,
                        itemMargin: 20,
                        prevText: "",
                        nextText: "",
                        asNavFor: '#js-catalog-slider'
                    });

                    var marg = $(window).height() - 600;
                    $(".popup-form").css('margin-top', $(window).scrollTop() + marg / 2);
                } catch (e1) {
                    console.log(data);
                    //return false;
                }
            }
        });
    });

    $(document).on("click", ".close-popup", function () {
        $(".popup").hide();
    });

    $(document).on("click", ".close-catalog-popup", function () {
        $(".catalog-popup").hide();
    });

    $(document).on("click", ".overlay", function (e) {
        var el = $(e.target);
        if ((el.hasClass('popup-form')) || (el.closest('.popup-form').length == 1)) {
            e.stopPropagation();
        } else {
            $(".popup").hide();
            $(".catalog-popup").hide();
        }
    });

    $(".fancyimage").fancybox({
        padding: 10
    });

    $(document).on("click", ".sidemenu li", function (e) {
        try {
            history.pushState({}, "", "" + $(this).find('a').attr('href') + "");
            $.ajax({type: "POST", url: $(this).find('a').attr('href'), data: {type:"ajax"},
                success: function (data) {
                    //console.log(data);
                    try {
                        $(".catalog-content").html(data);
                    } catch (e1) {
                        console.log(data);
                    }
                }
            });
            var prov = $(e.target).closest(".sidemenu__item-dropbox").length;
            var child = $(this).closest(".sidemenu__item").index();
            $(".sidemenu__item-dropbox").find("li").removeClass("active");
            $(".sidemenu .sidemenu__item").each(function (k, v) {
                if (k !== child) {
                    $(this).removeClass("active");
                    $(this).find(".sidemenu__item-dropbox").slideUp();
                } else {
                    if (!prov) {
                        $(this).addClass("active");
                        $(this).find(".sidemenu__item-dropbox").slideDown();
                    } else {
                        $(e.target).closest("li").addClass("active");
                    }
                }
            });
            return false;
        } catch (e1) {
            console.log(e1);
            //location.href = $(this).attr('href');
            return true;
        }
    });
});

$(window).scroll(function () {

    if ($(window).scrollTop() >= 110) {
        $(".nav-wrap").addClass('nav-wrap-2');
    } else {
        $(".nav-wrap").removeClass('nav-wrap-2');
    }

    if ($(window).scrollTop() > $(window).height() / 2) {

        $(".js-item-caption").addClass('fadeIn');

        setTimeout(function () {

            $(".js-catalog-row:odd").find("img").addClass('slideRight-img');
            $(".js-catalog-row:even").find("img").addClass('slideLeft-img');
        }, 700);

        setTimeout(function () {

            $(".js-catalog-row:odd").find(".item-image-arrow").addClass('slideRight-img');
            $(".js-catalog-row:even").find(".item-image-arrow").addClass('slideLeft-img');

        }, 1300);
    }
});

$(window).resize(function () {

});


function getMap() {
    var map = $('#map').empty();
    map.each(function () {
        var mapOptions = {
            zoom: 17,
            disableDefaultUI: true
        },
        coordCenter = [52.2916187, 104.2941396],
                map = new google.maps.Map(this, mapOptions);
        var styles = [{
                stylers: [
                    {saturation: -200}
                ]
            }];
        map.setOptions({styles: styles});

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(coordCenter[0], coordCenter[1]),
            map: map,
            icon: {
                url: 'images/map-marker.png',
                size: new google.maps.Size(40, 60),
                anchor: new google.maps.Point(40, 60)
            }
        });
        var infowindow = new google.maps.InfoWindow(
                {content: "<div>" +
                            "Город Иркутск, МОПРА переулок, 6 <br>" +
                            "Телефон: +7 (3952) 500‒225<br>" +
                            "График работы: Ежедневно 10:00–20:00<br>" +
                            "Адрес электронной почты: moscow@cheb-dveri.ru<br>" +
                            "<div>" +
                            "",
                    size: new google.maps.Size(150, 150)
                });
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });
        map.setCenter(new google.maps.LatLng(coordCenter[0], coordCenter[1]));
    });
}

//jQuery.extend(jQuery.validator.messages, {
//    required: "Это поле необходимо заполнить",
//    remote: "Исправьте это поле чтобы продолжить",
//    email: "Введите правильный email адрес.",
//    url: "Введите верный URL.",
//    date: "Введите правильную дату.",
//    dateISO: "Введите правильную дату (ISO).",
//    number: "Введите число.",
//    digits: "Введите только цифры.",
//    creditcard: "Введите правильный номер вашей кредитной карты.",
//    equalTo: "Повторите ввод значения еще раз.",
//    accept: "Пожалуйста, введите значение с правильным расширением.",
//    maxlength: jQuery.validator.format("Нельзя вводить более {0} символов."),
//    minlength: jQuery.validator.format("Должно быть не менее {0} символов."),
//    rangelength: jQuery.validator.format("Введите от {0} до {1} символов."),
//    range: jQuery.validator.format("Введите число от {0} до {1}."),
//    max: jQuery.validator.format("Введите число меньше или равное {0}."),
//    min: jQuery.validator.format("Введите число больше или равное {0}.")
//});
