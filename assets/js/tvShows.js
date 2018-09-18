document.getElementById('actions-btns').style.display = "none";
document.getElementById('nav-line').style.display = 'none';

var key = '7d64a9ed6d8e781b0d44e1b214945855';

$(function() {

    $.ajax({
        url: 'https://api.themoviedb.org/3/trending/tv/week?api_key=' + key + '&language=fr',
        type: 'GET',
        dataType: 'json',

        success: function(trendingTvShows) {

            // console.log(trendingTvShows);
            // console.log(Object.keys(trendingTvShows).length);

            trendingTvShows.results.forEach(function(tvShow) {
                $('#tv-shows-container').append('<div><a id="' + tvShow.id + '" href="#"></a><div class="img-containers"><img src="https://image.tmdb.org/t/p/w200' + tvShow.poster_path + '"/></div></div>');
            });
        }
    });

    $('#tv-shows-container').on('click', 'a', function(event) {
        event.preventDefault();

        var that = $(this),
            id = that.attr('id'),
            url = 'https://api.themoviedb.org/3/tv/' + id + '?api_key=' + key + '&language=fr';

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',

            success: function(tvShow) {
                $('#banner').html('');
                // $('nav').after('<a href="index.php?action=tvShows"><< Retour page d\'accueil des séries</a>');
                
                
                $('section').html('<div id="tv-show-container"><div id="tv-show-intro"></div><div id="tv-show-details"></div></div>');

                // titre série :
                $('#tv-show-intro').append('<h2>' + tvShow.name + '</h2>');
                // note série :
                $('#tv-show-intro').append('<p id="tv-show-note"><span><img src="public/images/vote_star.png" alt="logo note"/></span><span>' + tvShow.vote_average 
                                            + '</span>/10 (' + tvShow.vote_count + ' votes)</p>');

                // poster série :
                $('#tv-show-details').append('<div id="tv-show-poster"><img src="https://image.tmdb.org/t/p/w300' + tvShow.poster_path + '"/></div>');

                // infos séries :
                var creators = '<span>Réalisateurs</span>: ',
                    genres = '<span>Genre</span>: ',
                    productionCompanies = '<span>Compagnies de production</span>: ';

                tvShow.created_by.forEach(function(creator) {
                    creators += creator.name + ', ';
                });

                tvShow.genres.forEach(function(genre) {
                    genres += genre.name + ', ';
                });

                tvShow.production_companies.forEach(function(company) {
                    productionCompanies += company.name + ', ';
                });

                $('#tv-show-details').append('<div id="tv-show-infos"><p id="tv-show-creators">' + creators.substr(0, creators.length - 2) + '</p></div>');
                $('#tv-show-infos').append('<p id="tv-show-genres">' + genres.substr(0, genres.length - 2) + '</p>');
                $('#tv-show-infos').append('<p id="tv-show-production-companies">' + productionCompanies.substr(0, productionCompanies.length - 2) + '</p>');
                $('#tv-show-infos').append('<p id="tv-show-first-release">Première diffusion: ' + tvShow.first_air_date + '</p>');
                $('#tv-show-infos').append('<p id="tv-show-nb-of-episodes-and-seasons"><p>' 
                                                            + tvShow.number_of_seasons + ' saisons et ' 
                                                            + tvShow.number_of_episodes + ' épisodes</p></div>');
                if (tvShow.in_production) {
                    $('#tv-show-infos').append('<p id="tv-show-in-production"><i>En production</i></p>');
                }

                $('#tv-show-infos').append('<div id="tv-show-overview"><h3>SYNOPSIS :</h3><p>' + tvShow.overview + '</p></div>');

                // prochain et dernier épisode :
                $('#tv-show-container').after('<div id="tv-show-episodes"></div>');

                if (tvShow.next_episode_to_air != null) {

                    var nextEpisodeId = tvShow.next_episode_to_air.episode_number,
                        nextEpisodeSeasonId = tvShow.next_episode_to_air.season_number;

                    if (nextEpisodeId < 10) {
                        nextEpisodeId = '0' + nextEpisodeId;
                    }

                    if (nextEpisodeSeasonId < 10) {
                        nextEpisodeSeasonId = '0' + nextEpisodeSeasonId;
                    }

                    $('#tv-show-episodes').append('<div id="tv-show-next-episode"><h3>Prochaine diffusion: </h3><p>E' + nextEpisodeId + 'S' + nextEpisodeSeasonId + ': "' 
                                                                + tvShow.next_episode_to_air.name + '", le ' + tvShow.next_episode_to_air.air_date + '</p></div>');

                    if (tvShow.next_episode_to_air.overview != '') {
                        $('#tv-show-next-episode').append('<p id="next-episode-overview">Synopsis épisode : <br/>' + tvShow.next_episode_to_air.overview + '</p>');
                    }
                }

                var lastEpisodeId = tvShow.last_episode_to_air.episode_number,
                    lastEpisodeSeasonId = tvShow.last_episode_to_air.season_number;

                if (lastEpisodeId < 10) {
                    lastEpisodeId = '0' + lastEpisodeId;
                }

                if (lastEpisodeSeasonId < 10) {
                    lastEpisodeSeasonId = '0' + lastEpisodeSeasonId;
                }

                $('#tv-show-episodes').append('<div id="tv-show-last-episode"><h3>Dernière diffusion: </h3><p>E' + lastEpisodeId + 'S' + lastEpisodeSeasonId + ': "' 
                                                + tvShow.last_episode_to_air.name + '", le ' + tvShow.last_episode_to_air.air_date + '</p></div>');

                if (tvShow.last_episode_to_air.overview != '') {
                    $('#tv-show-last-episode').append('<p id="last-episode-overview">Synopsis épisode : <br/>' + tvShow.last_episode_to_air.overview + '</p>');
                }
                
                
                


                console.log(tvShow);
            }
        });
    });
});
