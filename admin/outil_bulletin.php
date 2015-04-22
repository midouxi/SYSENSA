<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="fr" />
</head>
<body >
<!-- OUTIL BULLETIN -->
<?php 
include("../connect.php");
?>

<!-- <div id="bulletin">
	<form method='post' name='nameCLASSE'>
	
	<h2>Changez le coefficient d'un bulletin</h2>
	Choix de la classe : <select name='classe' onChange="this.form.submit();">
	<option>CHOISIR

	<?php include("../connect.php");
        $classe=mysql_query("select * from CLASSE");
	while($ligne=mysql_fetch_array($classe)){
 	if(isset($_POST['classe'])){
		 	if($ligne[0]==$_POST['classe']) print("<option value='$ligne[0]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[0]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[0]'>$ligne[1]");
		 } 
	}
	?>
	</select>
	</form>
	<?php 
	if(isset($_POST['classe'])){
		?>
		<form method='POST'>
		Choix de la matiere<select name='matiere'>
		<option>CHOISIR
	
		<?php 
	        $matiere=mysql_query("select * from MATIERE,ENSEIGNE,CLASSE where MATIERE.id_matiere=ENSEIGNE.id_matiere and ENSEIGNE.id_classe=CLASSE.id_classe and CLASSE.id_classe=".$_POST['classe']." GROUP BY nom_matiere ORDER by MATIERE.nom_matiere");
		while($ligne=mysql_fetch_array($matiere)){?>
			<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
		}
		?>
		</select>
		<input type='submit' value='0k'>
		</form>
		<hr>
<?php }else print("<hr>"); ?>
	Afficher la liste des matières par classe	
	choix de la classe : <select name='classe' onChange="this.form.submit();">
	<option>CHOISIR

	<?php 
        $classe=mysql_query("select * from CLASSE");
	while($ligne=mysql_fetch_array($classe)){
 	if(isset($_POST['classe'])){
		 	if($ligne[0]==$_POST['classe']) print("<option value='$ligne[0]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[0]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[0]'>$ligne[1]");
		 } 
	}
	?>
	</select>
	<input type='submit' value='0k'>
	</form>	
</div> 
-->

		<?php 
		if(isset($_GET['classe'])){
			print($_GET['classe']."coucou");
		 }else print("pouet"); ?>
