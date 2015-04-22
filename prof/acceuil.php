<?php
/**-------------------**/
/**----- GMS  v1 -----**/ 
/**-- developped by --**/ 
/** SCHALCK  Baptiste **/ 
/**___________________**/
?>
<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>

<body style="background-image:url(img/slash2.png);background-repeat:repeat;  background-attachment:fixed;"> 
</head>
<body>
<?php 
$prof=mysql_query("select * from PROFESSEUR where id_professeur='$login'");
$ligne=mysql_fetch_array($prof);
print("<H1>Bienvenue ".$ligne[1]."  ".$ligne[2]."</h1>");
?>
<div align='left'>
<div id="horloge"></div>
        <script>
        var dateActuelle = new Date();
        var horloge = document.getElementById("horloge");
        function incrementer2()
                {
                dateActuelle.setTime(dateActuelle.getTime()+1000);
                horloge.innerHTML = "<b>Nous sommes le "+dateActuelle.getDate()+"/"+(dateActuelle.getMonth()+1)+"/"+dateActuelle.getFullYear()+". Il est : "+dateActuelle.getHours()+":"+dateActuelle.getMinutes()+":"+dateActuelle.getSeconds()+"</b>";
                setTimeout(incrementer2, 1000);
                }
        onload = incrementer2;
	</script>
<?php
print("<HR>");
$prof=mysql_query("select * from PROFESSEUR");
$nb_prof=mysql_num_rows($prof);
print("A ce jour, la base de données contient : ".$nb_prof." professeurs, ");
$classe=mysql_query("select * from CLASSE");
$nb_classe=mysql_num_rows($classe);
print(" ".$nb_classe." classes, ");
$matiere=mysql_query("select * from MATIERE");
$nb_mat=mysql_num_rows($matiere);
print(" ".$nb_mat." matieres.<hr>");
// AFFICHAGE DES CLASSES OU PP
if($prof=mysql_query("select * from CLASSE where CLASSE.id_pp='$login'")){
	$nb_pp=mysql_num_rows($prof);
	if($nb_pp>0){
		if($nb_pp>1) print("Vous etes professeur principal des classes :"); else print("Vous etes professeur principal de la classe :");
		while($ligne=mysql_fetch_array($prof)){
			$pp=mysql_query("select * from CLASSE where CLASSE.id_classe='$ligne[0]'");
			while($ligne_pp=mysql_fetch_array($pp)){
				print("<b>".$ligne_pp[1]."</b>  ");
			}
		}
	}
}else print("Vous n'etes pas professeur principal");
//AFFICHAGE DES CLASSES OU ENSEIGNE
if($prof=mysql_query("select * from PROFESSEUR  where PROFESSEUR.id_professeur='$login'")){
	print("<br><br>Vous êtes professeur de :");
	while($ligne=mysql_fetch_array($prof)){
		 $id=$ligne[0];
		 $matiere_prof=mysql_query("select * from MATIERE,ENSEIGNE,PROFESSEUR,CLASSE where PROFESSEUR.id_professeur=ENSEIGNE.id_professeur and CLASSE.id_classe=ENSEIGNE.id_classe and MATIERE.id_matiere=ENSEIGNE.id_matiere and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and PROFESSEUR.id_professeur='$id' GROUP BY MATIERE.id_matiere");
		while($ligne_matiere=mysql_fetch_array($matiere_prof)){
				print("<br>&nbsp;&nbsp; ".$ligne_matiere[1]." en classe ");
				$classe_matiere=mysql_query("select * from CLASSE,ENSEIGNE,MATIERE,PROFESSEUR where ENSEIGNE.id_matiere=MATIERE.id_matiere  and MATIERE.id_matiere='$ligne_matiere[0]' and ENSEIGNE.id_classe=CLASSE.id_classe and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and PROFESSEUR.id_professeur='$id'");
					while($ligne_classe=mysql_fetch_array($classe_matiere)){
							print("<b>".$ligne_classe[1]."</b> ");
					}
				print("</b>");
				}
	}
}else print(mysql_error());
?>
<form action='modif_mdp.php' target='frame2'><input type='submit' value='Modifier votre mot de passe !!'></form>

</div>
</body>
</html>
