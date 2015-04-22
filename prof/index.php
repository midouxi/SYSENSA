<?php session_start(); 
if(isset($_SESSION['id'])) unset($_SESSION['id']); 
if(isset($_SESSION['name'])) unset($_SESSION['name']);
if(isset($_SESSION['pp'])) unset($_SESSION['pp']);
$test=@mysql_close ();
?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
  <!--
    
    
    function soumettre_form() {
      if ( document.forms.form1.login.value == "" ) {
        alert ("Veuillez vous identifier !! ") ;
        return false ;
      } else{
         document.form1.method = "POST" ;
         document.form1.action = "verif.php" ;
         document.close () ;
         return true ;
       }
      }
      
      -->
      
  </SCRIPT>
<title>Accès Professeur </title>	
<body style="background-image:url(img/mehdi.png);background-repeat:repeat;  background-attachment:fixed;"> 


<link rel="icon" type="image/png" href="img/favicon.png">
<style type="text/css">
.mehdi {
	font-family: Tahoma, Geneva, sans-serif;
	color: #FFF;
}
</style>
</head>
<body>
<center>


<font size='18px' class="mehdi">Bienvenue </font><div id='middle'>

</div>
<h2 align='center' class="mehdi" color='blue'>Connexion</h2>
<form name='form1'>
<center>
<input type='hidden' name='type' value='log'>
<span class="mehdi">login :</span>
<input type="text" name="login"><br>
<span class="mehdi">mdp :      </span>
<input type="PASSWORD" name="mdp">
<br>
<input type="submit" value="0k" onClick='soumettre_form()'>
</form>
<center>

</div>
</body>
</html>
