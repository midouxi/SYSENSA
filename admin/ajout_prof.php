
<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
  <!--
    
    
    function soumettre_form() {
      if ( document.forms.form1.nom.value == "" || document.forms.form1.prenom.value== "") {
        alert ("Vous avez des champs vides !! ") ;
        return false ;
      } else {
        // Les 2 lignes ci-dessous devraient être activées pour réellement passer le form. à script CGI
        document.form1.method = "POST" ;
        document.form1.action = "verif.php" ;
        document.close () ;
        return true ;
      }
    }
        
   //-->
  </SCRIPT>
<title>GMS</title>


<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<?php 
include("../connect.php");
?>
<h1>Ajouter un enseignant</h1>

<form name='form1'>
<input type='hidden' name='type' value='enseigne'>
<?php

$prof=mysql_query("select * from PROFESSEUR group by nom_professeur order by nom_professeur asc ");
?> NOM : <select onChange="javascript:ahah('ajout_prof.php?idp='+options[this.selectedIndex].value,'principal');" name='nom'>
<option><?php if(isset($_GET['idp'])){$nom=$_GET['idp']; print($nom); }else print("CHOIX");?>
<?php
 while($ligne=mysql_fetch_array($prof)){ ?>
 	<option value="<?php print($ligne[1]); ?>" ><?php print($ligne[1]); ?>
 <?php }
?>
</select>
<?php if(isset($_GET['idp'])){ ?>
<?php $prof=mysql_query("select * from PROFESSEUR where nom_professeur='$_GET[idp]'");
?> Prenom : <select name='prenom'>
<?php
 while($ligne=mysql_fetch_array($prof)){
 	print("<option value='$ligne[2]'>$ligne[2]");
 }
?>
</select>
professeur de <?php print("<select name='matiere'>");
 $mat=mysql_query("select * from MATIERE");
 while($ligne=mysql_fetch_array($mat)){
 	print("<option value='$ligne[0]'>$ligne[1]");
 }
?>
</select>
<a href="#" onclick="javascript:ahah('ajout_matiere.php','principal');" >Ajouter une nouvelle mati&egrave;re</a><BR>
de coefficient : <?php print("<select name='coef'>");
 $coef=mysql_query("select * from COEFFICIENT ORDER BY num_coefficient");
 while($ligne=mysql_fetch_array($coef)){
 	print("<option value='$ligne[0]'>$ligne[1]");
 }
 print("</select>");
 print("<br>");
 ?>
dans la classe: <?php print("<select name='classe'>");
 $classe=mysql_query("select * from CLASSE");
 while($ligne=mysql_fetch_array($classe)){
 	print("<option value='$ligne[0]'>$ligne[1]");
 }
 print("</select>");
 print("<br>");
 ?>
 <br />
 <br />
 <a href="#" class="valid" onClick="javascript:ahah('ajout_prof.php?prenom='+form1.prenom.value+'&nom='+form1.nom.value+'&classe='+form1.classe.value+'&matiere='+form1.matiere.value+'&coef='+form1.coef.value,'principal');">
 Ajouter l'enseignant
 </a>
 <?php
}
?>
<br />
<br />

</form>
<?php
if(isset($_GET['nom'])){
	if(isset($_GET['prenom'])){
		print($_GET["nom"]." ".$_GET["prenom"]." ".$_GET["matiere"]." ".$_GET["classe"]." ".$_GET["coef"]);
		require("ajout_func.php");
		print("Ajout de l'enseignant...");
		print(ajout_enseigne($_GET["nom"],$_GET["prenom"],$_GET["matiere"],$_GET["classe"],$_GET["coef"]));
	}
}
?>
</body>
</html>

