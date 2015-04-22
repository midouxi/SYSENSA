<?php
	$aff_moyenne_matiere=$_POST['moyenne_dl'];;
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=AddressBook_" . date("Ymd").".xls");
	print $aff_moyenne_matiere;
	exit;
?>