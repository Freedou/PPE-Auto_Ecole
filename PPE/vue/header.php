<?php
session_start();
include "class/membre.class.php";
?>
<header>
	<div id="menu">
		<a id="bouton" href="index.php">Index</a>
		<a id="bouton" href="cours.php">Cours</a>
		<?php
			if(isset($_SESSION["pseudo"]))
			{
				switch($_SESSION["type"])
				{
					case 1 :
							echo"<a id=\"bouton\" href=\"espaceperso.php\">Espace élève</a>";
						break;
					
					case 2 :
							echo"<a id=\"bouton\" href=\"espaceperso.php\">Espace professeur</a>";
						break;
					default :
							echo"<a id=\"bouton\" href=\"espaceperso.php\">Espace perso</a>";
						break;
				}
			}
		?>
	</div>
	<?php include("vues/form_connect.php"); ?>
</header>