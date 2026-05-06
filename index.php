<?php
require "config.php";
$recettes = $pdo->query("SELECT r.titre,r.chapo,r.img,m.prenom,m.gravatar
FROM recettes r JOIN membres m ON m.idMembre=r.membre
ORDER BY r.dateCrea DESC LIMIT 3")->fetchAll();
$classes = ["marmelade","pommes","girolles"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>koo2fourchette</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

    <header class ="header">

        <div class="Application">
            <img src="images/facebook.png">
            <img src="images/twitter.png">
            <img src="images/google.png">
            <img src="images/youtube.png">
        </div>

        <div class ="l1">
            <img src= "images/koo_2_fourchette.png">
            <div class="search-bar">
                <input type="search" placeholder="Rechercher une recette">
                <button type="submit">OK</button>
            </div>
            <div class="action">
                <?php if(!isset($_SESSION["user"])) { ?>
                    <a href="connecter.php" class="connection">Se connecter</a>
                    <a href="compte.php" class="compte">Créer un compte</a>
                <?php } else { ?>
                    <a href="#" class="connection"><?= $_SESSION["user"]["login"] ?></a>
                    <a href="logout.php" class="compte">Déconnexion</a>
                <?php } ?>
            </div>
        </div>

        <div class="l2">
            <div class="slogan"><h1>miam miam, gloup gloup, laps laps</h1></div>
            <a href="deposer.php" id="deposer">Déposer une recette</a>
        </div>

        <nav class="navigateur">
            <ul>
                <li class="recettes"><a href="#">RECETTES</a></li>
                <li class="menus"><a href="#">MENUS</a></li>
                <li class="desserts"><a href="#">DESSERTS</a></li>
                <li class="minceur"><a href="#">MINCEUR</a></li>
                <li class="atelier"><a href="#">ATELIER</a></li>
                <li class="contact"><a href="#">CONTACT</a></li>
            </ul>
        </nav>

    </header>

    <main>

        <section class="block">
             <img src="photos/vig/creme-petits-poids.jpg" alt="Crème de petits pois">
             <div class="block-rose">block1<br>140×300</div>
             <div class="block-bleu">block1<br>140×300</div>
        </section>

        <section class="titre-jour">
            <h2>RECETTES DU JOUR</h2>
        </section>

        <section class="recettes-jour">
            <?php foreach($recettes as $i=>$r){ ?>
            <div class="<?php echo $classes[$i]; ?>">
                <img src="photos/recettes/<?php echo $r["img"]; ?>">
                <h3><?php echo $r["titre"]; ?></h3>
                <p><?php echo $r["chapo"]; ?></p>
                <div class="auteur">
                    <img src ="photos/gravatars/<?php echo $r["gravatar"]; ?>">
                    <p>proposé par <?php echo $r["prenom"]; ?></p>
                </div>
            </div>
            <?php } ?>
        </section>

    </main>
    <footer class="footer"></footer>
</body>
</html>