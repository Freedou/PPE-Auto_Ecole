<?php
class Forum
{
	public function __construct()
	{
		try{
			$this->bdd = new PDO("mysql:host=localhost;dbname=forum", "root", "");
		}
		catch(Exception $exp)
		{
			echo "Erreur lors de la connection à la BDD.";
		}
	}
	
	public function AffichageListePoste()
	{
		$afflst = $this->bdd->prepare("SELECT * FROM poste ORDER BY DateModifP desc");
		$afflst->execute();
		$resultliste = $afflst->fetchAll(PDO::FETCH_ASSOC);
		// var_dump($resultliste);
		echo"<table border=1>";
		echo"<tr><th>Titre du poste</th><th>Date de publication</th><th>Auteur du poste</th><th>Note du poste</th><th>Date de modification</th></tr>";
		foreach($resultliste as $liste)
		{
			echo"<tr>";
			echo"<td style='min-width: 512px;'><a href='viewposte.php?poste=".$liste["IdPoste"]."#services'>".$liste["Titre"]."</a></td>";
			echo"<td style='min-width: 165px;'>".$liste["DateP"]."</td>";
			echo"<td style='min-width: 165px;'><a href='membre.php?pseudo=".$liste["AuteurP"]."'>".$liste["AuteurP"]."</a></td>";
			echo"<td style='min-width: 112px;'>".$liste["Note"]."</td>";
			echo"<td style='min-width: 165px;'>".$liste["DateModifP"]."</td></tr>";
		}
		echo"</table>";
	}
	
	/* AffichagePosteComm(htmlspecialchars($_GET["poste"])); */
	public function AffichagePosteComm($poste)
	{
		echo"<table border=1>";
		/* Affichage du poste */
		$affpost = $this->bdd->prepare("SELECT * FROM poste WHERE IdPoste = :poste");
		$affpost->execute(array(
			"poste" => $poste));
		$resultpost = $affpost->fetch(PDO::FETCH_ASSOC);
		// var_dump($resultpost);
		
		/* Affichage du mini-profils de l'auteur du poste */
		$affaut = $this->bdd->prepare("SELECT * FROM user WHERE ID_User = :user");
		$affaut->execute(array(
			"user" => $resultpost["AuteurP"]));
		$resultaut = $affaut->fetch(PDO::FETCH_ASSOC);
		// var_dump($resultaut);
        echo "<tr><th style='width: 312px;'>Note Moyenne : ".$resultpost["Note"]."</th><th style='width: 712px;'>".$resultpost["Titre"]."</th></tr>";
        echo "<tr><td>Posté le : ";
        echo $resultpost["DateP"];
		echo "<br/><a href='membre.php?pseudo=".$resultpost["AuteurP"]."'>";
        echo "<img id='monkappa'
                    style='background: rgba(0, 0, 0, 0) url(".$resultaut["Avatar"].") no-repeat;
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-size: 100%;
                    background-position: center center;' src='img/transp.jpg'></img>";
        echo "</a><br/><a href='membre.php?pseudo=".$resultpost["AuteurP"]."'>";
        echo $resultpost["AuteurP"];
		echo "</a></td><td>";
		echo $resultpost["ContentP"];
		echo "</td></tr>";
		
		/* Afficher les commentaires */
		$affcomm = $this->bdd->prepare("SELECT * FROM commentaire WHERE IdPoste = :poste ORDER BY DateC asc");
		$affcomm->execute(array(
			"poste" => $poste));
		$resultcomm = $affcomm->fetchAll(PDO::FETCH_ASSOC);
		foreach($resultcomm as $comm)
		{
			/* Affichage du mini-profils de l'auteur du commentaire */
			$affautcomm = $this->bdd->prepare("SELECT * FROM user WHERE ID_User = :user");
			$affautcomm->execute(array(
				"user" => $comm["AuteurC"]));
			$resultautcomm = $affautcomm->fetch(PDO::FETCH_ASSOC);
            echo "<tr><td>Posté le : ";
            echo $comm["DateC"];
			echo "<br/>Note : ";
            echo $comm["NoteP"];
            echo "<br/><a href='membre.php?pseudo=".$comm["AuteurC"]."'>";
            echo "<img id='monkappa'
                    style='background: rgba(0, 0, 0, 0) url(".$resultautcomm["Avatar"].") no-repeat;
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-size: 100%;
                    background-position: center center;' src='img/transp.jpg'></img>";
			echo "</a><br/><a href='membre.php?pseudo=".$comm["AuteurC"]."'>";
            echo $comm["AuteurC"];
			echo "</a></td><td>";
			echo $comm["ContentC"];
			echo "</td></tr>";
		}
		echo"</table>";
	}
	
	public function CreationPoste($auteur, $titre, $contenu)
	{
		$crea = $this->bdd->prepare("INSERT INTO poste (AuteurP, Titre, ContentP, DateP) VALUES (:auteur, :titre, :contenu, NOW());");
		$crea->execute(array(
			"auteur" => $auteur,
			"titre" => $titre,
			"contenu" => $contenu));
		$result = $crea->fetchAll();
		echo"Votre post a bien été créé !";
	}
	
	/* CreationPosteComm(htmlspecialchars($_GET["poste"]), $auteur, $contenu, $note); */
	public function CreationPosteComm($poste, $auteur, $contenu, $note)
	{
		$crea = $this->bdd->prepare("INSERT INTO commentaire (IdPoste, AuteurC, ContentC, NoteP, DateC) VALUES (:poste, :auteur, :contenu, :note, NOW());");
		$crea->execute(array(
			"poste" => $poste,
			"auteur" => $auteur,
			"contenu" => $contenu,
			"note" => $note));
		$result = $crea->fetchAll();
		echo"Votre commentaire a bien été ajouté !";
	}

	public function infoMembre($pseudo)
	{
		$infoMembre = $this->bdd->prepare("SELECT * FROM user WHERE ID_User = :user");
		$infoMembre->execute(array(
			"user" => $pseudo));
		$resultinfoMembre = $infoMembre->fetch(PDO::FETCH_ASSOC);
		return $resultinfoMembre;
	}

	public function changeAvatar($pseudo, $files)
	{
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
		$extension_upload = strtolower(substr(strrchr($files['monavatar']['name'], '.'), 1));

		if(in_array($extension_upload, $extensions_valides))
		{
			echo "Extension correcte<br/>";
		}
	    else
        {
            echo "Extension incorrecte<br/>";
        }
        $pseudochemin = str_replace(" ", "%20", $pseudo);
        $chemin = "fichier/img/{$pseudo}.{$extension_upload}";
        $cheminbdd = "fichier/img/{$pseudochemin}.{$extension_upload}";

		$resultat = move_uploaded_file($files['monavatar']['tmp_name'],$chemin);
		if ($resultat)
		{
			echo "Transfert réussi<br/>";
            $updateavatar = $this->bdd->prepare("UPDATE user SET Avatar=:chemin WHERE Id_User=:user");
            $updateavatar->execute(array(
                "chemin" => $cheminbdd,
                "user" => $pseudo));
            echo"<meta http-equiv=\"Refresh\" content=\"3;URL=membre.php\">";
		}
	}

    public function changeVideo($pseudo, $files)
    {
        $extensions_valides = array('mp4', 'mkv', 'avi', 'wmv');
        $extension_upload = strtolower(substr(strrchr($files['mavideo']['name'], '.'), 1));

        if(in_array($extension_upload, $extensions_valides))
        {
            echo "Extension correcte<br/>";
        }
        else
        {
            echo "Extension incorrecte<br/>";
        }
        $pseudochemin = str_replace(" ", "%20", $pseudo);
        $chemin = "fichier/vid/{$pseudo}.{$extension_upload}";
        $cheminbdd = "fichier/vid/{$pseudochemin}.{$extension_upload}";

        $resultat = move_uploaded_file($files['mavideo']['tmp_name'],$chemin);
        if ($resultat)
        {
            echo "Transfert réussi<br/>";
            $updatevideo = $this->bdd->prepare("UPDATE user SET VideoP=:chemin WHERE Id_User=:user");
            $updatevideo->execute(array(
                "chemin" => $cheminbdd,
                "user" => $pseudo));
            echo"<meta http-equiv=\"Refresh\" content=\"3;URL=membre.php\">";
        }
    }
}
?>