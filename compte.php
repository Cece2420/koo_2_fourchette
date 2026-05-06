<?php
require "config.php";

if(isset($_POST["pseudo"]) && isset($_POST["mdp"])){
    $stmt=$pdo->prepare("SELECT idMembre FROM membres WHERE login=?");
    $stmt->execute([$_POST["pseudo"]]);
    if(!$stmt->fetch()){
        $ins=$pdo->prepare("INSERT INTO membres (gravatar,login,password,statut,prenom,nom) VALUES (?,?,?,?,?,?)");
        $ins->execute(["natha.png",$_POST["pseudo"],sha1($_POST["mdp"]),"membre",$_POST["pseudo"],""]);
        header("Location: connecter.php");
        exit;
    } else {
        $err=1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="compte.css" type="text/css">
</head>
<body>
    <div class="tout">
        <h1 class="compte">Créer un compte</h1>

        <?php if(isset($err)) echo "<p style='color:red;text-align:center'>Pseudo déjà utilisé</p>"; ?>

        <form class="formulaire" method="post">

            <div class="champ">
                <label>Pseudo</label>
                <input type="text" name="pseudo" class="pseudo" placeholder="Votre pseudo"/>
            </div>

            <div class="champ">
                <label>Adresse e-mail</label>
                <input type="text" name="email" class="email" placeholder="Votre adresse e-mail"/>
            </div>

            <div class="champ">
                <label>Mot de passe</label>
                <input type="password" name ="mdp" class="mdp" placeholder="Votre mot de passe"/>
            </div>

            <input type="submit" value="se connecter" class="bouton"/>

            <div class="connecter">
                <p>Vous avez déjà un compte ? <a href="connecter.php">Se connecter</a></p></br>
                <a href="./index.php" id="accueil">Retour à l'accueil</a>
            </div>

        </form>
    </div>
</body>
</html>