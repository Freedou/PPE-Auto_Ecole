<div id="login" class="login" style="font-size: 14px">
	<?php
	if(isset($_POST['deco']))
	{
		session_destroy();
		echo("<meta http-equiv=\"Refresh\" content=\"0;URL=index.php\">");
	}
	if(isset($_POST['send']))
	{
		$membre = new Membre();
		$resultat=$membre->connection($_POST["email"], $_POST["password"]);
		if($resultat)
		{
			$_SESSION['id_user']=$membre->findReal($resultat['email']);
			$_SESSION['prenom']=$resultat['prenom'];
			$_SESSION['nom']=$resultat['nom'];
			$_SESSION['type']=$membre->findType($resultat['email']);
		}
		else
		{
			echo "Erreur de connection mauvais identifiant";
		}

		echo("<meta http-equiv=\"Refresh\" content=\"0\">");
	}
	if(isset($_SESSION["id_user"]))
	{
		echo ("Bienvenue ".$_SESSION["prenom"]." ".$_SESSION['nom'].".");
		?>
		<form id="form_login" class="form_login" action="" method="POST">
			<input type="submit" value="Déconnexion" name="deco">
		</form>
		<?php
	}
	else
	{
		?>
		<form id="form_login" action="" method="POST">
			<input id="email" type="text" name ="email" placeholder="E-mail">
			<input id="password" type="password" name ="password" placeholder="Mot de passe">
			<input type="submit" value="Connecter" name="send">
			<a href="#content">Pas encore inscrit ?</a>
		</form>
		<?php
	}
	?>
</div>