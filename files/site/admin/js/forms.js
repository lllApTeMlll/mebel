$(function () {
    $(document).on("click", ".logout", function (e) {
        e.preventDefault();
        ajaxLoad({}, "/fasadm/loggout/").complete(function (dat) {
            location.reload();
        });
    });
    $(document).on("change", ".ajaxCat", function (e) {
        try {
            var id = $(this).val();
            //console.log(id);
            history.pushState({}, "", "?cat=" + id + "");
            var ajax = [{name: "type", value: "ajax"}];
            getLoader();
            ajaxLoad(ajax, window.location.href).complete(function (dat) {
                var result = dat.responseText;
                $(".ajaxConten").html(result);
                removeLoader();
                //console.log(dat.responseText);
            });
            return false;
        } catch (e1) {
            console.log(e1);
            //location.href = $(this).attr('href');
            return true;
        }
    });
    $("form [type='submit']").click(function (e) {
        e.preventDefault();
        var form = $(this).closest("form");
        if (valid(form)) {
            modefForMenu(form);
            var data = form.serializeArray();
            if ($(e.target).hasClass("ajax"))
                data.push({name: "type", value: "ajax"});
            console.log(data);
            getLoader();
            ajaxLoad(data, form.attr('action')).complete(function (dat) {
                removeLoader();
                var result = dat.responseText;
                console.log(result);
                try {
                    var mas = JSON.parse(result);
                    if (mas.result === "ok") {
                        $.growl.notice({message: mas.message});
                    } else {
                        $.growl.error({message: mas.message});
                        //sendMesseg("Ошибка при сохранении", "");
                    }
                    if (mas.location != undefined && mas.location != null) {
                        window.location.href = mas.location;
                    }
                    modefForMenuBack(form);
                } catch (e) {
                    $.growl.error({message: "Ошибка при сохранении"});
                    console.log(result);
                    console.log(e);
                }
                //console.log(dat.responseText);
            });
        }
    });
    //var editor;
    $(".ckedit").each(function () {
        //loadFile(loadEditor($(this).attr("id")));
        $(this).froalaEditor({heightMax: 500, height: 300, language: 'ru', imageManagerLoadURL: '/imageManager/',
            fileUploadURL: '/fileUpload/',imageUploadURL: '/uploadimage/'});
    });

    if ($("#mainForm #Title").length && $("#mainForm #EnglishTitle").length) {
        tttrran($("#mainForm #Title"), $("#mainForm #EnglishTitle"));
    }
    if ($("#loadImage").length) {
        $("#loadImage").loadImage({maxWidth: 2500});     
    }
    if ($("#rigthPhoto").length) {
        $("#rigthPhoto").loadImage({maxWidth: 1000, vid: "rigthPhoto"});
    }
    if ($("#loadImageMain").length) {
        $("#loadImageMain").loadImage({maxWidth: 700, minWidth: 700, onlismall: "true"});
    }
    if ($("#loadImageNews").length) { 
        $("#loadImageNews").loadImage({maxWidth: 450, minWidth: 450, onlismall: "true"});
    }
    if ($("#loadImageSlider").length) {
        $("#loadImageSlider").loadImage({maxWidth: 1920, minWidth: 1920, onlismall: "true"});
    }
    if ($("#itemFasad").length) {
        $("#itemFasad").loadImage({maxWidth: 500, vid: "itemFasad"});
    }
    if ($("#itemColor").length) {
        $("#itemColor").loadImage({maxWidth: 500, vid: "itemColor"});
    }
    $('.datepicker').datetimepicker({
        lang: 'ru',
        timepicker: false,
        format: 'Y-m-d',
        //formatDate:'Y-m-d',
    });
    var ns = $('#nestable3 ol').nestedSortable({
        forcePlaceholderSize: true,
        handle: '.dd3-handle',
        helper: 'clone',
        items: '.dd-item',
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        tolerance: 'pointer',
        //toleranceElement: '> div',
        maxLevels: 4,
        isTree: true,
        expandOnHover: 700,
        startCollapsed: true,
        protectRoot: true,
        disableParentChange: true,
    });
    
    $("#table-1").tableDnD();
});

function modefForMenu(form) {
    if (form.attr('id') === "menu") {
        form.find("[type='checkbox']").each(function () {
            if (!$(this).prop("checked")) {
                $(this).val("");
                $(this)[0].checked = true;
            }
        });
    }
}

function modefForMenuBack(form) {
    if (form.attr('id') === "menu") {
        form.find("[type='checkbox']").each(function () {
            if ($(this).val() === "") {
                $(this).val("checked");
                $(this)[0].checked = false;
            }
        });
    }
}

function ajaxLoad(data, url, type) {
    type = type || "data";
    var param = {type: "POST", url: url, data: data};
    if (type == 'file') {
        param.contentType = false;
        param.processData = false;
    }
    ;
    //console.log(param);
    return $.ajax(param);
}

function getLoader() {
    var text =
            "<div class='bg'></div>" +
            '<div class="spinner">' +
            '<div class="rect1"></div>' +
            '<div class="rect2"></div>' +
            '<div class="rect3"></div>' +
            '<div class="rect4"></div>' +
            '<div class="rect5"></div>' +
            '<!--</div><progress max="100" value="0"></progress>-->'
            ;
    $('body').append(text);
}

function removeLoader() {
    $('.bg').remove();
    $('.spinner').remove();
    $('progress').remove();
}

//function replaceText(form) {
//    $.each(CKEDITOR.instances, function (k, v) {
//        if (form.find("#" + k).length) {
//            //console.log(v.getData());
//            form.find("#" + k).val(v.getData());
//        }
//    });
//}
//
//function loadEditor(id) {
//    var instance = CKEDITOR.instances[id];
//    if (instance) {
//        CKEDITOR.remove(instance);
//    }
//    return CKEDITOR.replace(id, {
//    });
//}