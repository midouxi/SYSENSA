<html>
<?php

$nom=$_GET['nom'];
$annee=$_GET['annee'];

include("../connect.php");
$select=mysql_query("select * from PROFESSEUR where nom_professeur LIKE '$nom%' ORDER BY nom_professeur");
$num=mysql_num_rows($select);
?>
<table align='center'><tr><th>n&#xb0;</th><th>NOM</th><th>Prenom</th></tr>
<?php
$nb_prof=1;
while($ligne_select=mysql_fetch_array($select)){
	print("<tr><td>".$ligne_select[0]."</td><td>".$ligne_select[1]."</td><td>".$ligne_select[2]."</td></tr>");
	$nb_prof++;	
}
print("</table>");

?>
</html>