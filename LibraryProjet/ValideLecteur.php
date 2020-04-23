<?php SESSION_START();?>
<!DOCTYPE html>

<html>
<head>
<title></title>
<link rel="stylesheet" href="M.css" type="text/css">
</head>
<body>
<h1>Validation d'un lecteur</h1>
<h2>vous êtes enregistrés dans la base de la bibliothèque.<br>
vous avez maintenant la possibilité de réserver des livres ou vous <a href="index.php" >identifiant ici</a></h2>
<?php
try{ 
$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
$pdb=new PDO('mysql:host=localhost;dbname=id13342074_librairie','id13342074_root','JJZ&|Sj3uqRhlt{h',$pdo_options);
if(isset($_POST["go1"])){
	$nom=$_POST["nom"];
	$prénnom=$_POST["prenom"];
	$nomdepasse=$_POST["password"];
	$codlec=$_POST["codd"];
	$Adressee=$_POST["Adresse"];
	$codeps=$_POST["Code_postale"];
	$vil=$_POST["ville"];
    $pdb->exec("insert into lecteurs values('$codlec','$nom','$prénnom','$Adressee','$vil','$codeps','$nomdepasse')");
    $repons=$pdb->query("select * from lecteurs where  lecnom='".$nom."' and lecmotdepasse='".$nomdepasse."'");
    while($do=$repons->fetch()){
		$_SESSION["codlec"]=$do["lecnum"];
		$_SESSION["nom"]=$do["lecnom"];
		$_SESSION["prénnom"]=$do["lecprenom"];
		$_SESSION["Adressee"]=$do["lecadresse"];
		$_SESSION["vil"]=$do["lecville"];
		$_SESSION["codeps"]=$do["leccodepostal"];
		$_SESSION["nomdepasse"]=$do["lecmotdepasse"];
		
		
		echo'<table align="center" border="2" color="gray" bgcolor="peachPuff" width="20">';
		echo'<tr >';
	    echo'<td>Nom :</td>';
		echo'<td>'.$_SESSION["nom"].'</td>';
		echo'</tr >';
		echo'<tr >';
	    echo'<td>Prenom :</td>';
		echo'<td>'.$_SESSION["prénnom"].'</td>';
		echo'</tr >';
		echo'<tr >';
	    echo'<td> Adresse:</td>';
		echo'<td>'.$_SESSION["Adressee"].'</td>';
		echo'</tr >';
		echo'<tr >';
	    echo'<td> Ville:</td>';
		echo'<td>'.$_SESSION["vil"].'</td>';
		echo'</tr >';
		echo'<tr >';
	    echo'<td> Code postal:</td>';
		echo'<td>'.$_SESSION["codeps"].'</td>';
		echo'</tr >';
		echo'<tr >';
	    echo'<td> Numéro:</td>';
		echo'<td>'.$_SESSION["codlec"].'</td>';
		echo'</tr >';
		echo'</table>';
		}
		$repons->CloseCursor();
	
	 }
		?>
</body>
</html>

<?php  SESSION_DESTROY();
}catch(EXCEPTION $e){die('Erreur'.$e->getMessage());}?>