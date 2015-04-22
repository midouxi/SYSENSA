
<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
  <!--
    
    
    function soumettre_form() {
      if ( document.forms.form1.nom.value == "" || document.forms.form1.prenom.value== "") {
        alert ("Vous avez des champs vides !! ") ;
        return false ;
      }
    }
        
   //-->
  </SCRIPT>
<title>GMS</title>


<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<?php 
include("../connect.php");
?>
<h1>Ajouter un nouvel &eacute;l&egrave;ve</h1>
<form name='form1'>
<input type='hidden' name='type' value='eleve'>
Nom : <input type='text' name='nom' <?php if(isset($_GET['nom'])) print("value=".$_GET['nom']); ?> >
Prenom : <input type='text' name='prenom' <?php if(isset($_GET['prenom'])) print("value=".$_GET['prenom']); ?> ><br>
dans la classe : <?php print("<select name='classe'>");
 $classe=mysql_query("select * from CLASSE");
 while($ligne=mysql_fetch_array($classe)){
 	print("<option value='$ligne[0]'>$ligne[1]");
 }
 ?>
 </select>
 <br /><br />
<a href="#" class="valid"  onClick="javascript:ahah('ajout_eleve.php?prenom='+form1.prenom.value+'&nom='+form1.nom.value+'&classe='+form1.classe.value,'principal');" >Ajouter eleve</a>
</form>

<?php
if(isset($_GET['prenom']) && isset($_GET['nom'])){
	if($_GET['prenom']!="" ){
		if($_GET['nom']!=""){
			print("Ajout d'eleve...<br>");
			require("ajout_func.php");
			print(ajout_eleve($_GET["nom"],$_GET["prenom"],$_GET["classe"]));
		}else{
			print("<font color='#AA0000'>Veuillez renseigner le  NOM!!</font>");
		}
	}else{
		print("<font color='#AA0000'>Veuillez renseigner le  PRENOM !</font>");
	}
}
	
?>
<br />
</html>