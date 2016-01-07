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
	
	public function connection($id_user, $password)
	{
		$password = sha1($password);
		$req = $this->bdd->prepare("SELECT * FROM user WHERE id_user=:id_user AND password=:pass");
		$req->execute(array("id_user" => $id_user, "pass" => $password));
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

	private function selectId($id_user, $table)
	{
		$req = $this->bdd->prepare("SELECT * FROM ".$table." WHERE id_user=:id_user");
		$req->execute(array("id_user" => $id_user));
		$resultat = $req->fetch();

		return $resultat;
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
}
?>