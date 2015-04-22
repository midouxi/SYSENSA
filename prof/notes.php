<html>
<head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>


<?php
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$note=$_POST["note"]."<br>";
$classe=$_POST["classe"];
$matiere=$_POST["matiere"];
$ligne="Derniere mise a jour : ".date("j F Y, G:i")." par l'uitlisateur : ".$_POST["login"]."<table border='1' color='black'><tr><td>".$nom."</td><td>".$prenom."</td><td>".$note."</td><tr></table>";
if(!is_dir("c:\\test\\".$classe)) mkdir("c:\\test\\".$classe,0777);  
$fp = fopen("c:\\test\\".$classe."\\".$matiere.".txt", "a+");
if($fw=fwrite($fp,$ligne)) print("fichier ouvert et ecrit <br>"); else print("erreur fichier<br>");
print("<a href='afficher.php?nom=".$classe."&matiere=".$matiere."'>voir le fichier</a>");
?>
</html>