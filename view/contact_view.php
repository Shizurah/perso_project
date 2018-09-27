<?php $title = 'Contact'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h2Header = 'Vous pouvez ici nous contacter via notre formulaire'; 
    require('view/templates/header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

<p>Ici notre formulaire de contact</p>
</div> <!-- FIN MAIN-WRAP -->
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
    require_once('view/templates/footer_template.php');
    $footer = ob_get_clean(); 

    require_once('view/templates/template.php'); 
?>


