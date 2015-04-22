<HTML>
<?php
function login($login,$mdp){
	if($nb=mysql_num_rows(mysql_query("select * from PROFESSEUR where nom_professeur='$login'"))>0){
		if($nb=mysql_num_rows($car=mysql_query("select * from PROFESSEUR where nom_professeur='$login' and mdp='".mysql_real_escape_string($mdp)."'"))>0){
			$ligne=mysql_fetch_array($car);
			//if(session_register("login")) print("ok var<br>"); else print("cavepas<br>");
			//if(session_name($login)) print("ok".session_name()); else print("cavepas<br>");
			return "<script language='javascript'> eval(document.location.href='open_session.php?login=".$ligne[0]."') </script>";
		}else return "<script language='javascript'>alert('PASSWORD INCORRECT'); eval(document.location.href='index.php') </script>";
	}else return "<script language='javascript'>alert('UTILISATEUR INCONNU'); eval(document.location.href='index.php') </script>";
}
	
function ajout_matiere($matiere){
	$matiere_exist=mysql_query("select * from MATIERE where nom_matiere='$matiere'");
	if(($nb_mat=mysql_num_rows($matiere_exist)	)>0){
		$list=mysql_fetch_array($matiere_exist);
		print("La matiere ".$matiere."a le numero ".$list[0]);
	}else{
		if($MATIERE=mysql_query("insert into MATIERE(nom_matiere) values('$matiere')")) return "insertion <b>matiere</b> ok<BR>"; else return mysql_error();
	}
}

function ajout_professeur($nom,$prenom){
	$prof_exist=mysql_query("select * from PROFESSEUR where nom_professeur='$nom' and prenom_professeur='$prenom'");
	if(($exists=mysql_num_rows($prof_exist))>0){
		$ligne=mysql_fetch_array($prof_exist);
		print($nom." ".$prenom." a le numero ".$ligne[0]."<br>");
		return $ligne[0];
	}else{
		$p=split("[a-z]",$prenom);$pass=strtolower($p[0].$nom);

		if($prof=mysql_query("insert into PROFESSEUR(nom_professeur,prenom_professeur,mdp) values('$nom','$prenom','$pass')")) return mysql_insert_id();  else return mysql_error();
	}
}

function ajout_pp($nom,$prenom,$classe){
	$id_classe=mysql_query("select * from CLASSE where nom_classe='$classe'");
	$idclasse=mysql_fetch_array($id_classe);
	$idprofesseur=ajout_professeur($nom,$prenom);
	if($new_pp=mysql_query("update CLASSE set id_pp='$idprofesseur' where CLASSE.id_classe='$idclasse[0]'")) print("insertion <b>".$nom." ".$prenom." reussie dans classe".$classe."!"); else return mysql_error();
	
}

function ajout_eleve($nom,$prenom,$classe){
	$eleve_exist=mysql_query("select * from ELEVE where nom_eleve='$nom' and prenom_eleve='$prenom' and id_classe='$classe'");
	if(($exists=mysql_num_rows($eleve_exist))>0){
		$ligne=mysql_fetch_array($eleve_exist);
		return $nom." ".$prenom." a le numero ".$ligne[0]."<br>";
	}else{
		if($eleve=mysql_query("insert into ELEVE(nom_eleve,prenom_eleve,id_classe) values('$nom','$prenom','$classe')")) return "insertion <b>eleve</b> ok<br>"; else return mysql_error();
	}
}

function ajout_coef($coef){
	$coef_exist=mysql_query("select * from COEFFICIENT where num_coefficient='$coef'");
	if(($exists=mysql_num_rows($coef_exist))>0){
		$ligne=mysql_fetch_array($coef_exist);
		return $ligne[0];
	}else{
		if($coefinser=mysql_query("insert into COEFFICIENT(num_coefficient) values('$coef')")) return mysql_insert_id();  else return mysql_error();
	}

}
function ajout_enseigne($nom,$prenom,$matiere,$coef,$classe){
	$id_classe=mysql_query("select * from CLASSE where id_classe='$classe'");
	$id_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
	
	$idclasse=mysql_fetch_array($id_classe);
	$idprofesseur=ajout_professeur($nom,$prenom);
	$idcoef=ajout_coef($coef);
	$idmatiere=mysql_fetch_array($id_matiere);
	$enseigne_exist=mysql_query("select * from ENSEIGNE where id_classe='$idclasse[0]' and id_professeur='$idprofesseur' and id_matiere='$id_matiere[0]'");
        if(($exists=mysql_num_rows($enseigne_exist))>0){
        	$ligne=mysql_fetch_array($enseigne_exist);
        	return $nom." ".$prenom." ensegne deja la matiere ".$idmatiere[1]." a la classe ".$classe[1];
        }else{
                if($enseigne=mysql_query("insert into ENSEIGNE(id_professeur,id_classe,id_matiere,id_coefficient) values('$idprofesseur','$idclasse[0]','$idmatiere[0]','$idcoef')")) print("insertion <b>enseignement</b> ok<br>"); else print(mysql_error());
	}
}
?>	
<HTML>	
