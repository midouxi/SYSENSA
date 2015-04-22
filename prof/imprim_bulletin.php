<?php /*session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; */?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8;" />
<title>prof_notes</title>	
<?php include("connect.php"); ?>
<style type="text/css">
html,body {
background-image:url(img/slash.png);
text-align:center;
}
tr{
	height : 50;
}
td{
	border:solid 1px #000000;
	text : bold;
}
table{
	background-color : #FFFFFF;
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

.saut
   {
   /* saut de ligne apres le bloc*/
   page-break-after : always;
  /* saut de ligne avant le bloc*/
   //page-break-before : always;
}

</style>
</head><body>

<?php
$classe=mysql_query("select * from CLASSE where CLASSE.id_pp='$login'");
$ligne=mysql_fetch_array($classe);
$nb=mysql_num_rows($classe);
?>
<?php
if(isset($_POST["classe"])){
	$trimstre=$_POST["trimestre"];
	$classe=$_POST["classe"];
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
	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe' order by nom_eleve");
	while($ligne_eleve=mysql_fetch_array($all_classe)){
		?>
		<div class=saut>		
			<table 	cellpadding = 1	cellspacing = 0>
			<tr height='30'>
			<td colspan=4><center><h2 size=+1>INSTITUTION<br>SAINTE JEANNE D'ARC</h2><p>Religieuses de Saint-Joseph de Cluny</p><hr width='30%'>147,Avenue Pr&eacute;sident Lamine GUEYE<br>B.P. : 2074- DAKAR ( SENEGAL) <br>T&eacute;l. : (221) 821 30 52 / 821 67 69</td>
			<td colspan=2 width='60%'><center><h2>BULLETIN TRIMESTRIEL</h2>			
			<table id="nobroder" width=100% cellpadding = 0 cellspacing = 0 >
			<tr>
				<td id="nobroder"><b>NOM:</b><?php print($ligne_eleve[1]); ?></td>
				<td id="nobroder"><b>PRENOM :</b><?php print($ligne_eleve[2]); ?></td>
			</tr>
			<tr id="petit">
				<td id="nobroder"colspan=2><b>DATE DE NAISSANCE :</b> &nbsp;</td>
			</tr>
			<tr>
				<td id="nobroder"><b>ANNEE :</b> 2006/2007</td>
				<td id="nobroder" ><b>TRIMESTRE :</b> <?php print($trimestre); ?> &nbsp;  <b>CLASSE:</b><?php print($info_classe[1]); ?></td>
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
				<td><center>DISCIPLINES</td>
				<td><center>COEF</td>
				<td><center>MOYENNE<br>ELEVE</td>
				<td><center>MOYENNE<br>CLASSE</td>
				<td width=25%><center>APPRECIATIONS</td>
				<td width=25%><center>CONSEILS</td>
			</tr>
			<?php
			$id_eleve=$ligne_eleve[0];//print("eleve".$id_eleve);
			$moyenne=0;$moyenne_generale=0;$coef=0;
			if($list=mysql_query("select * from MATIERE,PROFESSEUR,ENSEIGNE where MATIERE.id_matiere=ENSEIGNE.id_matiere and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and ENSEIGNE.id_classe='$classe' GROUP BY MATIERE.nom_matiere ORDER BY MATIERE.nom_matiere ASC")){
				while(list($id_matiere,$nom_matiere,,$nom_professeur,$prenom_professeur) = mysql_fetch_row($list)){
					//print("<h1>".$id_matiere."</h1>");
					?>
					<?php 
					//print("<br>".$ligne_eleve[0]."<br>".$id_matiere."<br>");
					$eleve=@mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_eleve='".$id_eleve."' and MOYENNE_TRIMESTRE.id_matiere='".$id_matiere."' and ( moyenne!=0 OR appreciation_generale!='' ) ");
					if(($nb=mysql_num_rows($eleve))>0){
						$ll=mysql_fetch_array($eleve);//print_r($ll);
						?>
						<tr>
							<td><b><?php $matiere=strtoupper($nom_matiere); print($matiere); ?></b><br><?php $p=strtoupper($prenom_professeur[0]); print($p.".".$nom_professeur); ?></td>
							<td><b><?php print($ll["coef"]); ?></b></td>	
							<td><b><?php if($ll["moyenne"]!=0) print($ll["moyenne"]); else print("_");?></b></td>
							<td><b><?php if($ll["moyenne_classe"]!=NULL) print($ll["moyenne_classe"]); else print("_");?></b></td>
							<td><b><?php print(utf8_encode($ll["appreciation_generale"])); ?><b></td>
							<td><b><?php print(utf8_encode($ll["conseil_pour_progresser"])); ?></b></td>		
						</tr>
					<?php
						 if($ll["moyenne"]!=0){
							$moyenne=$ll["moyenne"];
							$moyenne*=$ll["coef"];
							$moyenne_generale+=$moyenne;
							$coef+=$ll["coef"];
						}//fin if!=NULL
						//print("moyenneg=".$moyenne_generale);
					}//fin >0
				$moyenne=0;	
				}//fin while
			}else print(mysql_error());
		?>
		<tr>
			<td colspan=4 ><div align='left'>ABSENCES : _______________1/2journ&eacute;es</div></td>
			<td colspan=2 ><div align='left'>APPRECIATION CONSEIL DE CLASSE</div></td>
		</tr>
		<tr>
			<?php
			$generale=0;
			$generale+=$moyenne_generale;
			$generale/=$coef;
			?>
			<td colspan=4 >MOYENNE TRIMESTRIELLE :  <?php print("  <b>".round($generale,2)."</b>  "); ?> </td>
			<td colspan=2 >&nbsp</td>
		</tr>
	</table>	
	</div>
	<?php	
	}//fin while classe	
}//fin if isset classe

?>
</body>
</html>
