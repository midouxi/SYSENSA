<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />

<title>GMS_ADMINISTRATION____AJOUT</title>

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
<table width=100%><tr>
<td class="td1" onmouseover="this.style.backgroundColor='#000000';document.getElementById('lien1').style.color='#FFFFFF';" onmouseout="this.style.backgroundColor='';document.getElementById('lien1').style.color='';" ><a id="lien1"  href="#" onclick="javascript:ahah('ajout_pp.php','principal');document.getElementById('principal').style.backgroundColor='#FFFFFF';"  >Ajouter professeur principal</a></td>
<td class="td2" onmouseover="this.style.backgroundColor='#99DD99';document.getElementById('lien2').style.color='#FFFFFF';" onmouseout="this.style.backgroundColor='';document.getElementById('lien2').style.color='';" ><a id="lien2" href="#" onclick="javascript:ahah('ajout_prof.php','principal');document.getElementById('principal').style.backgroundColor='#99DD99';" >Ajouter enseignement</a></td>
<td class="td3" onmouseover="this.style.backgroundColor='#9999DD';document.getElementById('lien3').style.color='#FFFFFF';" onmouseout="this.style.backgroundColor='';document.getElementById('lien3').style.color='';" ><a id="lien3" href="#" onclick="javascript:ahah('ajout_matiere.php','principal');document.getElementById('principal').style.backgroundColor='#9999DD';" >Ajouter une mati&egrave;re</a></td>
<td class="td4" onmouseover="this.style.backgroundColor='#DD9999';document.getElementById('lien4').style.color='#FFFFFF';" onmouseout="this.style.backgroundColor='';document.getElementById('lien4').style.color='';" ><a id="lien4" href="#" onclick="javascript:ahah('ajout_eleve.php','principal');document.getElementById('principal').style.backgroundColor='#DD9999';" >Ajouter un &eacute;l&egrave;ve</a></td>
</tr>
</table>

<div id="principal">
</div>
</body>
</html>