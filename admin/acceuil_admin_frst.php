<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='../index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>
  <script>  
<!-- Hack to avoid flash of unstyled content in IE -->                
 function cacheId(baliseId)                                                                                  
  {                                                                                                         
  if (document.getElementById && document.getElementById(baliseId) != null)                                 
    {                                                                                                       
    document.getElementById(baliseId).style.visibility='hidden';                                            
    document.getElementById(baliseId).style.display='none';  
    var test=0;                                               
    }                                                                                                       
  }  
 
 function affiche_table_Id(baliseId)                                                                              
  {                                                                                                         
  if (document.getElementById&&document.getElementById(baliseId) != null)                                 
    {                                                                                                       
    document.getElementById(baliseId).style.visibility='visible';                                           
	NavName = navigator.appName;
	//alert(NavName);
	if(NavName == 'Microsoft Internet Explorer'){ 
	//alert("on est sous IE!!");
		document.getElementById(baliseId).style.display='block';
	}else{
	//alert("on est pas sous IE!!");
	document.getElementById(baliseId).style.display='table';              
	}
	test=1;
    }                                                                                                       
  }  

 
 function affiche_td_Id(baliseId)                                                                              
  {                                                                                                         
  if (document.getElementById&&document.getElementById(baliseId) != null)                                 
    {                                                                                                       
    document.getElementById(baliseId).style.visibility='visible';                                           
	NavName = navigator.appName;
	//alert(NavName);
	if(NavName == 'Microsoft Internet Explorer'){ 
	//alert("on est sous IE!!");
		document.getElementById(baliseId).style.display='block';
	}else{
	//alert("on est pas sous IE!!");
	document.getElementById(baliseId).style.display='table-cell';              
	}
	test=1;
    }                                                                                                       
  }                                                                                                                                           

</script>
<title>prof_notes_ADMINISTRATION</title>
<?php include("../connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<table width=100%>
<tr><th><div  align='left'><font color='red'><a class='admin' href='acceuil_admin.php'>ADMINISTRATION</a></font>  Bienvenue dans le module d'administration du logiciel de gestion de notes GMS</div></th></tr>
</table>
<center>
<table cellspacing=0 width=100%>
<tr>
<td class="off" width=30% id='ELEVE_off' bgcolor='#CCFFCC'><h2>Outils élèves</h2></td>
<td class="on" width=30% id='ELEVE_on' bgcolor='#AAFFAA'><h2>Outils élèves</h2></td>
<td class="ouvrir" id='ouvrirELEVE' bgcolor='#CCFFCC'>&nbsp;<span class="open"><a class="eleve" href="javascript:cacheId('non_table1');affiche_td_Id('table1');affiche_td_Id('fermerELEVE');cacheId('ouvrirELEVE');cacheId('ELEVE_off');affiche_td_Id('ELEVE_on');"><img src='bouton.png'></a></span></td>
<td class="fermer" id='fermerELEVE' bgcolor='#AAFFAA'>&nbsp;<span class="close"><a class="eleve" href="javascript:affiche_td_Id('non_table1');cacheId('table1');cacheId('fermerELEVE');affiche_td_Id('ouvrirELEVE');cacheId('ELEVE_on');affiche_td_Id('ELEVE_off');"><img src='bouton2.png'></a></span></td>
<td style='border : none;'>&nbsp;</td>
<script>cacheId('fermerELEVE');</script>

<script>cacheId('ELEVE_on');</script>
<td width=30% id='BULLETIN_off' bgcolor='#CCCCFF' class="off"><h2>Outils bulletins</h2></td>
<td width=30% id='BULLETIN_on' bgcolor='#AAAAFF'class="on"><h2>Outils bulletins</h2></td>
<td id='ouvrirBULLETIN' class="ouvrir" bgcolor='#CCCCFF'><span class="Titre"><a class="bulletin" href="javascript:cacheId('non_table2');affiche_td_Id('table2');affiche_td_Id('fermerBULLETIN');cacheId('ouvrirBULLETIN');cacheId('BULLETIN_off');affiche_td_Id('BULLETIN_on');" color=''><img src='bouton.png' ></a></span></td>
<td id='fermerBULLETIN' class="fermer" bgcolor='#AAAAFF'><span class="Titre"><a class="bulletin" href="javascript:affiche_td_Id('non_table2');cacheId('table2');cacheId('fermerBULLETIN');affiche_td_Id('ouvrirBULLETIN');cacheId('BULLETIN_on');affiche_td_Id('BULLETIN_off');" color=''><img src='bouton2.png' ></a></span></td>
<td style='border : none;'>&nbsp;</td>

<td width=30% id='PROF_off' bgcolor='#FFCCCC' class="off"><h2>Outils professeurs</h2></td>
<td width=30% id='PROF_on' bgcolor='#FFAAAA' class="on"><h2>Outils professeurs</h2></td>
<td id='ouvrirPROF' class="ouvrir" bgcolor='#FFCCCC'><span class="Titre"><a class="prof" href="javascript:cacheId('non_table3');affiche_td_Id('table3');affiche_td_Id('fermerPROF');cacheId('ouvrirPROF');cacheId('PROF_off');affiche_td_Id('PROF_on');"><img src='bouton.png'></a></span></td>
<td id='fermerPROF' class="fermer" bgcolor='#FFAAAA'><span class="Titre"><a class="prof" href="javascript:affiche_td_Id('non_table3');cacheId('table3');cacheId('fermerPROF');affiche_td_Id('ouvrirPROF');cacheId('PROF_on');affiche_td_Id('PROF_off');"><img src='bouton2.png' ></a></span></td>
</tr>

<tr>
<!-- OUTIL ELEVE -->
<td width=30% id='non_table1' style='border : none;' colspan=2>&nbsp;</td>
<td width=30% id='table1'  style='border-top : none;'colspan=2 height='200px'>

<?php
	$classe=mysql_query("select * from CLASSE");
?>
	<form method="post" action="affich_classe.php">
	Voir les élèves de la classe : <select name='name'>
	<option>CHOISIR
	 <?php
	 while($ligne=mysql_fetch_array($classe)){?>
	 	<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]); ?>
	 <?php
	 }
	 ?>
	</select>
	<input type='submit' value='0k'>
	</form>
	<hr>
	<form method="post" action="affich_note.php">
	Voir les notes de la  classe : <select name='classe'>
	<option>CHOISIR
	<?php 
        $classe=mysql_query("select * from CLASSE");
		while($ligne=mysql_fetch_array($classe)){?>
	  		<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
		}
	?>
	</select>
	<input type='submit' value='0k'>
	</form>
	<hr>
	<form method="post" action="affich_bulletin.php">
	Voir le bulletin de la classe : <select name='classe'>
	<option>CHOISIR

	<?php 
        $classe=mysql_query("select * from CLASSE");
	while($ligne=mysql_fetch_array($classe)){?>
		<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
	}
	?>
	</select>
	<input type='submit' value='0k'>
	</form>

</td><script>cacheId('table1');</script>
<!-- FIN OUTIL ELEVE -->
<td style='border : none;'>&nbsp;</td>
<!-- OUTIL BULLETIN -->
<td width=30% id='non_table2' style='border : none;' colspan=2>&nbsp;</td>
<td width=30% id='table2' colspan=2 style='border-top : none;' height='200px'>
	<form method='post' name='nameCLASSE'>
	
	<h2>Changez le coefficient d'un bulletin</h2>
	Choix de la classe : <select name='classe' onChange="this.form.submit();">
	<option>CHOISIR

	<?php 
        $classe=mysql_query("select * from CLASSE");
	while($ligne=mysql_fetch_array($classe)){
 	if(isset($_POST['classe'])){
		 	if($ligne[0]==$_POST['classe']) print("<option value='$ligne[0]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[0]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[0]'>$ligne[1]");
		 } 
	}
	?>
	</select>
	</form>
	<?php 
	if(isset($_POST['classe'])){
		?>
		<form method='POST'>
		Choix de la matiere<select name='matiere'>
		<option>CHOISIR
	
		<?php 
	        $matiere=mysql_query("select * from MATIERE,ENSEIGNE,CLASSE where MATIERE.id_matiere=ENSEIGNE.id_matiere and ENSEIGNE.id_classe=CLASSE.id_classe and CLASSE.id_classe=".$_POST['classe']." GROUP BY nom_matiere ORDER by MATIERE.nom_matiere");
		while($ligne=mysql_fetch_array($matiere)){?>
			<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
		}
		?>
		</select>
		<input type='submit' value='0k'>
		</form>
		<hr>
<?php }else print("<hr>"); ?>
	Afficher la liste des matières par classe	
	choix de la classe : <select name='classe' onChange="this.form.submit();">
	<option>CHOISIR

	<?php 
        $classe=mysql_query("select * from CLASSE");
	while($ligne=mysql_fetch_array($classe)){
 	if(isset($_POST['classe'])){
		 	if($ligne[0]==$_POST['classe']) print("<option value='$ligne[0]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[0]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[0]'>$ligne[1]");
		 } 
	}
	?>
	</select>
	<input type='submit' value='0k'>
	</form>	
</td>
<!-- FIN OUTIL BULLETIN -->
<td style='border : none;'>&nbsp;</td>
<!-- OUTIL PROFESSEUR -->
<td width=30% id='non_table3' style='border : none;' colspan=2>&nbsp;</td>
<td width=30% id='table3' style='border-top : none;' colspan=2 height='200px'>
	
	
	<form method='POST' name='formPROF'>
	Voir le détail d'un professeur : <select name='nom'>
	<option>CHOIX
	 <?php
 
	 $classe=mysql_query("select * from PROFESSEUR GROUP BY nom_professeur order by nom_professeur ASC");
	 while($ligne=mysql_fetch_array($classe)){
		 if(isset($_POST['nom'])){
		 	if($ligne[1]==$_POST['nom']) print("<option value='$ligne[1]' selected> $ligne[1]"); 
		 	else print("<option value='$ligne[1]'>$ligne[1]");
		 }else{ 
		 	print("<option value='$ligne[1]'>$ligne[1]");
		 } 
	 }
	 ?>
	 </select>
	 <input type="submit" value="Ok">
	 </form>
	<?php 
	if(isset($_POST['nom'])){
		?>
		<br>
		<form method="post" action="affich_prof.php">
		<select name='prenom'>
		<option>CHOISIR
		<?php
     	   	$classe=mysql_query("select * from PROFESSEUR where nom_professeur='".$_POST['nom']."'");
		while($ligne=mysql_fetch_array($classe)){?>
			<option value="<?php print($ligne[0]); ?>" ><?php print($ligne[2]);
		}
	 ?>
	</select>
	<input type='submit' value='0k'>
	</form>
<?php }else print("&nbsp;"); ?>
</td>
</tr>
</table>


<?php
 /*
<span class="Titre"><a href="javascript:afficheId('Messages');javascript:afficheId('Messages2');javascript:afficheId('Messages3');">+</a></span>
<span class="Fermer"><a href="javascript:cacheId('Messages');javascript:cacheId('Messages2');javascript:cacheId('Messages3');">-</a></span>

  	<table id='table3'>
		<tr><th>TEST</th><th>EST</th><th id="Messages">OUEST</th><th id="Messages2">NORD</th></tr>
		<tr><td>BLA</td><td>OH</td><td id="Messages3"  colspan=2>COUCOU</td></tr>
	</table>
*/
if(isset($_POST['nom'])){
	 ?><script>affiche_td_Id('PROF_on');cacheId('PROF_off');cacheId('ouvrirPROF');affiche_td_Id('fermerPROF');cacheId('non_table3');affiche_td_Id('table3');</script>
	 <?php
}else{
?><script>cacheId('PROF_on');affiche_td_Id('PROF_off');affiche_td_Id('ouvrirPROF');cacheId('fermerPROF');affiche_td_Id('non_table3');cacheId('table3');</script>
<?php 
}
if(isset($_POST['classe'])){
	 ?><script>affiche_td_Id('BULLETIN_on');cacheId('BULLETIN_off');cacheId('ouvrirBULLETIN');affiche_td_Id('fermerBULLETIN');cacheId('non_table2');affiche_td_Id('table2');</script>
	 <?php
}else{
?><script>cacheId('BULLETIN_on');affiche_td_Id('BULLETIN_off');affiche_td_Id('ouvrirBULLETIN');cacheId('fermerBULLETIN');affiche_td_Id('non_table2');cacheId('table2');</script>
<?php 
}
?>

<script>cacheId('table1');</script>

<script>cacheId('fermerELEVE');</script>

<script>cacheId('ELEVE_on');</script>

</body>
</html>
