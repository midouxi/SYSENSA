<?php session_start(); $login=$_SESSION["id"]; ?>
<html>
<head>

<title>prof_notes</title>	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
<?php
if(isset($_POST['nouveau_coef'])){
	$new=$_POST['nouveau_coef'];
	$inter=$_POST['inter'];
	$select_inter=mysql_query("select * from CONTROLE where id_controle='$inter'");
	$ligne_inter=mysql_fetch_array($select_inter);
	print("<h2>L'interrogation <font color='blue'>".$ligne_inter[1]."</font> a comme coefficent <font color='red'>".$ligne_inter[2]."</font><br><br><h2>");
	if(mysql_query("update CONTROLE set coefficient='$new' where id_controle='$ligne_inter[0]'")) print("<h1>Le nouveau coef est : ".$new); else print(mysql_error());	
}else{
	$inter=$_GET["id"];
	$select_inter=mysql_query("select * from CONTROLE where id_controle='$inter'");
	$ligne_inter=mysql_fetch_array($select_inter);
	print("<h1>MODIFIER LE COEFFICIENT DE L'INTERROGATION</h1>");
	print("<h2>L'interrogation <font color='blue'>".$ligne_inter[1]."</font> a comme coefficent <font color='red'>".$ligne_inter[2]."</font><br><br>");
	print("<form method='post' action='modif_coef.php'>");
	print("Quel le nouveau coefficent ? ");
	print("<select name='nouveau_coef'>");
	for($i=0.5;$i<=4;$i+=0.5){ 
			print("<option value=".$i);if($i==1) print(" selected >"); else print(">");
			print($i);
	}
	print("<input type='hidden' value=".$inter." name='inter'>");
	print("</select><br><input type=submit value='enregistrer'>");
	print("</form>");
	print("<form action='acceuil.php'>");
	print("<input type=submit value=annuler>");
}
?>	

</html>
