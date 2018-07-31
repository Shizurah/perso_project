<?php $title = 'Authentification'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = 'Vous pouvez ici vous connecter ou créer un compte';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

<p>Ici DEUX formulaires : connexion et création de compte</p>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>