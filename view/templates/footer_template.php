
<footer class="container">
    <div>
        <p>Developped with <img id="api-logo" src="public/images/api.png" alt=""> API</p>
    </div>
   
    <div>
        <h5>
            INFOS
            <img src="public/images/arrow_down.png" alt="flèche_bas" width="10px">
        </h5>
        <a href="index.php?action=contact">A propos</a>
        <a href="index.php?action=contact">Contact</a>
        <a href="index.php?action=contact">Forum</a>
        <a href="index.php?action=contact"> API</a>
    </div>

    <div>
        <h5>
            COMMUNAUTE
            <img src="public/images/arrow_down.png" alt="flèche_bas" width="10px">
        </h5>
        <a href="index.php?action=contact">Facebook</a>
        <a href="index.php?action=contact">Twitter</a>
        <a href="index.php?action=contact">Instagram</a>
    </div>

     <div>
        <h5>
            NAVIGATION
            <img src="public/images/arrow_down.png" alt="flèche_bas" width="10px">
        </h5>
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
    </div>

</footer>

        