<?php
class Membre
{
	private $bdd;
	
	public function __construct()
	{
		$this->bdd = new PDO("mysql:host=localhost;dbname=auto_ecole", "root", "");
	}
	
	public function getVerifPass($password, $passverif)
	{
		if($password==$passverif)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function inscription($email, $password, $nom, $prenom, $date_naiss, $adresse)
	{	
		$req = $this->bdd->prepare("SELECT email FROM user WHERE email=:email");
		$req->execute(array("email" => $email));
		$doublemail = $req->fetch()[0];
		
		if(strtolower($doublemail)==strtolower($email))
		{
			echo("L'email est déjà utilisé, il ce peut que vous soyez déjà inscrit sur notre site.\n");
		}
		
		if(!$doublemail)
		{
			$password = sha1($password);
			$req = $this->bdd->prepare("INSERT INTO eleve(email, password, date_insc, nom, prenom, date_naiss, coordonnee) 
				VALUES(:email, :pass, CURDATE(), :nom, :prenom, :date_naiss, :coordonnee)");
			$req->execute(array(
				"pass" => $password,
				"email" => $email,
				"nom" => $nom,
				"prenom" => $prenom,
				"date_naiss" => $date_naiss,
				"coordonnee" => $adresse));
			echo("Félicitation vous etes maintenant inscrit sur notre site web.");
			echo"<br/><br/>";
			echo"<meta http-equiv=\"Refresh\" content=\"2\">";
		}
	}
	
	public function connection($email, $password)
	{
		$password = sha1($password);
		$req = $this->bdd->prepare("SELECT * FROM user WHERE email=:email AND password=:pass");
		$req->execute(array("email" => $email, "pass" => $password));
		$resultat = $req->fetch();
		
		if (!$resultat)
		{
			return null;
		}
		else
		{
			return $resultat;
		}
	}

	private function selectId($email, $table)
	{
		$req = $this->bdd->prepare("SELECT * FROM ".$table." WHERE email=:email");
		$req->execute(array("email" => $email));
		$resultat = $req->fetch();

		return $resultat;
	}

	public function findReal($id_user)
	{
		$resultat=$this->selectId($id_user, "eleve");
		if(!$resultat)
		{
			$resultat=$this->selectId($id_user, "moniteur");
			if (!$resultat)
			{
				$resultat=$this->selectId($id_user, "gestionnaire");
				if (!$resultat)
				{
					return 0;
				}
				else
				{
					return $resultat['id_user'];
				}
			}
			else
			{
				return $resultat['id_user'];
			}

		}
		else
		{
			return $resultat['id_user'];
		}
	}

	public function findType($id_user)
	{
		$resultat=$this->selectId($id_user, "eleve");
		if(!$resultat)
		{
			$resultat=$this->selectId($id_user, "moniteur");
			if (!$resultat)
			{
				$resultat=$this->selectId($id_user, "gestionnaire");
				if (!$resultat)
				{
					return 0;
				}
				else
				{
					return 3;
				}
			}
			else
			{
				return 2;
			}

		}
		else
		{
			return 1;
		}
	}

	public function listerMoniteur()
	{
		$req = $this->bdd->prepare("SELECT * FROM moniteur");
		$req->execute();
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function listerEleve()
	{
		$req = $this->bdd->prepare("SELECT * FROM eleve");
		$req->execute();
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function listerCoursDispo($moniteur, $date)
	{
		$cours=array('08','09','10','11','12','13','14','15','16','17','18','19');
		$req = $this->bdd->prepare("SELECT * FROM planning WHERE id_moniteur=:moniteur AND date_heure_debut LIKE :date_heure_debut");
		$req->execute(array(
			"moniteur" => $moniteur,
			"date_heure_debut" => $date."%"));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);

		if($resultat)
		{
			foreach ($cours as $key=>$values)
			{
				foreach ($resultat as $coursnondispo)
				{
					if ($values == substr($coursnondispo['date_heure_debut'], -8, 2))
					{
						unset($cours[$key]);
						$cours = array_values($cours);
					}
				}
			}
		}
		return $cours;
	}

	public function addCours($id_user, $id_moniteur, $date)
	{
		$req = $this->bdd->prepare("INSERT INTO planning(id_user, id_moniteur, date_heure_debut, etat) VALUES(:id_user, :id_moniteur, :date_heure_debut, :etat)");
		$req->execute(array(
			"id_user" => $id_user,
			"id_moniteur" => $id_moniteur,
			"date_heure_debut" => $date,
			"etat" => "Prochainement"));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function afficherMesCours($eleve)
	{
		$req = $this->bdd->prepare("SELECT * FROM planning WHERE id_user=:eleve");
		$req->execute(array("eleve" => $eleve));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function afficherMesLesson($moniteur)
	{
		$req = $this->bdd->prepare("SELECT * FROM planning WHERE id_moniteur=:moniteur");
		$req->execute(array("moniteur" => $moniteur));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function chercherEleve($eleve)
	{
		$req = $this->bdd->prepare("SELECT prenom, nom FROM eleve WHERE id_user=:id_user");
		$req->execute(array("id_user" => $eleve));
		$resultat = $req->fetch(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function chercherMoniteur($moniteur)
	{
		$req = $this->bdd->prepare("SELECT prenom FROM moniteur WHERE id_user=:moniteur");
		$req->execute(array("moniteur" => $moniteur));
		$resultat = $req->fetch(PDO::FETCH_ASSOC);
		return $resultat;
	}
}
?>