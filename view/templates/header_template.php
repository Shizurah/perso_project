<header>
    
    <!-- MENU  -->
    <nav id="nav">
        <?php 
            if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
                echo '<a href="index.php?action=administration">Administration</a>';
            }
        ?>

        <a href="index.php">Actus</a>
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
        
    </div>   
    
</header>

<br/>