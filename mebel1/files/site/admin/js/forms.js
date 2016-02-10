$(function () {
    $("form").submit(function () {
        if (valid($(this))) {
            return true;
        } else {
            return false;
        }
    });
    //var editor;
    $(".ckedit").each(function () {
        loadFile(loadEditor($(this).attr("id")));
    });
    
    
    if ($("#mainForm #Title").length && $("#mainForm #EnglishTitle").length) {
        tttrran($("#mainForm #Title"), $("#mainForm #EnglishTitle"));
    }
});

function loadFile(obj){
    return false;
//    AjexFileManager.init({
//        returnTo : "ckeditor",
//        editor: obj
//    });
}


function replaceText(form) {
    $.each(CKEDITOR.instances, function (k, v) {
        if (form.find("#" + k).length) {
            //console.log(v.getData());
            form.find("#" + k).val(v.getData());
        }
    });
}

function loadEditor(id) {
    var instance = CKEDITOR.instances[id];
    if (instance) {
        CKEDITOR.remove(instance);
    }
    return CKEDITOR.replace(id, {
    });
}

function ajaxLoad(data, url, type) {
    type = type||"data";
    var param = {type: "POST", url: url, data: data };
    if (type == 'file'){
        param.contentType = false;
        param.processData = false;
    };
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