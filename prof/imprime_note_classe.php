<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id'];?>
<html>
<head>
	
<?php include("connect.php"); 

$matiere=$_GET["matiere"];
$classe=$_GET["classe"];
$query="select * from CLASSE where id_classe='$classe'";
$aclasse=mysql_query($query);
$lclasse=mysql_fetch_array($aclasse);
$nom_classe=$lclasse[1];
$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
$ligne_matiere=mysql_fetch_array($all_matiere);
$all_classe=mysql_query("select * from ELEVE where id_classe='$classe'");
$ligne_classe=mysql_fetch_array($all_classe);
$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere'");
//$ligne_inter=mysql_fetch_array($inter);
$query="select * from CLASSE where id_classe='$classe'";
$aclasse=mysql_query($query);
$lclasse=mysql_fetch_array($aclasse);
$nom_classe=$lclasse[1];
?>
<title>---<?php  print("Classe : ".$nom_classe."	Matiere : ".$ligne_matiere[1]); ?>---</title>
<!-- <link rel="stylesheet" type="text/css" href="style.css">
//-->
</head><body>
<?php
if(mysql_num_rows($inter)){
	print("<center><table border=1 width='100%'><tr><td>N°</td><td>NOM</td><td>Prenom</td>");
	while($ligne_inter=mysql_fetch_array($inter)){
		print("<th>".$ligne_inter[1]."<br><font color='red' size='-1'>coef:".$ligne_inter[2]."</th>");	
	}
	
	print("<th>MOYENNE</th></tr><br>");
	$k=1;
	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe'");
	
	while($ligne_classe=mysql_fetch_array($all_classe)){
		$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere'");
		if($k%2) $bgcolor='springgreen'; else $bgcolor='lightskyblue';
		print("<tr bgcolor=".$bgcolor." font-size:'-1';><td>".$k."</td><td><b>".$ligne_classe[1]."</b></td><td>".$ligne_classe[2]."</td>");
		$i=0;$moy=0;$somme_coef=0;
		while($ligne_inter=mysql_fetch_array($inter)){
			$note_eleve=mysql_query("select * from NOTE,ELEVE,CONTROLE,OBTIENT where CONTROLE.id_matiere='$matiere' and OBTIENT.id_eleve='$ligne_classe[0]' and CONTROLE.id_controle='$ligne_inter[0]' and NOTE.id_note=OBTIENT.id_note and CONTROLE.id_controle=NOTE.id_controle");
			$note_eleve=mysql_fetch_array($note_eleve);
			if(is_null($note_eleve[1])){ print("<td bgcolor='white'><center>ABSENT</td>"); }else{ print("<td bgcolor='white'><center><b>".$note_eleve[1]."</b></center></td>"); }
			if(!is_null($note_eleve[1])){ $i++;$moy+=$note_eleve[1]*$ligne_inter[2]; $somme_coef+=$ligne_inter[2];}
		}
		@$moyTot=$moy/=$somme_coef;
		if($moyTot<9) $color="red"; else $color="blue";
		ereg("([0-9]{1,2})([.]{0,1})([0-9]{0,1})",$moyTot,$aff); 
		print("<td><font size='+2' color='$color'><center><tt><b>".$aff[0]."</center></td></tr>");
		$k++;
	}
	print("</table>");
}
?>
</body>
</html>