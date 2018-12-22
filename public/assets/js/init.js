'use strict';

jQuery(function($) {

    var objectModal = {
        'initModal': function() {
            if ($('.modal-window').length == 0) {
                return $('<div>')
                            .addClass('modal-window')
                            .appendTo('body');
            }
            
            return $('.modal-window');
        }
    };

    $('body').on('click', 'li>a', function(event) {
        event.preventDefault();

        $(this).addClass('active');

        var data = $(this)
                        .attr('href')
                        .replace(/.+?\?(.*)$/, '$1');

        var modal = objectModal.initModal();
    });

});