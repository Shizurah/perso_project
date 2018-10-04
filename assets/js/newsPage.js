// $(function() {
//     $('#pagination a').trigger('click');
// });

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