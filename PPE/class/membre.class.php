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
	
	public function inscription($pseudo, $email, $password)
	{
		$req = $this->bdd->prepare("SELECT ID_User FROM user WHERE ID_User=:pseudo");
		$req->execute(array("pseudo" => $pseudo));
		$doubleid = $req->fetch()[0];
		
		if(strtolower($doubleid)==strtolower($pseudo))
		{
			echo("Le pseudo est déjà utilisé, il ce peut que vous soyez déjà inscrit sur notre site, dans le cas contaire veuillez choisir un autre pseudo.\n");
		}
		
		$req = $this->bdd->prepare("SELECT E_Mail FROM user WHERE E_Mail=:email");
		$req->execute(array("email" => $email));
		$doublemail = $req->fetch()[0];
		
		if(strtolower($doublemail)==strtolower($email))
		{
			echo("L'email est déjà utilisé, il ce peut que vous soyez déjà inscrit sur notre site.\n");
		}
		
		if(!$doubleid && !$doublemail)
		{
			$password = sha1($password);
			$req = $this->bdd->prepare("INSERT INTO user(ID_User, E_Mail, Password, Date_Inscription) VALUES(:pseudo, :email, :pass, CURDATE())");
			$req->execute(array(
				"pseudo" => $pseudo,
				"pass" => $password,
				"email" => $email));
			echo("Félicitation vous etes maintenant inscrit sur notre site web.");
			echo"<br/><br/>";
			echo"<meta http-equiv=\"Refresh\" content=\"2;URL=index.php\">";
		}
	}
	
	public function connection($pseudo, $password)
	{
		$password = sha1($password);
		$req = $this->bdd->prepare("SELECT * FROM user WHERE (ID_User=:pseudo AND Password=:pass) OR (E_Mail=:pseudo AND Password=:pass)");
		$req->execute(array("pseudo" => $pseudo, "pass" => $password));
		$resultat = $req->fetch();
		
		if (!$resultat)
		{
			echo "Mauvais identifiant ou mot de passe !";
		}
		else
		{
			/*$_SESSION["id"] = $resultat["id"];*/
			$_SESSION["pseudo"] = $resultat["ID_User"];
			$_SESSION["type"] = $resultat["Type"];
		}
	}
}
?>