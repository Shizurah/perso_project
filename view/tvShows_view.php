<?php 
    $title = 'Séries TV'; 
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 
    echo '<div id="main-wrap" class="container">';
    $h1Header = '<img id="banner-img" src="public/images/logo2.png" alt="logo"/>';
?>

    <!-- <img src="public/images/banniere.jpg" alt="bannière du site"> -->

<?php
    require('header_template.php'); 
    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <p>Ici des séries</p>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

    <p>Ici des infos en bas de page</p>
    <a href="index.php?action=contact">Contact</a>
    </div>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>

<script>
    document.getElementById('actions-btns').style.display = "none";
    document.getElementById('nav-line').style.display = 'none';
</script>