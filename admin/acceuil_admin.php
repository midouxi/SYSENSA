<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />

<title>GMS_ADMINISTRATION</title>

<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="fucntion.js"></script>

<!-- script du menu -->
<script type="text/javascript" src="dynMenu.js"></script>
 <!-- détéction du navigateur -->
<script type="text/javascript" src="browserdetect.js"></script>

<!-- important pour que les vieux navigateurs ne comprennent pas le CSS -->
<style type="text/css">
    @import "menu.css";
  <!--
    a{
text-decoration : none;
color : #000000;
}
a:hover{
color : #FFFFFF;
}
-->
</style>

</head>
<body>
<?php
include("header.php");
?>
<br>
<center>
<table>
<tr>
<td>
<div id="bulletin" align="center">

	<form method='GET' name='nameCLASSE'>
	
	<h2>Afficher le bulletin d'une classe</h2>
	Choix de la classe : <select name='classe'>
	<option>CHOISIR

	<?php include("connect.php");
        $classe=mysql_query("select * from CLASSE");
	while($ligne=mysql_fetch_array($classe)){
 	if(isset($_POST['classe'])){
		 	if($ligne[0]==$_POST['classe']) print("<option value='$ligne[0]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[0]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[0]'"); ?>  > <?php print($ligne[1]);
		 } 
	}
	?>
	</select><br>
	Trimestre : 
	<select name='trimestre'>
	<option>CHOISIR
	<?php
	for($i=1;$i<=3;$i++){
		 print("<option value='$i'>".$i);
	}
	?>
	</select>
	<input type='button' value='0k' onClick="ahah('affich_bulletin.php?classe='+document.forms.nameCLASSE.classe.value+'&trimestre='+document.forms.nameCLASSE.trimestre.value,'bulletin2');">
	</form>
</div>
</td>
<td>
<div id="moyenne" align="center">

	<form method='GET' name='nameMoyenne'>
	
	<h2>Afficher la moyenne d'une classe</h2>
	Choix de la classe : <select name='classe' >
	<option>CHOISIR

	<?php include("../connect.php");
        $classe=mysql_query("select * from CLASSE");
	while($ligne=mysql_fetch_array($classe)){
 	if(isset($_POST['classe'])){
		 	if($ligne[0]==$_POST['classe']) print("<option value='$ligne[0]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[0]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[0]'"); ?>  > <?php print($ligne[1]);
		 } 
	}
	?>
	</select><br>
	Trimestre : 
	<select name='trimestre'>
	<option>CHOISIR
	<?php
	for($i=1;$i<=3;$i++){
		 print("<option value='$i'>".$i);
	}
	?>
	</select>
	<input type='button' value='0k' onClick="ahah('affich_moyenne.php?classe='+document.forms.nameMoyenne.classe.value+'&trimestre='+document.forms.nameMoyenne.trimestre.value,'bulletin2');">
	</form>
</div>
</td>
</tr>
</table>
</center>
<div id="bulletin2">
</div>

<!-- 
<script type="text/javascript">
    initMenu();
</script>
--> 
</body></html>
