<?php $title = 'Administration du site'; ?>


<!-- HEADER -->
<?php 
    ob_start(); 
    $h2Header = 'Gestion du site';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <?php require_once('asideForAdministration_template.php'); ?>

    <div>
        <p>Votre site possède actuellement NOMBRE utilisateurs inscrits</p>
        <p>NOMBRE articles publiés</p>
        <p>NOMBRE commentaires signalés</p>
        <p>NOMBRE messages reçus</p>
    </div>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>
<?php $footer = ob_get_clean(); ?>

<?php require('template.php'); ?>