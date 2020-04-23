<?php SESSION_START();

	   try{
	 $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
	 $pdb=new PDO('mysql:host=localhost;dbname=id13342074_librairie','id13342074_root','JJZ&|Sj3uqRhlt{h',$pdo_options);
	
	
 
 
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="M.css" type="text/css"> 
</head>
<body>
<h1 class="ml2">Gestion du lecteur</h1>
    <?php  
     if(isset($_POST["go"])){
       $nom=$_POST["nom"];
	   $password=$_POST["password"];
       $reponse=$pdb->query("select lecnum from lecteurs where  lecnom='".$nom."' and lecmotdepasse='".$password."'");
       while($do=$reponse->fetch()){
	  $numéro=$do["lecnum"];
	  $_SESSION["numéro"]=$do["lecnum"];
                                   }
	 $reponse->closeCursor();}
	 
	 
	 $pdostat=$pdb->prepare('SELECT * FROM livres WHERE livcode in (select
	empcodelivre FROM emprunts where empnumlect=:code)');
	$pdostat->bindValue('code',$_SESSION["numéro"],PDO::PARAM_STR);

	$pdostat->execute();
	$con=$pdostat->fetchAll();
	 
	 
	 
	 
	 
	 
	 
	 if(isset($_POST["goo"])){
		 $rop=$pdb->query("select * from emprunts");
		 while($di=$rop->fetch()){
	        $numéro=$di["empnumlect"];
				}
				$rop->closeCursor();
	 }
	 
	       if(isset($numéro)){
	    echo '<h2>le lecteur n°   '.$numéro.' est reconnu </h2><br>';
	  $reponse=$pdb->query("select * from livres where livdejareserve=0");
		$do=$reponse->fetchAll();
	  ?>
	<table border="2"bgcolor="Wheat" height="40"><caption align="top" >Voici la liste des ouvrages disponibles à la réservation</caption>
	<tr  style="font-weight:bold" align="center">
	<td>CodeLivre</td>
	<td>NomAuteur</td>
	<td>PrenomAuteur</td>
	<td>Titre</td>
    <td>Catégorie</td>
	<td>ISBN</td>
	<td></td>
	</tr>
	<tr align="center">

			 <?php foreach ($do as $contact2 ): ?>
                      
                   
                    <tr>
                          <td style="width: 120px"><?= $contact2['livcode']?></td>
                          <td style="width: 120px"><?= $contact2['livnomaut']?></td>
                          <td style="width: 120px"><?= $contact2['livprenomaut']?></td>
                          <td style="width: 120px"><?= $contact2['livtitre']?></td>
                          <td style="width: 120px"><?= $contact2['livcategorie']?></td>
                          <td style="width: 120px"><?= $contact2['livISBN']?></td>
						  <td style="width: 120px"><a href="ReserverUnLivre.php?numContact=<?php echo $contact2['livcode'] ?>">
						  <input class="submit" type="submit" name="reserver"  value="Réserver"></a></td>
                    
                    </tr>
              
			 <?php endforeach; ?>
	</tr>
	</table>
	
	
	<table border="2" bgcolor="wheat" height="40">
	<caption align="top">Voici  la liste de réservation</caption>
	<tr  style="font-weight:bold" align="center">
	<td>CodeLivre</td>
	<td>NomAuteur</td>
	<td>PrenomAuteur</td>
	<td>Titre</td>
    <td>Catégorie</td>
	<td>ISBN</td>
	</tr>
	<tr style="font-weight:bold" align="center"><?php 

	?>
	</tr>
		
        
			 <?php foreach ($con as $contact2 ): ?>
                      
                   
                    <tr>
                          <td style="width: 120px"><?= $contact2['livcode']?></td>
                          <td style="width: 120px"><?= $contact2['livnomaut']?></td>
                          <td style="width: 120px"><?= $contact2['livprenomaut']?></td>
                          <td style="width: 120px"><?= $contact2['livtitre']?></td>
                          <td style="width: 120px"><?= $contact2['livcategorie']?></td>
                          <td style="width: 120px"><?= $contact2['livISBN']?></td>
						
                    </tr>
              
			 <?php endforeach; ?>	</table>
<?php 
}else{ 
?>
<table align="center"><tr><td><h2>le lecteur n'est pas reconnu cliquer <a href="index.php">ici </a>pour tenter une nouvelle identification</h2></td></tr>
<form method="POST" action="ValideLecteur.php">
<table id="t" align="center"cellpadding="0" width="50">
<caption align="center">Enregistrement d'un lecteur</br>
Si vous êtes un nouveau lecteur,veuillez vous enregistrer en remplissant le formulaire ci-dessous :</caption>
<tr><td width="40" id="z">NOM:</td><td width="60"><input type="text" name="nom" id="n" size="60"></td></tr>
<tr><td width="40" id="y">Prenom:</td><td width="60"><input type="text" name="prenom" id="p" size="60"></td></tr>
<tr><td width="40" id="w">Mot de passe:</td><td width="60"><input type="password" name="password" id="d" size="60"></td></tr>
<tr><td width="40" id="i">Code lecteur:</td><td width="60"><input type="text" name="codd" id="j" size="60"></td></tr>
<tr><td width="40" id="x">Adresse:</td><td width="60"><input type="text" name="Adresse" id="a" size="60"></td></tr>
<tr><td width="40" id="s">Ville:</td><td width="60"><input type="text" name="ville" id="v" size="60"></td></tr>
<tr><td width="40" id="u">Code Postale:</td><td width="60"><input type="text" name="Code_postale" id="c" size="60"></td></tr>
<tr><td width="40"><div id="e"><input type="submit" name="go1" value="valider"size="30"></td></tr>
</form></table></body></html>
<?php 

 }	 
}catch(EXCEPTION $e){die('Erreur'.$e->getMessage());}
 ?>

