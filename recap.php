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
<nav>
    <ul>
        <li><a href="index.php">Ajout produit</a></li>
        <li><a href="recap.php">Récapitulatif des produits</a></li>
    </ul>
</nav>
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

               
    /*$product['name'] =  "pomme";
    $product ['price'] = "2.5";
    $product['qtt'] = 10;
    $product['total'] = 2.5*10;*/

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
"</tr>",
"</thead>",
"<tbody>";
$totalGeneral = 0;
$totalArticles = 0;
foreach($_SESSION['products'] as $index => $product){       //$index aura pour valeur l'index du tableau $_SESSION['products'] parcouru
 echo "<tr>",                                                          //$product contiendra le produit, sous forme de tableau, tel que l'a créé 
        "<td>".$index."</td>",                                                   //et stocké en session le fichier traitement.php
        "<td>".$product['name']."</td>",
        "<td>".number_format($product['price'], 2, ",","&nbsp;")."&nbsp;€</td>",
        "<td>".$product['qtt']."</td>",
        "<td>".number_format($product['total'], 2, ",","&nbsp;")."&nbsp;€</td>",
        "</tr>";
$totalGeneral+= $product['total']; 
$totalArticles+= $product['qtt'];

/* grâce à l'opérateur combiné +=, on ajoute le total du produit 
parcouru à la valeur de $totalGeneral, qui augmente d'autant pour chaque produit*/
}

/*La fonction PHP number_format permet de modifier l'affichage d'une valeur numérique, en précisant:
    number_format(
    variable à modifier, 
    nombre de décimales souhaité, 
    caractère séparateur décimal,
    caractère séparateur de milliers5
    );*/


/*Une fois la boucle terminée, nous affichons une dernière ligne avant de refermer notre 
tableau. Cette ligne contient deux cellules : une cellule fusionnée de 4 cellules (colspan=4) 
pour l'intitulé, et une cellule affichant le contenu formaté de $totalGeneral avec 
number_format()*/
echo "<tr>",
      "<td colspan=4>Total général: </td>",
      "<td><strong>".number_format($totalGeneral, 2, ",","&nbsp;")."&nbsp;€<strong></td>",
      "</tr>";
echo "<p>Nombre total d'articles en session : ".$totalArticles."</p>";
"</tbody>";
     "</table>";
}

//TEST POUR VERIFIER SI LA FONCTION FONCTIONNE:
$products = [
    ['name' => 'banane', 'price' => 1.25, 'qtt' => 3, 'total' => 3.75],
    ['name' => 'pomme', 'price' => 2.50, 'qtt' => 10, 'total' => 25.00]
];

$_SESSION['products'] = $products;
?>
    
</body>
</html>