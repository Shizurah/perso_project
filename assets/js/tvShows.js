$('section').css('padding', '20px').css('margin-top', '-30px');

var key = '7d64a9ed6d8e781b0d44e1b214945855',
    pageId = 1, // page renvoyée par défaut par l'api
    url,
    totalOfPages;

// FAIRE UNE VERIF DES PARAMETRES (if 'trending')
$.ajax({
    url: 'https://api.themoviedb.org/3/trending/tv/week?api_key=' + key + '&language=fr',
    type: 'GET',
    dataType: 'json',

    success: function(trendingTvShows) {
        console.log(trendingTvShows);

        trendingTvShows.results.forEach(function(tvShow) {
            $('#tv-shows-container').append('<div><a class="tv-shows-links" id="' + tvShow.id 
                                            + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id 
                                            + '"></a><div id="' + tvShow.name + '" class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                            + tvShow.poster_path + '"/></div></div>');
        });
        
        url = 'https://api.themoviedb.org/3/trending/tv/week?api_key=' + key + '&language=fr';
        totalOfPages = trendingTvShows.total_pages;
    }
});

// récuperation des genres disponibles pour les séries
$.ajax({
    url: 'https://api.themoviedb.org/3/genre/tv/list?api_key=' + key + '&language=fr',
    type: 'GET',
    dataType: 'json',

    success: function(genresList) {
        console.log(genresList);
        
        genresList.genres.forEach(function(genre) {
            $('#genres-selection').append('<option value="' + genre.id + '">' + genre.name + '</option>');
        });

        $('#genres-selection').selectpicker('refresh');
    }
});


$(function() {
    $('#search-input').on('focus', function() {
        $('#search-input').css('border-radius', '4px');
    });

    // Recherche de séries par MOTS-CLE:
    $('#search-form').on('submit', function(event) {
        var keywords = $('#search-input').val(); // changement ici

        $.ajax({
            url: 'https://api.themoviedb.org/3/search/tv',
            type: 'GET',
            data: {
                query: keywords,
                api_key: key,
                language: 'fr'
            },
            dataType: 'json',
        
            success: function(tvShows) {
                $('#search-input').val('');
                $('#tv-shows-container div').remove();

                console.log(tvShows);

                tvShows.results.forEach(function(tvShow) {
                    if (tvShow.poster_path != null) {
                        $('#tv-shows-container').append('<div><a class="tv-shows-links" id="' + tvShow.id 
                                                            + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id 
                                                            + '"></a><div id="' + tvShow.name + '" class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                                            + tvShow.poster_path + '"/></div></div>');
                    }
                });

                pageId = 1;
                url = 'https://api.themoviedb.org/3/search/tv?query=' + keywords + '&api_key=' + key + '&language=fr';
                totalOfPages = tvShows.total_pages;
            }
        });

        return false;
    });

    // Recherche de séries par FILTRES :
    $('#discover-form').on('submit', function(event) {
        var that = $(this),
        

        $.ajax({
            url: 'https://api.themoviedb.org/3/discover/tv',
            type: 'GET',
            data: {
                api_key: key,
                language: 'fr',
                sort_by: sortBy,
                genres: genres
            },
            dataType: 'json',
        
            success: function(tvShows) {
                // $('#search-input').val('');
                $('#tv-shows-container div').remove();

                console.log(tvShows);

                tvShows.results.forEach(function(tvShow) {
                    if (tvShow.poster_path != null) {
                        $('#tv-shows-container').append('<div><a class="tv-shows-links" id="' + tvShow.id 
                                                            + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id 
                                                            + '"></a><div id="' + tvShow.name + '" class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                                            + tvShow.poster_path + '"/></div></div>');
                    }
                });

                pageId = 1;
                url = 'https://api.themoviedb.org/3/search/tv?&api_key=' + key + '&language=fr&genres=' + genres + '&sortBy=' + sortBy;
                totalOfPages = tvShows.total_pages;
            }
        });

        return false;
    });
});

// chargement d'autres séries :
$(window).scroll(function() {

    if (totalOfPages > 1 && pageId <= totalOfPages) {
        
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 30) {
            
            pageId += 1;
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    page: pageId
                },
                dataType: 'json',
    
                success: function(tvShows) {
                    
                    console.log(tvShows);
                    
                    tvShows.results.forEach(function(tvShow) {
                        var tvShowName;

                        if (tvShow.poster_path != null) {
                            $('#tv-shows-container').append('<div><a class="tv-shows-links" id="' + tvShow.id 
                                                            + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id + '"></a><div class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                                            + tvShow.poster_path + '"/></div></div>');
                        }
                    });
                }
            });
        }
    }  
});
