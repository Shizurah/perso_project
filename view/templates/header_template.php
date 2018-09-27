<header>

    <!-- MENU  -->
    <nav id="nav">
        <?php 
            if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
                echo '<a href="index.php?action=administration">Administration</a>';
            }
        ?>

        <a href="index.php">Actus</a>
        <!-- <a href="index.php?action=weLove">On a aimé</a> -->
        <a href="index.php?action=tvShows">Séries TV</a>

        <?php
            if (isset($_SESSION['pseudo'])) {
        ?>
                <a href="index.php?action=mySpace">Mon espace</a>
                <a href="index.php?action=deconnexion">Déconnexion</a>
        <?php
            } else {
                echo '<a href="index.php?action=connexionPage">Connexion</a>';
            }
        ?>      
    </nav>

    <hr id="nav-line"/>
    
    <!-- BANNIERE : LOGO SITE ET BOUTONS RESEAUX SOCIAUX -->
    <div id="banner">
        
        <!-- LOGO SITE -->
        <div class="row">
            <h1 class="col-lg-12"><?= $h1Header ?></h1>
        </div>

        <!-- BOUTONS RESEAUX SOCIAUX -->
        <!-- <div id="actions-btns" class="row">

            <div class="network-logo col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <a href="#"><img src="public/images/logo_fb1.png" alt="logo Facebook"/></a>
            </div>

            <div class="network-logo col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <a href="#"><img src="public/images/logo_twitter1.png" alt="logo Twitter"/></a>
            </div>

            <div class="network-logo col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <a href="#"><img src="public/images/logo_instagram1.png" alt="logo Instagram"/></a>
            </div> 
        
            <div id="following-redirection-btn" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <a href="index.php?action=tvShows">Suivre les séries !</a> 
            </div>
              
        </div> -->
        
    </div>   
    
</header>

<br/>