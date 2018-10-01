$('#banner').css('display', 'none');
$('section').css('margin-top', '0px');
$('footer').css('background-color', 'white');
$('footer a').css('color', 'black');

// $('#error-msg-container')

var height = $(window).height();
$('section').css('height', height);


// pages d'administration : modification et suppression des commentaires
$('.link-for-post-action').hover(function() {
    $(this).find('img').css('visibility', 'visible');
}, function() {
    $(this).find('img').css('visibility', 'hidden');
});
