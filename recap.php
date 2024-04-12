<!--A la différence d'index.php, nous aurons besoin ici de parcourir le tableau de session, il est 
donc nécessaire d'appeler la fonction session_start() en début de fichier afin de récupérer la session
correspondante à l'utilisateur*/-->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <?php 
    
   /* EXEMPLE DE TEST AVEC UN PRODUIT BIZARRE/ CELA N A PAS AFFECTE LE TABLEAU GRACE AUX FILTRES:
   $name = "<a href='http://sitepirate.com'>Cliquez ici</a>";
    $price = "A définir";
    $qtt = 0;
    
    if ($name && $price && $qtt){ 
   $product1 = [                  
       $name = "<a href='http://sitepirate.com'>Cliquez ici</a>",
       $price = "A définir",   
       $qtt = 0,
       $total = "A définir"*0
   ];

   $product2 = [                  
       $name =  "pomme",
       $price = "2.5",
       $qtt = 10,
       $total = 2.5*10
   ];

   $_SESSION['products'][] = $product1;
   $_SESSION['products'][] = $product2;
}

var_dump($_SESSION);*/

if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ //Soit la clé "products" du tableau de session $_SESSION n'existe pas : !isset()
                                                                  
    echo "<p>Aucun produit en session...</p>";                      
}else{                                                              //Soit cette clé existe mais ne contient aucune donnée : empty()
echo "<table>",                                                                 //->Dans ces deux cas, nous afficherons à l'utilisateur un message le prévenant qu'aucun produit n'existe en session.
"<thead>",
"<tr>",
"<th>#</th>",
"<th>Nom</th>",
"<th>Prix</th>",
"<th>Quantité</th>",
"<th>Total</th>",
"<tr>",
"<thead>",
"<tbody>",

}

?>
    
</body>
</html>