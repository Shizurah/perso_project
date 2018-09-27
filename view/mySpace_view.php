<?php 
    $title = 'Mon espace'; 
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

    <div id="tv-shows-page-info-container">
        <div id="tv-shows-page-info">
            <!-- <img src="public/images/info_tv_shows.png" alt="info bulle"> -->
            <p>
                <span>Bonjour <?= htmlspecialchars($_SESSION['pseudo']) ?> !</span><br/>
                Nous vous informons que vous pourrez bientôt recevoir toutes les notifications de vos séries préférées dans votre espace !<br/>
            </p>
        </div>
    </div>
    

    <div id="avatar-form-container">
        <h3 id="change-avatar-title">MODIFIER VOTRE AVATAR</h3>

        <div id="avatar-form">
            <p id="personal-space-avatar"><img  src="public/members/avatars/<?= $_SESSION['avatar'] ?>" alt="avatar"></p>

            <div>

                <p id="error-msg"></p>
                
                <form id="avatar-form" action="index.php?action=avatar" method="post" enctype="multipart/form-data">
                    <p>
                        <input type="hidden" name="max-file-size" value="204800"> <!-- valeur en octets -->
                        <input type="file" name="avatar">
                    </p>
                    
                    <input type="submit" name="submit-avatar" value="Valider">
                </form>
            </div>
        </div>
    </div>

    <div id="personal-space-tv-shows-container">
        <h3 id="personal-space-tv-shows-title">VOS SERIES<br/> (bientôt disponible)</h3>
        <p>
            <img src="public/images/banniere/popcorn1.png" alt="popcorn">
        </p>
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
?>
       
    <script>$("section").css("margin-top", "-11px");</script>;
    <script src="assets/js/forms.js"></script>

<?php
    $scripts = ob_get_clean();

    require_once('view/templates/template.php'); 
?>

