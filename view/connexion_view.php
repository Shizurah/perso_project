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
    
    <div class="row">

        <div class="col-lg-6">
            <p>Je me connecte :</p>

            <p id="errorMsg"></p> <!-- message si erreur rencontrée -->

            <form id="connexion-form" action="index.php?action=connexion" method="post">
                <p>
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" required>
                </p>
                    
                <p>
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>
                </p>

                <p>
                    <input type="submit" value="Connexion">
                </p>
            </form>
        </div>

        <div class="col-lg-6">
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
        </div>
        
    </div>

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
