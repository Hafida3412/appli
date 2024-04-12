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
 }
}
  header("Location:index.php"); //Avec le type d'appel "Location:", cette réponse est envoyée au client avec le
 // status code 302, qui indique une redirection. 

 