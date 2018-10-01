$('#actions-btns').css('display', 'none');

// AFFICHAGE DES COMMENTAIRES EN AJAX (pfagination)  :
$(function() {
    $('#pagination a').trigger('click');
});

$('#pagination').on('click', 'a', function(event) {
    event.preventDefault();

    $('#comments-container .comments').remove();

    var that = $(this),
        url = that.attr('href'),
        pageId = that.attr('id'),
        pagination = '',

        data = {
            pageId: pageId,
            commentsPerPage: 10
        };

    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',

        success: function(response) {
            $('#comments-container p:first-child').after(response.commentsList);

            if (response.nbOfPages > 1) {

                for (i = 1; i <= response.nbOfPages; i++) {
                    pagination += '<div';
        
                    if (i == pageId) {
                        pagination += ' class="cell_active"><span>' + i + '</span>';
                    }
                    else {
                        pagination += ' class="cell"><a href="' + url + '" id="' + i + '">' + i + '</a>'
                    }
        
                    pagination += '</div>';
                }               
            
                $('#pagination').html(pagination); 
            }
        }

        // error:
    });
});

// AJOUT DE COMMENTAIRES :
var commentForm  = $('#comment-form');

$('#comment-btn').click(function() {
    commentForm.css('display', 'block');
    $('#comment-text').focus();
});

$('#comment-form').on('submit', function() {
    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        commentContent = $('#comment-text').val();

    if (commentContent != '') {
        $.ajax({
            url: url,
            type: type,
            data: {
                'comment-text': commentContent
            },
            
            success: function(response) {
                $('#comment-text').val('');
                commentForm.css('display', 'none');
    
                $('.nb-of-comments').each(function() {
                    $(this).text(parseInt(Number($(this).text())) + 1);
                });
    
                $('#comments-container p:first-child').after(response);
    
                if ($('#comments-container .comments').length > 10) {
                    $('#comments-container .comments').last().remove();
                }  
            }
        });
    }

    return false;
}); ////// FIN ajout de commentaires


// MODIFICATION DES COMMENTAIRES :
$('#comments-container').on('click', '.updating-comment-btn', function(event) {
    event.preventDefault();

    var aElt = $(this),
        idAttr = aElt.attr('id'),
        comment = $('#' + idAttr);

    console.log($(this));

    comment.replaceWith($('<form></form>')
        .attr({
            id: 'updating-form-for-' + idAttr,
            class: 'updating-comment-form', 
            action: 'index.php?action=commentUpdated&commentId=' + idAttr,
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
            id: 'cancel-comment-updating-link-for-' + idAttr,
            class: 'cancel-comment-updating-link'
        })

        .click(function(e) {
            e.preventDefault();

            $(this).replaceWith(aElt);
            $('#updating-form-for-' + idAttr).replaceWith(comment);
        })
    );

    // AJAX
    $('#updating-form-for-' + idAttr).on('submit', function() {
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
                $('#cancel-comment-updating-link-for-' + idAttr).replaceWith(aElt);
            }            
        });

        return false;
    });
}); ////// FIN modification des commentaires


// SUPPRESSION DES COMMENTAIRES :
$('#comments-container').on('click', '.deleting-comment-btn', function(event) {
    event.preventDefault();

    if (confirm('Êtes-vous sûr de vouloir supprimer votre commentaire ?')) {

        var that = $(this),
        id = that.attr('id'),
        commentId = 'comment' + id,

        url = 'index.php?action=commentDeleted&commentId=' + id;

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
    }
    else {
        return false;
    }
    
}); ////// FIN suppression des commentaires


// SIGNALEMENT DES COMMENTAIRES :
$('#comments-container').on('click', '.reporting-comment-btn', function(event) {
    event.preventDefault();

    if (confirm('Êtes-vous sûr de vouloir signaler ce commentaire ?')) {
        var that = $(this),
        id = that.attr('id'),
        commentId = 'comment' + id,

        url = 'index.php?action=commentReporting&commentId=' + id;

        $.ajax({
            url: url,
            type: 'post',
            data: '',

            success: function(response) {
                that.replaceWith(response);
            }
        });
    }  
});
    

// 
    
    

    