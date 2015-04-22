<html>
<head>
<title>prof_notes</title>
<?php include("connect.php"); ?>	
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
</body>
<font color="black" size="+3"><b>
<?php 
$nb=$_POST["nb"];$classe=$_POST["classe"].$nb;print($classe);$nb_eleves=$_POST["nb_eleves"];print(" classe de ".$nb_eleves." eleves<br>");
$matiere=$_POST["matiere"];print($matiere."<br>");$coef=$_POST["coef"];print("Coefficient :".$coef);
?>
</b></h1>
<table border="1" bgcolor="white">
<tr>
	<td bgcolor="bluescale"><b>NOM</td><td bgcolor="bluescale">PRENOM<td bgcolor="bluescale"><?php print("".$matiere); ?></td>
</tr>
<tr>
	<form method="post" action="notes.php">
	<?php
	for($i=1;$i<=$nb_eleves;$i++){
		print("<td><input type='text' name='nom".$i."'></td>");
		print("<td><input type='text' name='prenom".$i."'></td>");
		print("<td>");
		print("<select name='note'>");
			for($j=0;$j<=20;$j++){
				print("<option value='$j'>$j");
			}
		print("</select>");
		print("</td>");
		print("</tr>");
	}
	?>
</table>
	<input type="hidden" name="matiere" value=<?php print($matiere); ?> >
	<input type="hidden" name="classe" value=<?php print($classe); ?>>
	<input type="hidden" name="login" value=<?php print($_POST["login"]); ?> >
	<input type="submit" value="enregistrer">
	</form>
</html>