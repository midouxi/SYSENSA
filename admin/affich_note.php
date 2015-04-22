<?php 
error_reporting(0);
session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id'];?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
   <!--
    
    
    function soumettre_form() {
      if (document.forms.form1.trimestre.value == 1 ){
      	//alert("valeur de test: "+document.forms.form1.choi.value+" et classe"+document.forms.form1.classe.value);
        document.form1.method = "POST" ;
        document.form1.action = "affich_note_classe.php" ;
        document.close () ;
        return false ;
      }else{
        //alert("valeur de test: "+document.forms.form1.choi.value+" et classe"+document.forms.form1.classe.value);
        document.form1.method = "POST" ;
        document.form1.action = "affich_note_classe.php" ;
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
<h1>Afficher les notes</h1>
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
	  	<option value="affich_note.php?idc=<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
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
	MATIERE : <select name='idm'>
	<?if($nb=mysql_num_rows($mat)>1){ ?><option>CHOISIR <?php }
		while($ligne=mysql_fetch_array($mat)){ ?>
	 		<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
	
		}	
	?>
	</select>
        <br>
        TRIMESTRE :  <select name="trimestre">
                <?php
                $classe=mysql_query("select * from TRIMESTRE");
                        while($ligne=mysql_fetch_array($classe)){?>
                  <option value=<?php print($ligne[0]); if($ligne[1]==3) print("  selected");?> ><?php print($ligne[1]);
                }
                ?>
                </select>
	<input type='hidden' value='classe' name='choi'>
	<input type='hidden' value=<?php print("'".$nom_classe[0]."'"); ?> name='idc'> <br>
	<input type='submit' value='0k' onClick='soumettre_form()'>
	</form>
<?php

if(isset($_GET["ide"])){
	$ide=$_GET["ide"];
	$idm=$_GET["idm"];
	$eleve=mysql_query("select * from ELEVE where id_eleve='$ide'");
	$eleve=mysql_fetch_array($eleve);
	$matiere=mysql_query("select * from MATIERE where id_matiere='$idm'");
	$matiere=mysql_fetch_array($matiere);
	$inter=mysql_query("select * from CONTROLE where CONTROLE.id_matiere='$idm'");
	if(($nb=@mysql_num_rows($inter))>0){
		print("<table><tr><th >NOM</th><th>Prenom</th>");
		while($ligne_inter=mysql_fetch_array($inter)){
			print("<th>".$ligne_inter[1]."<br><font color='red' size='-1'>coef:".$ligne_inter[2]."</th>");
		}
		print("<th>MOYENNE</th></tr><br>");
		$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere'");
		print("<tr><td><b>".$eleve[1]."</b></td><td>".$eleve[2]."</td>");
		$inter=mysql_query("select * from CONTROLE where CONTROLE.id_matiere='$idm'");
		$i=0;$moy=0;
		while($ligne_inter=mysql_fetch_array($inter)){
			$note_eleve=mysql_query("select * from NOTE,ELEVE,CONTROLE,OBTIENT where CONTROLE.id_matiere='$idm' and OBTIENT.id_eleve='$ide' and CONTROLE.id_controle='$ligne_inter[0]' and NOTE.id_note=OBTIENT.id_note and CONTROLE.id_controle=NOTE.id_controle");
			$note_eleve=mysql_fetch_array($note_eleve);
			print("<td bgcolor='white'><center><b>".$note_eleve[1]."</b></center></td>");
			$i++;$moy+=$note_eleve[1];
		}
		print("<td>".$moy/=$i."</td></tr>");
		print("</table>");

	}else print("<h1>aucun controle n'a été effectué dans cette matiere!!</h1>");
	
}else{
	if(isset($_POST["classe"])){
		$idc=$_POST["classe"];
		$idm=$_POST["matiere"];
		print("<table>");
		if($classe=mysql_query("select * from CLASSE where id_classe='$idc'")){
			$ligne=mysql_fetch_array($classe);
			print("<font size='+1'><tt>Choisissez <b>l</b> eleve parmis la liste des eleves de la <b>".$ligne[1]."</b></tt> </font>");
		}else print(mysql_error());
		$eleve=mysql_query("select * from ELEVE where id_classe='$idc' order by nom_eleve asc");
		$i=1;
		while($ligne=mysql_fetch_array($eleve)){
			print("<tr><td>".$i++."</td><td><input type='radio' onClick=\"document.location='affich_note.php?ide=".$ligne[0]."&idc=".$idc."&idm=".$idm."'\"><b>".$ligne[1]."</b> ".$ligne[2]."</td></tr>");
		}
		print("</table>");
	}
}
	?>
<!-- $note=mysql_query("select * from NOTE");
-->
</html>
