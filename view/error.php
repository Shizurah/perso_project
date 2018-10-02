<?php
    $title = 'Erreur'; 
    $other = '<link href="assets/css/administration_style.css" rel="stylesheet"';
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    // echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h1Header = '';
    // <img id="banner-img" src="public/images/logo2.png" alt="logo"/>
    require('view/templates/header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>
    <div id="error-msg-container">
        <p>
            <?= $errorMsg; ?>
        </p>
        <a href="index.php">Retour page d'accueil</a>
    </div>
<?php
    
    $section = ob_get_clean(); 
?>


<!-- FOOTER -->
<?php 
    ob_start(); 
    // require_once('footer_template.php');
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    ob_start();
?>
        <script src="assets/js/file.js"></script>;
        <script>
            $('section').css('display', 'block')
                        .css('position', 'relative')
                        .css('top', '-14px');
        </script>
<?php
    $scripts = ob_get_clean();

    require_once('view/templates/template.php'); 
?>