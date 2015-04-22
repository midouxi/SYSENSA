<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<h1>Liste des professeurs</h1>
	<form>
	Voir la classe : <select onChange="document.location=this.options[this.selectedIndex].value">
	<option>CHOIX
	 <?php
	 $classe=mysql_query("select * from CLASSE,ENSEIGNE,PROFESSEUR where PROFESSEUR.id_professeur=ENSEIGNE.id_professeur and CLASSE.id_classe=ENSEIGNE.id_classe and PROFESSEUR.id_professeur='$login' GROUP BY CLASSE.id_classe");
	 while($ligne=mysql_fetch_array($classe)){?>
	 	<option value="affich_prof.php?idc=<?php print($ligne[0]); ?>" ><?php print($ligne[1]); ?>
	 <?php
	 }
	 ?>
	 </select>
	 </form>
	<?php if(isset($_GET['idc'])){
		$classe=$_GET['idc'];
		$fiche=mysql_query("select * from CLASSE where id_classe='$classe'");
		$ligne=mysql_fetch_array($fiche);print("<h2>CLASSE : ".$ligne[1]."</h2>");
		if($prof=mysql_query("select * from PROFESSEUR,ENSEIGNE where PROFESSEUR.id_professeur=ENSEIGNE.id_professeur and ENSEIGNE.id_classe='$classe' GROUP BY PROFESSEUR.nom_professeur,PROFESSEUR. prenom_professeur order by nom_professeur asc")){
		print("<table><tr><th>NOM  Prenom</th><th>MATIERE</th></tr>");
		//print("<table>");
		while($ligne=mysql_fetch_array($prof)){
			 $id=$ligne[0];if($id==$login) $bgcolor='lightsalmon'; else $bgcolor='lightskyblue';
			 $matiere_prof=mysql_query("select * from MATIERE,ENSEIGNE,PROFESSEUR,CLASSE where PROFESSEUR.id_professeur=ENSEIGNE.id_professeur and CLASSE.id_classe=ENSEIGNE.id_classe and MATIERE.id_matiere=ENSEIGNE.id_matiere and CLASSE.id_classe='$classe' and PROFESSEUR.id_professeur='$id' GROUP BY MATIERE.nom_matiere asc");
			 while($ligne2=mysql_fetch_array($matiere_prof)){
			 print("<tr><td bgcolor='$bgcolor'><b>".$ligne[1]." ".$ligne[2]."</b></td><td>".$ligne2['nom_matiere']."</td></tr>");
			}
				
	
			
		
		}
	print("</table>");
	$fiche=mysql_query("select * from CLASSE,PROFESSEUR where PROFESSEUR.id_professeur=CLASSE.id_pp and id_classe='$classe'");
	$ligne=mysql_fetch_array($fiche); print("<tt><font size='+2'>Professeur principal : <b>".$ligne['nom_professeur']." ".$ligne['prenom_professeur']."</b></tt></font>");
	}else print(mysql_error());
}
?>
</body>
</html>