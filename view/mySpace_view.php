<?php 
    $title = 'Mon espace'; 
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
                <form action="index.php?action=avatar" method="post" enctype="multipart/form-data">
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
    
    
    <!-- <div>
        <h3>Vos séries (bientôt disponbile)</h3>
        <hr class="title-separation"/>
    </div> -->


    <!-- <h3>Modifier vos informations</h3>

    <form action="">
        <p>
            <label for="pseudo">Modifier votre pseudo :</label><br/>
            <input type="text" name="pseudo" id="pseudo">
        </p>
        
        <input type="submit" value="Modifier pseudo">
    </form>

    <form action="">
        <p>
            <label for="pass1">Modifier votre mot de passe :</label><br/>
            <input type="password" name="pass1" id="pass1">
        </p>

        <p>
            <label for="pass2">Confirmer mot de passe :</label><br/>
            <input type="password" name="pass2" id="pass2">
        </p>
        
        <input type="submit" value="Modifier mot de passe">
    </form>

    <form action="">
        <p>
            <label for="email">Modifier votre e-mail :</label><br/>
            <input type="email" name="email" id="email">
        </p>

        <input type="submit" value="Modifier e-mail">
    </form> -->

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
            '<script>
                $("section").css("margin-top", "-11px");
            </script>';
    $scripts = ob_get_clean();

    require_once('template.php'); 
?>

