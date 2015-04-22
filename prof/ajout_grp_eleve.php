<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
  <!--
    
    
    function soumettre_form() {
      if ( document.forms.form1.nom1.value == "" || document.forms.form1.prenom1.value== "") {
        alert ("Vous avez des champs vides !! ") ;
        return false ;
      } else {
        document.form1.method = "POST" ;
        document.form1.action = "verif.php" ;
        document.close () ;
        return true ;
      }
    }
        
   //-->
  </SCRIPT>
<title>prof_notes</title>

<?php include("connect.php"); ?>	
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<? if(!isset($_POST["nb"])){ ?>
<form method='post' action='ajout_grp_eleve.php'>
combien d'eleves voulez vous ajouter ? <input type='integer' size='2' maxlength='2' name='nb' value='3'> <br>
dans quelle classe ? <?print("<select name='classe'>");
 $classe=mysql_query("select * from CLASSE where id_pp='$login'");
 while($ligne=mysql_fetch_array($classe)){
 	print("<option value='$ligne[0]'>$ligne[1]");
 }
 print("</select>");
 ?>
<input type='submit' value='afficher'>
</form>
 <? }else{ 
	 $idc=$_POST["classe"];
	 $classe=mysql_query("select * from CLASSE where id_classe=$idc");
	 $ligne=mysql_fetch_array($classe);
	 /* affiche la lise des eleves de la classe */
	 print("<table >");
	$idc=$_POST["classe"];
	
	if($classe=mysql_query("select * from CLASSE where id_classe='$idc'")){
		$ligne=mysql_fetch_array($classe);
		print("<h1>Liste des eleves de la ".$ligne[1]."</h1><br>");
	}else print(mysql_error());
	$eleve=mysql_query("select * from ELEVE where id_classe='$idc' order by nom_eleve asc");
	while($ligne=mysql_fetch_array($eleve)){
		print("<tr><td><b>".$ligne[1]."</b></td><td>".$ligne[2]."</td></tr>");
	}
	/*fin de l'affichage de la liste des eleves*/
	 ?>
	 </table>
	<h1>Ajouter un groupe d'eleves dans la classe</h1>
	<form name='form1'>
	<?php
	$nb=$_POST["nb"];
	?>
	<input type='hidden' name='type' value='grp_eleve'>
	<input type='hidden' name='nb' value=<?php print($nb); ?> >
	<input type='hidden' name='classe' value=<?php print($idc); ?> >
	<?php 
	for($i=1;$i<=$nb;$i++){
		?>
	    NOM : <input type='text' name=<?php print("'nom".$i."'"); ?> >
	    Prenom : <input type='text' name=<?php print("'prenom".$i."'"); ?> ><br>
	<?php
	}
	print("<input type='submit' value='inserer tous les eleves' onClick='soumettre_form()'>");
	print("</form>");
	}
?>
</html>