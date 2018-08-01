<?php

function afficheForm($id = '', $nom = '', $ville = '')
{
?>
<form action="modifier.php" method="post">
    <label for=""> ID :</label> 
    <input type="text" name="id" value="<?php echo  $id; ?>" size="30" maxlength="40"/>
    <br /><br />

    <label for=""> nom :</label> 
    <input type="text" name="nom" value="<?php echo  $nom; ?>" size="30" maxlength="40"/>
    <br /><br />

    <label for=""> Ville :</label> 
    <input type="text" name="ville" value="<?php echo  $ville; ?>" size="30" maxlength="40"/>
    <br /><br />
    <input type="submit" value="Rechercher" name="rechercher" />

</form>
<?php
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Modifier </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    </head>

    <body>
       
        <?php
        // On vérifie si la page a reçue le bouton rechercher par la méthode POST (==> donc on a validé le formulaire)
        if(isset($_POST['rechercher']))
        {

            // On récupère les données envoyées par la formulaire (dans des variables)
            $id=trim($_POST['id']);
            $nom = ucfirst(trim($_POST['nom']));// trim enleve les espaces avant et apres le nom// ucfirst: premire lettre en maj
            $ville = trim($_POST['ville']); 

            // On ré-affiche le formulaire
            afficheForm($id, $nom, $ville);


            if (!empty($id) || !empty($nom)|| !empty($ville))
            {
                $id = $id . '%';
                $nom = $nom . '%';
                $ville = $ville . '%';
                //Connexion à la base de données
                require 'connexion.php';

                $requete = $pdo->prepare("select n_cli, nom_cli, ville_cli from clients where n_cli like :id and nom_cli like :nom and ville_cli like :ville" );

                $requete->bindValue(':id', $id);
                $requete->bindValue(':nom', $nom);
                $requete->bindValue(':ville', $ville);


                //On exécute la requête
                $requete->execute();

                $nb_ligne = $requete->rowCount();
                if($nb_ligne == 0)
                {
                    echo 'Désole aucun clients trouver';
                }
                else
                { 

        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="d-none col-12 d-md-block col-md-3 text-center">Numéro</div>
                <div class="d-none col-12 d-md-block col-md-3 text-center">Nom</div>
                <div class="d-none col-12 d-md-block col-md-3 text-center">Ville</div>
                <div class="d-none col-12 d-md-block col-md-3 text-center">Modifier</div>
            </div>

            <?php
                    echo 'nombres de ligne(s) : ' . $nb_ligne . '<br/>';
                }
                while($ligne_tab = $requete->fetch())
                {
            ?>

            <div class="row border border-info">
                <div class="col-12 col-md-3 text-center"><?= $ligne_tab['n_cli'] ?></div>
                <div class="col-12 col-md-3 text-center"><?= $ligne_tab['nom_cli'] ?></div>
                <div class="col-12 col-md-3 text-center"><?= $ligne_tab['ville_cli'] ?></div>
                <div class="col-12 col-md-3 text-center "><a href="modif_client_phi.php?num=<?= $ligne_tab['n_cli'] ?>"><img class="w-25 text-center " src="images/images.jpeg" alt=""></a></div>
            </div>

            <?php
                }

                // On vide le jeu d'enregistrements
                $requete->closeCursor();

                // Déconnexion de la base de données
                unset($pdo);
            ?>

        </div>

        <?php

            }
            else
            {
                echo 'Veuillez saisir un champs';
            }
        }
        else
        {
            afficheForm();
        }
        ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
