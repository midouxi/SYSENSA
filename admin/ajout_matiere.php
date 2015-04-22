<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
  <!--
    
    
    function soumettre_form() {
      if ( document.forms.form2.matiere.value == "" ) {
        alert ("Vous avez laisse le champ vide !! ") ;
        return false ;
      } else {
        document.form2.method = "POST" ;
        document.form2.action = "verif.php" ;
        document.close () ;
        return true ;
      }
    }
        
   //-->
  </SCRIPT>
<title>ajout_matiere</title>


<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

<?php 
include("../connect.php");
?>
<h1>Ajout d'une nouvelle matiere</h1>
<form name='form2'>
<input type='hidden' name='type' value='matiere'>
Nom de la nouvelle matiere :<input type='text' name='matiere'><br /><br />
<a href="#" class="valid" onClick="javascript:ahah('ajout_matiere.php?matiere='+form2.matiere.value,'principal');" >Ajouter matiere</a>
<br />
</form>

<?php
if(isset($_GET['matiere'])){
	if($_GET['matiere']!=''){
		require("ajout_func.php");
		print(ajout_matiere($_GET["matiere"]));
	}else{
		print("<font color='#AA0000'>Veuillez renseigner la MATIERE</font>");
	}
}
?>
<br />
</body>
</html>