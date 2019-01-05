(function ($) {
    $.fn.dateZoom = function (options) {
        var opts = $.extend($.fn.dateZoom.defaults, options);

        return this.each(function() {
            var originalSize = $(opts.selector).css('font-size');
       
            $(this).hover(function() {
                $.fn.dateZoom.zoom(opts.selector, opts.fontSize, opts);
            }, function() {
                $.fn.dateZoom.zoom(opts.selector, originalSize, opts);
            });
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
   
    $.fn.dateZoom.zoom = function(element, size, opts) {
        if (opts.match) {
            element = $.grep($(element), function(e) {
                if ($('a:hover').length > 0) {
                    return e[opts.match] === $('a:hover')[0][opts.match];
                }
            });
        }

        $(element).animate({
            'font-size': size
        }, {
            'duration': opts.duration,
            'easing': opts.easing,
            'complete': opts.callBack
        })
        .dequeue()
        .clearQueue();
    };

})(jQuery);