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

		if(strlen($password)<=7)
		{
			echo "<p class=\"alert alert-warning\">Votre mot de passe doit faire un minimum de 8 caractère.</p>";
		}

		if(strtolower($doublemail)==strtolower($email))
		{
			echo("<p class=\"alert alert-warning\">L'email est déjà utilisé, il ce peut que vous soyez déjà inscrit sur notre site.</p>");
		}

		if(!$doublemail && strlen($password)>7)
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
			echo("<p class=\"alert alert-success\">Félicitation vous etes maintenant inscrit sur notre site web.</p>");
			echo"<br/><br/>";
			echo"<meta http-equiv=\"Refresh\" content=\"2\">";
		}
	}

	public function inscriptionMono($email, $password, $nom, $prenom, $qualification)
	{
		$req = $this->bdd->prepare("SELECT email FROM user WHERE email=:email");
		$req->execute(array("email" => $email));
		$doublemail = $req->fetch()[0];

		if(strlen($password)<=7)
		{
			echo "<p class=\"alert alert-warning\">Votre mot de passe doit faire un minimum de 8 caractère.</p>";
		}

		if(strtolower($doublemail)==strtolower($email))
		{
			echo("<p class=\"alert alert-warning\">L'email est déjà utilisé, il ce peut que vous soyez déjà inscrit sur notre site.</p>");
		}

		if(!$doublemail && strlen($password)>7)
		{
			$password = sha1($password);
			$req = $this->bdd->prepare("INSERT INTO moniteur(email, password, nom, prenom, qualification)
				VALUES(:email, :pass, :nom, :prenom, :qualification)");
			$req->execute(array(
				"pass" => $password,
				"email" => $email,
				"nom" => $nom,
				"prenom" => $prenom,
				"qualification" => $qualification));
			echo("<p class=\"alert alert-success\">Le moniteur a correctement été inscrit.</p>");
			echo"<br/><br/>";
		}
	}

	public function inscriptionGest($email, $password, $nom, $prenom)
	{
		$req = $this->bdd->prepare("SELECT email FROM user WHERE email=:email");
		$req->execute(array("email" => $email));
		$doublemail = $req->fetch()[0];

		if(strlen($password)<=7)
		{
			echo "<p class=\"alert alert-warning\">Votre mot de passe doit faire un minimum de 8 caractère.</p>";
		}

		if(strtolower($doublemail)==strtolower($email))
		{
			echo("<p class=\"alert alert-warning\">L'email est déjà utilisé, il ce peut que vous soyez déjà inscrit sur notre site.</p>");
		}

		if(!$doublemail && strlen($password)>7)
		{
			$password = sha1($password);
			$req = $this->bdd->prepare("INSERT INTO gestionnaire(email, password, nom, prenom)
				VALUES(:email, :pass, :nom, :prenom)");
			$req->execute(array(
				"pass" => $password,
				"email" => $email,
				"nom" => $nom,
				"prenom" => $prenom));
			echo("<p class=\"alert alert-success\">Le gestionnaire a été correctement inscrit.</p>");
			echo"<br/><br/>";
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
						//$cours = array_values($cours);
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
		$req = $this->bdd->prepare("SELECT * FROM planning WHERE id_user=:eleve ORDER BY date_heure_debut");
		$req->execute(array("eleve" => $eleve));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function afficherMesLesson($moniteur)
	{
		$req = $this->bdd->prepare("SELECT * FROM planning WHERE id_moniteur=:moniteur AND date_heure_debut>=SYSDATE()-60480000 ORDER BY date_heure_debut");
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

	public function changeState($state, $date)
	{
		$req = $this->bdd->prepare("UPDATE planning SET etat=:etat WHERE date_heure_debut=:dates");
		$req->execute(array("etat" => $state, "dates" => $date));
		$resultat = $req->fetch(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function cancelCours($eleve, $date)
	{
		$req = $this->bdd->prepare("DELETE FROM planning WHERE date_heure_debut=:dates AND id_user=:eleve");
		$req->execute(array("dates" => $date, "eleve" => $eleve));
		$resultat = $req->fetch(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function afficherMesLessonOrderDate($date)
	{
		$req = $this->bdd->prepare("SELECT * FROM planning WHERE date_heure_debut>=:dates AND date_heure_debut<date_add(:dates, INTERVAL 1 DAY) ORDER BY date_heure_debut");
		$req->execute(array("dates" => $date));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function afficherTicket()
	{
		$req = $this->bdd->prepare("SELECT * FROM ticket WHERE etat=0 ORDER BY dates");
		$req->execute();
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}

	public function validerTicket($id)
	{
		$req = $this->bdd->prepare("UPDATE ticket SET etat=1 WHERE idT=:id");
		$req->execute(array("id" => $id));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultat;
	}
}
?>