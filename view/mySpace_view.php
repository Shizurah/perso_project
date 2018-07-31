<?php $title = 'Mon espace'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = 'Vous pouvez ici gérer votre compte : avatar, infos persos, séries suivies ...';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

<p>Ici votre espace</p>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>