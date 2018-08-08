<header>

    <h2><?= $h2Header ?></h2>

    <nav>
        <?php 
            if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
                echo '<a href="index.php?action=administration">Administration</a>';
            }
        ?>

        <a href="index.php">Actus</a>
        <a href="index.php?action=weLoved">On a aimé</a>
        <a href="index.php?action=tvShows">Séries TV</a>

        <?php
            if (isset($_SESSION['pseudo'])) {
                echo '<a href="index.php?action=mySpace">Mon espace</a> 
                      <a href="index.php?action=deconnexion">Déconnexion</a>';
            } else {
                echo '<a href="index.php?action=connexionPage">Connexion</a>';
            }
        ?>      
    </nav>

</header>

<br/>