<html>
<?php include("connect.php"); ?>

<?php
$prf=mysql_query("select * from PROFESSEUR");
while($nom=mysql_fetch_array($prf)){
	$name=strtolower($nom[1]);
	$prenom=strtolower($nom[2]);
	list($p)=split('[^a-z]',$prenom);
	$mdp=$p[0].$name;
	print($nom[2]." ".$nom[1]." a comme mdp ".$mdp);
	if(mysql_query("update PROFESSEUR set mdp='$mdp' where nom_professeur='$nom[1]' and prenom_professeur='$nom[2]'")) print(" insertion ok<br>");
	else die(mysql_error());
}
?>
</html>