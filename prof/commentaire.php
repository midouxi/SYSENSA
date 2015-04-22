<?php error_reporting(0);
session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id'];?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
   <!--
    
    
    function soumettre_form() {
      if (document.forms.form1.choi.value == "eleve" ){
      	//alert("valeur de test: "+document.forms.form1.choi.value+" et classe"+document.forms.form1.classe.value);
        document.form1.method = "POST" ;
        document.form1.action = "affich_note.php" ;
        document.close () ;
        return false ;
      }else{
        //alert("valeur de test: "+document.forms.form1.choi.value+" et classe"+document.forms.form1.classe.value);
        document.form1.method = "POST" ;
        document.form1.action = "ajout_commentaire.php" ;
        document.close () ;
        return false ;
      }
    }
        
   //-->
  </SCRIPT>
</head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<h1>Ajouter les commentaires</h1>
<?php
/*	<select name="choi">
	<option value="eleve">  Un eleve
	<option value="classe" selected > Une classe
	</select>
	<br>*/

	$classe=mysql_query("select * from CLASSE,ENSEIGNE where CLASSE.id_classe=ENSEIGNE.id_classe and ENSEIGNE.id_professeur='$login' GROUP BY CLASSE.id_classe");
	if($nb=mysql_num_rows($classe)>1){ ?>

	Voir la classe : <select onChange="document.location=this.options[this.selectedIndex].value">
	<form>
	<option>CHOISIR
	<?php 
		while($ligne=mysql_fetch_array($classe)){?>
	  	<option value="commentaire.php?idc=<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
		}
	?>
	</select>
	</form>
	<?php 
	}else{
		$ligne=mysql_fetch_array($classe);
		$_GET['idc']=$ligne[0];
	} ?>
<br>
<?php	
	if(isset($_GET['idc'])){
	$classe=$_GET['idc'];
	$idclasse=mysql_query("select * from CLASSE where id_classe='$classe'");
	$nom_classe=mysql_fetch_array($idclasse);
	$mat=mysql_query("select * from MATIERE,ENSEIGNE,PROFESSEUR where PROFESSEUR.id_professeur='$login' and ENSEIGNE.id_classe='$classe' and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and ENSEIGNE.id_matiere=MATIERE.id_matiere GROUP BY MATIERE.id_matiere");
	print("<h2>Choix de la matiere : pour la <font color='blue'>".$nom_classe[1]."</font></h2>"); ?>
	<form name='form1'>
	<select name='matiere'>
	<?if($nb=mysql_num_rows($mat)>1){ ?><option>CHOISIR <?php }
		while($ligne=mysql_fetch_array($mat)){ ?>
	 		<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
	
		}	
	?>
	</select>


                        Trimestre : <select name="trimestre">
                        <?php $matiere=mysql_query("select * from TRIMESTRE");
                        while($ligne=mysql_fetch_array($matiere)){?>
                        <option value=<?php print("'".$ligne[0]."'"); if($ligne[0]==3) print("selected"); ?> >
                        <?php print($ligne[1]);
                        }
                        ?>
                        </select>
	<input type='hidden' value='classe' name='choi'>
	<input type='hidden' value=<?php print($classe); ?> name='classe'><br>
	<input type='submit' value='0k' onClick='soumettre_form()'>
	</form>

?>
</html>
