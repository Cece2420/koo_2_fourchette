<?php
require "config.php";
$cats=$pdo->query("SELECT idCategorie,nom FROM categories")->fetchAll();

if(isset($_POST["titre"])){
    if(!isset($_SESSION["user"])) { $err=1; }
    else{
        $img="marmelade-carottes.jpg";
        if(!empty($_FILES["photo"]["name"])){
            $img=$_FILES["photo"]["name"];
            move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/recettes/".$img);
        }

        $stmt=$pdo->prepare("INSERT INTO recettes (titre,chapo,img,preparation,ingredient,membre,couleur,categorie,tempsCuisson,tempsPreparation,difficulte,prix)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([
            $_POST["titre"],
            $_POST["resume"],
            $img,
            $_POST["etapes"],
            $_POST["ingredients"],
            $_SESSION["user"]["idMembre"],
            "fushia",
            $_POST["categorie"],
            "0 min",
            $_POST["temps"]." min",
            $_POST["difficulte"],
            "Pas cher"
        ]);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Déposer une recette</title>
  <link rel="stylesheet" href="./deposer.css" />
</head>

<body>

  <div class="card">

    <h1 class="titre">Déposer une recette</h1>

    <?php if(isset($err)) echo "<p style='color:red;text-align:center'>Connecte-toi</p>"; ?>

    <form class="formulaire" action="#" method="post" enctype="multipart/form-data">

      <div class="champ">
        <label for="titre">Titre de la recette</label>
        <input id="titre" type="text" name="titre" placeholder="Ex: Poulet au curry" required>
      </div>

      <div class="ligne">
        <div class="champ">
          <label for="categorie">Catégorie</label>
          <select id="categorie" name="categorie" required>
            <option value="">Choisir…</option>
            <?php foreach($cats as $c){ ?>
              <option value="<?php echo $c["idCategorie"]; ?>"><?php echo $c["nom"]; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="champ">
          <label for="difficulte">Difficulté</label>
          <select id="difficulte" name="difficulte" required>
            <option value="">Choisir…</option>
            <option>Facile</option>
            <option>Moyen</option>
            <option>Difficile</option>
          </select>
        </div>
      </div>

      <div class="ligne">
        <div class="champ">
          <label for="temps">Temps (minutes)</label>
          <input id="temps" type="number" name="temps" min="1" placeholder="Ex: 25" required>
        </div>

        <div class="champ">
          <label for="portions">Portions</label>
          <input id="portions" type="number" name="portions" min="1" placeholder="Ex: 4" required>
        </div>
      </div>

      <div class="champ">
        <label for="resume">Résumé (optionnel)</label>
        <input id="resume" type="text" name="resume" placeholder="Ex: Une recette simple et rapide…">
      </div>

      <div class="champ">
        <label for="ingredients">Ingrédients</label>
        <textarea id="ingredients" name="ingredients" placeholder="Ex: - 200g de riz - 1 oignon - 2 cuillères de curry" required></textarea>
      </div>

      <div class="champ">
        <label for="etapes">Étapes</label>
        <textarea id="etapes" name="etapes" placeholder="Ex: 1) Couper l'oignon… 2) Faire revenir… 3) Ajouter…" required></textarea>
      </div>

      <div class="champ">
        <label for="photo">Photo (optionnel)</label>
        <input id="photo" type="file" name="photo" accept="image/*">
      </div>

      <button type="submit" class="bouton">Déposer la recette</button>

      <p class="mini">
        <a href="./index.php">Retour à l'accueil</a>
      </p>

    </form>

  </div>

</body>
</html>