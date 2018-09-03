<?php $title = 'Séries TV'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 
    $h2Header = 'Liste des séries auxquelles vous pouvez vous abonner !';
?>

    <!-- <img src="public/images/banniere.jpg" alt="bannière du site"> -->

<?php
    require('header_template.php'); 
    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

<p>Ici des séries</p>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>