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

<br/><br/>

<p>Ici DEUX formulaires : connexion et création de compte</p>

<p>Je me connecte :</p>
<form action="index.php?action=connexion" method="post">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" id="pseudo"> <br/><br/>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password"> <br/><br/>

    <input type="submit" value="Connexion">
</form>

<br/>

<p>Pas encore de compte ?</p>
<form action="index.php?action=registration" method="post">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" id="pseudo" required><br/><br/>

    <label for="email">E-mail :</label>
    <input type="email" name="email" id="email" required><br/><br/>

    <label for="password1">Mot de passe :</label>
    <input type="password" name="password1" id="password1" required><br/><br/>

    <label for="password2">Confirmation du mot de passe :</label>
    <input type="password" name="password2" id="password2" required><br/><br/>

    <input type="submit" value="Créer mon compte">
</form>

<br/><br/>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>