$(function () {
    $(document).on("click", ".ajax", function (e) {
        e.preventDefault();
        var form = $(this).closest("form");
        if (valid(form)) {
            var data = form.serializeArray();
            var ajax = {name: "type", value: "ajax"}
            data.push(ajax);
            //console.log(data);
            ajaxLoad(data, form.attr('action')).complete(function (dat) {
                var result = dat.responseText;
                if (result === "ok") {
                    sendMesseg("Ваши данные сохранены", "");
                } else {
                    sendMesseg("Ошибка при сохранении", "");
                }
                //console.log(dat.responseText);
            });
        }
    });
    $("form").submit(function () {
        if (valid($(this))) {
            console.log($(this).serializeArray());
            return true;
        } else {
            return false;
        }
    });
    //var editor;
    $(".ckedit").each(function () {
        //loadFile(loadEditor($(this).attr("id")));
        $(this).froalaEditor({heightMax: 500, height: 300, language: 'ru', imageManagerLoadURL: '/imageManager/',
            fontFamily: {
                'Arial,Helvetica,sans-serif': 'Font 1',
                'Impact,Charcoal,sans-serif': 'Font 2',
                'Tahoma,Geneva,sans-serif': 'Font 3'}});
    });

    if ($("#mainForm #Title").length && $("#mainForm #EnglishTitle").length) {
        tttrran($("#mainForm #Title"), $("#mainForm #EnglishTitle"));
    }
    if ($("#loadImage").length) {
        $("#loadImage").loadImage({maxWidth: 1100});
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
        startCollapsed: false,
        protectRoot: true,
        disableParentChange: true,
    });
});


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