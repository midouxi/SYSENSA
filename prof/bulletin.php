<html>
<?php include("connect.php"); ?>
<style type="text/css">
tr{
	height : 50;
}
td{
	border:solid 1px #000000;
	text : bold;
}
table{
	border:solid 1px #000000;
	text-align : center;	
}
p{ font : Tahoma;}

#nobroder{
	border:solid 1px #ffffff;
	text-align : left;	
}
#petit{
	height : 20;
}
</style>

<center>
<table 	cellpadding = 1	cellspacing = 0>
<tr height='30'>
	<td colspan=4><h2 size=+1>INSTITUTION<br>SAINTE JEANNE D'ARC</h2><p>Religieuse de Saint-Joseph de Cluny</p><hr width='30%'>147,Avenue Président Lamine GUEYE<br>B.P. : 2074- DAKAR ( SENEGAL) <br>Tél. : (221) 821 30 52 / 821 67 69</td>
	<td colspan=2 width='60%'><h2>BULLETIN TRIMESTRIEL</h2>
	
	<table id="nobroder" width=100% cellpadding = 0 cellspacing = 0 >
	<tr>
		<td id="nobroder">NOM:&nbsp;</td>
		<td id="nobroder">PRENOM : &nbsp;</td>
	</tr>
	<tr id="petit">
		<td id="nobroder"colspan=2>DATE DE NAISSANCE : &nbsp;</td>
	</tr>
	<tr>
		<td id="nobroder">ANNEE : 2006/2007</td>
		<td id="nobroder" > TRIMESTRE  &nbsp;  CLASSE:</td>
	</tr>
	</table>
	<table id="nobroder">
	<tr id='petit'>
		<td id="nobroder">REDOUBLANT:</td>
		<td id="nobroder">OUI&nbsp;</td>
		<td width=20>&nbsp;</td>
		<td id="nobroder">NON&nbsp;</td>
		<td width=20>&nbsp;</td>
	</tr>
	</table>
	
	</td>
</tr>
<tr>
	<td>DISCIPLINES</td>
	<td>COEF</td>
	<td>MOYENNE<br>ELEVE</td>
	<td>MOYENNE<br>CLASSE</td>
	<td width=25%>APPRECIATION</td>
	<td width=25%>CONSEILS</td>
</tr>
<?php
$list=mysql_query("select * from MATIERE,PROFESSEUR,ENSEIGNE where MATIERE.id_matiere=ENSEIGNE.id_matiere and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and ENSEIGNE.id_classe=13 GROUP BY MATIERE.nom_matiere ORDER BY MATIERE.nom_matiere ASC");
while(list($id,$nom_matiere,,$nom_professeur) = mysql_fetch_row($list)){

?>
<tr>
	<td><b><?php $matiere=strtoupper($nom_matiere); print($matiere); ?></b><br><?php print("M.".$nom_professeur); ?></td>
	<td>&nbsp;</td>	
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<?php 
}
?>
<tr>
	<td colspan=4 ><div align='left'>ABSCENCES : _______________1/2journées</div></td>
	<td colspan=2 >APPRECIATION CONSEIL DE CLASSE</td>
</tr>
<tr>
	<td colspan=4 >MOYENNE TRIMESTRIELLE : ___________</td>
	<td colspan=2 >&nbsp</td>
</tr>
</table>
<?php

?>
</html>