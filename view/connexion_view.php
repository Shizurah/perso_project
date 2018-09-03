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

    <?php
        if (isset($_SESSION['confirmationMsg'])) {
            echo $_SESSION['confirmationMsg'];
        }
    ?>

    <br/><br/>

    <?php
        if (isset($errorFields)) {
            echo $errorFields;
        }
    ?>
    
    <p>Je me connecte :</p>

    <form action="index.php?action=connexion" method="post">
        <p>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" required>

            <?php
                if (isset($errorConnexion)) {
                    echo $errorConnexion;
                }
            ?>
        </p>
            
        <p>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
        </p>

        <p>
            <input type="submit" value="Connexion">
        </p>
    </form>

    <br/>

    <p>Pas encore de compte ?</p>

    <form action="index.php?action=registration" method="post">
        <p>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" required>

            <?php 
                if (isset($errorPseudo)) {
                    echo $errorPseudo;
                }
            ?>
        </p>

        <p>
            <label for="email">E-mail :</label>
            <input type="email" name="email" id="email" required>
        </p>
        
        <p>
            <label for="password1">Mot de passe :</label>
            <input type="password" name="password1" id="password1" required>
            
            <?php 
                if (isset($errorPass)) {
                    echo $errorPass;
                }
            ?>
        </p>

        <p>
            <label for="password2">Confirmation du mot de passe :</label>
            <input type="password" name="password2" id="password2" required>
        </p>

        <p>
            <input type="submit" value="Créer mon compte">
        </p>
    </form>

    <br/><br/>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>