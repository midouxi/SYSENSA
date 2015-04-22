<html>
<?php

$nom=$_GET['nom'];
$annee=$_GET['annee'];

include("../connect.php");
$select_eleve=mysql_query("select * from ELEVE where nom_eleve LIKE '$nom%' ORDER BY nom_eleve");
$num=mysql_num_rows($select_eleve);
?>
<h1>Recherche ELEVE</h1><table align='center'><tr><th>NOM</th><th>Prenom</th><th>Classe</th></tr>

<?php
$nb_prof=1;
while($ligne_select=mysql_fetch_array($select_eleve)){
	$select_classe=mysql_query("SELECT * from CLASSE where id_classe='$ligne_select[3]'");
	$nom_classe=mysql_fetch_array($select_classe);
	print("<tr><td>".$ligne_select[1]."</td><td>".mb_convert_encoding($ligne_select[2],"ISO-8859-1")."</td><td>".$nom_classe[1]."</td></tr>");
	$nb_prof++;	
}
print("</table>");

?>
</html>

