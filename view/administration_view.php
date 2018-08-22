<?php $title = 'Administration du site'; ?>


<!-- HEADER -->
<?php 
    ob_start(); 
    $h2Header = '';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <!-- <h2>Gestion du site</h2> -->
    <?php require_once('asideForAdministration_template.php'); ?>

    <br/>
    
    <h3>Informations de votre site</h3>

    <div>
        <p>Votre site possède actuellement NOMBRE utilisateurs inscrits</p>
        <p>NOMBRE articles publiés</p>
        <p><?= $nbOfReportedComments ?> commentaires signalés</p>
        <p>NOMBRE messages reçus</p>
    </div>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>
<?php $footer = ob_get_clean(); ?>

<?php require('template.php'); ?>