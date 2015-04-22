<?php session_start();?>
<?php if(isset($_SESSION['id']) && $_SESSION['id']!="")
{
?>		
<a href="ajout_buillets.php">Ajouter message :</a></br>
<a href="deconnexion.php">se déconnecter</a>

<?php 
}
?>