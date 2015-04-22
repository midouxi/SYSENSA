<html>
  <head>
 
<SCRIPT language='Javascript'>
</SCRIPT>
    <title>INFORMATION __ GMS</title>
<script type="text/javascript" src="fucntion.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />	
	<link rel="stylesheet" type="text/css" href="style.css">
<style type="text/css">	
<!--
a{
text-decoration : none;
color : #000000;
}
a:hover{
color : #FFFFFF;
}
-->
</style>
  </head>
  <body>
	<script>
	</script>
		<?php
		include("header.php");
		$annee=2006;
		print("<h2>Afficher les informations de l'ann&eacute;e".$annee."</h2>");
		?>
		<table width='100%' >
		<tr><td id="moyenne"  style="vertical-align : top;" colspan="2" >
		<?php	
				include("../connect.php");
				$select_classe=mysql_query("select * from CLASSE ORDER BY nom_classe");
				$num_classe=mysql_num_rows($select_classe);
				print($num_classe." <b>classes :</b> ");
				?>
				<table align='center' style="vertical-align : 'top';"><tr>
				
				<?php
				$i=0;
				while($ligne_classe=mysql_fetch_array($select_classe)){
					
					?>
					<td  bgcolor='#FFFFFF'  style="cursor : pointer" onclick=
					<?php
						$aff=null;
						$aff="<h3>Les eleves de la classe : ".$ligne_classe[1]."<br>"; 
						$select_liste_eleve=mysql_query("select * from ELEVE where id_classe='$ligne_classe[0]' ORDER BY nom_eleve");
						$num_eleve=mysql_num_rows($select_liste_eleve);
						$aff=$aff.$num_eleve." &eacute;l&egrave;ves :</h3> ";
						$aff=$aff."<table align=\'center\'>";
						$aff=$aff."<tr><th>n&#xb0;</th><th>NOM</th><th>Prenom</th></tr>";
						$nb_eleve=1;
						while($ligne_eleve=mysql_fetch_array($select_liste_eleve)){
							$aff=$aff."</tr><tr>";
							$aff=$aff."<td>".$nb_eleve."</td>";
							$aff=$aff."<td>".$ligne_eleve[1]."</td>";
							$aff=$aff."<td>".utf8_encode($ligne_eleve[2])."</td>";
							$nb_eleve++;
						}
						$aff=$aff."</tr></table><br>";
					?>
					"document.getElementById('chercheDiv').innerHTML=<?php print("'".$aff."'"); ?>;" onmouseout="this.style.backgroundColor='';" onmouseover="this.style.backgroundColor='#44FF99';"><?php print($ligne_classe[1]); ?></td>
					<?php
					$i++;
				}
				print("</tr></table>");
			?>
			
	</td></tr>
	<tr>
	<td id="professeur">
		<?php
		$select_professeur=mysql_query("select * from PROFESSEUR ORDER BY nom_professeur");
		$num_professeur=mysql_num_rows($select_professeur);
		print($num_professeur."<b> professeurs <br> </b>");		
		?>	
		<strong>Recherche :</strong><br/>
		<form name='rechercheProf'>
		<input type="text" name="recherche" value="" id="cherche" size="20" style="margin-left: 10px;" tabindex="1" onKeyUp="ahah('chercheProfesseur.php?nom='+this.value+'&annee=<?php print($annee); ?>','chercheDiv');" onClick="ahah('chercheProfesseur.php?nom=&annee=<?php print($annee); ?>','chercheDiv');">
		</form>
	</td>
	<td id="bulletin">
		<?php
		$select_eleve=mysql_query("select * from ELEVE ORDER BY nom_eleve");
		$num_eleve=mysql_num_rows($select_eleve);
		print($num_eleve."<b> &eacute;l&egrave;ves </b><br> ");
		?>	
		<strong>Recherche :</strong><br/>
		<form name='rechercheEleve'>
		<input type="text" name="recherche" value="" id="cherche" size="20" style="margin-left: 10px;" tabindex="1" onKeyUp="ahah('chercheEleve.php?nom='+this.value+'&annee=<?php print($annee); ?>','chercheDiv');" onClick="ahah('chercheEleve.php?nom=&annee=<?php print($annee); ?>','chercheDiv');">
		</form>
	</td>
	</tr></table></center>
	
<div id="chercheDiv">
		</div>
</body>
</html>