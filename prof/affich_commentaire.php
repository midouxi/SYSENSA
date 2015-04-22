<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>
</head>
<title>prof_notes</title>
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<h1>Afficher les commentaires</h1>
<?php
        $classe=mysql_query("select * from CLASSE,ENSEIGNE where CLASSE.id_classe=ENSEIGNE.id_classe and ENSEIGNE.id_professeur='$login' GROUP BY CLASSE.id_classe");
        if($nb=mysql_num_rows($classe)>1){ ?>

        Voir la classe : <select onChange="document.location=this.options[this.selectedIndex].value">
        <form>
        <option>CHOISIR
        <?php 
                while($ligne=mysql_fetch_array($classe)){?>
                <option value="affich_commentaire.php?idc=<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
                }
        ?>
        </select>
        </form>
        <?php 
        }else{
                $ligne=mysql_fetch_array($classe);
                $_GET['idc']=$ligne[0];
        } ?>
<br>
<?php   
        if(isset($_GET['idc'])){
        $classe=$_GET['idc'];
        $idclasse=mysql_query("select * from CLASSE where id_classe='$classe'");
        $nom_classe=mysql_fetch_array($idclasse);
        $mat=mysql_query("select * from MATIERE,ENSEIGNE,PROFESSEUR where PROFESSEUR.id_professeur='$login' and ENSEIGNE.id_classe='$classe' and ENSEIGNE.id_professeur=PROFESSEUR
.id_professeur and ENSEIGNE.id_matiere=MATIERE.id_matiere GROUP BY MATIERE.id_matiere");
       print("<h2>Choix de la matiere : pour la <font color='blue'>".$nom_classe[1]."</font></h2>"); }?>
        <form name='form1' method='post' action='affich_commentaire.php'>
        <select name='matiere'>

        <?php if($nb=mysql_num_rows($mat)>1){ ?><option>CHOISIR <?php }
                while($ligne=mysql_fetch_array($mat)){ ?>
                        <option value="<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
        
                }       
        ?>
        </select>
                        Trimestre : <select name="trimestre">
                        <?php $matiere=mysql_query("select * from TRIMESTRE");
                        while($ligne=mysql_fetch_array($matiere)){?>
                        <option value=<?php print("'".$ligne[0]."'"); if($ligne[0]==2) print("selected"); ?> >
                        <?php print($ligne[1]);
                        }
                        ?>
                        </select>

        <input type='hidden' value='classe' name='choi'>
        <input type='hidden' value=<?php print($classe); ?> name='classe'><br>
        <input type='submit' value='0k'>
        </form>





<?php
if(isset($_POST["classe"])){
	$classe=$_POST["classe"];
	$matiere=$_POST['matiere'];
	$trimestre=$_POST['trimestre'];
	$idclasse=mysql_query("select * from CLASSE where id_classe='$classe'");
	$nom_classe=mysql_fetch_array($idclasse);
	$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
	$ligne_matiere=mysql_fetch_array($all_matiere);
	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe' ORDER BY ELEVE.nom_eleve ASC");
	print("<h1>Appreciation de la classe de ".$nom_classe[1]." en ".$ligne_matiere[1]." pour le trimestre ".$trimestre."</h1>");
	$i=1;
	print("<table><tr><th>n&#176;</th><th>nom</th><th>moyenne</th><th>comment</th><th>conseil</th></tr>");
	while($ligne_classe=mysql_fetch_array($all_classe)){
		$comment=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre=".$trimestre." and id_eleve=".$ligne_classe[0]." and id_matiere='".$matiere."'");
		$ligne_com=mysql_fetch_array($comment);

		if($ligne_com["appreciation_generale"]=="" && $ligne_com["conseil_pour_progresser"]==""){
				if($ligne_com["moyenne"]>0){
					$moyenne=$ligne_com["moyenne"];
				}else{
					$moyenne="NULL";
				}
					
	 			print("<tr><td>".$i."</td><td>".$ligne_classe[1]."</td><td>".$moyenne."</td><td>".$ligne_com["apreciation_generale"]."</td><td>".$ligne_com["conseil_pour_progresser"]."</td></tr>");				
		}else{
			$comment=$ligne_com["appreciation_generale"];
			$conseil=$ligne_com["conseil_pour_progresser"];
                                if($ligne_com["moyenne"]>0){
                                        $moyenne=$ligne_com["moyenne"];
                                }else{
                                        $moyenne="NULL";

                                }

			print("<tr><td>".$i."</td><td>".$ligne_classe[1]."</td><td>".$moyenne."</td><td>".$comment."</td><td>".$conseil."</td></tr>");
		}
		$i++;
	}
	print("</table>");
}

?>
</body>
</html>
