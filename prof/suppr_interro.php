<?php session_start(); $login=$_SESSION["id"]; ?>
<html>
<head>

<title>prof_notes</title>	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<?php
$matiere=$_POST["matiere"];
$classe=$_POST["classe"];
$inter=$_POST["inter"];
$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
$ligne_matiere=mysql_fetch_array($all_matiere);
$all_classe=mysql_query("select * from CLASSE,ENSEIGNE where CLASSE.id_classe=ENSEIGNE.id_classe and ENSEIGNE.id_professeur='$login' and CLASSE.id_classe='$classe'");
$ligne_classe=mysql_fetch_array($all_classe);
$del_inter=mysql_query("delete from CONTROLE where id_controle='$inter'");

$all_note=mysql_query("select * from NOTE where id_controle='$inter'");
while($ligne_note=mysql_fetch_array($all_note)){
	$del_obtient=mysql_query("delete from OBTIENT where id_note='$ligne_note[0]'");
}
$del_note=mysql_query("delete from NOTE where id_controle='$inter'");

?>	
<h1>L'interrogation <font color='red'><?php print($_POST["inter_nom"]); ?></font> a été supprimée avec succès!</h1>
</html>