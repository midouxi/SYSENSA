<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id']; ?>
<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

<h1>ajouter une note</h1>

<?php 
$classe=mysql_query("select * from CLASSE,ENSEIGNE where CLASSE.id_classe=ENSEIGNE.id_classe and ENSEIGNE.id_professeur='$login'");
$matiere=mysql_query("select * from ENSEIGNE where ENSEIGNE.id_professeur='$login'");
$ligne=mysql_fetch_array($classe);
$nb=mysql_num_rows($classe);
$nb_mat=mysql_num_rows($matiere);
$ligne_mat=mysql_fetch_array($matiere);
?>
<? 
if(isset($_GET["choi1"])){
	switch($_GET["choi1"]){
		case 'eleve' :  ?>
			<?php if($nb>1){ ?>
				<form>
				Voir la classe : <select onChange="document.location=this.options[this.selectedIndex].value">
				<option>CHOISIR
				<?php
				while($ligne=mysql_fetch_array($classe)){ ?>
			  	<option value="ajout_note.php?choi2=eleve&choi1=<?php print($ligne[0]); ?>" >
			  	<?php print($ligne[1]);
				}
			
				?>
				</select>
				</form>
			<?php }else  print("<script language='javascript'> eval(document.location.href='ajout_note.php?choi2=eleve&choi1=".$ligne[0]."'); </script>");  ?>
	<?php  break;
		case 'classe' : ?>
		<form method='post' action='ajout_note_classe.php'>
			Classe : <select name="classe">
			<?php $classe=mysql_query("select * from CLASSE,ENSEIGNE where ENSEIGNE.id_classe=CLASSE.id_classe and ENSEIGNE.id_professeur='$login' GROUP BY ENSEIGNE.id_classe");
			while($ligne=mysql_fetch_array($classe)){?>
			  <option value="<?php print($ligne[0]); ?>" >
			  <?php print($ligne[1]);
			}
			?>
			</select>
		
			Matiere : <select name="matiere">
			<?php $matiere=mysql_query("select * from MATIERE,ENSEIGNE,PROFESSEUR where PROFESSEUR.id_professeur='$login' and ENSEIGNE.id_professeur=PROFESSEUR.id_professeur and ENSEIGNE.id_matiere=MATIERE.id_matiere GROUP BY MATIERE.id_matiere");
			while($ligne=mysql_fetch_array($matiere)){?>
			<option value="<?php print($ligne[0]); ?>" >
			<?php print($ligne[1]);
			}
			?>
			</select>
			
		<input type='submit' value='ok' >
		</form>	
	<?php break; 
		default : switch($_GET["choi2"]){
			case 'eleve' :
				if($nb>1){ ?>
					<form>
					Voir la classe : <select onChange="document.location=this.options[this.selectedIndex].value">
					<option>CHOISIR
					<?php
					while($ligne=mysql_fetch_array($classe)){?>
				  	<option value="ajout_note.php?choi2=eleve&choi1=<?php print($ligne[0]); ?>" >
				  	<?php print($ligne[1]);
					}
					?>
					</select>
					</form>
				<? }else{	
				$idc=$_GET["choi1"];
				if($classe=mysql_query("select * from CLASSE where id_classe='$idc'")){
					$ligne=mysql_fetch_array($classe);
					print("<h1>Liste des eleves de la ".$ligne[1]."</h1><br>");
				}else print(mysql_error());
				print("<table>");$i=1;
				$eleve=mysql_query("select * from ELEVE where id_classe='$idc' order by nom_eleve,prenom_eleve asc");
				while($ligne=mysql_fetch_array($eleve)){ 
					print("<tr><td bgcolor='white'>".$i++."</td><td><input type='radio' onClick=\"document.location='ajout_note_eleve.php?ide=".$ligne[0]."'\"><b>".$ligne[1]."</b> ".$ligne[2]."</td></tr>");
				}
				print("</table>");
				}
			break;
			}// fin switch choi 2	
	}// fin switch choi1
}else{
	?>
<form>
	<INPUT TYPE='RADIO' NAME='test' VALUE="eleve" onClick="document.location='ajout_note.php?choi1=eleve'">  A un eleve
	<INPUT TYPE='RADIO' NAME='test' VALUE="classe" onClick="document.location='ajout_note.php?choi1=classe'"> A une classe
</form>
<?php
}
?>
</body>

</html>
