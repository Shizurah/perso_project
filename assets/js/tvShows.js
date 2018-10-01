$('section').css('margin-top', '-20px');

var key = '7d64a9ed6d8e781b0d44e1b214945855',
    url, // requête api
    pageId = 1, // page renvoyée par défaut par l'api
    totalOfPages; // total des pages renvoyé par l'api


$(function() {

    // Au chargement de la page :
    // 1. Récuperation GENRES des SERIES 
    $.ajax({
        url: 'https://api.themoviedb.org/3/genre/tv/list?api_key=' + key + '&language=fr',
        type: 'GET',
        dataType: 'json',
        timeout: 3000,

        success: function(genresList) {

            genresList.genres.forEach(function(genre) {
                $('#genres-selection').append('<option value="' + genre.id + '">' + genre.name + '</option>');
            });

            $('#genres-selection').selectpicker('refresh');
        },

        error: function() {
            alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
            // $('#filters-search-show').html('');
            // $('#filters-search-show').html('<p class="error-msg">La recherche de séries par filtre n\'est actuellement pas disponible.<br/>Nous vous prions de bien vouloir nous excuser</p>');
        }
    });

    // animation 
    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").remove();
    });

    // 2. Récuperation SERIES TRENDING
    $.ajax({
        url: 'https://api.themoviedb.org/3/trending/tv/week?api_key=' + key + '&language=fr',
        type: 'GET',
        dataType: 'json',
        timeout: 3000,

        success: function(trendingTvShows) {

            trendingTvShows.results.forEach(function(tvShow) {
                $('#tv-shows-container').append('<div><a class="tv-shows-links" id="' + tvShow.id 
                                                + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id 
                                                + '"></a><div id="' + tvShow.name + '" class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                                + tvShow.poster_path + '"/></div></div>');
            });
            
            url = 'https://api.themoviedb.org/3/trending/tv/week?api_key=' + key + '&language=fr';
            totalOfPages = trendingTvShows.total_pages;
        }, 

        error: function() {
            alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
            // $('#tv-shows-container').append('<p></p>')
            //     .attr('class', 'error-msg')
            //     .text('Oups, l\'affichage des séries populaires n\'est actuellement pas disponible');
        }
    });


    // RECHERCHE DE SERIES :
    // 1. Par MOTS-CLE:
    $('#search-form').on('submit', function(event) {
        var keywords = $('#search-input').val();

        $.ajax({
            url: 'https://api.themoviedb.org/3/search/tv',
            type: 'GET',
            data: {
                query: keywords,
                api_key: key,
                language: 'fr'
            },
            dataType: 'json',
            timeout: 3000,
        
            success: function(tvShows) {
                $('#search-input').val('');
                $('#tv-shows-category-title').text('Résultat de votre recherche');
                $('#back-to-trending-tv-shows').remove();
                $('#tv-shows-category-title').after('<i><a id="back-to-trending-tv-shows" href="index.php?action=tvShows">Retour aux séries de la semaine</a></i>');
                $('#tv-shows-container div').remove();

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
            },

            error: function() {
                alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
                // $('#search-form').html('');
                // $('#search-form').html('<p class="errorMsg">Un problème est survenu lors de votre recherche, veuillez ré-essayer ultérieurement.</p>');
            }
        });

        return false;
    });

    // 2. Par FILTRES :
    $('#discover-form').on('submit', function(event) {

        var arrayOfSelectedGenres = $('#genres-selection').val(),
            sortBy = $('#sort-by-selection').val();
            selectedGenres = '';

        arrayOfSelectedGenres.forEach(function (genre) {
            selectedGenres += genre + ',';
        });

        selectedGenres = selectedGenres.substring(0, selectedGenres.length - 1);

        $.ajax({
            url: 'https://api.themoviedb.org/3/discover/tv?api_key=' + key + '&language=fr',
            type: 'GET',
            data: {
                with_genres: selectedGenres,
                sort_by: sortBy
            },
            dataType: 'json',
            timeout: 3000,
        
            success: function(tvShows) {
                $('#tv-shows-category-title').text('Résultat de votre recherche');
                $('#back-to-trending-tv-shows').remove();
                $('#tv-shows-category-title').after('<i><a id="back-to-trending-tv-shows" href="index.php?action=tvShows">Retour aux séries de la semaine</a></i>');
                $('#tv-shows-container div').remove();

                tvShows.results.forEach(function(tvShow) {
                    if (tvShow.poster_path != null) {
                        $('#tv-shows-container').append('<div><a class="tv-shows-links" id="' + tvShow.id 
                                                            + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id 
                                                            + '"></a><div id="' + tvShow.name + '" class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                                            + tvShow.poster_path + '"/></div></div>');
                    }
                });

                pageId = 1;
                url = 'https://api.themoviedb.org/3/discover/tv?api_key=' + key + '&language=fr' + '&with_genres=' + selectedGenres + '&sort_by=' + sortBy;
                totalOfPages = tvShows.total_pages;
            }, 

            error: function() {
                alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
                // $('#filters-search-show').html('');
                // $('#filters-search-show').html('<p class="error-msg">Un problème est survenu lors de votre recherche, veuillez ré-essayer ultérieurement.</p>');
            }
        });

        return false;
    });
});

// Paramètre 'page' ajouté pour affichage des séries suivantes
$(window).scroll(function() {

    if (totalOfPages > 1 && pageId <= totalOfPages) {

        if ($(window).scrollTop() + $(window).height() > $(document).height() - 30) {
            $('#tv-shows-container').append('<p id="loading"><img  src="public/images/load2.gif" alt="Chargement..."/></p>');
            pageId += 1;

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    page: pageId
                },
                dataType: 'json',
                timeout: 3000,
    
                success: function(tvShows) {
                    console.log(tvShows);
                    
                    tvShows.results.forEach(function(tvShow) {
                        if (tvShow.poster_path != null) {
                            $('#tv-shows-container').append('<div><a class="tv-shows-links" id="' + tvShow.id 
                                                            + '" href="index.php?action=tvShow&amp;tvShowId=' + tvShow.id + '"></a><div class="img-containers"><img src="https://image.tmdb.org/t/p/w200' 
                                                            + tvShow.poster_path + '"/></div></div>');
                        }
                    });
                },

                error: function() {
                    alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
                    // $('#tv-shows-container').append('<p></p>')
                    //     .attr('class', 'error-msg')
                    //     .text('Un problème est survenu : l\'affichage des séries suivantes n\'est actuellement pas disponible');
                }
            });
        }
    }  
});
