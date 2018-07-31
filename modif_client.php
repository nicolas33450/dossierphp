<?php

function afficheForm($id = '', $nom = '', $ville = '')
{
?>
<form action="modif_client.php" method="get">
    <label for=""> ID :</label> 
    <input type="text" name="id" value="<?= $id; ?>" size="30" maxlength="40"/>
    <br /><br />

    <label for=""> nom :</label> 
    <input type="text" name="nom" value="<?= $nom; ?>" size="30" maxlength="40"/>
    <br /><br />

    <label for=""> Ville :</label> 
    <input type="text" name="ville" value="<?= $ville; ?>" size="30" maxlength="40"/>
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <title> Modif client </title>
    </head>

    <body>

        <?php

        // On vérifie si la page a reçue le bouton rechercher par la méthode POST (==> donc on a val$nomé le formulaire)
        if(isset($_GET['num']))
        {
            $num = trim($_GET['num']); 

            include 'connexion.php';

            $requete = $pdo->prepare("select * from clients where n_cli = :num");

            $requete->bindValue(':num', $num);

            $requete->execute();

            if($ligne_tab = $requete->fetch())
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
        }

        // on se deco de la bdd
        unset($pdo);  

        ?>   

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    </body>
</html>

