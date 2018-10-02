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
                        $('#success-msg').remove();
                    }, 3000);
                });
                // $('#row' + linkId).html(response);
                // $('#' + id).fadeOut(700, function() { 
                //     $(this).replaceWith(response);
                //     setTimeout(function() {
                //         $('.success-msg-for-deleting-comment').remove();
                //     }, 2500);
                // });
            }
        });
    }

});

// index.php?action=postDeleting&amp;postId=<?= $post->id(); ?>

// $('#comments-container').on('click', '.deleting-comment-btn', function(event) {
//     event.preventDefault();

//     if (confirm('Êtes-vous sûr(e) de vouloir supprimer le commentaire ?')) {

//         var that = $(this),
//         id = that.attr('id'),
//         commentId = 'comment' + id,

//         url = 'index.php?action=commentDeleted&commentId=' + id;

//         $.ajax({
//             url: url,
//             type: 'post',
//             data: '',
//             timeout: 3000,
    
//             success: function(response) {
//                 $('.nb-of-comments').each(function() {
//                     $(this).text(parseInt(Number($(this).text())) - 1);
//                 });
    
//                 $('#' + commentId).fadeOut(700, function() { 
//                     $(this).replaceWith(response);
//                     setTimeout(function() {
//                         $('.success-msg-for-deleting-comment').remove();
//                     }, 2500);
//                 });
//             },

//             error: function() {
//                 alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
//                 // $(this).prepend('<p></p>')
//                 //     .attr('class', 'error-msg')
//                 //     .text('Oups, la suppression de votre commentaire a échoué. Veuillez ré-essayer ultérieurement.');
//             }
//         });    
//     }
//     else {
//         return false;
//     }
    
// }); ////// FIN suppression des commentaires