<html>
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>

</body>
	
<?php
//if(isset($_GET["idc"])){
for($j=1;$j<=17;$j++){
	$classe=mysql_query("select * from CLASSE where id_classe='$j'");
	$id_classe=mysql_fetch_array($classe);
	print("<br><h1>".$id_classe[0]."</h1><br><h1>".$id_classe[1]."</h1><br>");
	//if($contenu_string = file_get_contents("c://test//test.txt"))
	//print $contenu_string; else print("erreur fichier<br>");
	$noms = file("./test/classe/".$j.".txt");
	
	$insertNom = array();
	// pour chaque nom, on enlève le caractère de retour de chariot
	// et on place sous forme d'insertion mysql dans un autre tableau
	foreach ($noms as $nom) {
	    $insertNom[] = "('".rtrim($nom)."')";
	}
	
	print_r($insertNom);
	
	for($i=0;$i<sizeof($insertNom);$i++){
		$query = "insert into  ELEVE(nom_eleve,prenom_eleve,id_classe) values (".$insertNom[$i].",".$insertNom[$i+=1].",".$id_classe[0].")";
		if(mysql_query($query)) print("insertion ok"); else die("<br><b>".mysql_error()."<br>".__LINE__."<br>");
	}
}

?>
</html>
