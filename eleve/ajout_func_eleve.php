<HTML>
<?php
function login($login,$mdp){
	if($nb=mysql_num_rows(mysql_query("select * from eleve where nom_eleve='$login'"))>0){
		if($nb=mysql_num_rows($car=mysql_query("select * from eleve where nom_eleve='$login' and mdp='".mysql_real_escape_string($mdp)."'"))>0){
			$ligne=mysql_fetch_array($car);
			//if(session_register("login")) print("ok var<br>"); else print("cavepas<br>");
			//if(session_name($login)) print("ok".session_name()); else print("cavepas<br>");
			return "<script language='javascript'> eval(document.location.href='open_session.php?login=".$ligne[0]."') </script>";
		}else return "<script language='javascript'>alert('PASSWORD INCORRECT'); eval(document.location.href='index.php') </script>";
	}else return "<script language='javascript'>alert('UTILISATEUR INCONNU'); eval(document.location.href='index.php') </script>";
}
	
?>


<HTML>	
