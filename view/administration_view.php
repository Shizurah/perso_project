<?php 
    $title = 'Administration du site'; 
    $other = '<link href="assets/css/administration_style.css" rel="stylesheet"';
?>


<!-- HEADER -->
<?php 
    ob_start(); 
    $h1Header = '';
    require('templates/header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <!-- <h2>Gestion du site</h2> -->
    <?php require_once('templates/asideForAdministration_template.php'); ?>

    <br/>
    
    <h3>Informations de votre site</h3>

    <div>
        <p>Votre site compte actuellement <?= $nbOfUsers ?> utilisateurs inscrits</p>
        <p> <?= $nbOfPosts ?> articles publiés</p>
        <p> <?= $nbOfReportedComments ?> commentaires signalés</p>
    </div>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    ob_start();
        echo 
            '<script src="assets/js/file.js"></script>';
    $scripts = ob_get_clean();

    require_once('templates/template.php'); 
?>




