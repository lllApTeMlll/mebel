/*!
 * Nestable jQuery Plugin - Copyright (c) 2012 David Bushell - http://dbushell.com/
 * Dual-licensed under the BSD or MIT licenses
 */
;
(function ($, window, document, undefined)
{
    var hasTouch = 'ontouchstart' in document;

    /**
     * Detect CSS pointer-events property
     * events are normally disabled on the dragging element to avoid conflicts
     * https://github.com/ausi/Feature-detection-technique-for-pointer-events/blob/master/modernizr-pointerevents.js
     */
    var hasPointerEvents = (function ()
    {
        var el = document.createElement('div'),
                docEl = document.documentElement;
        if (!('pointerEvents' in el.style)) {
            return false;
        }
        el.style.pointerEvents = 'auto';
        el.style.pointerEvents = 'x';
        docEl.appendChild(el);
        var supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents === 'auto';
        docEl.removeChild(el);
        return !!supports;
    })();

    var defaults = {
        listNodeName: 'ol',
        itemNodeName: 'li',
        rootClass: 'dd',
        listClass: 'dd-list',
        itemClass: 'dd-item',
        dragClass: 'dd-dragel',
        handleClass: 'dd-handle',
        collapsedClass: 'dd-collapsed',
        placeClass: 'dd-placeholder',
        noDragClass: 'dd-nodrag',
        emptyClass: 'dd-empty',
        expandBtnHTML: '<button data-action="expand" type="button">Expand</button>',
        collapseBtnHTML: '<button data-action="collapse" type="button">Collapse</button>',
        group: 0,
        maxDepth: 5,
        threshold: 0
    };

    function Plugin(element, options)
    {
        this.w = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {
        init: function ()
        {
            var list = this;
            list.start();            
        },
        start: function ()
        {
            var list = this;
            //list.el.find('.dd4-handle').unbind('click');
            list.el.find('.plus,.dell').unbind('click');
            list.el.find('.plus').on('click', function (e) {
                var opt = list.options;
                var dat_id = $(this).closest("li").attr('data-id');
                var il = $(this).closest("li");
                if (il.find('ol').length) {
                    var ol = il.find('>ol');
                } else {
                    var list1 = $(document.createElement(opt.listNodeName)).addClass(opt.listClass);
                    il.append(list1);
                    var ol = il.find('>ol');
                }
                var pointEl = $(document.elementFromPoint(e.pageX - document.body.scrollLeft, e.pageY - (window.pageYOffset || document.documentElement.scrollTop)));
                var dragDepthCur = pointEl.parents(opt.listNodeName).length;
                ol.append('<li class="dd-item dd3-item " data-id="-1">' +
                        getNewEl({Parent_id: dat_id}) +
                        ' </li>');
                var newE = il.find(" > ol > li:last-child");
                newE.fadeOut(0);
                newE.fadeIn(1000);
                // }
                list.start();
            });
            list.el.find('.dell').on('click', function (e) {
                if (!confirm('Удалить')) {
                    return false;
                }
                var opt = list.options;
                if ($(this).parent().length) {
                    var il = $(this).parent();
                    il.fadeOut(1000, function () {
                        il.remove();
                    });
                }
                list.start();
            });
            list.el.transfer();
        },
    };

    $.fn.nestable = function (params)
    {
        var lists = this,
                retval = this;

        lists.each(function ()
        {
            var plugin = $(this).data("nestable");

            if (!plugin) {
                $(this).data("nestable", new Plugin(this, params));
                $(this).data("nestable-id", new Date().getTime());
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function') {
                    retval = plugin[params]();
                }
            }
        });

        return retval || lists;
    };

})(window.jQuery || window.Zepto, window, document);
