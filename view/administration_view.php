<?php 
    $title = 'Administration du site'; 
    $other = '<link href="assets/css/administration_style.css" rel="stylesheet">';
?>


<!-- HEADER -->
<?php 
    ob_start(); 
    $h1Header = '';

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <?php require_once('templates/asideForAdministration_template.php'); ?>

    <div id="administration-main-content">
        <h3>Informations de votre site</h3>

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
?>
   
    <script src="assets/js/file.js"></script>

<?php
    $scripts = ob_get_clean();
    require_once('templates/template.php'); 
?>




