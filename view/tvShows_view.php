<?php 
    $title = 'Séries TV'; 
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h1Header = '';
    // <img id="banner-img" src="public/images/logo2.png" alt="logo"/>
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <h3>RECHERCHER DES SERIES</h3>

    <hr class="title-separations"/>

    <h5>Par mots-clé</h4>

    <hr/>

    <form id="search-form">
        <p id="search-container">
            <input class="form-control" id="search-input" type="text" placeholder="Recherche...">
            <button type="submit"><img src="public/images/search_icon.png" alt="icône de recherche"></button> 
        </p>
    </form>

    <h5>Par filtres</h4>

    <hr/>

    <form id="discover-form">
        <p>
            Genres :
            <select name="with_genres" id="genres-selection" class="selectpicker" data-live-search="true" multiple>
            </select>
        </p>

        <p>
            Trier par :
            <select name="sort_by" id="sort-by-selection" class="selectpicker">
                <option value="popularity.desc">Popularité</option>
                <option value="vote_average.desc">Note</option>
                <option value="first_air_date.desc">1ere date de diffusion</option>
            </select>
        </p>

        <p><input type="submit" value="FILTRER"></p>
    </form>

    <br/>
    
    <h3 id="tv-shows-category-title">Séries populaires cette semaine</h3>
    <hr class="title-separations"/>

    <div id="tv-shows-container">
        <a id="scroll-up-arrow" href="#nav"><img src="public/images/scroll_up_arrow.png" alt="flèche retour haut de page"></a>
    </div>

    
    </div> <!-- FIN MAIN-WRAP -->
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    $footer = '';

    // SCRIPTS JS :
    $scripts = '<script src="assets/js/tvShows.js"></script>';

    require('template.php'); 
?>
