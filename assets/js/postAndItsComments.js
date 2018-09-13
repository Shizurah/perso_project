$('#actions-btns').css('display', 'none');


$(function() {

    // AJOUT DE COMMENTAIRES :
    var commentForm  = $('#comment-form');

    $('#comment-btn').click(function() {
        commentForm.css('display', 'block');
        $('#comment-text').focus();
    });

    $('#comment-form').on('submit', function() {
        // event.preventDefault();

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
                $('#comment-text').val('');
                commentForm.css('display', 'none');

                $('.nb-of-comments').each(function() {
                    $(this).text(parseInt(Number($(this).text())) + 1);
                });

                $('#comments-container p:first-child').after(response);
            }
        });

        return false;
    });
    // FIN ajout de commentaires


    // MODIFICATION DES COMMENTAIRES :
    // $('.comments-date-and-actions').on('click', '.updating-comment-btn', function(event) {
    $('#comments-container').on('click', '.updating-comment-btn', function(event) {
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


    // SUPPRESSION DES COMMENTAIRES :
    $('#comments-container').on('click', '.deleting-comment-btn', function(event) {
        event.preventDefault();

        var that = $(this),
            btnHrefAttr = that.attr('href'),
            commentId = 'comment' + btnHrefAttr,

            url = 'index.php?action=commentDeleted&commentId=' + btnHrefAttr;

        $.ajax({
            url: url,
            type: 'post',
            data: '',

            success: function(response) {
                $('.nb-of-comments').each(function() {
                    $(this).text(parseInt(Number($(this).text())) - 1);
                });

                $('#' + commentId).fadeOut(700, function() { 
                    $(this).replaceWith(response);
                    setTimeout(function() {
                        $('.success-msg').remove();
                    }, 2500);
                });
            }
        });


    });
});


