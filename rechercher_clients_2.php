<?php

function affiche_form($nom = '', $prenom = '', $ville = ''){
?>
<h1 class="text-center pb-5"> Les clients </h1>

<div class="container">
    <div class="row border border-danger mb-4">
        <div class="col-md-4 text-center">
            <h5> Numero </h5>
        </div>
        <div class="col-md-4 text-center">
            <h5> Clients </h5>                    
        </div>
        <div class="col-md-4 text-center">
            <h5> Ville </h5>
        </div>
    </div>
</div>

<?php
    //require 'connexion.php'; autre possibilité
    include 'connexion.php';

    $recherche = $nom . '%';

    // requete préparée en sql //
    $requete=$pdo->prepare('select n_cli, nom_cli, ville_cli from clients where nom_cli like :nom');

    $requete->bindValue(':nom', $recherche);

    // execute la requete (on recupere un jeu d'enregistrement)
    $requete->execute();


    while($ligne_tab = $requete->fetch())
    {
?>

<div class="container liste">
    <div class="row border border-primary m-2">

        <div class="col-md-4 text-center">
            <?= $ligne_tab['n_cli'] ?>
        </div>
        <div class="col-md-4 text-center">
            <?= $ligne_tab['nom_cli'] ?>
        </div>
        <div class="col-md-4 text-center">
            <?= $ligne_tab['ville_cli'] ?>
        </div>
    </div>
</div>           


<?php
    }


    // on se deco e la bdd
    unset($pdo);  

?>   
<?php
}

?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="css/formulaire-get.css">
        <title> Rechercher Clients </title>
    </head>

    <body>
        <h1 class="text-center pb-5"> Les clients </h1>
        <form action="rechercher_clients_2.php" method="post">

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3 mt-5">
                        <label for="idn"> Nom : </label>
                    </div>
                    <div class="col-12 col-md-9 mt-5">
                        <input type="text" name="nom" id="idn" placeholder="Nom" value="">
                    </div>
                    <div class="col-12 col-md-3">
                <label for="idp"> Prenom : </label>
            </div>

            <div class="col-12 col-md-9">
                <input type="text" name="prenom" id="idp" placeholder="Prenom" >
            </div>
            <div class="col-12 col-md-3">
                <label for="idv"> Ville : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="ville" id="idv" placeholder="Ville" >
            </div>

                    <div class="col-12">
                        <button class="btn btn-secondary mt-3" type="submit" name="envoyer" value="Envoyer"> Envoyer </button>
                    </div>
                </div>
            </div>
        </form>

        <?php
        //on verifie que l'on a recu par la methode post une variable envoyer (bouton)
        if(isset($_POST['envoyer']))
        {
            $n = strtoupper(trim($_POST['nom']));// strtoupper : majuscule du nom
            $p = ucfirst(trim($_POST['prenom']));// trim enleve les espaces avant et apres le nom// ucfirst: premire lettre en maj
            $v = trim($_POST['ville']); 

            if(empty($n) || empty($p) || empty($v))//empty remplace le == ''
            {

                affiche_form($n);
            }
        }

        ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
