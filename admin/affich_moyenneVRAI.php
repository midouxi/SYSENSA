<?php /*session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; */?>
<html>
<head>
<title>prof_notes</title>	
<?php include("../connect.php"); ?>
</head><body>

<?php

?>
<?php
if(isset($_GET["classe"]) && isset($_GET["trimestre"])){
	$trimestre=$_GET["trimestre"];
	$classe=$_GET["classe"];
	//$eleve=$_POST["eleve"];
	//$all_classe=mysql_query("select * from ELEVE where id_eleve='$eleve'");
//	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe'");
	
		$k=1;
//	$ligne_eleve=mysql_fetch_array($all_classe);
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
	$nb_mat=0;
	while($ligne_matiere=mysql_fetch_array($all_matiere)){
	if($matiere_trimestre=mysql_query("select * from MOYENNE_TRIMESTRE,ELEVE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve=ELEVE.id_eleve and ELEVE.id_classe='$classe' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'")){
		$coef_matiere=mysql_fetch_array($matiere_trimestre);
		//$colspan=$trimestre+1;
		$colspan=1;
		print("<td colspan='".$colspan."'>".$ligne_matiere[1]."<br><center>");
		?>
		<a href='#' onclick="ahah('modif_coef.php?matiere=<?php print($ligne_matiere[0]); ?>&classe=<?php print($classe); ?>&trimestre=<?php print($trimestre); ?>&ide=<?php print($coef_matiere['id_eleve']); ?>','bulletin2');" >
		<?php
		print($coef_matiere['coef']."</a></center><br>");
		print("</td>");
		$nb_mat++;

	}else die(mysql_error());
	}
	
	print("<td>MOYENNE<br>Trimestre".$trimestre."</td><th>Moyenne<br />ANNUELLE</th></tr><br>");
	/*print("<tr><td colspan=2></td>");
	for($nbmat=0;$nbmat<$nb_mat;$nbmat++){
		for($trimestre_precedent=1;$trimestre_precedent<$trimestre;$trimestre_precedent++){
			print("<td bgcolor='#DCDCDC'>T".$trimestre_precedent."</td>");
		}
		print("<td>T".$trimestre."</td><td>Moyenne</td>");
	}
	print("<td></td></tr>");*/
	$k=1;
	while($ligne_classe=mysql_fetch_array($all_classe)){
		
		if($k%2) $bgcolor=""; else $bgcolor='lightskyblue';
		print("<tr bgcolor='".$bgcolor."'  style=' font-size : 10px ; '><td><b>".$ligne_classe[1]."</b></td><td>".$ligne_classe[2]."</td>");
		$all_matiere=mysql_query("select * from MATIERE,ENSEIGNE where ENSEIGNE.id_classe='$classe' and ENSEIGNE.id_matiere=MATIERE.id_matiere GROUP BY MATIERE.nom_matiere");
		$total=0;$coef=0;
		//--pour la moyenne generale annuelle
		$moyTotG=0;$moyenne_coef=0;
		//----
		while($ligne_matiere=mysql_fetch_array($all_matiere)){
			$trip=1;$trim_moy_mat=0;$nb_moy_mat_trim=0;
			/*while($trip<$trimestre){
				$eleve=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trip' and MOYENNE_TRIMESTRE.id_eleve='".$ligne_classe[0]."' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
				$eleve_note=mysql_fetch_array($eleve);
				if($eleve_note["moyenne"]!=null && $eleve_note["moyenne"]!='0'){
					$coef+=$eleve_note["coef"];
					//print("<td bgcolor='#DCDCDC' ><center><tt><b>".$eleve_note["moyenne"]."</center></tt></td>");
					$trim_moy_mat+=$eleve_note["moyenne"];$nb_moy_mat_trim++;
					$total+=$eleve_note["moyenne"]*$eleve_note["coef"];
				}//else print("<td>&nbsp;</td>");
				$trip++;
			}*/
			$eleve=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve='".$ligne_classe[0]."' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
				$eleve_note=mysql_fetch_array($eleve);
				if($eleve_note["moyenne"]!=null && $eleve_note["moyenne"]!='0'){
					$coef+=$eleve_note["coef"];$nb_moy_mat_trim++;
					print("<td><center><tt><b>".$eleve_note["moyenne"]."</center></tt></td>");
					$trim_moy_mat+=$eleve_note["moyenne"];
					$total+=$eleve_note["moyenne"]*$eleve_note["coef"];
					/*moyenneANNUELLE*/
					if($nb_moy_mat_trim!=0){
						$moyenne_matiere=$trim_moy_mat/=$nb_moy_mat_trim;
						ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,2})",$moyenne_matiere,$aff_moyenne_matiere); 
						//print("<th>".$aff_moyenne_matiere[0]."</th>");
						$moyenne_generale+=$aff_moyenne_matiere[0]*$eleve_note["coef"];$moyenne_coef+=$eleve_note["coef"];
					}
					/***********************/

				}else print("<td>&nbsp;</td>");
			
			
		}
		if($coef!=0) $moyTot=$total/=$coef;
		if(isset($moyTot)){
			
			
			if($moyTot<9) $color="red"; else $color="blue";
			ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,2})",$moyTot,$aff); 
			//if($aff[0]<'9') $bgcolor="white"; else $bgcolor="";
			print("<td><font color='$color'><b><center>".$aff[0]."</center></b></td>");
			
			
		}
		if($moyenne_coef!=0) $moyTotG=$moyenne_generale/=$moyenne_coef;
		if(isset($moyTotG)){
			
			
			if($moyTotG<9) $color="red"; else $color="blue";
			ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,2})",$moyTotG,$aff); 
			//if($aff[0]<'9') $bgcolor="white"; else $bgcolor="";
			print("<th><center>".$aff[0]."</center></b></th></tr>");
			
			
		}
		$k++;
		$eleve_last=$ligne_classe[0];
	}//fin affichage moyenne eleve
//affichage moyenne genera
		print("<tr><td colspan='2'>MOYENNE GENERALE</td>");
		$all_matiere=mysql_query("select * from MATIERE,ENSEIGNE where ENSEIGNE.id_classe='$classe' and ENSEIGNE.id_matiere=MATIERE.id_matiere GROUP BY MATIERE.nom_matiere");
		$total=0;$coef=0;
		//--pour la moyenne generale annuelle
		$moyTotG=0;$moyenne_coef=0;
		//----
		while($ligne_matiere=mysql_fetch_array($all_matiere)){
			$trip=1;$trim_moy_mat=0;$nb_moy_mat_trim=0;
			while($trip<$trimestre){
				$eleve=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trip' and MOYENNE_TRIMESTRE.id_eleve='".$eleve_last."' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
				$eleve_note=mysql_fetch_array($eleve);
				$coef+=$eleve_note["coef"];
				//print("<td bgcolor='#DCDCDC'><center><tt><b>".$eleve_note["moyenne_classe"]."</center></tt></td>");$total+=$eleve_note["moyenne"]*$eleve_note["coef"];
				$trip++;
				//$trim_moy_mat+=$eleve_note["moyenne"];$nb_moy_mat_trim++;
			}	
			$eleve=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve='".$eleve_last."' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
			$eleve_note=mysql_fetch_array($eleve);
			$coef+=$eleve_note["coef"];
			print("<td><center><tt><b>".$eleve_note["moyenne_classe"]."</center></tt></td>");$total+=$eleve_note["moyenne"]*$eleve_note["coef"];
			if($nb_moy_mat_trim!=0){
				$moyenne_matiere=$trim_moy_mat/=$nb_moy_mat_trim;
				ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,2})",$moyenne_matiere,$aff_moyenne_matiere); 
				//print("<th>".$aff_moyenne_matiere[0]."</th>");
				$moyenne_generale+=$aff_moyenne_matiere[0]*$eleve_note["coef"];$moyenne_coef+=$eleve_note["coef"];
			}
		}
		if($moyenne_coef!=0) $moyTotG=$moyenne_generale/=$moyenne_coef;
		if(isset($moyTotG)){
			
			
			if($moyTotG<9) $color="red"; else $color="blue";
			ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,2})",$moyTotG,$aff); 
			//if($aff[0]<'9') $bgcolor="white"; else $bgcolor="";
			print("<td></td><th><center>".$aff[0]."</center></b></th></tr>");
			
			
		}
		
			
	print("</table>");
	?>	
	<hr width=100%>
	</div>
	<?php	

}//fin if isset classe

?>
</body>
</html>
