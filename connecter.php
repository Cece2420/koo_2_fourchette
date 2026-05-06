<?php
require "config.php";

if(isset($_POST["pseudo"]) && isset($_POST["mdp"])){
    $stmt=$pdo->prepare("SELECT * FROM membres WHERE login=?");
    $stmt->execute([$_POST["pseudo"]]);
    $u=$stmt->fetch();
    if($u && $u["password"]==sha1($_POST["mdp"])){
        $_SESSION["user"]=$u;
        header("Location: index.php");
        exit;
    } else {
        $err=1;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="connecter.css">
</head>

<body>

<div class="tout">

    <h1 class="connecter">Se Connecter</h1>

    <?php if(isset($err)) echo "<p style='color:red;text-align:center'>Erreur</p>"; ?>

    <form class="formulaire" method="post">

        <div class="champ">
            <label>Pseudo</label>
            <input type="text" name="pseudo" class="pseudo" placeholder="Votre pseudo">
        </div>

        <div class="champ">
            <label>Mot de passe</label>
            <input type="password" name="mdp" class="mdp" placeholder="Votre mot de passe">
        </div>

        <input type="submit" value="Se connecter" class="bouton">

        <div class="compte">
            <p>Vous n'avez pas encore de compte ? <a href="compte.php">Inscrivez-vous ici !</a></p></br>
            <a href="./index.php" id="accueil">Retour à l'accueil</a>
        </div>

    </form>

</div>

</body>
</html>