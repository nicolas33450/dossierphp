<?php

function afficheForm($num = '',$n = '', $v='')
{
?>
	<form action="rechercher_client3.php" method="post">
		<label for="idnum">Numéro : </label>
		<input type="text" id="idnum" name="num" value="<?php echo  $num; ?>" size="30" maxlength="40"/>
		<br />
		<label for="idn">Nom : </label>
		<input type="text" id="idn" name="nom" value="<?php echo  $n; ?>" size="30" maxlength="40"/>
		<br />
		<label for="idv">Ville : </label>
		<input type="text" id="idv" name="ville" value="<?php echo  $v; ?>" size="30" maxlength="40"/>
		<br />
		<br />
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
		<title>Les clients</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

		<link rel="stylesheet" href="css/moncss.css">
	</head>

	<body>
		<h1>Recherche clients</h1>

		<?php
		// On vérifie si la page a reçue le bouton rechercher par la méthode POST (==> donc on a validé le formulaire)
		if(isset($_POST['rechercher']))
		{

			// On récupère les données envoyées par la formulaire (dans des variables)
			$num=trim($_POST['num']);
			$nom=trim($_POST['nom']);
			$ville=trim($_POST['ville']);

			// On ré-affiche le formulaire
			afficheForm($num, $nom, $ville);

			
			if ( (!empty($num)) || (!empty($nom)) || (!empty($ville)) )
			{
				$num = $num . '%';
				$nom = $nom . '%';
				$ville = $ville . '%';
				
				//Connexion à la base de données
				require 'connexion.php';

				$requete = $pdo->prepare("select n_cli, nom_cli, ville_cli from clients where n_cli like :num and nom_cli like :nom and ville_cli like :ville");

				$requete->bindValue(':num', $num);
				$requete->bindValue(':nom', $nom);
				$requete->bindValue(':ville', $ville);

				//On exécute la requête
				$requete->execute();
				
				// On récupère le nombre de ligne dans le recordset
				$nb_ligne= $requete->rowCount();
				echo 'Nombre de ligne(s) : ' . $nb_ligne . '<br />';
				
				if ($nb_ligne != 0)
				{
				?>
					<div class="container mt-5">
						<div class="row">
							<div class="d-none col-12 d-md-block col-md-4 text-center">Numéro</div>
							<div class="d-none col-12 d-md-block col-md-4 text-center">Nom</div>
							<div class="d-none col-12 d-md-block col-md-4 text-center">Ville</div>
						</div>	
						<?php
						while($ligne_tab = $requete->fetch())
						{
						?>
							<div class="row border border-info">
								<div class="col-12 col-md-4"><?= $ligne_tab['n_cli'] ?></div>
								<div class="col-12 col-md-4"><?= $ligne_tab['nom_cli'] ?></div>
								<div class="col-12 col-md-4"><?= $ligne_tab['ville_cli'] ?></div>
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
				?>
					<div class="container mt-5">
						<div class="row">
							<div class="col-12 text-center">
								Désolé aucun client correspond à ce critère
							</div>
						</div>
					</div>
				<?php
				}
			}
			else
			{
				?>
				
				<div class="container mt-5">
						<div class="row">
							<div class="col-12 text-center">
								Veuillez remplir un des champs
							</div>
						</div>
					</div>
				<?php
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
