<header>

    <h2><?= $h2Header ?></h2>

    <nav>
        <?php 
            if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
                echo '<a href="index.php?action=administration">Administration</a>';
            }
        ?>

        <a href="index.php">Actus</a>
        <a href="index.php?action=weLove">On a aimé</a>
        <a href="index.php?action=tvShows">Séries TV</a>

        <?php
            if (isset($_SESSION['pseudo'])) {
        ?>
                <img src="public/members/avatars/<?= $_SESSION['avatar'] ?>" width="25" height="25" alt="avatar"/> <a href="index.php?action=mySpace">Mon espace</a>
                <a href="index.php?action=deconnexion">Déconnexion</a>
        <?php
            } else {
                echo '<a href="index.php?action=connexionPage">Connexion</a>';
            }
        ?>      
    </nav>

</header>

<br/>