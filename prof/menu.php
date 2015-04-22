<?php session_start(); 
if(!isset($_SESSION["id"])){ echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; }?> 
<?php include("connect.php");?>
<html>
<head>
<title>GMS</title>
<link rel="stylesheet" type="text/css" href="style.css">
<body style="background-image:url(img/slash1.png);background-repeat:repeat;  background-attachment:fixed;"> 
<script language="javascript">

function test(id){
	<?php 
	if(isset($_SESSION['pp']))
		{    ?>
	for(var i=1;i<11;i++){
	<?php }else{ ?> 
	for(var i=1;i<9;i++){
	<?php } ?>
	document.getElementById('menu'+i).style.border='2px outset #000000';
	document.getElementById('menu'+i).style.backgroundColor='';
	}
	
	document.getElementById(id).style.border='2px inset #000000';
}

</script>
</head>
<body>
<!-- <table cellpadding='0'>  -->
<table class='menu_liste'  style='background-color : #DDFFDD;'  width='100%'>
<tr><td><b><center>LISTES</B></center></td></tr>
<tr><td><div id="menu1" class='menu_liste' onclick="test('menu1');this.style.backgroundColor='#CCFFCC';top.frame2.location.href='affich_pp.php';">Profs principaux</div></td></tr>
<tr><td><div id="menu2" class='menu_liste' onclick="test('menu2');this.style.backgroundColor='#CCFFCC';top.frame2.location.href='affich_classe.php';">Les classes</div></td></tr>
<tr><td><div id="menu3" class='menu_liste' onclick="test('menu3');this.style.backgroundColor='#CCFFCC';top.frame2.location.href='affich_prof.php';">Les professeurs</div></td></tr>
</table>
<br />
<table class='menu_liste'  style='background-color : #DDDDFF;'  width='100%'>
<tr><td><b><center>NOTES</B></center></td></tr>
<tr><td><div id="menu4"   class='menu_note' onclick="test('menu4');this.style.backgroundColor='#CCCCFF';top.frame2.location.href='affich_note.php';">Afficher / Modifer</div></td></tr>
<tr><td><div id="menu5"   class='menu_note' onclick="test('menu5');this.style.backgroundColor='#CCCCFF';top.frame2.location.href='ajout_note.php';">Ajouter</div></td></tr>
</table>
<br />
<table class='menu_liste'  style='background-color : #FFDDDD;'  width='100%'>
<tr><td><div bgcolor='#FFCCCC'><b><center>COMMENTAIRES</B></center></td></tr>
<tr><td><div id="menu7" class='menu_bulletin' onclick="test('menu7');this.style.backgroundColor='#FFCCCC';top.frame2.location.href='affich_commentaire.php';">Afficher</div></td></tr>
<tr><td><div id="menu6" class='menu_bulletin' onclick="test('menu6');this.style.backgroundColor='#FFCCCC';top.frame2.location.href='commentaire.php';">Ajouter / Modifier</div></td></tr>
</table>
</br>
<?php if(isset($_SESSION['pp'])){
/*	    
	    <tr><td> <div id="menu11" class='menu_pp' onclick="test('menu11');this.style.backgroundColor='#EEE8AA';top.frame2.location.href='ajout_eleve.php';">ajouter un eleve</div>  </td></tr>  
<tr><td> <div id="menu12" class='menu_pp' onclick="test('menu12');this.style.backgroundColor='#EEE8AA';top.frame2.location.href='ajout_prof.php';">ajout_prof</div>  </td></tr> -->
*/
	    ?>
<table width='100%' style=' border: 2px solid #FF0000; background-color : #FFF5DD;' >
<tr><td><div bgcolor='#FFF5DD'><font style='color : #FF0000;'><b><center>PROFESSEUR PRINCIPAL</b></center></font></div></td></tr> 
<tr><td> <div id="menu9" class='menu_pp' onclick="test('menu9');this.style.backgroundColor='#EEE8AA';top.frame2.location.href='moyenne.php';">MOYENNES</div></td></tr>  
<tr><td> <div id="menu10" class='menu_pp' onclick="test('menu10');this.style.backgroundColor='#EEE8AA';top.frame2.location.href='affich_bulletin.php';">BULLETINS</div>  </td></tr>

<?php } ?>
 </table>
 <br /> 
 
<div id="menu8" class='menu_accueil' onclick="test('menu8');this.style.backgroundColor='#66AAFF';top.frame2.location.href='acceuil.php';">Accueil</div><br>
<a href="index.php" target='_top' alt="quitter"><img  border="0" src='img/lc_quit.png' /></a>

</body>
</html>