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
    <section>
        <aside>
            <a href="index.php?action=infosSite">Infos site</a> <!-- nb utilisateurs inscrits, commentaires signalés, msg envoyés etc -->
            <a href="index.php?action=postsList">Articles</a> <!-- liens de modification et de suppression pour chaque article -->
            <a href="index.php?action=postWriting">Rédiger un article</a>
            <a href="index.php?action=">Commentaires utilisateurs</a> <!-- liens ignorer et supprimer pour chaque commentaire -->
            <a href="index.php">Retour au site</a>
            <a href="index.php?action=deconnexion">Déconnexion</a>
        </aside>

        <div>
            <p>Votre site possède actuellement NOMBRE utilisateurs inscrits</p>
            <p>NOMBRE articles publiés</p>
            <p>NOMBRE commentaires signalés</p>
            <p>NOMBRE messages reçus</p>
        </div>
    </section>
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>
<?php $footer = ob_get_clean(); ?>

<?php require('template.php'); ?>