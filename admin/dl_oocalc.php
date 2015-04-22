<?php
	$aff_moyenne_matiere=$_POST['moyenne_dl'];;
	header("Content-type: application/vnd.sun.xml.calc");
	header("Content-disposition: attachment; filename=AddressBook_" . date("Ymd").".sxc");
	print $aff_moyenne_matiere;
	exit;
?>