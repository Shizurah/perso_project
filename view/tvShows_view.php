<?php 
    $title = 'Séries TV'; 
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h1Header = '<img id="banner-img" src="public/images/logo2.png" alt="logo"/>';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <h3>SERIES DU MOMENT</h3>
    <div id="tv-shows-container"></div>

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
