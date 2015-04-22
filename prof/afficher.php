<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; ?>
<html>
<head>
<title>prof_notes</title>
<?php include("header.php"); ?>	
</head>
<body bgcolor="silver">
<center>
</body>

<?php 
$classe=$_GET["nom"];print("classe de : ".$classe." <br>");
$matiere=$_GET["matiere"];print("matiere de :".$matiere."<br>");
$fp = fopen("c:\\test\\".$classe."\\".$matiere.".txt", "a+");
if($fr=fread($fp,filesize("c:\\test\\".$classe."\\".$matiere.".txt"))) print("voila le contenu du fichier : <br>".$fr); else print("erreur fichier<br>");
?>
</html>