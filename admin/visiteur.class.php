<?php
	class visiteur
	{
		
		private $login;
		private $mdp;
		private $titre;
		private $contenu;
		private $invite;
		private $date_de_creation;
		
		
		// Méthode hydrate(): ssigner les valeurs passées en paramètres aux attributs correspondant
		public function __construct(array $donnees)
		{
			foreach ($donnees as $key => $value)
			{
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method))
				{
					$this->$method($value);
				}
			}
		}
		
		// Liste des getters**************************************************
		
		 
		public function login()
		{
			return $this->login;
		}
		
		public function mdp()
		{
		return $this->mdp;
		}
		
		public function titre()
		{
		return $this->titre;
		}
		
		public function contenu()
		{
		return $this->contenu;
		}
		
		public function invite()
		{
		return $this->invite;
		}
		
		public function date_de_creation()
		{
			return $this->date_de_creation;
		}
		
		// Liste des setters**************************************************
		
		
		public function setLogin($login)
		{
			if (is_string($login))
			{
			  $this->login = $login;
			}
		}
		
		public function setmdp($mdp)
		{
			  $this->mdp = $mdp;
		}
		
		public function setTitre($titre)
		{
			  $this->titre = $titre;
		}
		
		public function setContenu($contenu)
		{
			  $this->contenu = $contenu;
		}
		
		public function setInvite($invite)
		{
			  $this->invite = $invite;
		}
		
		public function setdate($date)
		{
			  $this->date_de_creation = $date;
		}
}
?>