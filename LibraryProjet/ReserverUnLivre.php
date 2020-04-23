<?php  SESSION_START();
try{
$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
$pdb=new PDO('mysql:host=localhost;dbname=id13342074_librairie','id13342074_root','JJZ&|Sj3uqRhlt{h',$pdo_options);

$id=$_GET['numContact'];

  $pdostat1=$pdb->prepare("select * from livres where livcode=:num LIMIT 1 ");

 
  $pdostat1->bindValue('num',$id,PDO::PARAM_STR);

  
  $pdostat1->execute();

  $contacts= $pdostat1->fetch();
 
$_SESSION['idcode']=$contacts['livcode'];
  
?>
<!DOCTYPE html>


<html>
<head>
<title></title>
<link rel="stylesheet" href="M.css" type="text/css">
</head>
<body>
<h1>Réserver un livre</h1>
<h2>Vous désirez réserver le livre suivant : </h2>
<table border="2" color="gray" bgcolor="peachPuff" width="20">
<tr id="NO">
<td>Code de livre</td>
<td><?php  echo $contacts["livcode"] ?></td>
</tr>
<tr id="PO">
<td>Nom de l'auteur</td>
<td><?php  echo $contacts["livnomaut"] ?></td>
</tr>
<tr id="HO">
<td>Prénom de l'auteur</td>
<td><?php  echo $contacts["livprenomaut"] ?></td>
</tr>
<tr id="KO">
<td>Titre</td>
<td><?php  echo $contacts["livtitre"] ?></td>
</tr>
<tr id="RO">
<td>Categorie</td>
<td><?php  echo $contacts["livcategorie"] ?></td>
</tr>
<tr id="LO">
<td>ISBN</td>
<td><?php  echo $contacts["livISBN"] ?></td>
</tr>
</table>
<form method="POST" action="ConfirmationReservation.php" >
<input type="submit" value="Confirmer" name="conf">
</form>
</body>
</html>
<?php
}catch(EXCEPTION $e){die('erreur'.$e->getMessage());}
?>