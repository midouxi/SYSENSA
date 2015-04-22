<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id']; ?>
<html>
<head>

<title>prof_notes</title>	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

<?php $ide=$_GET['ide'];
	$eleve=mysql_query("select * from eleve where id_eleve='$ide'");
	$ligne=mysql_fetch_array($eleve);
	print("eleve ".$ligne[1]." ".$ligne[2]);
	if($prof=mysql_query("select MATIERE.id_matiere,nom_matiere from MATIERE,PROFESSEUR,ENSEIGNE where ENSEIGNE.id_matiere=MATIERE.id_matiere and ENSEIGNE.id_classe='$ligne[3]' and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and PROFESSEUR.id_professeur='$login'")){
		$ligne=mysql_fetch_array($prof);
		$id_matiere=$ligne[0];
		print("Matiere enseigne a la classe :".$ligne[1]);
	}else print(mysql_error());
?>
</html>