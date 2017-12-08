<!DOCTYPE html>
<html>
<head>
	<title>TO DO LIST</title>
</head>

<body>

	<?php	

	// 	DECLARATION DE LA PDO ET OPERATIONS SQL

	$db = new PDO('mysql:host=localhost;dbname=EX_TODO', 'root', 'lpdip:17');
	if ($db->connect_error) { // VERIFICATION DE LA BONNE CONNEXION A LA BASE
    	die("Connection failed: " . $conn->connect_error);
	}
	if ($_POST['tache']){ // REQUETE LORS DE L'AJOUT D'UNE TACHE
		$db->exec("INSERT INTO liste(libelle) VALUES('".$_POST['tache']."')");
	}
	if ($_GET['id']){ // SUPPRESSION D'UNE TACHE
		$db->exec("DELETE FROM liste WHERE id=".$_GET['id']);
		header("Location: index.php");
	}	

	$resultats=$db->query("SELECT * FROM liste");
	$resultats->setFetchMode(PDO::FETCH_OBJ);	

	//

	echo "<h1>TO DO LIST</h1>";

	// AFFICHAGE DES TACHES

	echo "<ul>";

	while( $resultat = $resultats->fetch() )
	{
        echo '<li>'.$resultat->libelle.'  <a href="?id='.$resultat->id.'">Supprimer</a></li>';
	}	

	$resultats->closeCursor();

	echo "</ul>";

	?>

	<!-- FORMULAIRE D'AJOUT -->

	<form action="index.php" method="post">
		<p>
			<input placeholder="Ajouter une tache" type="text" name="tache" />
			<input type="submit" value="Valider" />
		</p>
	</form>

</body>

</html> 