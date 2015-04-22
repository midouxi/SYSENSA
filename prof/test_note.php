<html>
<?php if(!$connect=mysql_connect("localhost","root")) mysql_error();
if(!$db=mysql_select_db("prof_notes_save1",$connect)) mysql_error();
?>
</html>

<form method='post'>
<input type='float' name='nb' maxlength='5' size='4'>
<input type='submit' action='test_note.php'>
</form>
<?php
if(isset($_POST['nb'])) { if($_POST['nb']!=null) print("nb vaut : ".$_POST['nb']."<br>"); else print("PAS DE NB!!!<br>"); }
#$insert_test=mysql_query("insert into NOTE(note,id_controle) values('15.71','300')") or die(mysql_error());

 
 
#$select_test=mysql_query("select * from NOTE where id_controle='300'");
#$select=mysql_fetch_array($select_test);print("controle enregistré : ".$select[0]."<br>");
$close=mysql_close();
?>
