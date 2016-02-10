
$(function () {
    $("#loadImage").loadImage();
});


(function ($, window, document, undefined)
{

    var options = {
        type: /image.*/,
        maxSize: '1000000',
        maxHeigth: 1300,
        maxWidth: 500,
        minWidth: 300
    };
    //var fr = new FileReader();
    //var img = new Image();
    var canvas;
    var URL = window.webkitURL || window.URL;

    var methods = {
        // инициализация плагина
        init: function (params) {
            var list = params;
            var thiss = this;
            if (!$("#ImageCanvas").length) {
                list.before('<canvas id="ImageCanvas" width="300" height="300" style="display:none;"></canvas>');
            }
            canvas = document.getElementById('ImageCanvas');
            list.change(function () {
                var filesToUpload = $(this)[0].files;
                var pr = true;
                $.each(filesToUpload, function (index, value) {
                    if (!value.type.match(/image.*/)) {
                        pr = false;
                    }
                });
                if (pr) {
                    thiss.handleFiles(filesToUpload, list);
                } else {
                    alert("no image");
                }
                console.log(pr);
                console.log(filesToUpload);
            });
            this.start(params);
        },
        start: function (params)
        {
            var list = params;
            var thiss = this;
            $('.delPhoto').unbind('mousedown');
            $('.delPhoto').mousedown(function () {
                $(this).closest("li").hide(1000);
                return false;
            });
            list.closest(".box-body").find('li').unbind('mousedown');
            list.closest(".box-body").find('li').dragdrop({
                makeClone: true,
                sourceHide: true,
                dragClass: "shadow",
                container: list.closest(".box-body"),
                canDrag: function ($src, event) {
                    $srcElement = $src;
                    srcIndex = $srcElement.index();
                    dstIndex = srcIndex;
                    return $src;
                },
                canDrop: function ($dst) {
                    if ($dst.is("li")) {
                        dstIndex = $dst.index();
                        if (srcIndex < dstIndex)
                            $srcElement.insertAfter($dst);
                        else
                            $srcElement.insertBefore($dst);
                    }
                    else {
                        $dst = $dst.closest("li");
                        dstIndex = $dst.index();
                        if (srcIndex < dstIndex)
                            $srcElement.insertAfter($dst);
                        else
                            $srcElement.insertBefore($dst);
                    }
                    return true;
                },
                didDrop: function ($src, $dst) {
                    // Must have empty function in order to NOT move anything.
                    // Everything that needs to be done has been done in canDrop.

                    //if (srcIndex != dstIndex) {
                    //newZ();
                    //}
                }
            });

        },
        handleFiles: function (filesToUpload, list) {
            var thiss = this;
            var ctx = canvas.getContext('2d');
            $.each(filesToUpload, function (index, e) {
                var url = URL.createObjectURL(e);
                var img = new Image();
                img.onload = function () {
                    var width = this.width;
                    var height = this.height;
                    if (width > height) {
                        if (width > options.maxWidth) {
                            height *= options.maxWidth / width;
                            width = options.maxWidth;
                        }
                    } else {
                        if (height > options.maxHeigth) {
                            width *= options.maxHeigth / height;
                            height = options.maxHeigth;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);
                    //console.log(width);
                    var dataUrl = canvas.toDataURL("image/jpeg");
                    var blob = thiss.dataURLtoBlob(dataUrl);
                    var formData = new FormData();
                    formData.append("action", "load");
                    formData.append("max", options.maxWidth);
                    formData.append("min", options.minWidth);
                    formData.append("files", blob, "thumb.jpg");
                    var provTime = true;
                    getLoader();
                    $.ajax({type: "POST", url: "/fasadm/LoadImage/", data: formData, contentType: false, processData: false,
                        success: function (data) {
                            provTime = false;
                            removeLoader();
                            $('form').get(0).reset();
                           // console.log(data);
                            try {
                                var mas = JSON.parse(data);
                                //console.log(mas);
                                list.closest(".box-body").find('.photoActiv').append(mas.elem);
                                thiss.start(list);
                            } catch (e1) {
                                console.log(data);
                                //return false;
                            }
                        }
                    });
                }
                img.src = url;
            });
        },
        dataURLtoBlob: function (dataurl) {
            var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {type: mime});
        }
    };
    $.fn.loadImage = function (params)
    {
        options = $.extend({}, options, params);
        methods.init(this);
    }
    ;
})(window.jQuery || window.Zepto, window, document);
