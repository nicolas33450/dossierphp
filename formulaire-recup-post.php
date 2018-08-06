<?php

function affiche_form($nom = '', $prenom = '', $login = '',$mdp = '', $date_naissance = '',$tel = '', $email = '', $role = '' , $admin = '', $moderateur ='', $verif = false){
?>
<form action="formulaire-recup-post.php" method="post">

    <div class="container">
        <div class="row">

            <div class="col-12 text-center">
                <h2> Création </h2>
            </div>
            <div class="col-12 col-md-3 mt-5">
                <label for="idn"> Nom : </label>
            </div>
            <div class="col-12 col-md-9 mt-5">
                <input type="text" name="nom" id="idn" placeholder="Nom" value="<?= $nom ?>"><?=  etoile_rouge($nom, $verif) ?>
            </div>
            <div class="col-12 col-md-3">
                <label for="idp"> Prenom : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="prenom" id="idp" placeholder="Prenom" value="<?= $prenom ?>"><?=  etoile_rouge($prenom, $verif) ?>
            </div>
            <div class="col-12 col-md-3">
                <label for="idl"> Login : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="login" id="idl" placeholder="login" value="<?= $login ?>"><?=  etoile_rouge($login, $verif) ?>
            </div>
            <div class="col-12 col-md-3">
                <label for="idm"> Mot de passe : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="mdp" id="idmdp" placeholder="mdp" value="<?= $mdp ?>"><?=  etoile_rouge($mdp, $verif) ?>
            </div>
            <div class="col-12 col-md-3">
                <label for="iddn"> Date naissance : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="date_naissance" id="iddn" placeholder="date naissance" value="<?= $date_naissance ?>"><?=  etoile_rouge($date_naissance, $verif) ?>
            </div>
            <div class="col-12 col-md-3">
                <label for="idt"> Tel : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="tel" id="idt" placeholder="tel" value="<?= $tel ?>"><?=  etoile_rouge($tel, $verif) ?>
            </div>
            <div class="col-12 col-md-3">
                <label for="ide"> Email : </label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="email" id="ide" placeholder="email" value="<?= $email ?>"><?=  etoile_rouge($email, $verif) ?>
            </div>
            <div class="col-12 col-md-3">
                <label for="idr"> Role : </label>
            </div>
            <div class="col-12 col-md-9">
                <select name="role" id="idr">
                    <option value="<? $admin ?>"> Admin </option>
                    <option value="<? $moderateur ?>"> Moderateur </option>                   
                </select><?=  etoile_rouge($email, $verif) ?>
            </div>

            <div class="col-12">
                <button class="btn btn-secondary mt-3" type="submit" name="envoyer" value="Envoyer"> Créer </button>
            </div>
        </div>
    </div>
</form>
<?php                                                                 
 }
?>    
<?php
function etoile_rouge($champ, $verif = false)
{ 
    if(empty($champ) && ($verif /* == true */))
    {
        echo'<span class="rouge">*</span>';
    }
    else
    {
        echo '*';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="css/formulaire-get.css">
        <title> Formulaire recup post </title>
    </head>

    <body>

        <?php
        //on verifie que l'on a recu par la methode post une variable envoyer (bouton)
        if(isset($_POST['envoyer']))
        {
            $n = strtoupper(trim($_POST['nom']));// strtoupper : majuscule du nom
            $p = ucfirst(trim($_POST['prenom']));// trim enleve les espaces avant et apres le nom// ucfirst: premire lettre en maj
            $l = trim($_POST['login']); 
            $m = trim($_POST['mdp']); 
            $dn = trim($_POST['date_naissance']); 
            $t = trim($_POST['tel']); 
            $e = trim($_POST['email']); 
            $r = trim($_POST['role']); 

            if(empty($n) || empty($p) || empty($l)|| empty($m) || empty($dn) || empty($t) || empty($e) || empty($admin) || empty($moderateur)) //empty remplace le == ''
            {

                affiche_form($n, $p, $l, $m, $dn, $t, $e, $r, true);

                if($n == '')
                {
                    echo 'veuillez saisir votre nom <br/>';
                }
                if($p == '')
                {
                    echo 'veuillez saisir votre prenom <br/>';
                }
                if($l == '')
                {
                    echo 'veuillez saisir votre login <br/>';
                }
                if($m == '')
                {
                    echo 'veuillez saisir votre mot de passe <br/>';
                }
                if($dn == '')
                {
                    echo 'veuillez saisir votre date de naissance <br/>';
                }
                if($t == '')
                {
                    echo 'veuillez saisir votre telephone <br/>';
                }
                if($e == '')
                {
                    echo 'veuillez saisir votre email <br/>';
                }
                if($r == '')
                {
                    echo 'veuillez saisir votre role <br/>';
                }
            }
            else
            { 
        ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-md-3">
                    Nom :
                </div>
                <div class="col-12 col-md-9">
                    <?= $n; ?>
                </div>
                <div class="col-12 col-md-3">
                    Prénom : 
                </div>
                <div class="col-12 col-md-9">
                    <?= $p; ?>
                </div>               
                <div class="col-12 col-md-3">
                    login : 
                </div>
                <div class="col-12 col-md-9 ">
                    <?= $l; ?>
                </div>
                <div class="col-12 col-md-3">
                    mdp : 
                </div>
                <div class="col-12 col-md-9 ">
                    <?= $m; ?>
                </div>
                <div class="col-12 col-md-3">
                    date_naissance : 
                </div>
                <div class="col-12 col-md-9 ">
                    <?= $dn; ?>
                </div>
                <div class="col-12 col-md-3">
                    telephone : 
                </div>
                <div class="col-12 col-md-9 ">
                    <?= $t; ?>
                </div>
                <div class="col-12 col-md-3">
                    email : 
                </div>
                <div class="col-12 col-md-9 ">
                    <?= $e; ?>
                </div>
                <div class="col-12 col-md-3">
                    role : 
                </div>
                <div class="col-12 col-md-9 ">
                    <?= $r; ?>
                </div>


            </div>
        </div>

        <?php 
            }
        }
        else
        { 

            affiche_form();

        }
        ?>    

        <!--<div class="col-12 col-md-3">
Ville
</div>
<div class="col-12 col-md-9">
<?= $v; ?> equivalent <?php echo $v ?>
</div>-->


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
