<?php
/**-------------------**/
/**----- GMS  v1 -----**/ 
/**-- developped by --**/ 
/** SCHALCK  Baptiste **/ 
/**___________________**/
?>
<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>

<title>prof_notes</title>	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<?php
if(isset($_POST['old']) && isset($_POST['new2']) && isset($_POST['new1'])){
	$id=$_SESSION["id"];
	$old=mysql_real_escape_string($_POST['old']);
	$new1=mysql_real_escape_string($_POST['new1']);
	$new2=mysql_real_escape_string($_POST['new2']);
	$select_professeur=mysql_query("select * from PROFESSEUR where id_professeur='$id'");
	$ligne_professeur=mysql_fetch_array($select_professeur);
	if($_POST['old']==$ligne_professeur['mdp']){
		if($new1 != "" ){
				if($new1 == $new2){
						if(mysql_query("update PROFESSEUR set mdp='".$new1."' where id_professeur='$id'")){ 
						
							mail('isja@isja.yi.org', 'GMS : changement de mot de passe'.$ligne_professeur[1], 'le professeur '.$ligne_professeur[1].' '.$ligne_professeur[2].' a change de mot depasse Il est maintenant : '.$new1.' !');
							
							echo("<h1>Votre mot de passe a ete change avec succes");

						}else print(mysql_error());	
					
					
				}else{
					echo "<script language=JavaScript>alert('les 2 mots de passe sont différents !');</script>";
					echo "<script language=JavaScript> eval(document.location.href='modif_mdp.php') </script>";
				}
			
		}else{
			echo "<script language=JavaScript>alert('LE MOT DE PASSE DOIT CONTENIR AU MOINS 1 CARACTERE !!');</script>";
			echo "<script language=JavaScript> eval(document.location.href='modif_mdp.php') </script>";
		}
	}else{
			echo "<script language=JavaScript>alert('MAUVAIS MOT DE PASSE !!');</script>";
			echo "<script language=JavaScript> eval(document.location.href='modif_mdp.php') </script>";
	}	

}else{
	$id=$_SESSION["id"];
	$select_professeur=mysql_query("select * from PROFESSEUR where id_professeur='$id'");
	$ligne_professeur=mysql_fetch_array($select_professeur);
	print("<h1>MODIFIER VOTRE MOT DE PASSE</h1><table>");	
	print("<form method='post' action='modif_mdp.php'>");
	print("<br />");
	?>
	<tr><td>ancien mot depasse : </td><td><input type='password'  name='old' maxlength=8 size=8 onKeyPress="if(this.value.length > 8) { alert('Taille max atteinte'); this.value = this.value.substr(0,8); }" ></td></tr>
	<tr><td>nouveau mot de passe : </td><td><input type='password'  name='new1' maxlength=8 size=8 onkeypress="if(this.value.length > 8) { alert('Taille max atteinte'); this.value = this.value.substr(0,8); }"></td></tr>
	<tr><td>retaper le nouveau mot depasse :</td><td> <input type='password' maxlength=8 name='new2' size=8 onkeypress="if(this.value.length > 8) { alert('Taille max atteinte'); this.value = this.value.substr(0,8); }"></td></tr>
	</table><input type=submit value='enregistrer'>
	</form>
	<?php
}
?>	

</html>
