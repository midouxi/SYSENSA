
<?php
	class visiteurmanager
	{
		private $_db;
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		 
		public function add(visiteur $visiteur)
		{
			$q = $this->_db->prepare('INSERT INTO invite SET login = :login, passwd = :passwd');
			$q->bindValue(':login', $visiteur->login(), PDO::PARAM_INT);
			$q->bindValue(':passwd', $visiteur->passwd(), PDO::PARAM_INT);
			$q->execute();
?>
					<script>alert('Merci, votre inscription a été bien enregistré !');</script>
					<meta http-equiv="Refresh" content="0;url=personnelle.php">
<?php
		}
		
		public function addmsg(visiteur $visiteur)
		{
			$q = $this->_db->prepare('INSERT INTO messages SET titre = :titre, contenu = :contenu, invite = :invite, date_de_creation = :date_de_creation');
			$q->bindValue(':titre', $visiteur->titre());
			$q->bindValue(':contenu', $visiteur->contenu(), PDO::PARAM_INT);
			$q->bindValue(':invite', $visiteur->invite(), PDO::PARAM_INT);
			$q->bindValue(':date_de_creation', date("d/m/Y H:M:S"), PDO::PARAM_INT);
			$q->execute();
?>
					<script>alert('Votre message a été bien enregisté dans l\'attente de confirmation');</script>
					<meta http-equiv="Refresh" content="0;url=acceuil.php">
<?php
		}
		 
		public function delete(visiteur $visiteur)
		{
			$this->_db->exec('DELETE FROM invite WHERE id = '.$visiteur->id());
		}
		
		public function identifier(visiteur $visiteur)
		{
			$q = $this->_db->query('SELECT * FROM invite');
			$_SESSION['login']=$_SESSION['passwd']="";
			while($donnee = $q->fetch())
				{
					if(htmlspecialchars($_POST['login'])==$donnee['login'] && htmlspecialchars($_POST['passwd'])== $donnee['passwd'])
					{
						$_SESSION['login']=$donnee['login'];
						$_SESSION['passwd']=$donnee['passwd'];
?>
						<script>alert("Bienvenue !");</script>
						<meta http-equiv="Refresh" content="0;url=personnelle.php">
<?php
					}
				}
				if($_SESSION['login']=="")
				{
?>
					<script>alert('Pseudo ou mot de passe incorrecte');</script>
					<meta http-equiv="Refresh" content="0;url=personnelle.php">
<?php
				}
		}
		
		
		
		public function affichemsg(visiteur $visiteur)
		{
			$q = $this->_db->query('SELECT * FROM messages ORDER BY date_de_creation DESC');
			while($donnee = $q->fetch())
				{
					if($donnee['invite']==$visiteur->login())
					{
						echo "Date    : ".$donnee['date_de_creation']."</br>";
						echo "Titre   : ".$donnee['titre']."</br>";
						echo "Source   : ".$donnee['invite']."</br>";
						echo "Contenu : ".$donnee['contenu']."</br></br></br>";
					}
				}
		}
		
	
		
		public function modpasswd(visiteur $visiteur)
		{
			$q = $this->_db->query('SELECT * FROM invite');
			while($donnee = $q->fetch())
				{
					if($donnee['login']==$_SESSION["login"])
					{
						$q = $this->_db->prepare('UPDATE invite SET passwd = :passwd WHERE login = :login');
							$q->bindValue(':passwd', $visiteur->passwd(), PDO::PARAM_INT);
							$q->bindValue(':login', $_SESSION['login'], PDO::PARAM_INT);
							$q->execute();
					}
				}
		}
		
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
	}
?>