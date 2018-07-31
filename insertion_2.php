<?php

function afficheForm($nom = '', $descr = '', $prix = '', $stock = '')
{
?>
<form action="insertion_2.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 mt-5">
                <label for="$nomn"> Nom : </label>
            </div>
            <div class="col-12 col-md-9 mt-5">
                <input type="text" name="nom" $nom="$nomn" placeholder="Nom" value="<?php echo  $nom; ?>">
            </div>

            <div class="col-12 col-md-3">
                <label for="$nomp"> descr : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="descr" $nom="$nomp" placeholder="Description" value="<?php echo  $descr; ?>">
            </div>

            <div class="col-12 col-md-3">
                <label for="$nomv"> prix : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="prix" $nom="$nomv" placeholder="Prix" value="<?php echo  $prix; ?>">
            </div>

            <div class="col-12 col-md-3">
                <label for="$nomv"> stock : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="stock" $nom="$nomv" placeholder="Stock" value="<?php echo  $stock; ?>">
            </div>

            <div class="col-12">
                <button class="btn btn-success mt-3" type="submit" name="envoyer" value="Envoyer"> Envoyer </button>
            </div>
        </div>
    </div>
</form>
<?php
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="w$nomth=device-w$nomth, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <title> Insertion </title>
    </head>
    <h1 class="text-center"> Ajout d'articles </h1>
    <body>

        <?php
        // On vérifie si la page a reçue le bouton rechercher par la méthode POST (==> donc on a val$nomé le formulaire)
        if(isset($_POST['envoyer']))
        {

            // On récupère les données envoyées par la formulaire (dans des variables)
            $nom=trim($_POST['nom']);
            $descr = ucfirst(trim($_POST['descr']));// trim enleve les espaces avant et apres le nom// ucfirst: premire lettre en maj
            $prix = trim($_POST['prix']); 
            $stock = trim($_POST['stock']); 

            // On ré-affiche le formulaire
            //afficheForm($nom, $descr, $prix, $stock);


            if (!empty($nom) && !empty($descr) && !empty($prix) && !empty($stock))
            {
                    
                //Connexion à la base de données
                include 'connexion.php';

                $requete = $pdo->prepare("insert into articles(nom_art, descr_art, prix_art, stock_art) values(:nom, :descr, :prix, :stock)");

                $requete->bindValue(':nom', $nom);
                $requete->bindValue(':descr', $descr);
                $requete->bindValue(':prix', $prix);
                $requete->bindValue(':stock', $stock);

                //On exécute la requête
                $requete->execute();               

            }
        }

        afficheForm();

        ?>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
