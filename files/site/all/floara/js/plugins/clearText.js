 $((function() {
    var textClear;
    textClear = (function() {
      function textClear(editor) {
        var self;
        this.editor = editor;
        this.btn = this.editor.$tb.find(".fr-command[data-cmd='textClear']");
        self = this;
        $(document).on('click', ".addTextEditor", function() {
          var textarea;
          textarea = $(this).closest('.fr-layer').find('[name="text"]');
          self.editor.html.insert(textarea.val());
          return textarea.val('').replace(/<\/?[^>]+>/g,'');
        });
        $(document).on('click', ".clearPopupTextEditor", (function(_this) {
          return function() {
            return _this.editor.popups.hide('textClear.popup');
          };
        })(this));
      }

      textClear.prototype._initPopup = function() {
        var $popup, tpl;
        tpl = "<div class=\"fr-layer fr-active\" id=\"fr-textClear-layer-" + this.editor.id + "\">\n  <!--<p>Вставте текск в форму <span style='color: #C3C3C3;'>(ctrl+v)</span></p>-->\n  <small>Пожалуйста, вставьте текст в прямоугольник, используя сочетание клавиш <b>(Ctrl/Cmd+V)</b>, и нажмите <b>Далее</b>.</small>\n  <textarea name='text' class=\"form-control\" rows=\"4\"></textarea>\n  <div style='text-align: right; margin-top: 10px;'>\n    <button type=\"button\" class=\"btn btn-danger clearPopupTextEditor\" tabindex=\"2\">Отмена</button>\n    <button type=\"button\" class=\"btn btn-primary addTextEditor\" tabindex=\"2\">Далее</button>\n  </div>\n</div>";
        return $popup = this.editor.popups.create('textClear.popup', {
          custom_layer: tpl
        });
      };

      textClear.prototype.showPopup = function() {
        var $popup, left, top;
        $popup = this.editor.popups.get('textClear.popup') || ($popup = this._initPopup());
        this.editor.popups.setContainer('textClear.popup', this.editor.$tb);
        left = this.btn.offset().left + this.btn.outerWidth() / 2;
        top = this.btn.offset().top + (this.editor.opts.toolbarBottom ? 10 : this.btn.outerHeight() - 10);
        return this.editor.popups.show('textClear.popup', left, top, this.btn.outerHeight());
      };

      return textClear;

    })();
    $.extend($.FroalaEditor.POPUP_TEMPLATES, {
      'textClear.popup': '[_CUSTOM_LAYER_]'
    });

    /* fn для плагина */
    $.FroalaEditor.PLUGINS.textClear = function(editor) {
      return new textClear(editor);
    };

    /* Иконка для плагина */
    $.FroalaEditor.DefineIcon('textClear', {
      NAME: 'file-text'
    });

    /* Создаем плагин */
    return $.FroalaEditor.RegisterCommand('textClear', {
      title: 'Вставка только текст',
      callback: function(a, b) {
        return this.textClear.showPopup();
      }
    });
  })());