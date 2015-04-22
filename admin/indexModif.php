<html>
<head>
<title>GMS_ADMINISTRATION____MODIFICATION</title>

<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="fucntion.js"></script>

<!-- script du menu -->
<script type="text/javascript" src="dynMenu.js"></script>
 <!-- détéction du navigateur -->
<script type="text/javascript" src="browserdetect.js"></script>

<!-- important pour que les vieux navigateurs ne comprennent pas le CSS -->
<style type="text/css">
    @import "menu.css";
</style>

</head>
<body>
<?php
include("header.php");


?>
<a class="id1" href="#" onclick="javascript:ahah('modif_coef.php','principal');" >Modifier un professeur</a>
<a href="#" onclick="javascript:ahah('modif_matiere.php','principal');" >Modifier une mati&egrave;re</a> 
<a href="#" onclick="javascript:ahah('outil_eleve.php','principal');" >Modifier un &eacute;l&egrave;ve</a>
<div id="principal">
</div>
