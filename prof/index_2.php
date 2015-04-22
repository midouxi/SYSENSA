<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; ?>
<html>
<head><link rel="icon" type="image/png" href="img/favicon.png"><title>GMS</title></head>
<frameset rows='10%,*' border='1'>
	<frame src='header.php' scrolling='no'>
	<frameset cols='15%,*' border='1'>
		<frame src='menu.php' scrolling='yes'>
		<frame src='acceuil.php' name='frame2'>
	</frameset>
</frameset>
</html>
