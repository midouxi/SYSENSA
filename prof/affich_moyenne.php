<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>
<title>prof_notes</title>	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<?php
$classe=mysql_query("select * from CLASSE where CLASSE.id_pp='$login'");
$ligne=mysql_fetch_array($classe);
$nb=mysql_num_rows($classe);
?>
<?php
if(isset($_POST["classe"])){
	$classe=$_POST["classe"];
	$k=1;
	        $sql_classe=mysql_query("select * from CLASSE where CLASSE.id_classe='$classe'");
	        $info_classe=mysql_fetch_array($sql_classe);
	
		?>
		<center>	
	<?php
	$all_matiere=mysql_query("select * from MATIERE,ENSEIGNE where ENSEIGNE.id_classe='$classe' and MATIERE.id_matiere=ENSEIGNE.id_matiere GROUP BY MATIERE.nom_matiere");

	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe' order by nom_eleve");
	$nomClasse=mysql_query("select * from CLASSE where id_classe='$classe'");
	$nom=mysql_fetch_array($nomClasse);
	print("<h1>Moyennes de la ".$nom[1]."</h1><br>");
	
	print("<table cellspacing='0'><tr bgcolor='palegreen'><td>NOM</td><td>Prenom</td>");
	while($ligne_matiere=mysql_fetch_array($all_matiere)){
	if($matiere_trimestre=mysql_query("select * from MOYENNE_TRIMESTRE,ELEVE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve=ELEVE.id_eleve and ELEVE.id_classe='$classe' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'")){
		$coef_matiere=mysql_fetch_array($matiere_trimestre);
		print("<td>".$ligne_matiere[1]."<br><center>".$coef_matiere["coef"]."</center></td>");
	}else die(mysql_error());
	}
	
	print("<td>MOYENNE</td></tr><br>");
	$k=1;
	while($ligne_classe=mysql_fetch_array($all_classe)){
		
		if($k%2) $bgcolor=""; else $bgcolor='lightskyblue';
		print("<tr bgcolor='".$bgcolor."'  style=' font-size : 10px ; '><td><b>".$ligne_classe[1]."</b></td><td>".$ligne_classe[2]."</td>");
		$all_matiere=mysql_query("select * from MATIERE,ENSEIGNE where ENSEIGNE.id_classe='$classe' and ENSEIGNE.id_matiere=MATIERE.id_matiere GROUP BY MATIERE.nom_matiere");
		$total=0;$coef=0;
		while($ligne_matiere=mysql_fetch_array($all_matiere)){
			$eleve=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve='".$ligne_classe[0]."' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
			$eleve_note=mysql_fetch_array($eleve);
			if($eleve_note["moyenne"]!=null && $eleve_note["moyenne"]!=0){
				$coef+=$eleve_note["coef"];
				print("<td><center><tt><b>".$eleve_note["moyenne"]."</center></tt></td>");$total+=$eleve_note["moyenne"]*$eleve_note["coef"];
			}else print("<td>&nbsp;</td>");
			
			
		}
		if($coef!=0) $moyTot=$total/=$coef;
		if(isset($moyTot)){
			
			
			if($moyTot<9) $color="red"; else $color="blue";
			ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,2})",$moyTot,$aff); 
			//if($aff[0]<'9') $bgcolor="white"; else $bgcolor="";
			print("<td><font color='$color'><b><center>".$aff[0]."</center></b></td></tr>");
			$k++;
			
		}
		$eleve_last=$ligne_classe[0];
	}
		print("<tr><td colspan='2'>MOYENNE GENERALE</td>");
		$all_matiere=mysql_query("select * from MATIERE,ENSEIGNE where ENSEIGNE.id_classe='$classe' and ENSEIGNE.id_matiere=MATIERE.id_matiere GROUP BY MATIERE.nom_matiere");
		$total=0;$coef=0;
		while($ligne_matiere=mysql_fetch_array($all_matiere)){
		$eleve=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve='".$eleve_last."' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
		$eleve_note=mysql_fetch_array($eleve);
		$coef+=$eleve_note["coef"];
		print("<td><center><tt><b>".$eleve_note["moyenne_classe"]."</center></tt></td>");$total+=$eleve_note["moyenne"]*$eleve_note["coef"];
			
		}
		/*$moyTot=$total/=$coef;
			if($moyTot<9) $color="red"; else $color="blue";
			ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,2})",$moyTot,$aff); 
			//if($aff[0]<'9') $bgcolor="white"; else $bgcolor="";*/
			print("<td><font color='$color'><b><center>&nbsp;</center></b></td></tr>");
			
	print("</table>");
}
?>
</body>
</html>
