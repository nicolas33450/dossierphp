<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <title> Formulaire Get </title>
    </head>

    <body>
        <form action="recup-get.php" method="get">

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3 mt-5">
                        <label for="idn"> Nom : </label>
                    </div>
                    <div class="col-12 col-md-9 mt-5">
                        <input type="text" name="nom" id="idn" placeholder="Nom">
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="idp"> Prenom : </label>
                    </div>

                    <div class="col-12 col-md-9">
                        <input type="text" name="prenom" id="idp" placeholder="Prenom">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="idv"> Ville : </label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" name="ville" id="idv" placeholder="Ville">
                    </div>
                    
                    <div class="col-12">
                        <button class="btn btn-success mt-3" type="submit" name="envoyer" value="Envoyer"> Envoyer </button>
                    </div>
                </div>
            </div>
        </form>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
