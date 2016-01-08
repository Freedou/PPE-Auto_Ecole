<section id="lesson">
	<div class="container">
		<div class="box">
			<div class="center">
				<?php
					$membre = new Membre();
					switch ($_SESSION["type"])
					{
						case '1':
							$listeMoniteur=$membre->listerMoniteur();
							if(isset($_POST['addCours']))
							{
								$success=$membre->addCours($_SESSION['id_user'], $_POST["moniteur"], $_POST["date"]);
							}
							if(isset($_POST["mono_date"]))
							{
								$coursDispo=$membre->listerCoursDispo($_POST["moniteur"], $_POST["date"]);
								?>
								<form method="POST" action="#planning">
									<input name="moniteur" value="<?php echo $_POST["moniteur"]; ?>" style="display: none;" >
									<label for="coursDispo"><?php echo "Ton moniteur est disponnible le ".$_POST["date"] ?> à : </label>
									<select name="date">
										<?php foreach ($coursDispo as $coursDispo)
										{
											echo "<option value='" . $_POST["date"]." ".$coursDispo . ":00:00'>" . $coursDispo . " heure</option>";
										}
										?>
									</select>
									<br/>
									<br/>
									<input type="submit" value="Prendre rendez-vous" name="addCours">
								</form>
								<?php
							}
							else
							{
								?>
								<form method="POST" action="#lesson">
									<label for="moniteur">Moniteur : </label>
									<select name="moniteur">
										<option value="" selected></option>
										<?php foreach ($listeMoniteur as $moniteur) {
											echo "<option value='" . $moniteur[id_user] . "'>" . $moniteur[prenom] . "</option>";
										}
										?>
									</select>
									<br/>
									<br/>
									<label for="date">Date : </label>
									<input type="date" name="date" min="<?php echo date("Y-m-d"); ?>">
									<br/>
									<br/>
									<input type="submit" value="Chercher les cours dispo" name="mono_date">
								</form>
								<?php
							}
							break;

						case '2': 
							break;

						case '3': 
							break;
						
						default: break;
					}
				?>
				</div>
			</div><!--/.box-->
		</div><!--/.container-->
</section><!--/#about-us-->