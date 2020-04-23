<?php SESSION_START() ?>
<!DOCTYPE HTML>
<?php
try{
$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
$pdb=new PDO('mysql:host=localhost;dbname=id13342074_librairie','id13342074_root','JJZ&|Sj3uqRhlt{h',$pdo_options);?>
<html>
<head>
<title></title>
<link rel="stylesheet" href="M.css" type="text/css">
</head>
<body>
<h1>Authentification du lecteur</h1>
<form method="POST" action="GestionLecteure.php">
<table width="100"size="80">
<tr><td width="60" id="N">Nom de lecture:</td><td width="50"><input type="text" name="nom" id="n" size="60" height="40"></td></tr> 
<tr><td width="60" id="M">Mot de passe:</td>
<td width="50" size=""><input type="password" name="password" id="p" size="60" height="40"></td></tr>
<tr><td width="40"><div id="e"><input type="submit"  name="go" value="Login" size="30"></div></td></tr>
</table>
</form>
</body>
</html>
<?php 
if(isset($_POST["go"])){
	
	$nom=$_POST["nom"];
	$password=$_POST["password"];
$reponse=$bdd->query("select lecnum from lecteurs where  lecnom='".$nom."' and lecmotdepasse='".$password."'");
    while($do=$reponse->fetch()){
		$_SESSION["numéro"]=$do["lecnum"];
    }$reponse->closeCursor();
	                 }
}catch(EXCEPTION $e){die('Erreur'.$e->getMessage());}
?>


