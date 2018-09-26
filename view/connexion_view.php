<?php 
    $title = 'Authentification'; 
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h1Header = NULL;
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

<!-- <div id="connexion-and-registration-forms-container" class="row"> -->
    <div id="connexion-and-registration-forms-container">

        <h4 id="form-title">Connexion</h4>

        <p id="errorMsg"></p> <!-- message si erreur rencontrée -->

        <form id="connexion-form" action="index.php?action=connexion" method="post">
            <p>
                
                <input type="text" name="pseudo" id="pseudo" required><br/>
                <label for="pseudo">Pseudo</label>
            </p>
                
            <p>
                
                <input type="password" name="password" id="password" required><br/>
                <label for="password">Mot de passe</label>
            </p>

            
            <input type="submit" value="Se connecter">
            
        </form>

        <a href="index.php?action=registrationPage">Pas encore de compte ?</a> 
    </div>
<!-- </div> -->
      

</div> <!-- FIN MAIN-WRAP -->
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
        require_once('footer_template.php');
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    ob_start();
        echo 
            '<script src="assets/js/connexion.js"></script>';
    $scripts = ob_get_clean();

    require_once('template.php'); 
?>
