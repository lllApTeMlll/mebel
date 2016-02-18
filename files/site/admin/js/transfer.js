
(function ($, window, document, undefined)
{

    var defaults = {
        
    };
    //var fr = new FileReader();
    //var img = new Image();
    var canvas;
    var URL = window.webkitURL || window.URL;

    function Plugin(element, options)
    {
        this.w = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init(element);
    }

    Plugin.prototype = {
        // инициализация плагина
        init: function (params) {
            var list = $(params),
                    thiss = this;
            this.start(params);
        },
        start: function (params)
        {
            var thiss = this;
            $(document).on("input", ".natura", function (e) {
                var cont = $(this).closest(".grup");
                var item = $(this).closest(".dd-item");
                var result = cont.find(".result");
                if (result.length){
                    if (item.find(">label input:checked").length){
                        result.val(thiss.get_translit($(this).val()));
                    }
                }
            });
            console.log("start");
        },
        get_translit: function (str) {
            var entoru = [[['а'], ['a']],
                [['б'], ['b']],
                [['в'], ['v']],
                [['г'], ['g']],
                [['д'], ['d']],
                [['е'], ['e']],
                [['ё'], ['yo']],
                [['ж'], ['zh']],
                [['з'], ['z']],
                [['и'], ['i']],
                [['й'], ['j']],
                [['к'], ['k']],
                [['л'], ['l']],
                [['м'], ['m']],
                [['н'], ['n']],
                [['о'], ['o']],
                [['п'], ['p']],
                [['р'], ['r']],
                [['с'], ['s']],
                [['т'], ['t']],
                [['у'], ['u']],
                [['ф'], ['f']],
                [['х'], ['h']],
                [['ц'], ['c']],
                [['ч'], ['ch']],
                [['ш'], ['sh']],
                [['щ'], ['shch']],
                [['ъ'], ['']],
                [['ы'], ['y']],
                [['ь'], ['']],
                [['э'], ['e']],
                [['ю'], ['yu']],
                [['я'], ['ya']],
                [['і'], ['i']],
                [['ї'], ['i']],
                [['є'], ['e']],
                [['А'], ['A']],
                [['Б'], ['B']],
                [['В'], ['V']],
                [['Г'], ['G']],
                [['Д'], ['D']],
                [['Е'], ['E']],
                [['Ё'], ['Yo']],
                [['Ж'], ['Zh']],
                [['З'], ['Z']],
                [['И'], ['I']],
                [['Й'], ['J']],
                [['К'], ['K']],
                [['Л'], ['L']],
                [['М'], ['M']],
                [['Н'], ['N']],
                [['О'], ['O']],
                [['П'], ['P']],
                [['Р'], ['R']],
                [['С'], ['S']],
                [['Т'], ['T']],
                [['У'], ['U']],
                [['Ф'], ['F']],
                [['Х'], ['H']],
                [['Ц'], ['C']],
                [['Ч'], ['Ch']],
                [['Ш'], ['Sh']],
                [['Щ'], ['Shch']],
                [['Ъ'], ['']],
                [['Ы'], ['Y']],
                [['Ь'], ['']],
                [['Э'], ['E']],
                [['Ю'], ['Yu']],
                [['Я'], ['Ya']],
                [[' '], ['-']],
                [['І'], ['I']],
                [['Ї'], ['I']],
                [['Є'], ['E']]];
            var nameVal = trim(str);
            var trans = new String();
            for (i = 0; i < entoru.length; i++) {
                var regex = new RegExp(entoru[i][0][0], "g");
                nameVal = nameVal.replace(regex, entoru[i][1][0]);
            }
            return nameVal.toLowerCase();
        }//,resetFile
    };
    $.fn.transfer = function (params)
    {
        var lists = this,
                retval = this;
        lists.each(function ()
        {
            var plugin = $(this).data("transfer");
            if (!plugin) {
                $(this).data("transfer", new Plugin(this, params));
                $(this).data("transfer-id", new Date().getTime());
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function') {
                    retval = plugin[params]();
                }
            }
        });
        return retval || lists;
    }
    ;
})(window.jQuery || window.Zepto, window, document);
