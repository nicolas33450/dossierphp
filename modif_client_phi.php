<?php

// Fonction qui écrit une étoile si le champ est vide
function affich_etoile($champ, $v, $message='')
{
	if (empty($champ) && $v)
	{
		echo '<span class="rouge">* Veuillez saisir ' . $message .'.</span>';
		//echo '<span class="rouge">*</span>';
	}
	else
	{
		echo '*';
	}
}

// Déclaration de la fonction (pour afficher le formulaire)
function formulaire($num='', $n='', $p='', $a1='', $a2='',$cp='', $v='', $e='', $verif=false)
{
?>

<form action="modif_client_phi.php" method="post">

	<div class="container mt-5">
		<div class="row">
			<div class="col-12 offset-md-2 col-md-8">
				<div class="row">
					<div class="col-12 col-md-2">
						<input type="hidden" name="num" value="<?= $num ?>" />
						<label for="idn">Nom :</label>
					</div>
					<div class="col-12 col-md-6">
						<input type="text" name="nom" id="idn" value="<?= $n ?>" />
					</div>
					<div class="col-12 col-md-4">
						<?php affich_etoile($n, $verif, 'le nom'); ?>
					</div>

					<div class="col-12 col-md-2">
						<label for="idp">Prénom :</label>
					</div>
					<div class="col-12 col-md-6">
						<input type="text" name="prenom" id="idp" value="<?= $p ?>" />
					</div>
					<div class="col-12 col-md-4">
						<?php affich_etoile($p, $verif, 'le prénom'); ?>
					</div>

					<div class="col-12 col-md-2">
						<label for="ida1">Adresse 1 :</label>
					</div>
					<div class="col-12 col-md-6">
						<input type="text" name="ad1" id="ida1" value="<?= $a1 ?>" /> 
					</div>
					<div class="col-12 col-md-4">
						<?php affich_etoile($a1, $verif, 'l\'adresse 1'); ?>
					</div>
					<div class="col-12 col-md-2">
						<label for="ida2">Adresse 2 :</label>
					</div>
					<div class="col-12 col-md-6">
						<input type="text" name="ad2" id="ida2" value="<?= $a2 ?>" />
					</div>
					<div class="col-12 col-md-4">
					</div>
					<div class="col-12 col-md-2">
						<label for="idcp">CP :</label>
					</div>
					<div class="col-12 col-md-6">
						<input type="text" name="cp" id="idp" value="<?= $cp ?>" /> 
					</div>
					<div class="col-12 col-md-4">
						<?php affich_etoile($cp, $verif, 'le code postal'); ?>
					</div>
					<div class="col-12 col-md-2">
						<label for="idv">Ville :</label>
					</div>
					<div class="col-12 col-md-6">
						<input type="text" name="ville" id="idv" value="<?= $v ?>" /> 
					</div>
					<div class="col-12 col-md-4">
						<?php affich_etoile($v, $verif, 'la ville'); ?>
					</div>
					<div class="col-12 col-md-2">
						<label for="ide">Email :</label>
					</div>
					<div class="col-12 col-md-6">
						<input type="text" name="email" id="ide" value="<?= $e ?>" /> 
					</div>
					<div class="col-12 col-md-4">
						<?php affich_etoile($e, $verif, 'l\'email'); ?>
					</div>
					<div class="col-12 text-center">
						<input type="submit" name="modifcli" value="Modifier" />
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php
}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ajout article</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
		<link rel="stylesheet" href="css/moncss.css">
	</head>

	<body>
		<?php

		if(isset($_GET['num']))
		{
			$num=trim($_GET['num']);
			
			require 'connexion.php';

			$requete = $pdo->prepare("select * from clients where n_cli = :num");

			$requete->bindValue(':num', $num);
            
			$requete->execute();

			if ($ligne_tab = $requete->fetch())
			{

				formulaire( $ligne_tab['n_cli'], $ligne_tab['nom_cli'], $ligne_tab['prenom_cli'], $ligne_tab['adr1_cli'], $ligne_tab['adr2_cli'],$ligne_tab['cp_cli'], $ligne_tab['ville_cli'], $ligne_tab['email_cli'], true);

			}
			else
			{
				echo 'Bizarre bizarre, aucun client correspond à ce numéro !!!!';
			}
		}
		elseif(isset($_POST['modifcli']))
		{
			$num=$_POST['num'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$ad1 = $_POST['ad1'];
			$ad2 = $_POST['ad2'];
			$cp = $_POST['cp'];
			$ville = $_POST['ville'];
			$email = $_POST['email'];
			
			// On vérifie que tous les champs obligatoires sont remplis
			if((empty($num)) || (empty($nom)) || (empty($prenom)) || (empty($ad1)) || (empty($cp)) || (empty($ville)) || (empty($email)))
			{
				formulaire( $num, $nom, $prenom, $ad1, $ad2, $cp, $ville, $email, true);
			}
			else
			{
				require 'connexion.php';

				$requete = $pdo->prepare("update clients set nom_cli = :nom, prenom_cli = :prenom, adr1_cli = :ad1,
				 adr2_cli = :ad2, cp_cli = :cp, ville_cli = :ville, email_cli = :email where n_cli = :num");

				$requete->bindValue(':num', $num);
				$requete->bindValue(':nom', $nom);
				$requete->bindValue(':prenom', $prenom);
				$requete->bindValue(':ad1', $ad1);
				$requete->bindValue(':ad2', $ad2);
				$requete->bindValue(':cp', $cp);
				$requete->bindValue(':ville', $ville);
				$requete->bindValue(':email', $email);
							
				$requete->execute();
				
				//echo 'Le client a été modifié';
                
                // redirection sur une page que l'on souhaite
                header('location: clients.php');

			}
			
			
		}
		else
		{
			echo 'Que faites vous là ?';
		}

		?>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

	</body>
</html>
