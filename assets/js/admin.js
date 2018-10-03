$('#banner').css('display', 'none');
$('section').css('margin-top', '0px');
$('footer').css('background-color', 'white');
$('footer a').css('color', 'black');

// $('#error-msg-container')

var height = $(window).height();
$('section').css('min-height', height);


// pages d'administration : modification et suppression des articles
$('.link-for-post-action').hover(function() {
    $(this).find('img').css('visibility', 'visible');
}, function() {
    $(this).find('img').css('visibility', 'hidden');
});

$('.link-for-post-watching').hover(function() {
    $(this).find('img').css('visibility', 'visible');
}, function() {
    $(this).find('img').css('visibility', 'hidden');
});


// Supression article :
$('table tr').on('click', '.link-for-post-deleting', function(event) {
    event.preventDefault();

    if (confirm('Etes-vous sûr(e) de vouloir supprimer cet article ?')) {
        var that = $(this),
        linkId = that.attr('id'),
        url = 'index.php?action=postDeleting';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                // 'action': 'postDeleting',
                'postId': linkId
            },
            timeout: 3000,

            success: function(response) {

                $('#' + linkId).closest('tr').fadeOut(700, function() {
                    $('h3').after(response);
                    setTimeout(function() {
                        $('.success-msg').remove();
                    }, 3000);
                });
            }
        });
    }

});


// Suppression commentaire :
$('table tr').on('click', '.link-for-comment-deleting', function(e) {
    e.preventDefault();

    if (confirm('Etes-vous sûr(e) de vouloir supprimer ce commentaire ?')) {

        var that = $(this),
        rowElt = that.closest('tr'),
        commentId = rowElt.attr('id'),

        url = 'index.php?action=commentDeleted';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                // 'action': 'postDeleting',
                'commentId': commentId
            },
            timeout: 3000,

            success: function(response) {

                rowElt.fadeOut(700, function() {
                    $('h3').after(response);
                    setTimeout(function() {
                        $('.success-msg').remove();
                    }, 3000);
                });
            }
        });
    }
});

// Ignorer commentaire signalé :
$('table tr').on('click', '.link-for-comment-ignoring', function(e) {
    e.preventDefault();

    if (confirm('Le commentaire ne sera plus visible depuis votre espace d\'administration, mais ne sera pas supprimé. \nEtes-vous sûr(e) de vouloir ignorer ce commentaire ?')) {

        var that = $(this),
            rowElt = that.closest('tr'),
            commentId = rowElt.attr('id'),
            
            url = 'index.php?action=commentIgnored';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                // 'action': 'postDeleting',
                'commentId': commentId
            },
            timeout: 3000,

            success: function(response) {

                rowElt.fadeOut(700, function() {
                    $('h3').after(response);

                    setTimeout(function() {
                        $('.success-msg').remove();
                    }, 3000);
                });
            }
        });
    }
});