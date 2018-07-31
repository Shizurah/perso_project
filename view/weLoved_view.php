<?php $title = 'Actus'; ?>

<!-- HEADER -->
<?php ob_start(); ?>

<header>
    <h2>On vous présente ici les films et séries qu'on a adorés !</h2>

    <nav>
        <a href="index.php">Actus</a>
        <a href="index.php?action=weLoved">On a aimé</a>
        <a href="index.php?action=tvShows">Séries TV</a>
        <a href="index.php?action=mySpace">Mon espace</a>

        <a href="index.php?action=connexion">Connexion</a>
        <a href="index.php?action=deconnexion">Déconnexion</a>
    </nav>
</header>

<?php $header = ob_get_clean(); ?>


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