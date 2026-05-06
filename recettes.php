<?php
require "config.php";
$recettes = $pdo->query("SELECT titre, dateCrea FROM recettes ORDER BY idRecette DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Recettes</title>
  <link rel="stylesheet" href="recettes.css" type="text/css">
</head>
<body>

<h1>Recettes</h1>

<p><a href="deposer.php">Déposer une recette</a> | <a href="index.php">Accueil</a></p>

<?php foreach($recettes as $r){ ?>
  <div>
    <b><?php echo $r["titre"]; ?></b><br>
    <small><?php echo $r["dateCrea"]; ?></small>
  </div>
<?php } ?>

</body>
</html>