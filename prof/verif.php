<?php session_start(); ?>
<html>
<head>
<title>prof_notes</title>

<?php include("connect.php"); ?>	
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<?php
require("ajout_func.php");
if(($comp=strcmp($_POST["type"],'log'))==0){
	print(login($_POST["login"],$_POST["mdp"]));
}
if(($comp=strcmp($_POST["type"],'enseigne'))==0){
	print("Ajout de l'enseignant...");
	print(ajout_enseigne($_POST["nom"],$_POST["prenom"],$_POST["matiere"],$_POST["classe"],$_POST["coef"]));
}
if(($comp=strcmp($_POST["type"],'matiere'))==0){
	print(ajout_matiere($_POST["matiere"]));
	print("<a href='ajout_prof.php'>ajouter un nouveau professeur</a>");
}
if(($comp=strcmp($_POST["type"],'professeur'))==0){
	print(ajout_professeur($_POST["nom"],$_POST["prenom"]));
}

if(($comp=strcmp($_POST["type"],'eleve'))==0){
	print("Ajout d'eleve...<br>");
	print(ajout_eleve($_POST["nom"],$_POST["prenom"],$_POST["classe"]));
}

if(($comp=strcmp($_POST["type"],'grp_eleve'))==0){
	print("Ajout groupe de ".$_POST["nb"]." eleves...<br>");
	for($i=1;$i<=$_POST["nb"];$i++){
	   print(ajout_eleve($_POST["nom".$i],$_POST["prenom".$i],$_POST["classe"]));
	}
}
?>
</html>