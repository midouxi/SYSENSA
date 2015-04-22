
<html>
<HEAD>
<link rel="stylesheet" type="text/css" href="style.css">
<SCRIPT LANGUAGE="JavaScript">
  <!--
    
    
    function soumettre_form() {
      if ( document.forms.form1.nom.value == "" || document.forms.form1.prenom.value== "" || document.forms.form1.classe.value == "") {
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
<title>prof_notes</title>

</head>
<body>
<center>
<?php 
include("../connect.php");
?>
<h1>Ajouter un professeur principal</h1>
<form name='form1'>
<input type='hidden' name='type' value='pp'>
Nom : <input type='text' name='nom'>
Prenom : <input type='text' name='prenom'><br>
prof principal de la classe : 
<select name="classe">
<?php
$classe=mysql_query("select * from CLASSE where id_pp=null ");
while($ligne=mysql_fetch_array($classe)){
	print("<option>".$ligne[1]);

}
?>
</select>
<br />
<br />

<a href="#" class="valid"  onClick="javascript:ahah('ajout_pp.php?prenom='+form1.prenom.value+'&nom='+form1.nom.value+'&classe='+form1.classe.value,'principal');" >
Ajouter Professeur Principal</a>
</form>
<?php
if(isset($_GET['prenom']) && isset($_GET['nom'])){
	if($_GET['prenom']!="" ){
		if($_GET['nom']!=""){
			require("ajout_func.php");
			print(ajout_pp($_GET["nom"],$_GET["prenom"],$_GET["classe"]));
		}else{
			print("<font color='#AA0000'>Veuillez renseigner le  NOM!!</font>");
		}
	}else{
		print("<font color='#AA0000'>Veuillez renseigner le  PRENOM !</font>");
	}
}
?>
<br />
<br />

</body>
</html>