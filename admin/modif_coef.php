
<html>
<head>

<title>prof_notes</title>	
<?php include("../connect.php"); ?>
<link rel="stylesheet" type="text/css" href="../style.css">
</head><body>

</body>
<?php
if(isset($_GET['nouveau_coef'])){
	$new=$_GET['nouveau_coef'];
	$matiere=$_GET['matiere'];
	$trimestre=$_GET['trimestre'];
	$classe=$_GET['classe'];
	$select_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere' ");
	$ligne_matiere=mysql_fetch_array($select_matiere);
	$select_classe=mysql_query("select * from CLASSE where id_classe='$classe' ");
	$ligne_classe=mysql_fetch_array($select_classe);
	$select_inter=mysql_query("select * from MOYENNE_TRIMESTRE,ELEVE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve=ELEVE.id_eleve and ELEVE.id_classe='$classe' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
	while($ligne=mysql_fetch_array($select_inter)){
		if(mysql_query("update MOYENNE_TRIMESTRE set coef='$new' where id_moyenne='".$ligne['id_moyenne']."' and id_matiere='$matiere'and id_trimestre='$trimestre'")) print(""); else print(mysql_error());	
	}
	?>
	<a href='#' onclick="ahah('affich_moyenne.php?classe='+<?php print($classe); ?>+'&trimestre='+<?php print($trimestre); ?>+'','bulletin2');">RETOUR</a>
	<?php
}else{
	$matiere=$_GET["matiere"];$trimestre=$_GET["trimestre"];$ide=$_GET['ide'];$classe=$_GET['classe'];
	$select_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere' ");
	$ligne_matiere=mysql_fetch_array($select_matiere);
	$select_inter=mysql_query("select * from MOYENNE_TRIMESTRE,ELEVE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve='$ide' and ELEVE.id_classe='$classe' and MOYENNE_TRIMESTRE.id_matiere='".$ligne_matiere["id_matiere"]."'");
	$ligne_inter=mysql_fetch_array($select_inter);
	print("<h1>MODIFIER LE COEFFICIENT DE L'INTERROGATION</h1>");
	print("<h2>La matiere <font color='blue'>".$ligne_matiere[1]."</font> pour le trimestre ".$trimestre." a comme coefficent <font color='red'>".$ligne_inter['coef']."</font><br><br>");
	print("<form method='GET' name='choix_coef'>");
	print("Quel le nouveau coefficent ? ");
	print("<select name='nouveau_coef'>");
	for($i=0.5;$i<=9;$i+=0.5){ 
			print("<option value=".$i);if($i==1) print(" selected >"); else print(">");
			print($i);
	}
	print("<input type='hidden' value=".$classe." name='classe'>");
	print("<input type='hidden' value=".$matiere." name='matiere'>");
	print("<input type='hidden' value=".$trimestre." name='trimestre'>");
	?>
	</select><br><input type=submit value='enregistrer' onClick="ahah('modif_coef.php?nouveau_coef='+document.forms.choix_coef.nouveau_coef.value+'&matiere='+document.forms.choix_coef.matiere.value+'&classe='+document.forms.choix_coef.classe.value+'&trimestre='+document.forms.choix_coef.trimestre.value,'bulletin2');">
	
	<?php print("</form>");
}
?>	

</html>
