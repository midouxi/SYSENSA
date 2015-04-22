<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Language" content="fr" />
</head>
<body >
<!-- OUTIL PROFESSEUR -->

	 <?php
 include("../connect.php");
?>	

<div id="professeur">
	<h2>Administration professeurs</h2>
	<form name='formPROF'>
	Voir le détail d'un professeur : <select name='nom'>
	<option>CHOIX
	 <?php
	 $classe=mysql_query("select * from PROFESSEUR GROUP BY nom_professeur order by nom_professeur ASC");
	 while($ligne=mysql_fetch_array($classe)){
		 if(isset($_POST['nom'])){
		 	if($ligne[1]==$_POST['nom']) print("<option value='$ligne[1]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[1]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[1]'>$ligne[1]");
		 } 
	 }
	 ?>
	 </select>
	 <input type="submit" value="Ok" onclick="javascript:ahah('outil_professeur.php','div2');">
	 </form>

</div>
<div id="div2">	<?php 
	if(isset($_GET['nom'])){
		?>
		<br>
		<form method="post" action="affich_prof.php">
		<select name='prenom'>
		<option>CHOISIR
		<?php
     	   	$classe=mysql_query("select * from PROFESSEUR where nom_professeur='".$_POST['nom']."'");
		while($ligne=mysql_fetch_array($classe)){?>
			<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[2]);
		}
	 ?>
	</select>
	<input type='submit' value='0k'>
	</form>
<?php }else print("TEST"); ?></div>