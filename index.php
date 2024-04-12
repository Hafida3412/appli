<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Ajout produit</a></li>
        <li><a href="recap.php">Récapitulatif des produits</a></li>
    </ul>
</nav>

    
  <h1>Ajouter un produit</h1>
  <form action="traitement.php" method="post">
    <p>
        <label>
            Nom du produit:
            <input type="text" name="name">
        </label>
    </p>
    <p>
        <label>
            Prix du produit:
            <input type="number" step="any" name="price">
        </label>
    </p>
    <p>
        <label>
            Quantité désirée:
            <input type="number" name="qtt" value="1">
        </label>
    </p>
    <p>
        <input type="submit" name="submit" value="Ajouter le produit">
    </p>
  </form>

<!--création d'un message (d'erreur ou de succès, selon si le prioduit est rajouté ou pas dans le forum)-->
  <?php
session_start();

if(isset($_SESSION['message'])){
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']);// POUR SUPPRIMER LE MESSAGE
}
?>

</body>
</html>