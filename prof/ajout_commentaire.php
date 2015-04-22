<?php error_reporting(0);
session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION["id"]; ?>
<html>
<head>

<SCRIPT LANGUAGE="JavaScript">
   <!-- 
    function ajout_moyenne(){
      	
		document.form1.method = "POST" ;
        	document.form1.action = "ajout_commentaire.php" ;
        	document.close () ;
        	return false ;		
        
		
        
   }

  function verif_press(textarea,max,count) // vérifie que le nombre maxi n'a pas été atteint pendant que l'utilisateur reste appuyé sur la touche
 {
          if (textarea.value.length > max -1){ //s'il dépasse la taille requise, on sort
              alert('Vous ne pouvez rentrer que '+ max +' caractères maximum pour ce champs');
               return false;
           }
          else { // sinon
               count.value = textarea.value.length +1 ; // on met à jour le champs de contrôle.
               return true;
          }
   }
    
   // textarea est la référence du TEXTAREA à contrôler, max en est la valeur maximal, pour cette fonction count n'est pas inclu
   // car lorsqu'elle est appellée, le nombre de caractère a déja été inscrit lors de l'évenement "onkeyup"
    
   function verif_change(textarea,max) // vérifie que le nombre maxi n'a pas été atteint lorsque l'utilisateur sort du champs
  {
          if (textarea.value.length > max ){ // s'il dépasse la taille requise, on prévient et on sort
              alert('Vous ne pouvez rentrer que '+ max +' caractères maximum pour ce champs');
              return false;
          }
          else return true; // sinon, on continu
   }
  // textarea est la référence du TEXTAREA à contrôler, count est la référence
 // du champs texte de contrôle où s'affichera le nombre de caractère en cour. Cette fonction est appelée lors de l'évenement "onkeyup"
 function show_nb_car(textarea,count)
 {
             count.value = textarea.value.length;
             return true;
 }

   //-->
  </SCRIPT>
</head>
<title>prof_notes</title>
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<?php
if(!isset($_POST['ajout']) || $_POST['ajout'] == "non"){
	?>
<?php
if($_POST["matiere"]=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de matiere !!');eval(document.location.href='commentaire.php');</script>");
if($_POST["classe"]=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de classe !!');eval(document.location.href='commentaire.php');</script>");

	$classe=$_POST["classe"];
	$matiere=$_POST['matiere'];
	$trimestre=$_POST['trimestre'];
		$idclasse=mysql_query("select * from CLASSE where id_classe='$classe'");
		$nom_classe=mysql_fetch_array($idclasse);
		$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
		$ligne_matiere=mysql_fetch_array($all_matiere);
		$all_classe=mysql_query("select * from ELEVE where id_classe='$classe'");
		$ligne_classe=mysql_fetch_array($all_classe);
		$inter=mysql_query("select * from CONTROLE where id_trimestre='$trimestre' and id_matiere='$matiere' and id_classe='$classe' and id_trimestre=1");
		$table_moy = "Moyenne_de_la_classe_de_".$nom_classe[1]."_en_".$ligne_matiere[1];
		$trim=mysql_query("select * from MOYENNE_TRIMESTRE,ELEVE where MOYENNE_TRIMESTRE.id_trimestre='$trimestre' and MOYENNE_TRIMESTRE.id_matiere=$ligne_matiere[0] and ELEVE.id_eleve=MOYENNE_TRIMESTRE.id_eleve and ELEVE.id_classe=$nom_classe[0]");
		$index_trim=mysql_fetch_array($trim);
		if($inter!=NULL){
			/*while($ligne_inter=mysql_fetch_array($inter)){
				print("coucou".$ligne_inter[0]."<font color='red' size='-1'>coef:".$ligne_inter[1]."");
			}*/
			print("<h2>Les commentaires de la <font color='blue'>".$nom_classe[1]."</font> en ".$ligne_matiere[1]."<h2>"); 
			?>
			<table><tr><td bgcolor='pink'><u><font color='red'><center>coefficient de la mati&egrave;re DANS LE BULLETIN</u> :
			<?php
				
				$idcoef=mysql_query("select * from COEFFICIENT,ENSEIGNE where ENSEIGNE.id_professeur='$login' and ENSEIGNE.id_matiere='$matiere' and ENSEIGNE.id_classe='$classe' and COEFFICIENT.id_coefficient=ENSEIGNE.id_coefficient");
 				$ligne_coef=mysql_fetch_array($idcoef);
 				$num_coef=$ligne_coef[1];
 				print("<b>".$num_coef."</b>");
 				print("<form name='form1'>");
 				print("<input type='hidden' name='coef' value='$num_coef'>");
			print("</select></td></tr></table>");
			print("TRIMESTRE : ".$trimestre."<input type='hidden' name='trimestre' value='$trimestre'>");
			print("<input type='hidden' name='ajout' value='ok'>");
			print("<input type='hidden' name='matiere' value='$matiere'>");
			print("<input type='hidden' name='classe' value='$classe'>");
			print("<table><tr><th>N&#176;</th><th>NOM</th><th>Prenom</th>");
			$i=2;
			/*while($ligne_inter=mysql_fetch_array($inter)){
				print("<th>".$ligne_inter[1]."<br><font color='red' size='-1'>coef:".$ligne_inter[2]."<br>");
				print("</th>");	
				$i++;
			}*/
			
			print("<th>MOYENNE</th><th>APPRECIATION GENERALE</th><th>CONSEIL POUR PROGRESSER</tr><br>");
			$k=1;
			$all_classe=mysql_query("select * from ELEVE where id_classe='$classe' ORDER BY ELEVE.nom_eleve ASC");
			
			while($ligne_classe=mysql_fetch_array($all_classe)){
				$inter=mysql_query("select * from CONTROLE where id_trimestre='$trimestre' and id_matiere='$matiere' and id_classe='$classe'");
					if($k%2) $bgcolor=""; else $bgcolor='lightskyblue';

					$i=0;$moy=0;$somme_coef=0;
					while($ligne_inter=mysql_fetch_array($inter)){
						$note_eleve=mysql_query("select * from NOTE,ELEVE,CONTROLE,OBTIENT where CONTROLE.id_trimestre='$trimestre' and CONTROLE.id_matiere='$matiere' and OBTIENT.id_eleve='$ligne_classe[0]' and CONTROLE.id_controle='$ligne_inter[0]' and NOTE.id_note=OBTIENT.id_note and CONTROLE.id_controle=NOTE.id_controle");
						$note_eleve=mysql_fetch_array($note_eleve);
						//if(is_null($note_eleve[1])){ print("<td bgcolor='white'>ABSENT</td>"); }else{ print("<td><center><b>".$note_eleve[1]."</b></center></td>"); }
						if(!is_null($note_eleve[1])){ $i++;$moy+=$note_eleve[1]*$ligne_inter[2]; $somme_coef+=$ligne_inter[2];}
					}
					if($somme_coef!=0){
						$moyTot=$moy/=$somme_coef;
						if($moyTot<9) $color="red"; else $color="blue";
						preg_match("/([0-9]{1,2})([.]{0,1})([0-9]{0,2})/",$moyTot,$aff); 
						print("<tr bgcolor=".$bgcolor."><td>".$k."</td><td><b>".$ligne_classe[1]."</b></td><td>".$ligne_classe[2]."</td>");
						$comment=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trimestre' and id_eleve=".$ligne_classe[0]." and id_matiere='".$matiere."'");
						$ligne_com=mysql_fetch_array($comment);
						print("<input type='hidden' name='nb_car_suite' size='3' value='100'>");
						print("<input type='hidden' name='nb_car_rappel' size='3' value='100'>");
						print("<td><font size='+2' color='$color'><center><tt><b>".$aff[0]."</center><input type='hidden' name=moyenne".$k." value=".$aff[0]."></td>");
						print("<td><center><textarea rows='3' name='comment".$k."'    onKeyup='show_nb_car(this,document.text.nb_car_suite)'   onKeypress='return verif_press(this,200,nb_car_rappel)' onchange='return verif_change(this,200)'>");
							if(isset($ligne_com["appreciation_generale"])) print($ligne_com["appreciation_generale"]); 
							
						print("</textarea></td><td><center><textarea rows='3' name='conseil".$k."'onKeyup='show_nb_car(this,nb_car_suite)'   onKeypress='return verif_press(this,200,nb_car_rappel)' onchange='return verif_change(this,200)'   >"); 
							if(isset($ligne_com["conseil_pour_progresser"])) print($ligne_com["conseil_pour_progresser"]); 
							 
						print("</textarea></td></tr>");$table_moy=$table_moy.";".$aff[0];
					}else{
                                                print("<input type='hidden' name='nb_car_suite' size='3' value='100'>"); 
                                                print("<input type='hidden' name='nb_car_rappel' size='3' value='100'>");
						print("<tr bgcolor=".$bgcolor."><td>".$k."</td><td><b>".$ligne_classe[1]."</b></td><td>".$ligne_classe[2]."</td>");
						$comment=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre='$trimestre' and id_eleve=".$ligne_classe[0]." and id_matiere='".$matiere."'");
						$ligne_com=mysql_fetch_array($comment);
						print("<td><font size='+2'><center><tt><b>AUCUNE NOTE</center><input type='hidden' name=moyenne".$k." value=''></td>");
						print("<td><center><textarea rows='3' name='comment".$k."' onKeyup='show_nb_car(this,nb_car_suite)'   onKeypress='return verif_press(this,200,nb_car_rappel)' onchange='return verif_change(this,200)'>");
							if(isset($ligne_com["appreciation_generale"])) print($ligne_com["appreciation_generale"]); 
							else{
								if(isset($_POST['comment'.$k])) print($_POST['comment'.$k]);
							}
						print("</textarea></td><td><center><textarea rows='3' name='conseil".$k."'    onKeyup='show_nb_car(this,document.text.nb_car_suite)'   onKeypress='return verif_press(this,100,nb_car_rappel)' onchange='return verif_change(this,100)' >"); 
							if(isset($ligne_com["conseil_pour_progresser"])) print($ligne_com["conseil_pour_progresser"]); 
							else{
								if(isset($_POST['conseil'.$k])) print($_POST['conseil'.$k]);
							}
						print("</textarea></td></tr>");
					}
				$k++;
			}
			print("<tr  bgcolor='pink'><td colspan=3><b><center>MOYENNE</td>");
			$inter=mysql_query("select * from CONTROLE where id_trimestre='$trimestre' and id_matiere='$matiere' and id_classe='$classe'");
		
				while($ligne_inter=mysql_fetch_array($inter)){
					$somme_inter=0;$nb_note=0;
					$all_note=mysql_query("select * from NOTE where NOTE.id_controle=".$ligne_inter[0]);
					while($ligne_note=mysql_fetch_array($all_note)){				
						$somme_inter+=$ligne_note[1];
						$nb_note++;
					}
					$somme_inter/=$nb_note;
					//print("<td><center><b>".round($somme_inter,2)."</td>");
			}
			$note=explode(";",$table_moy);
			$nb=0;
			$moy_moy=0;
			$nb_note=count($note);
			$nb_note--;
			while($nb<$nb_note){
				$nb++;
				$moy_moy+=$note[$nb];
			}
			if($nb!=0){
				 $moy_moy/=$nb;
				$table_moy=$table_moy.";".$moy_moy;
				print("<td><font color=blue><center><b>".round($moy_moy,2)."</td>");
				print("</tr></table>");
				print("<input type='hidden' name='moy_classe' value=".round($moy_moy,2).">");
				//print("<a href='graphique.php?note=$table_moy'>afficher graphique des moyennes</a>");
			}else 
			print("</tr></table>");
		
		
		}else print("<h1>Aucun controle enregistré !!</h1>");
		print("<input type='submit' value='enregistrer' onCLick='ajout_moyenne();'>");
		print("</form>");
		//print("<br><br><a HREF='Javascript:history.go(-1)'>retour aux moyennes</a>");
}else{
	$classe=$_POST["classe"];
	$matiere=$_POST['matiere'];
	$trimestre=$_POST['trimestre'];
	$coef=$_POST['coef'];
	$moy_classe=$_POST["moy_classe"];if($moy_classe=="") $moy_classe="NULL";
	$idclasse=mysql_query("select * from CLASSE where id_classe='$classe'");
	$nom_classe=mysql_fetch_array($idclasse);
	$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
	$ligne_matiere=mysql_fetch_array($all_matiere);
	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe' ORDER BY ELEVE.nom_eleve ASC");
	print("<h1>Appr&eacute;ciation de la classe de ".$nom_classe[1]." en ".$ligne_matiere[1]." pour le trimestre ".$trimestre." coefficient ".$coef."</h1>");
	$i=1;
	print("<table><tr><th>N&#176;</th><th>nom</th><th>moyenne</th><th>comment</th><th>conseil</th></tr>");
	while($ligne_classe=mysql_fetch_array($all_classe)){
		$comment=mysql_query("select * from MOYENNE_TRIMESTRE where id_trimestre=".$trimestre." and id_eleve=".$ligne_classe[0]." and id_matiere='".$matiere."'");
		$ligne_com=mysql_fetch_array($comment);

		if(!isset($ligne_com["appreciation_generale"]) && !isset($ligne_com["conseil_pour_progresser"])){
			if($_POST["comment".$i]!="") $comment=$_POST['comment'.$i]; else $comment="";
			if($_POST["conseil".$i]!="") $conseil=$_POST['conseil'.$i]; else $conseil="";		
			//if($comment != "" || $conseil != ""){
				if($_POST["moyenne".$i]>0){
					$moyenne=$_POST['moyenne'.$i];
				}else{
					$moyenne="NULL";
				}
					
	 			print("<tr><td>".$i."</td><td>".$ligne_classe[1]."</td><td>".$moyenne."</td><td>".$comment."</td><td>".$conseil."</td></tr>");
				if(mysql_query("insert into MOYENNE_TRIMESTRE(id_eleve,id_matiere,id_trimestre,appreciation_generale,conseil_pour_progresser,moyenne,coef,moyenne_classe) values(".$ligne_classe[0].",".$matiere.",".$trimestre.",'".$comment."','".$conseil."','".$moyenne."','".$coef."','".$moy_classe."')"));
				else die("<h1>".__LINE__." ".$i."<br>".mysql_error());
			//}else{
			//	print("<tr><td>".$i."</td><td>".$ligne_classe[1]."</td><td>".$ligne_classe[2]."</td><td colspan=2>AUCUN COMMENTAIRE NI CONSEIL</td></tr>");
			//}	
		}else{
			$comment=$_POST['comment'.$i];
			$conseil=$_POST['conseil'.$i];
                                if($_POST["moyenne".$i]>0){
                                        $moyenne=$_POST['moyenne'.$i];
                                }else{
                                        $moyenne="NULL";
                                }
			
			if(mysql_query("update MOYENNE_TRIMESTRE set MOYENNE_TRIMESTRE.appreciation_generale='".$comment."', conseil_pour_progresser='".$conseil."', moyenne='$moyenne', coef='$coef', moyenne_classe='$moy_classe' where id_eleve='$ligne_classe[0]' and id_matiere='$matiere' and id_trimestre='$trimestre'"))
			print("<tr><td>".$i."</td><td>".$ligne_classe[1]."</td><td>".$moyenne."</td><td>".$comment."</td><td>".$conseil."</td></tr>");
			else die("<h1>".__LINE__."<br>".mysql_error());
		}
		$i++;
	}
	print("</table>");
}

?>
</body>
</html>
