<?php $title = 'On a aimé'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = 'On vous présente ici les films et séries qu\'on a adorés !';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

<p>Ici des articles</p>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>