$('#banner').css('display', 'none');
$('section').css('margin-top', '0px');
$('footer').css('background-color', 'white');
$('footer a').css('color', 'black');


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
                'postId': linkId
            },
            dataType: 'json',
            timeout: 10000,

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
                'commentId': commentId
            },
            dataType: 'json',
            timeout: 10000,

            success: function(response) {

                if (response.status == 'success') {
                    rowElt.fadeOut(1000, function() {
                        $('h3').after(response.message);
    
                        setTimeout(function() {
                            $('.success-msg').remove();
                        }, 3000);
                    });
                }
                else if (response.status == 'error') {
                    $('#error-msg').remove();
                    $('h3').after(response.message);
                }
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
                'commentId': commentId
            },
            dataType: 'json',
            timeout: 10000,

            success: function(response) {

                if (response.status == 'success') {
                    rowElt.fadeOut(1000, function() {
                        $('h3').after(response.message);
    
                        setTimeout(function() {
                            $('.success-msg').remove();
                        }, 3000);
                    });
                }
                else if (response.status == 'error') {
                    $('#error-msg').remove();
                    $('h3').after(response.message);
                }
            }
        });
    }
});