<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>

<title>prof_notes</title>	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
<script language="javascript">
function process_keydown(e,nextObject) {
	if(window.event){
		if (window.event.type == "keydown" && window.event.keyCode == 13)
		window.event.keyCode=9;
	}
	if(e){
		if (e.type == "keydown" && e.keyCode == 13){
			alert("prochain="+nextObject.focus());
			if(nextObject) nextObject.focus();
			else return false;
		}
     	}
}
document.onkeydown = process_keydown;

function is_numeric(num)
	{
		var exp = new RegExp("^[0-9-.]+$","g");
		return exp.test(num);
	}
</script>

</head><body>

</body>
<?php
if($_POST["matiere"]=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de matiere !!');eval(document.location.href='ajout_note.php');</script>");
if($_POST["classe"]=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de classe !!');eval(document.location.href='ajout_note.php');</script>");

$matiere=$_POST["matiere"];
$classe=$_POST["classe"];
$trimestre=$_POST["trimestre"];
$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
$ligne_matiere=mysql_fetch_array($all_matiere);
$all_classe=mysql_query("select * from CLASSE,ENSEIGNE where CLASSE.id_classe=ENSEIGNE.id_classe and ENSEIGNE.id_professeur='$login' and CLASSE.id_classe='$classe'");
$ligne_classe=mysql_fetch_array($all_classe);
?>

<h2>Ajout de notes de <font color='blue'><?php print($ligne_matiere[1]); ?></font> pour la classe <font color='blue'><?php print($ligne_classe[1]); ?></font></h2>
<?php

if($obtient=mysql_query("select * from OBTIENT where id_classe='$classe' and id_matiere='$matiere'")){
	affich_note($matiere,$classe);
}
if(!isset($_POST['coef'])){
	print("<form method='post' action='ajout_note_classe.php'>"); 
	/*$nom_cont=mysql_query("select * from CONTROLE where CONTROLE.id_matiere=".$_POST["matiere"]);
	if(($nb=mysql_num_rows($nom_cont))>0){
		print("<font size='+1'>Interrogation existante en ".$ligne_matiere[1].":<br>");
		while($ligne_matiere=mysql_fetch_array($nom_cont)){
			print("<font color='blue'>".$ligne_matiere[1]."</font><br>");
		}
	}*/	
	?>
	<table><tr><td bgcolor='pink'>Nom du controle : <input type='text' maxlength='20' name='nom_control' value=<?php print("'".date("d/m/Y")."'"); ?> ></td></tr>
	<tr><td bgcolor='pink'><u><font color='red'><center>coefficient :</u><select name='coef'>
	<?php for($i=0.5;$i<=4;$i+=0.5){ 
		print("<option value=".$i);if($i==1) print(" selected >"); else print(">");
		print($i);
	}
	$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
	$ligne_matiere=mysql_fetch_array($all_matiere);	
	print("</select></td></tr><tr><td><center>Trimestre:<select name='trimestre'>");
	$trim_choix=mysql_query("SELECT * from TRIMESTRE");
	while($ligne_trim_choi=mysql_fetch_array($trim_choix)){
		print("<option value=".$ligne_trim_choi[0]);if($ligne_trim_choi[1]==$trimestre) print(" selected");print(">".$ligne_trim_choi[1]);
	}
	print("</select></td></tr></table>");
	print("<table width='30%'><tr><th rowspan='2'>N&#xb0;</th><th rowspan='2'> NOM</th><th rowspan='2'>Prenom</th>");
	
	$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere' and id_classe='$classe' and id_trimestre='$trimestre'");
	if(($nb_inter=mysql_num_rows($inter))>1) print("<td bgcolor='#CCCCCC' colspan='".$nb_inter."'><center>interrogations existantes</center></td>"); 
	if(($nb_inter=mysql_num_rows($inter))==1) print("<td bgcolor='#CCCCCC' colspan='".$nb_inter."'><center>interrogation existante</center></td>");
	
	print("<td bgcolor='white' rowspan='2'><tt><b>".$ligne_matiere[1]."</center></tt></b></td></tr>");
	print("<tr>");

		while($ligne_inter=mysql_fetch_array($inter)){
			print("<td bgcolor='#DCDCDC'><b><font color='blue'><center>".$ligne_inter[1]."</center></b></td>");
		}
	print("</tr>");
	if($eleve=mysql_query("select * from ELEVE where id_classe='$classe' order by nom_eleve asc")){
		$i=1;
		while($ligne_eleve=mysql_fetch_array($eleve)){
			if($i%2) $bgcolor=""; else $bgcolor='lightskyblue';
			
			print("<tr bgcolor='$bgcolor'><td>".$i."</td><td><b>".$ligne_eleve[1]."</b></td><td>".$ligne_eleve[2]."</td>");
			
			
			
/////////////////////////////////////////////////////////////////////affich les notes des interrogations enregistrées
			$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere' and id_classe='$classe' and id_trimestre='$trimestre'");
			while($ligne_inter=mysql_fetch_array($inter)){
				$note_eleve=mysql_query("select * from NOTE,ELEVE,CONTROLE,OBTIENT,TRIMESTRE where CONTROLE.id_matiere='$matiere' and OBTIENT.id_eleve='$ligne_eleve[0]' and CONTROLE.id_controle='$ligne_inter[0]' and NOTE.id_note=OBTIENT.id_note and CONTROLE.id_controle=NOTE.id_controle and CONTROLE.id_trimestre='$trimestre'");
				$note_eleve=mysql_fetch_array($note_eleve);
				if($i%2) $bgcolor="#ECECEC"; else $bgcolor='#CCCCCC';
				if(is_null($note_eleve[1])){ print("<td bgcolor=$bgcolor><center>ABSENT</center></td>"); }else{ print("<td bgcolor=$bgcolor><center><b>".$note_eleve[1]."</b></center></td>"); }
				//if(!is_null($note_eleve[1])){ $i++;$moy+=$note_eleve[1]*$ligne_inter[2]; $somme_coef+=$ligne_inter[2];}
			}
/////////////////////////////////////////////////////////////////////////
		
			?>
			
			
			
			
			<td><center>
			<input type='float' name=<?php $j=$i+1;print("'note".$i."'"); ?> maxlength='5' size='5' onKeyDown ='process_keydown(event,<?php print("note".$j); ?> )'  >
			</td></tr>
		<?php
		$i++;
		}

		
	}else print(mysql_error());	
	?>
	</table>
	<?php
	print("<input type='hidden' value='".--$i."' name='nb_eleve'>");
	print("<input type='hidden' value='".$ligne_classe[0]."' name='classe'>");
	print("<input type='hidden' value='".$ligne_matiere[0]."' name='matiere'>");
	?>
	<input type=submit value='enregistrer'>
	</form>
	
	<form action='acceuil.php'>
	<input type=submit value='annuler'>
<?php 
}else{
	print("nom_controle : ".$_POST["nom_control"]." et coef :".$_POST["coef"]." pour le trimestre ".$_POST["trimestre"]."<br>");
	if($eleve=mysql_query("select * from ELEVE where id_classe='$classe' order by nom_eleve asc")) print("ok<br>"); else print(mysql_error()." ".__LINE__."<br>");
	if($note_inser=mysql_query("insert into CONTROLE(nom_controle,coefficient,id_matiere,id_classe,id_trimestre) values('".$_POST['nom_control']."',".$_POST['coef'].",".$_POST["matiere"].",".$_POST["classe"].",".$_POST["trimestre"].")")) print("ok<br>"); else print(mysql_error()."ici ".__LINE__."<br>");
	if($id_controle=mysql_insert_id()) print("<h1>Les notes ont ete inserees avec succes</h1>"); else print(mysql_error()." ".__LINE__."<br>");
	$i=1;
	while($ligne=mysql_fetch_array($eleve)){
		if(($_POST['note'.$i]>= 0 && $_POST['note'.$i]<= 20) || $_POST['note'.$i] == NULL ){
			mysql_query("insert into NOTE(note,id_controle) values(".$_POST['note'.$i].",".$id_controle.")");
			mysql_query("insert into OBTIENT(id_eleve,id_note) value(".$ligne[0].",".mysql_insert_id().")");
			$i++;
		}else{
			?>
				<script language='javascript'>
					alert('Note '+<?php echo($_POST['note'.$i]); ?>+' invalide'); 
				</script>
			<?php
			$i++;
		}
	}
}
?>	
</html>
