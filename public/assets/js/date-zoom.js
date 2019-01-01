(function ($) {
    $.fn.dateZoom = function (options) {
        var opts = $.extend($.fn.dateZoom.defaults, options);

        return this.each(function() {

        });
    };

    $.fn.dateZoom.defaults = {
        'fontSize': '110%',
        'easing': 'swing',
        'duration': '600',
        'selector': 'li>a',
        'match': 'href',
        'callBack': null
    };

})(jQuery);