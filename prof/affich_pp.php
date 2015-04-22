<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; ?>
<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<?php
$prof=mysql_query("select * from PROFESSEUR,CLASSE where PROFESSEUR.id_professeur=CLASSE.id_pp GROUP by PROFESSEUR.nom_professeur,PROFESSEUR.prenom_professeur asc");
print("<h1>Liste des professeurs principaux</h1>");
print("<table><tr><th>NOM Prenom</th><th>Classe(s)</tr>");
while($ligne=mysql_fetch_array($prof)){
	print("</tr><tr><td><b>".$ligne[1]." ".$ligne[2]."</td><b><td bgcolor='white'>");
	$pp=mysql_query("select * from CLASSE where CLASSE.id_pp='$ligne[0]'");
	while($ligne_pp=mysql_fetch_array($pp)){
		 print("<b>".$ligne_pp[1]."</b>  ");
	}
	print("</td></tr>");
}
?>
</table>
</html>