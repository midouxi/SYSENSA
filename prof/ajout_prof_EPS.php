
<html>
<HEAD>

<title>prof_notes</title>

<?php include("connect.php");?>	
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

<h1>ajouter un professeur</h1>

<form name='form1'>
<input type='hidden' name='type' value='enseigne'>
<?php
$prof_EPS=array("68","69","70","71");
$classe=mysql_query("select * from CLASSE");
while($ligne=mysql_fetch_array($classe)){
	$i=0;
	while($i<4){
		print($prof_EPS[$i]." ".$ligne[0]."<br>");
		if($insert=mysql_query("insert into ENSEIGNE(id_professeur,id_matiere,id_classe) values('$prof_EPS[$i]','12','$ligne[0]') ")) print ("insertion OK"); else mysql_error();
		$i++;
	}
}
?>
</body>
</html>

