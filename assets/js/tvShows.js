document.getElementById('actions-btns').style.display = "none";
document.getElementById('nav-line').style.display = 'none';

$(function() {

    $.ajax({
        url: 'https://api.themoviedb.org/3/trending/tv/week?api_key=7d64a9ed6d8e781b0d44e1b214945855&language=fr',
        type: 'GET',
        dataType: 'json',

        success: function(trendingTvShows) {

            console.log(trendingTvShows);
            console.log(Object.keys(trendingTvShows).length);

            trendingTvShows.results.forEach(function(tvShow) {
                $('#tv-shows-container').append('<div id="' + tvShow.id + '"><a href="#"></a><div class="img-containers"><img src="https://image.tmdb.org/t/p/w200' + tvShow.poster_path + '"/></div></div>');
            });

            // for (i = 0; i <= trendingTvShows.length; i++) {
            //     $('#tv-shows-container').append('<div id="' + trendingTvShows[i].id + '">' + trendingTvShows[i].poster_path + '</div>');
            // }


            // for (var key in trendingTvShows) {
            //     $('#tv-shows-container').append('<div id="' + trendingTvShows.id + '">' + trendingTvShows.poster_path + '</div>');
            // }
        }
    });
});