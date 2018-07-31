<?php

include 'connexion.php';

$nom ='azazazazz';
$descr = 'vvvbbbbvb';
$prix = 150;
$stock = 20; 

$requete = $pdo->prepare("insert into articles(nom_art, descr_art, prix_art, stock_art) values(:nom, :descr, :prix, :stock)");

$requete->bindValue(':nom', $nom);
$requete->bindValue(':descr', $descr);
$requete->bindValue(':prix', $prix);
$requete->bindValue(':stock', $stock, PDO::PARAM_INT);

$requete->execute();


?>


