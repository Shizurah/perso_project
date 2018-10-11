document.getElementById("nav-line").style.display = "none"

if ($(window).width() < 992) {
    $('#main-wrap').css('margin-top', '0px');
} else {
    $('#main-wrap').css('margin-top', '260px');
}


if ($(window).width() <= 425 ) {
    $('#banner-img').attr('src', 'public/images/mobil_banner2.png');
}


if ($(window).width() <= 320 ) {
    $('section').css('margin-top', '10px');
}

var currentNbOfPosts = 10;

$('#pagination').on('click', 'a', function(e) {
    e.preventDefault();

    var that = $(this),
        nbOfPostsToDisplay = 10,
        url = 'index.php';
    
    $.ajax({
        url: url,
        type: 'get', 
        data: {
            'nbOfPostsToDisplay': nbOfPostsToDisplay,
            'currentNbOfPosts': currentNbOfPosts
        },
        dataType: 'html',

        success: function(response) {
            currentNbOfPosts += 10;

            that.closest('div').remove();
            $('#news-posts-container').append(response);
        }
    });
});