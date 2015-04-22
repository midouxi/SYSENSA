<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id']; ?>
<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

<h1>modifier le nom de l'interrogation</h1>

<?php 


//$nb=mysql_num_rows($);
//$nb_mat=mysql_num_rows($matiere);
//$ligne_mat=mysql_fetch_array($matiere);
if(!isset($_POST["name"])){
	$id_inter=$_GET["id_c"];

	$controle=mysql_query("select * from CONTROLE where id_controle='$id_inter'");
	
	//$matiere=mysql_query("select * from ENSEIGNE where ENSEIGNE.id_professeur='$login'");
	//$ligne_eleve=mysql_fetch_array($eleve);
	$ligne_controle=mysql_fetch_array($controle);
	print("<table><tr><th>Nom actuel du controle : ".$ligne_controle[1]."</th></tr>");	
	
	?>
	<form method='post' action='modif_nom_inter.php'>
	
	<tr><td bgcolor='pink'>NOUVEAU Nom du controle : <input type='text' maxlength='20' name='name' value=<?php print("'".date("d/m/Y")."'"); ?> ></td></tr>
	</tr></table>
	<input type='hidden' name="controle" value=<?php print("'".$id_inter."'"); ?> >
	<input type='hidden' value=<?php print("'".$ligne_controle[1]."'"); ?> name='old_name' >
	<input type=submit value="modifier">
	</form>
<?php 
}else{
	$nouveau_nom=$_POST["name"];$idc=$_POST["controle"];$old=$_POST["old_name"];
	//$eleve=mysql_query("select * from ELEVE where id_eleve='$ide'");
	$controle=mysql_query("select * from CONTROLE where id_controle='$idc'");
	//$note=$_POST["note"];
	//$matiere=mysql_query("select * from ENSEIGNE where ENSEIGNE.id_professeur='$login'");
	//$ligne_eleve=mysql_fetch_array($eleve);;
	$ligne_controle=mysql_fetch_array($controle);
	//$idn=$_POST["note_base"];
	//$note_prec=mysql_query("select * from NOTE where id_note='$idn'");
	//$ligne_note=mysql_fetch_array($note_prec);
	if(mysql_query("update CONTROLE set nom_controle='$nouveau_nom' where id_controle=$idc")) print("Le nom du controle<h3> ".$old." </h3>a été remplacé par  : <h2>".$nouveau_nom."<h2>");
 	else print(mysql_error());
}
 ?>
 <br><a href='affich_note.php'>retour aux notes</a>
</html>