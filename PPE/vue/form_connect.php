<div id="login" class="login" style="font-size: 14px">
	<?php
	if(isset($_POST['send2']))
	{
		session_destroy();
		echo("<meta http-equiv=\"Refresh\" content=\"0;URL=index.php\">");
	}
	if(isset($_POST['send']))
	{
		$membre = new Membre();
		$membre->connection($_POST["pseudo"], $_POST["password"]);
	}
	if(isset($_SESSION["pseudo"]))
	{
		echo ("Bienvenue " . $_SESSION["pseudo"] . ".");
		?>
		<form id="form_login" class="form_login" action="" method="POST">
			<input type="submit" value="Déconnexion" name="send2">
		</form>
		<?php
	}
	else
	{
		?>
		<form id="form_login" action="" method="POST">
			<input id="pseudo" type="text" name ="pseudo" placeholder="E-mail ou Pseudo">
			<input id="password" type="password" name ="password" placeholder="Mot de passe">
			<input type="submit" value="Connecter" name="send">
			<a href="inscription.php">Pas encore inscrit ?</a>
		</form>
		<?php
	}
	?>
</div>