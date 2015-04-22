<?php session_start();?>
<?php
		include_once('visiteur.class.php');
		include_once('visiteurmanager.php');
		$invite = new visiteur(array('titre' => $_POST["titre"],'contenu' => $_POST["contenu"],'invite' => $_SESSION["id"]));
     
		$db = new PDO('mysql:host=localhost;dbname=prof_notes_2006_2007', 'root', '');
		$manager = new visiteurManager($db);
     
		$manager->addmsg($invite);
?>