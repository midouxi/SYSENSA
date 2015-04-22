
<html>
<head>
<title>GMS</title>
	

</head>
<body bgcolor="lightsteelblue">
<center>
</body>
<?php
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$classe=$_POST["classe"]; 
$matiere=$_POST["matiere"];
$id_classe=mysql_query("select * from CLASSE where nom_classe='$classe'");
$id_professeur=mysql_query("select * from PROFESSEUR where nom_professeur='$nom' and prenom_professeur='$prenom'");
$id_matiere=mysql_query("select * from MATIERE where nom_matiere='$matiere'");

$idclasse=mysql_fetch_array($id_classe);
$idprofesseur=mysql_fetch_array($id_professeur);
$idmatiere=mysql_query($id_matiere);

if($enseigne=mysql_query("insert into ENSEIGNE(id_professeur,id_classe,id_matiere) values('idprofesseur[0]','$idclasse[0]','$idmatiere[0]')")) print("YOUHOUOUOUOUOUOUOUOOUOUOUOUOUOUO"); else print(mysql_error());

?>
<br><a href='ajout.php' >retour</a>
</html>