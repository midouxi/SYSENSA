<?php session_start(); if(!isset($_SESSION["id"])) echo "<script language=JavaScript> eval(document.location.href='index.php') </script>"; $login=$_SESSION['id'];?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
   <!--
    
    
    function soumettre_form() {
      if (document.forms.form1.adr1.value == "" || document.forms.form1.adr2.value == ""){
      	alert("Vousa avez laisse des champs vides !");
        return false ;
      }else{
        document.form1.method = "POST" ;
        document.form1.action = "adresse_mail_pp.php" ;
        document.close () ;
        return true ;
      }
    }
        
   //-->
  </SCRIPT>
</head>
<title>prof_notes</title>
	
<?php include("connect.php"); ?>
<link rel="stylesheet" type="text/css" href="style.css">
</head><body>
<?
$query="select * from PROFESSEUR where id_professeur='$login'";
$prof=mysql_query($query);
$table=mysql_fetch_array($prof);
if(isset($_POST["adr1"]) && isset($_POST["adr2"]) ){
	$mail=$_POST["adr1"]."@".$_POST["adr2"];
	$insert="UPDATE PROFESSEUR set adr_mail='$mail' where id_professeur='$login'";
	if($sql=mysql_query($insert)) echo "<script language='javaScript'> eval(dcument.location.href='adresse_mail_pp.php'); </script>";
	else print(mysql_error());
} 
if(!isset($_GET["modif"])){
	print("Adresse mail :".$table[4]."<br><a href='adresse_mail_pp.php?modif=1'>modifer_adresse</a>");
}else{
	if($table[4]!=NULL){
		$adr=split("@",$table[4]);
	}else $adr[0]="";$adr[1]="";
?>
	<form name='form1'>
	<input type=text maxlength='15' size='15' value=<?php print("'".$adr[0]."'"); ?> name="adr1" >@<input type=text maxlength='15' size='15' value=<?php print("'".$adr[1]."'"); ?> name="adr2">
	<input type=submit value="0k" onClick='soumettre_form()'>
<?
}
?>
</html>