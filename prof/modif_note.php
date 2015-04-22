<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id']; ?>
<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>


<?php 


//$nb=mysql_num_rows($);
//$nb_mat=mysql_num_rows($matiere);
//$ligne_mat=mysql_fetch_array($matiere);
if(!isset($_POST["note"])){
	$ide=$_GET["ide"];$idc=$_GET["idc"];$num=$_GET["ne"];

	$eleve=mysql_query("select * from ELEVE where id_eleve='$ide'");
	if(isset($_GET['idn'])){
		$idn=$_GET["idn"];
		$note=mysql_query("select * from NOTE where id_note='$idn'"); 
		$ligne_note=mysql_fetch_array($note);
	}else $ligne_note[1]=0;
	$controle=mysql_query("select * from CONTROLE where id_controle='$idc'");
	print("<h1>modifier une note</h1>");
	print("Pour mettre l'eleve ABSENT, tapez <font color='red'><b>ABSEN</b></font> comme note<br>");
	//$matiere=mysql_query("select * from ENSEIGNE where ENSEIGNE.id_professeur='$login'");
	$ligne_eleve=mysql_fetch_array($eleve);
	$ligne_controle=mysql_fetch_array($controle);
	$idt=$ilgne_controle["id_trimestre"];
	print("<table><tr><th>N°</th><th>NOM</th><th>Prenom</th><th colspan=2>".$ligne_controle[1]."<br><font color='red' size='-1'>coef:".$ligne_controle[2]."</th><tr>");	
	
	print("<tr><td>".$num."</td><td>".$ligne_eleve[1]."</td><td>".$ligne_eleve[2]."</TD><td bgcolor='#CCCCCC'>note actuelle : ".$ligne_note[1]."</td>"); ?>
	<form method='post' action='modif_note.php'>
	<?php /*
<td><center><select name="note" >
					<option value='NULL' > */ 
?>


	 <td><center>
                        <input type='float' name="note"  maxlength='5' size='5'>
        </td>
	</tr></table>
	<input type=hidden name=eleve value=<?php print($ide); ?> >
	<input type=hidden name=controle value=<?php print($idc); ?> >
	<input type=hidden name=trimestre value=<?php print($idt); ?> >
	<?php if(isset($_GET['idn'])) print("<input type=hidden name='note_base' value=".$idn.")>"); ?>
	<input type=submit value="modifier">
	</form>
<?php 
}else{
	$idt=$_POST["trimestre"];
	$ide=$_POST["eleve"];
	$idc=$_POST["controle"];
	$eleve=mysql_query("select * from ELEVE where id_eleve='$ide'");
	$controle=mysql_query("select * from CONTROLE where id_controle='$idc'");
	$note=$_POST["note"];
	//$matiere=mysql_query("select * from ENSEIGNE where ENSEIGNE.id_professeur='$login'");
	$ligne_eleve=mysql_fetch_array($eleve);
	
	$ligne_controle=mysql_fetch_array($controle);
	if(isset($_POST["note_base"])){
		$idn=$_POST["note_base"];
		$note_prec=mysql_query("select * from NOTE where id_note='$idn'");
		$ligne_note=mysql_fetch_array($note_prec);

		if($note=='ABSEN'){
			$del_obtient=mysql_query("delete from OBTIENT where id_note='$ligne_note[0]'");
			$del=mysql_query("delete from NOTE where id_note='$ligne_note[0]'");
			print("<h2>la note de ".$ligne_eleve[1]." ".$ligne_eleve[2]." pour le controle ".$ligne_controle[1]." a ete supprime avec succes ! </h2>");
		}else{
			if(mysql_query("update NOTE set note='$note' where id_note='$ligne_note[0]'"))	print("<h2>la note de ".$ligne_eleve[1]." ".$ligne_eleve[2]." pour le controle ".$ligne_controle[1]." etait <font color='blue'>".$ligne_note[1]."</font>. <br>Elle a maintenant :<font color='red'>".$note."</font>");
			else print(mysql_error());
		}
	}else{	
		if($note!='ABSEN'){
			if(mysql_query("insert into NOTE(note,id_controle) values(".$note.",".$idc.")")) print("<br>");  else print("NOTE".mysql_error());
			if(mysql_query("insert into OBTIENT(id_eleve,id_note) value(".$ide.",".mysql_insert_id().")")) print("<H2>la note de ".$ligne_eleve[1]." ".$ligne_eleve[2]." pour le controle ".$ligne_controle[1]."est de ".$note."</h2>");  else print("PUET".mysql_error());		
		}
	}

	$eleve=mysql_query("select * from ELEVE where id_eleve='$ide'");
        $ligne_eleve=mysql_fetch_array($eleve);
	

?>
	<form method='POST' action='affich_note_classe.php'>
	<input type='hidden' name='trimestre' value=<?php print("'".$ligne_controle["id_trimestre"]."'"); ?> >
	<input type='hidden' name='idm' value=<?php print("'".$ligne_controle["id_matiere"]."'"); ?> >
	<input type='hidden' name='idc' value=<?php print("'".$ligne_eleve["id_classe"]."'"); ?> >
	<input type='submit' value='retour a la liste des notes'>
	<?php
}
 ?>
</html>
