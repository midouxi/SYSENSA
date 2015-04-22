<?php session_start(); ?> 
<html>
<head>
<title>prof_notes</title>	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<?php $id=$_GET['login'];
$nom=mysql_query("select * from PROFESSEUR where id_professeur='$id'");
$ligne=mysql_fetch_array($nom);
if(!isset($_SESSION['id'])) $_SESSION['id']=$id; else print("<h1>".$_SESSION['id']."</h1>");
if(!isset($_SESSION['name'])) $_SESSION['name']=$ligne[1]; else print("<h1>".$_SESSION['id']."</h1>");
if($nb=mysql_num_rows(mysql_query("select * from CLASSE where id_pp='$id'"))>0) $_SESSION['pp']=1;
/*print("coucou".$ligne[1]."<br>");
			//if(session_register("login")) print("ok var<br>"); else print("cavepas<br>");
			//if(session_name($ligne[1]));
$_SESSION['name']=$ligne[1];*/
echo "<script language='javascript'> eval(document.location.href='index_2.php'); </script>";

?>
<html>
<!-- <a href='index_2.php'>continue</a>
//-->
</html>