<?php 
    $title = 'Création de compte'; 
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h1Header = NULL;
    require('view/templates/header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <div id="connexion-and-registration-forms-container">

        <h4 id="form-title">Création de compte</h4>

        <p id="errorMsg"></p> <!-- message si erreur rencontrée -->

        <form id="registration-form" action="index.php?action=registration" method="post">
            <p>
                <input type="text" name="pseudo" id="pseudo" required>
                <label for="pseudo">Pseudo</label>
            </p>

            <p>
                <input type="email" name="email" id="email" required>
                <label for="email">E-mail</label>
            </p>
            
            <p>
                <input type="password" name="password1" id="password1" required>
                <label for="password1">Mot de passe</label>
            </p>

            <p>
                <input type="password" name="password2" id="password2" required>
                <label for="password2">Confirmation du mot de passe</label>
            </p>

            
            <input type="submit" value="Créer son compte">
            
        </form>

        <a href="index.php?action=connexionPage">Déjà inscrit ?</a>

    </div>

</div> <!-- FIN MAIN-WRAP -->
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
        require_once('view/templates/footer_template.php');
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    ob_start();
        echo 
            '<script src="assets/js/forms.js"></script>';
    $scripts = ob_get_clean();

    require_once('view/templates/template.php'); 
?>
