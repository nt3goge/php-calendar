'use strict';

jQuery(function($) {

    var processFile = 'public/assets/inc/ajax.inc.php',
    objectModal = {
        'initModal': function() {
            if ($('.modal-window').length == 0) {
                return $('<div>')
                            .hide()
                            .addClass('modal-window')
                            .appendTo('body');
            }
            
            return $('.modal-window');
        },
        'boxIn': function(data, modal) {
            $('<div>')
                .hide()
                .addClass('modal-overlay')
                .click(function(event) {
                    objectModal.boxOut(event);
                })
                .appendTo('body');

            modal
                .hide()
                .append(data)
                .appendTo('body');

            $('.modal-window, .modal-overlay').fadeIn('slow');
        },
        'boxOut': function(event) {
            if (event != undefined) {
                event.preventDefault();
            }

            $('a').removeClass('active');

            $('.modal-window, .modal-overlay').fadeOut('slow', function() {
                $(this).remove();
            });
        },
        'addEvent': function(data, formData) {
            var entry = objectModal.deserialize(formData),
                cal = new Date(NaN),
                event = new Date(NaN),
                cdata = $('h2').attr('id').split('-'),
                date = entry.event_start.split(' ')[0],
                edata = data.split('-');

            cal.setFullYear(cdata[1], cdata[2], 1);
            event.setFullYear(edata[0], edata[1], edata[2]);
            event.setMinutes(event.getTimezoneOffset());

            if (cal.setFullYear() == event.getFullYear() && cal.getMonth() == event.getMonth()) {
                var day = String(event.getDate());
                day = day.length == 1 ? '0' + day : day;

                $('<a>')
                .hide()
                .attr('href', 'view.php?event_id=' + data)
                .text(entry.event_title)
                .insertAfter($('strong:contains(' + day + ')'))
                .delay(1000)
                .fadeIn('slow');
            }
        },
        'deserialize': function(string) {
            var data = string.split('&'),
                pairs = [], entry = {}, key, val;

            for (var x in data) {
                pairs = data[x].split('=');
                key = pairs[0];
                val = pairs[1];
                entry[key] = objectModal.urlDecode(val);
            }

            return entry;
        },
        'urlDecode': function(string) {
            var converted = string.replace(/\+/g, ' ');

            return decodeURIComponent(converted);
        }
    };

    $('body').on('click', 'li>a', function(event) {
        event.preventDefault();

        $(this).addClass('active');

        var data = $(this)
                        .attr('href')
                        .replace(/.+?\?(.*)$/, '$1');

        var modal = objectModal.initModal();

        $('<a>')
            .attr('href', '#')
            .addClass('modal-close-btn')
            .html('&times;')
            .click(function(event) {
                objectModal.boxOut(event);
            })
            .appendTo(modal);
            
        $.ajax({
            type: 'POST',
            url: processFile,
            data: 'action=event_view&' + data,
            success: function(data) {
                objectModal.boxIn(data, modal);
            },
            error: function(message) {
                modal.append(message);
            }
        });
    });
    
    $('body').on('click', '.admin', function(event) {
        event.preventDefault();
        
        var action = 'edit_event';

        $.ajax({
            type: 'POST',
            url: processFile,
            data: 'action=' + action,
            success: function(data) {
                var form = $(data).hide(),
                    modal = objectModal.initModal();

                objectModal.boxIn(null, modal);

                form
                    .appendTo(modal)
                    .addClass('edit-form')
                    .fadeIn('slow');
            },
            error: function(message) {
                modal.append(message);
            }
        });
    });
    
    $('body').on('click', '.edit-form a:contains(cancel)', function(event) {
        objectModal.boxOut(event);
    });

    $('body').on('click', '.edit-form input[type="submit"]', function(event) {
        event.preventDefault();

        var formData = $(this).parents('form').serialize();

        $.ajax({
            type: 'POST',
            url: processFile,
            data: formData,
            success: function(data) {
                objectModal.boxOut();
                objectModal.addEvent(data, formData);
            },
            error: function(message) {
                modal.append(message);
            }
        });
    });

});