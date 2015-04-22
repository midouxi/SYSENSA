<html>
<?php
if(!$connect=mysql_connect("localhost","root","")) mysql_error();
if(!$db=mysql_select_db("prof_notes_2006_2007",$connect)) mysql_error(); 
/* if(!$connect=mysql_connect("localhost","isja_admin","isja1245")) mysql_error();
if(!$db=mysql_select_db("isja_profnotes2006",$connect)) mysql_error();*/
?>
</html>