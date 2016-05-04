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
								echo("<meta http-equiv=\"Refresh\" content=\"0\">");
							}
							if(isset($_POST["mono_date"]))
							{
								$date = new DateTime(date("Y-m-d"));
								$date->modify('+1 day');
								$datetomo = $date->format('Y-m-d');
								if($_POST["date"]<$datetomo){
									?>
										<script>
											alert("Impossible de commander un rendez-vous pour le jours même.");
										</script>
									<?php
									echo("<meta http-equiv=\"Refresh\" content=\"0\">");
								}
								else{

								}
								$coursDispo=$membre->listerCoursDispo($_POST["moniteur"], $_POST["date"]);
								?>
								<form method="POST" action="#planning">
									<input name="moniteur" value="<?php echo $_POST["moniteur"]; ?>" style="display: none;" >
									<label for="coursDispo"><?php echo "Ton moniteur est disponnible le ".$_POST["date"] ?> à : </label>
									<select name="date">
										<?php foreach ($coursDispo as $coursDispoo)
										{
											echo "<option value=\"".$_POST["date"]." ".$coursDispoo.":00:00\">".$coursDispoo." heure</option>";
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
									<select name="moniteur" required>
										<option value="" selected></option>
										<?php foreach ($listeMoniteur as $moniteur) {
											echo "<option value=\"". $moniteur["id_user"] ."\">". $moniteur["prenom"] ." : ".$moniteur["qualification"]."</option>";
										}
										?>
									</select>
									<br/>
									<br/>
									<label for="date">Date (demain au plus tôt): </label>
									<input type="date" name="date" min="<?php $date = new DateTime(date("Y-m-d"));
									$date->modify('+1 day');
									echo $date->format('Y-m-d'); ?>" required>
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