<?php
 session_start();

  
 /*Ici, nous vérifions alors l'existence de la clé "submit" dans le tableau $_POST, celle clé 
correspondant à l'attribut "name" du bouton <input type="submit" name="submit"> du 
formulaire. La condition sera alors vraie seulement si la requête POST transmet bien une 
clé "submit" au serveur.
Dans l'autre cas, la ligne 8 effectue une redirection grâce à la fonction header(). Il n'y a pas 
de "else" à la condition puisque dans tous les cas (formulaire soumis ou non), nous 
souhaitons revenir au formulaire après traitement.*/

 if(isset($_POST['submit'])){ /*Vérifier l'existence d'une requête POST: il faut limiter l'accès 
 à traitement.php par les seules requêtes HTTP provenant de la soumission de notre formulaire.*/

//FILTRES DES VALEURS TRANSMISES/VERIFICATION DE L INTEGRITE DES VALEURS TRANSMISES
 $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);        
 $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT);

 if ($name && $price && $qtt){ //CETTE CONDITION PERMET DE VERIFIER SI TOUS LES FILTRES ONT FONCTIONNE

 $product = [                  //CREATION DU TABLEAU ASSOCIATIF $PRODUCT
    "name" => $name,
    "price"=> $price,
    "qtt"=> $qtt,
    "total"=> $price*$qtt
 ];

 $_SESSION['products'][] = $product;  //ENREGISTREMENT DU PRODUIT NVELMT CREE EN SESSION
 /*Cette ligne: -> sollicite le tableau de session $_SESSION fourni par PHP.
                -> on indique la clé "products" de ce tableau. Si cette clé n'existait pas auparavant (ex: 
l'utilisateur ajoute son tout premier produit), PHP la créera au sein de $_SESSION.
                -> les deux crochets "[]" sont un raccourci pour indiquer à cet emplacement que nous 
ajoutons une nouvelle entrée au futur tableau "products" associé à cette clé. 
                -> $_SESSION["products"] doit être lui aussi un tableau afin d'y stocker de nouveaux 
produits par la suite.*/

//création d'un message (d'erreur ou de succès, selon si le prioduit est rajouté ou pas dans le formulaire)
$_SESSION['message'] = "Votre produit a été ajouté avec succès.";
} else {
$_SESSION['message'] = "Erreur";
}
 }


 // Vérification de l'action à effectuer
 /*Ce code est comme un guide pour dire au site Web ce qu'il doit faire lorsque 
 quelqu'un clique sur un bouton spécifique. Le "if" vérifie si une certaine action a été déclenchée,
 et le "switch" indique les différentes actions possibles qu'il peut faire en fonction de ce qui a 
 été déclenché*/
 if (isset($_GET['action'])) {
     switch($_GET['action']) {
             case 'delete':
             // Supprimer un produit en session
             $id_produit = $_GET['id_produit'];// la variable $id_produit va contenir la valeur passée en paramètre dans l'URL sous la clé 'id_produit' lorsqu'une requête HTTP GET est effectuée.
             unset($_SESSION['products'][$id_produit]);//Dans la variable de session $_SESSION['products'], il y a une clé correspondant à l'id du produit ($id_produit) et la valeur associée à cette clé est la donnée concernant ce produit
             $_SESSION['message'] = "Le produit a été supprimé avec succès.";//variable de session nommée "message" en PHP. Cette variable est utilisée pour stocker des messages temporaires
             break;// l'instruction break est utilisée pour sortir d'une boucle for, foreach, while, ou do-while prématurément
          
             case 'delete_all':
             // Supprimer tous les produits en session
             unset($_SESSION['products']);
             $_SESSION['message'] = "Tous les produits ont été supprimés avec succès.";
             break;
         
             case 'update_quantity':
             if (isset($_GET['increment'])) {
                 // Modifier la quantité de produit en session
                 $id_produit = $_GET['id_produit'];/* Le $_GET est une superglobale en PHP qui permet de 
récupérer des données envoyées en paramètre par la méthode GET dans l'URL. Dans ce cas, $_GET['id_produit'] 
va récupérer la valeur de l'attribut 'id_produit' dans l'URL et la stocker dans la variable $id_produit.*/
                 $increment = $_GET['increment'];/*permet de récupérer la valeur du paramètre "increment"
 qui est passé dans l'URL de la requête. La valeur de ce paramètre est ensuite stockée dans la variable
 $increment. Cela permet de récupérer des données transmises via la méthode GET dans un formulaire ou un 
 lien URL.*/
          if ($increment == '+') {
$_SESSION['products'][$id_produit]['qtt']++;//à chaque fois que cette ligne de code est exécutée, la quantité du produit avec l'identifiant $id_produit stocké dans la variable de session $_SESSION['products'] est augmentée de 1.
$_SESSION['products'][$id_produit]['total'] = $_SESSION['products'][$id_produit]['qtt'] * $_SESSION['products'][$id_produit]['price'];// le total du produit correspond au produit de la quantité du produit et son prix. Le total est donc calculé en multipliant la quantité du produit par son prix.
          } elseif ($increment == '-') {
$_SESSION['products'][$id_produit]['qtt']--;
$_SESSION['products'][$id_produit]['total'] = $_SESSION['products'][$id_produit]['qtt'] * $_SESSION['products'][$id_produit]['price'];
          }
$_SESSION['message'] = "La quantité du produit a été modifiée avec succès.";
         }
     }
 }
 
 // Redirection vers recap.php après traitement
 /*header("Location: recap.php");*/
 header("Location: recap.php?message=" . urlencode($_SESSION['message']));




 
 