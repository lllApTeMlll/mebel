$(document).ready(function() {


    // ааОаНбаОаЛб
    var console = $("#console");

    // ааНбаА аО аВбаБбаАаНаНбб баАаЙаЛаАб
    var countInfo = $("#info-count");
    var sizeInfo = $("#info-size");

    // аЁбаАаНаДаАбаНбаЙ input аДаЛб баАаЙаЛаОаВ
    var fileInput = $('#file-field');
    
    // ul-баПаИбаОаК, баОаДаЕбаЖаАбаИаЙ аМаИаНаИаАбббаКаИ аВбаБбаАаНаНбб баАаЙаЛаОаВ
    var imgList = $('ul#img-list');
    
    // ааОаНбаЕаЙаНаЕб, аКбаДаА аМаОаЖаНаО аПаОаМаЕбаАбб баАаЙаЛб аМаЕбаОаДаОаМ drag and drop
    var dropBox = $('#img-container');

    // аЁбаЕббаИаК аВбаЕб аВбаБбаАаНаНбб баАаЙаЛаОаВ аИ аИб баАаЗаМаЕбаА
    var imgCount = 0;
    var imgSize = 0;
    
    
    ////////////////////////////////////////////////////////////////////////////


    // абаВаОаД аВ аКаОаНбаОаЛб
    function log(str) {
        $('<p/>').html(str).prependTo(console);
    }

    // абаВаОаД аИаНбб аО аВбаБбаАаНаНбб
    function updateInfo() {
        countInfo.text( (imgCount == 0) ? 'ааЗаОаБбаАаЖаЕаНаИаЙ аНаЕ аВбаБбаАаНаО' : ('ааЗаОаБбаАаЖаЕаНаИаЙ аВбаБбаАаНаО: '+imgCount));
        sizeInfo.text(Math.round(imgSize / 1024));
    }

    // ааБаНаОаВаЛаЕаНаИаЕ progress bar'аА
    function updateProgress(bar, value) {
        var width = bar.width();
        var bgrValue = -width + (value * (width / 100));
        bar.attr('rel', value).css('background-position', bgrValue+'px center').text(value+'%');
    }



    // абаОаБбаАаЖаЕаНаИаЕ аВбаБбаАаНбб баАаЙаЛаОаВ аИ баОаЗаДаАаНаИаЕ аМаИаНаИаАббб
    function displayFiles(files) {
        var imageType = /image.*/;
        var num = 0;
        
        $.each(files, function(i, file) {
            
            // аббаЕаИаВаАаЕаМ аНаЕ аКаАббаИаНаКаИ
            if (!file.type.match(imageType)) {
                log('аЄаАаЙаЛ аОббаЕбаН: `'+file.name+'` (баИаП '+file.type+')');
                return true;
            }
            
            num++;
            
            // аЁаОаЗаДаАаЕаМ баЛаЕаМаЕаНб li аИ аПаОаМаЕбаАаЕаМ аВ аНаЕаГаО аНаАаЗаВаАаНаИаЕ, аМаИаНаИаАбббб аИ progress bar,
            // аА баАаКаЖаЕ баОаЗаДаАаЕаМ аЕаМб баВаОаЙббаВаО file, аКбаДаА аПаОаМаЕбаАаЕаМ аОаБбаЕаКб File (аПбаИ аЗаАаГббаЗаКаЕ аПаОаНаАаДаОаБаИббб)
            var li = $('<li/>').appendTo(imgList);
            $('<div/>').text(file.name).appendTo(li);
            var img = $('<img/>').appendTo(li);
            $('<div/>').addClass('progress').attr('rel', '0').text('0%').appendTo(li);
            li.get(0).file = file;

            // аЁаОаЗаДаАаЕаМ аОаБбаЕаКб FileReader аИ аПаО аЗаАаВаЕббаЕаНаИаИ ббаЕаНаИб баАаЙаЛаА, аОбаОаБбаАаЖаАаЕаМ аМаИаНаИаАбббб аИ аОаБаНаОаВаЛбаЕаМ
            // аИаНбб аОаБаО аВбаЕб баАаЙаЛаАб
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.attr('src', e.target.result);
                    aImg.attr('width', 150);
                    log('ааАббаИаНаКаА аДаОаБаАаВаЛаЕаНаА: `'+file.name + '` (' +Math.round(file.size / 1024) + ' ааБ)');
                    imgCount++;
                    imgSize += file.size;
                    updateInfo();
                };
            })(img);
            
            reader.readAsDataURL(file);
        });
    }
    
    
    ////////////////////////////////////////////////////////////////////////////


    // ааБбаАаБаОбаКаА баОаБббаИб аВбаБаОбаА баАаЙаЛаОаВ баЕбаЕаЗ ббаАаНаДаАббаНбаЙ input
    // (аПбаИ аВбаЗаОаВаЕ аОаБбаАаБаОббаИаКаА аВ баВаОаЙббаВаЕ files баЛаЕаМаЕаНбаА input баОаДаЕбаЖаИббб аОаБбаЕаКб FileList,
    //  баОаДаЕбаЖаАбаИаЙ аВбаБбаАаНаНбаЕ баАаЙаЛб)
    fileInput.bind({
        change: function() {
            log(this.files.length+" баАаЙаЛ(аОаВ) аВбаБбаАаНаО баЕбаЕаЗ аПаОаЛаЕ аВбаБаОбаА");
            displayFiles(this.files);
        }
    });
          

    // ааБбаАаБаОбаКаА баОаБббаИаЙ drag and drop аПбаИ аПаЕбаЕбаАбаКаИаВаАаНаИаИ баАаЙаЛаОаВ аНаА баЛаЕаМаЕаНб dropBox
    // (аКаОаГаДаА баАаЙаЛб аБбаОббб аНаА аПбаИаНаИаМаАббаИаЙ баЛаЕаМаЕаНб баОаБббаИб drop аПаЕбаЕаДаАаЕббб аОаБбаЕаКб Event,
    //  аКаОбаОббаЙ баОаДаЕбаЖаИб аИаНбаОбаМаАбаИб аО баАаЙаЛаАб аВ баВаОаЙббаВаЕ dataTransfer.files. а jQuery "аОбаИаГаИаНаАаЛ"
    //  аОаБбаЕаКбаА-баОаБббаИб аПаЕбаЕаДаАаЕббб аВ баВ-аВаЕ originalEvent)
    dropBox.bind({
        dragenter: function() {
            $(this).addClass('highlighted');
            return false;
        },
        dragover: function() {
            return false;
        },
        dragleave: function() {
            $(this).removeClass('highlighted');
            return false;
        },
        drop: function(e) {
            var dt = e.originalEvent.dataTransfer;
            log(dt.files.length+" баАаЙаЛ(аОаВ) аВбаБбаАаНаО баЕбаЕаЗ drag'n'drop");
            displayFiles(dt.files);
            return false;
        }
    });


    // ааБаАаБаОбаКаА баОаБббаИб аНаАаЖаАбаИб аНаА аКаНаОаПаКб "ааАаГббаЗаИбб". абаОбаОаДаИаМ аПаО аВбаЕаМ аМаИаНаИаАбббаАаМ аИаЗ баПаИбаКаА,
    // баИбаАаЕаМ б аКаАаЖаДаОаЙ баВаОаЙббаВаО file (аДаОаБаАаВаЛаЕаНаНаОаЕ аПбаИ баОаЗаДаАаНаИаИ) аИ аНаАбаИаНаАаЕаМ аЗаАаГббаЗаКб, баОаЗаДаАаВаАб
    // баКаЗаЕаМаПаЛббб аОаБбаЕаКбаА uploaderObject. ааО аМаЕбаЕ аЗаАаГббаЗаКаИ, аОаБаНаОаВаЛбаЕаМ аПаОаКаАаЗаАаНаИб progress bar,
    // баЕбаЕаЗ аОаБбаАаБаОббаИаК onprogress, аПаО аЗаАаВаЕббаЕаНаИаИ аВбаВаОаДаИаМ аИаНбаОбаМаАбаИб
    $("#upload-all").click(function() {
        
        imgList.find('li').each(function() {

            var uploadItem = this;
            var pBar = $(uploadItem).find('.progress');
            log('ааАбаИаНаАаЕаМ аЗаАаГббаЗаКб `'+uploadItem.file.name+'`...');

            new uploaderObject({
                file:       uploadItem.file,
                url:        './serverLogic.php',
                fieldName:  'my-pic',

                onprogress: function(percents) {
                    updateProgress(pBar, percents);
                },
                
                oncomplete: function(done, data) {
                    if(done) {
                        updateProgress(pBar, 100);
                        log('аЄаАаЙаЛ `'+uploadItem.file.name+'` аЗаАаГббаЖаЕаН, аПаОаЛббаЕаНаНбаЕ аДаАаНаНбаЕ:<br/>*****<br/>'+data+'<br/>*****');
                    } else {
                        log('абаИаБаКаА аПбаИ аЗаАаГббаЗаКаЕ баАаЙаЛаА `'+uploadItem.file.name+'`:<br/>'+this.lastError.text);
                    }
                }
            });
        });
    });

    
    // абаОаВаЕбаКаА аПаОаДаДаЕбаЖаКаИ File API аВ аБбаАбаЗаЕбаЕ
    if(window.FileReader == null) {
        log('ааАб аБбаАбаЗаЕб аНаЕ аПаОаДаДаЕбаЖаИаВаАаЕб File API!');
    }
    
    
});