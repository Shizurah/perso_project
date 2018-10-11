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
    require('view/templates/header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <div id="tv-shows-page-info-container">
        <div id="tv-shows-page-info">
            <img src="public/images/info_tv_shows.png" alt="info bulle">
            Vous pourrez bientôt suivre vos séries préférées sur cette page, et retrouver chaque semaine leurs notifications dans votre espace !<br/>
        </div>

        <?php
            if (!isset($_SESSION['id']) && !isset($_SESSION['userStatus'])) {
                echo '<a href="index.php?action=registrationPage">Créer un compte</a>';
            }
        ?>
    </div>

    <div id="forms-container">
        <h3 id="tv-shows-research-show">
            RECHERCHER DES SERIES 
        </h3>

        <!-- recherche par mots-clé -->
        <div id="key-words-search-show">
            <h5>
                Par <span>mots-clé</span>
            </h5>

            <form id="search-form">
                <p id="search-container">
                    <input class="form-control" id="search-input" type="text" placeholder="Recherche...">
                    <button type="submit"><img src="public/images/search_icon.png" alt="icône de recherche"></button> 
                </p>
            </form>
        </div>
        

        <!-- recherche par filtres -->
        <div id="filters-search-show">
            <h5>
                Par <span>filtres</span> 
            </h5>

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
        </div>
    </div>

    <br/>

    <div id="tv-shows-category-title">
        <h3>Séries populaires cette semaine</h3>
    </div>

    <hr class="title-separations"/>

    <p id="loading"><img  src="public/images/load2.gif" alt="Chargement..."/></p>

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

    require('view/templates/template.php'); 
?>
