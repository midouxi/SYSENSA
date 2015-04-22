<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />

<title>ADMINISTRATION____AJOUT_MESSAGE</title>

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
.td1{
background-color : #FFFFFF;
color : #000000;
}
.td2{
background-color : #FFFFFF;
color : #000000;
}
.td3{
background-color : #FFFFFF;
color : #000000;
}
.td4{
background-color : #FFFFFF;
color : #000000;
}

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
<?php session_start();?>
<?php 
if(isset($_SESSION['login']) && $_SESSION['login']!="")
{
?>		
		<h2>Vos anciens messages :</h2>
		<fieldset>
<?php
		include_once('visiteur.class.php');
		include_once('visiteurmanager.php');
		$invite = new visiteur(array('login' => $_SESSION["login"]));
     
		$db = new PDO('mysql:host=localhost;dbname=billets', 'root', '');
		$manager = new visiteurManager($db);
     
		$manager->affichemsg($invite);
}

?>
