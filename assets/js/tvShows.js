$('#nav-line').css('display', 'none');
$('section').css('padding', '20px');

var key = '7d64a9ed6d8e781b0d44e1b214945855',
    page = 1; // page renvoyée par défaut par l'api

$.ajax({
    url: 'https://api.themoviedb.org/3/trending/tv/week?api_key=' + key + '&language=fr',
    type: 'GET',
    dataType: 'json',

    success: function(trendingTvShows) {
        // console.log(trendingTvShows);

        trendingTvShows.results.forEach(function(tvShow) {
            $('#tv-shows-container').append('<div><a id="' + tvShow.id 
                                            + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id + '"></a><div class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                            + tvShow.poster_path + '"/></div></div>');
        });
    }
});

// chargement d'autres séries :
$(window).scroll(function() {
    
    if ($(window).scrollTop() == ($(document).height() - $(window).height())) {
        $('#tv-shows-container').append('<img id="loading-img" src="public/images/load2.gif" alt="chargement..." width="80px" height="80px"/>');

        page++;

        $.ajax({
            url: 'https://api.themoviedb.org/3/trending/tv/week?api_key=' + key + '&language=fr&page=' + page,
            type: 'GET',
            dataType: 'json',

            success: function(trendingTvShows) {
                // console.log(trendingTvShows);
                setTimeout(function() {
                    $('#loading-img').remove();
            
                    trendingTvShows.results.forEach(function(tvShow) {
                        $('#tv-shows-container').append('<div><a id="' + tvShow.id 
                                                        + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id + '"></a><div class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                                        + tvShow.poster_path + '"/></div></div>');
                    });
                }, 1000);
            }
        });
    }
});
