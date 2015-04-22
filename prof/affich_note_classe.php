<?php 

session_start(); $login=$_SESSION['id'];?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
   <!--
    
    
    function soumettre_form() {
      if (document.forms.form1.choi.value == "eleve" ){
      	//alert("valeur de test: "+document.forms.form1.choi.value+" et classe"+document.forms.form1.classe.value);
        document.form1.method = "POST" ;
        document.form1.action = "affich_note.php" ;
        document.close () ;
        return false ;
      }else{
        //alert("valeur de test: "+document.forms.form1.choi.value+" et classe"+document.forms.form1.classe.value);
        document.form1.method = "POST" ;
        document.form1.action = "affich_note_classe.php" ;
        document.close () ;
        return false ;
      }
    }
       
    function effacer_inter(number){

      	var name=confirm("Etes vous sur de vouloir supprimer l'interrogation "+document.forms['form'+number].inter_nom.value);
	if (name==true){
		document.forms['form'+number].method = "POST" ;
        	document.forms['form'+number].action = "suppr_interro.php" ;
        	document.close () ;
        	return false ;		
        }else{
		document.forms['form'+number].method = "POST" ;
        	document.forms['form'+number].action = "affich_note_classe.php" ;
        	document.close () ;
        	return false ;
	}
   }
function getPercent(myText,myNewPercent, myDiv) {
  d=document.getElementById(myDiv);
d.innerHTML = "<center>"+myText+"</center>";
  d.style.width = myNewPercent+"%";
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
if(!isset($_GET['idm'])){
	//$ligne=mysql_fetch_array($classe);
	//$nb=mysql_num_rows($classe);
	?>
	<h1>Afficher les notes</h1>

       	Voir la classe : <select onChange="document.location=this.options[this.selectedIndex].value">
        <form>
        <option>CHOISIR
        <?php 
		$classe=mysql_query("select * from CLASSE,ENSEIGNE where CLASSE.id_classe=ENSEIGNE.id_classe and ENSEIGNE.id_professeur='$login' GROUP BY CLASSE.nom_classe");
                while($ligne=mysql_fetch_array($classe)){?>
                	<option value="affich_note.php?idc=<?php print($ligne[0]); ?>" ><?php print($ligne[1]);
              	}
        ?>
        </select>
        </form>
<br>

<?php	
if($_POST["idm"]=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de matiere !!');eval(document.location.href='affich_note.php');</script>");
if($_POST["idc"]=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de classe !!');eval(document.location.href='affich_note.php');</script>");
	$matiere=$_POST["idm"];
	$classe=$_POST["idc"];
	$trimestre=$_POST["trimestre"];
	$idclasse=mysql_query("select * from CLASSE where id_classe='$classe'");
	$nom_classe=mysql_fetch_array($idclasse);
	$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
	$ligne_matiere=mysql_fetch_array($all_matiere);
	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe'");
	$ligne_classe=mysql_fetch_array($all_classe);
	$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere' and id_classe='$classe' and id_trimestre='$trimestre'");
	$table_moy = "Moyenne_de_la_classe_de_".$nom_classe[1]."_en_".$ligne_matiere[1];
	if($inter!=NULL){

		print("<h2>Les notes de la <font color='blue'>".$nom_classe[1]."</font> en ".$ligne_matiere[1]."<h2>"); 
		?>
		
		<div id="notes" style="height : 21px ;width: 100% ; border : 1px solid #000000;">
		<div align='left'>
		<div id='progBar' style="height: 21px ;width:0%; background-image:url(img/load.gif);">
			<img src='img/load.gif' align='left'></img>	
  		</div>
		</div>
		</div>
		<?php
		$affich = "<table><tr><th>N&#xb0;</th><th>NOM</th><th>Prenom</th>";
		$i=2;
		while($ligne_inter=mysql_fetch_array($inter)){
			$affich = $affich. "<th><a href=modif_nom_inter?id_c=".$ligne_inter[0].">".$ligne_inter[1]."</a><br><font color='red' size='-1'><a href=modif_coef.php?id=".$ligne_inter[0].">coef:".$ligne_inter[2]."</a><br>";
			 $affich = $affich. "<form name=form".$i.">"; 
				$affich = $affich. "<input type=hidden name='trimestre' value=".$trimestre." >";
				$affich = $affich. "<input type=hidden name='inter_nom' value=".$ligne_inter[1]." >";
				$affich = $affich. "<input type=hidden name='inter' value=".$ligne_inter[0]."  >";
				$affich = $affich. "<input type=hidden name='matiere' value=".$matiere."  >";
				$affich = $affich. "<input type=hidden name='classe' value=".$classe."  >";
				$affich = $affich. "<input type='submit' value='supprimer' onClick='effacer_inter(".$i.")'><br /></form>";
				
				$affich = $affich. "</th>";	
			$i++;
		}
		
		$affich = $affich. "<th>MOYENNE</th></tr><br>";
		$k=1;
		$all_classe=mysql_query("select * from ELEVE where id_classe='$classe' ORDER BY ELEVE.nom_eleve ASC");
		$num_rows=1;
		$nb_eleve=mysql_num_rows($all_classe);
	while ($num_rows < $nb_eleve) {
		while($ligne_classe=mysql_fetch_array($all_classe)){
			$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere' and id_classe='$classe' and id_trimestre='$trimestre'");
				if($k%2) { $bgcolor="";} else {$bgcolor='lightskyblue';}
				$affich = $affich. "<tr bgcolor=".$bgcolor."><td>".$k."</td><td><b>".$ligne_classe[1]."</b></td><td>".$ligne_classe[2]."</td>";
				$i=0;$moy=0;$somme_coef=0;
				while($ligne_inter=mysql_fetch_array($inter)){
					$note_eleve=mysql_query("select * from NOTE,ELEVE,CONTROLE,OBTIENT where CONTROLE.id_trimestre='$trimestre' and CONTROLE.id_matiere='$matiere' and OBTIENT.id_eleve='$ligne_classe[0]' and CONTROLE.id_controle='$ligne_inter[0]' and NOTE.id_note=OBTIENT.id_note and CONTROLE.id_controle=NOTE.id_controle");
					$note_eleve=mysql_fetch_array($note_eleve);
					if(is_null($note_eleve[1])){ $affich = $affich. "<td bgcolor='white'><a href='modif_note.php?ide=$ligne_classe[0]&idc=$ligne_inter[0]&ne=$k'>ABSENT</a></td>"; }else{ $affich = $affich. "<td><center><b><a href='modif_note.php?ide=$ligne_classe[0]&idc=$ligne_inter[0]&idn=$note_eleve[0]&ne=$k'>".$note_eleve[1]."</b></center></td>"; }
					if(!is_null($note_eleve[1])){ $i++;$moy+=$note_eleve[1]*$ligne_inter[2]; $somme_coef+=$ligne_inter[2];}
				}
				if($somme_coef!=0){
					$moyTot=$moy/=$somme_coef;
					if($moyTot<9){ $color="red";} else{ $color="blue";}
					preg_match("/([0-9]{1,2})([.]{0,1})([0-9]{0,2})/",$moyTot,$aff); 
					$affich = $affich. "<td><font size='+2' color='$color'><center><tt><b>".$aff[0]."</center></td></tr>";$table_moy=$table_moy.";".$aff[0];
				}
			
			$pourcent=$num_rows*100;
			$pourcent/=$nb_eleve;
			$k++;
			?>
			
			<script language="Javascript">getPercent('<?php print($num_rows." / ".$nb_eleve); ?>','<?php print($pourcent); ?>','progBar');</script>
			<?php
			  flush();

			$num_rows++;
		}
		$affich = $affich. "<tr  bgcolor='pink'><td colspan=3><b><center>MOYENNE</td>";
		$inter=mysql_query("select * from CONTROLE where id_trimestre='$trimestre' and id_matiere='$matiere' and id_classe='$classe'");
	
			while($ligne_inter=mysql_fetch_array($inter)){
				$somme_inter=0;$nb_note=0;
				$all_note=mysql_query("select * from NOTE where NOTE.id_controle=".$ligne_inter[0]);
				while($ligne_note=mysql_fetch_array($all_note)){				
					$somme_inter+=$ligne_note[1];
					$nb_note++;
				}
				$somme_inter/=$nb_note;
				$affich = $affich. "<td><center><b>".round($somme_inter,2)."</td>";
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
			$affich = $affich. "<td><font color=blue><center><b>".round($moy_moy,2)."</td>";
			$affich = $affich. "</tr></table>";
			$affich = $affich. "<a href='graphique.php?note=$table_moy'>afficher graphique des moyennes</a>";
		}else{ 
		$affich = $affich. "</tr></table>";
		
	}

	}}else $affich = "<h1>Aucun controle enregistré !!</h1>";
	print($affich);

	?>
	
	
	<?php
}else{
if($_GET['idm']=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de matiere !!');eval(document.location.href='affich_note.php');</script>");
if($_GET['idc']=='CHOISIR') print("<script>alert('Vous n avez pas renseigne de classe !!');eval(document.location.href='affich_note.php');</script>");
$classe=$_GET['idc'];
$matiere=$_GET['idm'];
$trimestre=$_GET['idt'];
	$idclasse=mysql_query("select * from CLASSE where id_classe='$classe'");
	$nom_classe=mysql_fetch_array($idclasse);
	$all_matiere=mysql_query("select * from MATIERE where id_matiere='$matiere'");
	$ligne_matiere=mysql_fetch_array($all_matiere);
	$all_classe=mysql_query("select * from ELEVE where id_classe='$classe'");
	$ligne_classe=mysql_fetch_array($all_classe);
	$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere' and id_classe='$classe' and id_trimestre='$trimestre'");
	$table_moy = "Moyenne_de_la_classe_de_".$nom_classe[1]."_en_".$ligne_matiere[1];
	if($inter!=NULL){
		print("<h2>Les notes de la <font color='blue'>".$nom_classe[1]."</font> en ".$ligne_matiere[1]."<h2>"); 
		
		$affich = "<table><tr><th>N°</th><th>NOM</th><th>Prenom</th>";
		$i=2;
		while($ligne_inter=mysql_fetch_array($inter)){
			$affich = $affich. "<th>".$ligne_inter[1]."<br><font color='red' size='-1'>coef:".$ligne_inter[2]."<br>";
			$affich = $affich. "</th>";	
			$i++;
		}
		
		$affich = $affich. "<th>MOYENNE</th></tr><br>";
		$k=1;
		$all_classe=mysql_query("select * from ELEVE where id_classe='$classe' ORDER BY ELEVE.nom_eleve ASC");
		
		while($ligne_classe=mysql_fetch_array($all_classe)){
			$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere' and id_classe='$classe' and id_trimestre='$trimestre'");
				if($k%2) $bgcolor=""; else $bgcolor='lightskyblue';
				$affich = $affich. "<tr bgcolor=".$bgcolor."><td>".$k."</td><td><b>".$ligne_classe[1]."</b></td><td>".$ligne_classe[2]."</td>";
				$i=0;$moy=0;$somme_coef=0;
				while($ligne_inter=mysql_fetch_array($inter)){
					$note_eleve=mysql_query("select * from NOTE,ELEVE,CONTROLE,OBTIENT where CONTROLE.id_trimestre='$trimestre' and CONTROLE.id_matiere='$matiere' and OBTIENT.id_eleve='$ligne_classe[0]' and CONTROLE.id_controle='$ligne_inter[0]' and NOTE.id_note=OBTIENT.id_note and CONTROLE.id_controle=NOTE.id_controle");
					$note_eleve=mysql_fetch_array($note_eleve);
					if(is_null($note_eleve[1])){ $affich = $affich. "<td bgcolor='white'>ABSENT</td>"; }else{ $affich = $affich. "<td><center><b>".$note_eleve[1]."</b></center></td>"; }
					if(!is_null($note_eleve[1])){ $i++;$moy+=$note_eleve[1]*$ligne_inter[2]; $somme_coef+=$ligne_inter[2];}
				}
				if($somme_coef!=0){
					$moyTot=$moy/=$somme_coef;
					if($moyTot<9) $color="red"; else $color="blue";
					preg_match("/([0-9]{1,2})([.]{0,1})([0-9]{0,2})/",$moyTot,$aff); 
					$affich = $affich. "<td><font size='+2' color='$color'><center><tt><b>".$aff[0]."</center></td></tr>";$table_moy=$table_moy.";".$aff[0];
				}
			$k++;
		}
		$affich = $affich. "<tr  bgcolor='pink'><td colspan=3><b><center>MOYENNE</td>";
		$inter=mysql_query("select * from CONTROLE where id_matiere='$matiere' and id_classe='$classe' and id_trimestre='$trimestre'");
	
			while($ligne_inter=mysql_fetch_array($inter)){
				$somme_inter=0;$nb_note=0;
				$all_note=mysql_query("select * from NOTE where NOTE.id_controle=".$ligne_inter[0]);
				while($ligne_note=mysql_fetch_array($all_note)){				
					$somme_inter+=$ligne_note[1];
					$nb_note++;
				}
				$somme_inter/=$nb_note;
				$affich = $affich. "<td><center><b>".round($somme_inter,2)."</td>";
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
			$affich = $affich. "<td><font color=blue><center><b>".round($moy_moy,2)."</td>";
			$affich = $affich. "</tr></table>";
			$affich = $affich. "<a href='graphique.php?note=$table_moy'>afficher graphique des moyennes</a>";
		}else 
		$affich = $affich. "</tr></table>";
	
	
	}else $affich = $affich. "<h1>Aucun controle enregistré !!</h1>";
	
	$affich = $affich. "<br><br><a HREF='Javascript:history.go(-1)'>retour</a>";
}
?>
</body>
</html>
