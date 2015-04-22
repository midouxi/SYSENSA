<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Language" content="fr" />
</head>
<body >

<?php
include("../connect.php");
	$classe=mysql_query("select * from CLASSE");
?>
<div id="eleve">
	<h2>Administration eleves</h2>
	<form method="post" action="affich_classe.php">
	Voir les eleves de la classe : <select name='name'>
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
</div>
</html>