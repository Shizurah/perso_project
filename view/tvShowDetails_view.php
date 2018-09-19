<?php 
    $title = 'Séries TV'; // METTRE NOM DE LA SERIE
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h1Header = '';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>
 
<!-- <a href="index.php?action=tvShows"><< Retour page d'accueil des séries</a> -->
<div id="tv-show-container">

    <div id="tv-show-intro">

        <div>
            <p id="following-tvshows-btn">
                <img src="public/images/following_tvshows_btn.png" alt="bouton de suivi"/>
            </p>

            <div>
                <!-- titre série : -->
                <h2><?= $phpResponse->{'name'}; ?></h2>

                <!-- genres série -->
                <?php
                    $genres = '';
                    for ($i = 0; $i < count($phpResponse->{'genres'}); $i++) {
                        $genres .= $phpResponse->{'genres'}[$i]->{'name'}. ', ';
                    }
                ?>
                <p id="tv-show-genres"><?= substr($genres, 0, -2) ?></p>
            </div>

            <!-- note série : -->
            <p id="tv-show-note">
                <span><img src="public/images/vote_star.png" alt="logo note"/></span>
                <span><?= $phpResponse->{'vote_average'}; ?></span> /10 (<?= $phpResponse->{'vote_count'}; ?>)
            </p>
        </div>

        <hr/>

        <p id="tv-show-nb-of-episodes-and-seasons">
            <?= $phpResponse->{'number_of_seasons'}; ?> saisons et <?= $phpResponse->{'number_of_episodes'}; ?> épisodes
        </p>
    </div>

    <div id="tv-show-details">

        <!-- // poster série : -->
        <div id="tv-show-poster">
            <img src="https://image.tmdb.org/t/p/w300<?= $phpResponse->{'poster_path'}; ?>" alt="affiche série"/>
        </div>

        <!-- infos séries : -->
        <?php
        $creators = '<span>Réalisateurs</span>: ';
        $genres = '<span>Genre</span>: ';
        $productionCompanies = '<span>Compagnies de production</span>: ';
        
        for ($i = 0; $i < count($phpResponse->{'created_by'}); $i++) {
            $creators .= $phpResponse->{'created_by'}[$i]->{'name'}. ', ';
        }

        for ($i = 0; $i < count($phpResponse->{'genres'}); $i++) {
            $genres .= $phpResponse->{'genres'}[$i]->{'name'}. ', ';
        }

        for ($i = 0; $i < count($phpResponse->{'production_companies'}); $i++) {
            $productionCompanies .= $phpResponse->{'production_companies'}[$i]->{'name'}. ', ';
        }
        ?>

        <!-- Infos série -->
        <div id="tv-show-infos">
            <p id="tv-show-creators"><?= substr($creators, 0, -2) ?></p>
            <!-- <p id="tv-show-genres"><?= substr($genres, 0, -2) ?></p> -->
            <p id="tv-show-production-companies"><?= substr($productionCompanies, 0, -2) ?></p>
            
            <p id="tv-show-first-release">Première diffusion: <?= $phpResponse->{'first_air_date'}; ?></p>

            <!-- <p id="tv-show-nb-of-episodes-and-seasons">
                <?= $phpResponse->{'number_of_seasons'}; ?> saisons et <?= $phpResponse->{'number_of_episodes'}; ?> épisodes
            </p> -->

            <?php
            if ($phpResponse->{'in_production'}) {
                echo '<p id="tv-show-in-production"><i>En production</i></p>';
            }
            ?>

            <div id="tv-show-overview">
                <h3>SYNOPSIS</h3>
                <p><?= $phpResponse->{'overview'}; ?></p>
            </div>
        </div>

    </div>

    <!-- prochain et dernier épisode : -->
    <div id="tv-show-episodes">

        <!-- Prochain épisode -->
        <?php
        if ($phpResponse->{'next_episode_to_air'} != null) {
            $nextEpisodeId = $phpResponse->{'next_episode_to_air'}->{'episode_number'};
            $nextEpisodeSeasonId = $phpResponse->{'next_episode_to_air'}->{'season_number'};

            if ($nextEpisodeId < 10) {
                $nextEpisodeId = '0' .$nextEpisodeId;
            }

            if ($nextEpisodeSeasonId < 10) {
                $nextEpisodeSeasonId = '0' .$nextEpisodeSeasonId;
            }
        ?>
            <div id="tv-show-next-episode">
                <h3>Prochain épisode</h3>
                <p>
                    E<?= $nextEpisodeId; ?>S<?= $nextEpisodeSeasonId; ?>: "<?= $phpResponse->{'next_episode_to_air'}->{'name'}; ?>" - 
                    diffusion le <?= $phpResponse->{'next_episode_to_air'}->{'air_date'}; ?>
                </p>
            </div>
        <?php
        }
        ?>

        <!-- Dernier épisode : -->
        <?php
        $lastEpisodeId = $phpResponse->{'last_episode_to_air'}->{'episode_number'};
        $lastEpisodeSeasonId = $phpResponse->{'last_episode_to_air'}->{'season_number'};

        if ($lastEpisodeId < 10) {
            $lastEpisodeId = '0' .$lastEpisodeId;
        }
        if ($lastEpisodeSeasonId < 10) {
            $lastEpisodeSeasonId = '0' .$lastEpisodeSeasonId;
        }
        ?>

        <div id="tv-show-last-episode">
            <h3>Dernier épisode</h3>
            <p>
                E<?= $lastEpisodeId; ?>S<?= $lastEpisodeSeasonId; ?>: "<?= $phpResponse->{'last_episode_to_air'}->{'name'}; ?>", 
                diffusé le <?= $phpResponse->{'last_episode_to_air'}->{'air_date'}; ?>
            </p>
        </div>

    </div>     

    <!-- <?php var_dump($phpResponse); ?> -->

</div>
    
</div> <!-- FIN MAIN-WRAP -->
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
    require_once('footer_template.php');
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    $scripts = '<script src="assets/js/tvShows.js"></script>';

    require('template.php'); 
?>
