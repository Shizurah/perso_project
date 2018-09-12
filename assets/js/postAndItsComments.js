$('#actions-btns').css('display', 'none');


$(function() {

    var commentForm  = $('#comment-form');

    $('#comment-btn').click(function() {
        commentForm.css('display', 'block');
        $('#comment-text').val('');
        $('#comment-text').focus();
    });


    $('.comments-date-and-actions').on('click', '.updating-comment-btn', function(event) {
        event.preventDefault();

        var aElt = $(this),
            hrefAttr = aElt.attr('href'),
            comment = $('#' + hrefAttr);

        console.log($(this));

        comment.replaceWith($('<form></form>')
            .attr({
                id: 'updating-form-for-' + hrefAttr,
                class: 'updating-comment-form', 
                action: 'index.php?action=commentUpdated&commentId=' + hrefAttr,
                method: 'post'
            })
            .append($('<textarea></textarea>')
                .attr({
                    name: 'updated-comment', 
                    id: 'updating-comment-text',
                })
                .val($.trim(comment.text())),

                $('<input></input>')
                    .attr({
                        type: 'submit',
                        value: 'Modifier'
                    }))
        );
        
        $('#updating-comment-text').focus();

        $(this).replaceWith($('<a></a>')
            .text('annuler')
            .attr({
                href: '#',
                id: 'cancel-comment-updating-link-for-' + hrefAttr,
                class: 'cancel-comment-updating-link'
            })

            .click(function(e) {
                e.preventDefault();

                $(this).replaceWith(aElt);
                $('#updating-form-for-' + hrefAttr).replaceWith(comment);
            })
        );

        // AJAX
        $('#updating-form-for-' + hrefAttr).on('submit', function() {
            var that = $(this),
                url = that.attr('action'),
                type = that.attr('method'),
                data = {};
    
            that.find('[name]').each(function(index, value) {
                var that = $(this),
                    name = that.attr('name'),
                    value = that.val();
    
                    data[name] = value;
            });
    
            $.ajax({
                url: url,
                type: type,
                data: data,
    
                success: function(response) {
                    that.replaceWith(response);
                    $('#cancel-comment-updating-link-for-' + hrefAttr).replaceWith(aElt);
                }            
            });
    
            return false;
        });
        // 

    });


    // AJAX :
    // $('.updating-comment-form').on('submit', function() {
    //     var that = $(this),
    //         url = that.attr('action'),
    //         type = that.attr('method'),
    //         data = {};

    //     that.find('[name]').each(function(index, value) {
    //         var that = $(this),
    //             name = that.attr('name'),
    //             value = that.val();

    //             data[name] = value;
    //     });

    //     $.ajax({
    //         url: url,
    //         type: type,
    //         data: data,

    //         success: function(response) {
    //             console.log(response);
    //         }            
    //     });

    //     return false;
    // });

    // FORMULAIRE AJOUT COMM :
    // $('form #comment-form').on('submit', function() {
    //     var that = $(this),
    //         url = that.attr('action'),
    //         type = that.attr('method'),
    //         data = {};

    //     that.find('[name]').each(function(index, value) {
    //         var that = $(this),
    //             name = that.attr('name'),
    //             value = that.val();

    //             data[name] = value;
    //     });

    //     $.ajax({
    //         url: url,
    //         type: type,
    //         data: data,

    //         success: function(response) {
    //             console.log(response);
    //         }            
    //     });

    //     return false;
    // });

});

