<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title></title>
<link rel="stylesheet" href="M.css" type="text/css">
</head>
<body>
<h1>Confirmation de votre réservation</h1>
<?php
try{ 
$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
$pdb=new PDO('mysql:host=localhost;dbname=id13342074_librairie','id13342074_root','JJZ&|Sj3uqRhlt{h',$pdo_options);
     
	   $nbr=$_SESSION['idcode'];
	   $nb=$_SESSION["numéro"];
	   
	 if(isset($_POST["conf"])){
		 	 
		 
	$t=$pdb->query("update livres set livdejareserve=1 where livcode ='".$nbr."'");
	$date_debut =date('Y-m-d');
    list($annee, $mois, $jour)=explode('-',$date_debut);
    $jour_supp='5';
    $date_fin = date("Y-m-d", mktime(0, 0, 0, $mois, $jour+$jour_supp, $annee));
	$r=substr($nbr,0,2);
	$u='08976atQm';
	$r.=$u; 
    $pdb->exec("insert into emprunts values('$r','$date_debut','$date_fin','$nbr','$nb')");

	$rep=$pdb->query("select * from emprunts where empcodelivre='".$nbr."'");
	while($a=$rep->fetch()){
	$_SESSION["num"]=$a["empnum"];
 	$_SESSION["dtt"]=$a["empdate"];
	$_SESSION["dtf"]=$a["empdateret"];
	}
	$rep->closeCursor(); 
	
	$t->closeCursor();
	}  
		 ?>

<div id="DRT">
<h3>Votre réservation est confirmée sous le numéro: <?php echo $_SESSION["num"];?></h3>

<br>
<h3>Date de réservation: <?php echo $_SESSION["dtt"];?></h3>
<br>
<h3>Date du retour: <?php echo $_SESSION["dtf"];?></h3>
<br>
<br>
<h2>Vous pouvez revenir à la liste de livre disponible à la réservation en cliquant <form method="POST" action="GestionLecteure.php" ><input type="submit" value="ici" name="goo"></form></h2></div>
</body> 
</html>
<?php

}catch(EXCEPTION $e){die('erreur'.$e->getMessage());}
?>