<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<?php
//$prof=mysql_query("select * from PROFESSEUR where id_professeur='$login");
if($prof=mysql_query("select * from PROFESSEUR  order by nom_professeur asc")){
	//print("<h1>Liste des professeurs</h1>");
	//print("<table><tr><th>NOM  Prenom</th><th>MATIERE</th><th>classe</th></tr>");
	print("<table>");
	while($ligne=mysql_fetch_array($prof)){
		 $id=$ligne[0];if($id==$login) $bgcolor='lightsalmon'; else $bgcolor='lightskyblue';
		 $matiere_prof=mysql_query("select * from MATIERE,ENSEIGNE,PROFESSEUR,CLASSE where PROFESSEUR.id_professeur=ENSEIGNE.id_professeur and CLASSE.id_classe=ENSEIGNE.id_classe and CLASSE.id_pp='$login' and MATIERE.id_matiere=ENSEIGNE.id_matiere and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and PROFESSEUR.id_professeur='$id' GROUP BY MATIERE.id_matiere");
		//for($i=0;$i<mysql_num_rows($matiere_prof);$i++){
//		$i=0;
		while($ligne_matiere=mysql_fetch_array($matiere_prof)){
				print("</tr><tr><td colspan='2' bgcolor='$bgcolor'><center><b> ".$ligne[1]." ".$ligne[2]." enseigne </td></tr>");
				print("<td bgcolor='palegreen' colspan='2' ><b><center>".$ligne_matiere[1]."</center></td></tr>");
				$classe_matiere=mysql_query("select * from CLASSE,ENSEIGNE,MATIERE,PROFESSEUR where ENSEIGNE.id_matiere=MATIERE.id_matiere  and MATIERE.id_matiere='$ligne_matiere[0]' and ENSEIGNE.id_classe=CLASSE.id_classe and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and PROFESSEUR.id_professeur='$id'");
					while($ligne_classe=mysql_fetch_array($classe_matiere)){
						//print_r($ligne_classe);
						//for($j=0;$j<mysql_num_rows($classe_matiere);$j+=2){
							//print("<td bgcolor='white' colspan='2' ><b><center>".$ligne_classe[7]."</center></td></tr>");
							print("<tr><td></b> dans la classe de <b>".$ligne_classe[1]."</td></tr>");
							//$j++;// else $j+=3;
						//}
						
					//$i++;
					//print("</tr>");
					}
				}
				//}else print(mysql_error());
			
			//}
			//print("</tr><tr><td><b> ".$ligne[1]." ".$ligne[2]."</td>");

		//}
	//}else print(mysql_error());
	}
	print("</table>");
}else print(mysql_error());
?>
</html>