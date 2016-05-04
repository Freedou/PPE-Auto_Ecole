
				<?php
					$membre = new Membre();
					switch ($_SESSION["type"])
					{
						case '1':
                            if(isset($_POST["cancelcours"]))
                            {
                                $datecompare=explode(" ", $_POST["date"]);
                                $datecompare = $datecompare[0];
                                $date=date("Y-m-d");
                                if($date>=$datecompare)
                                {
                                    ?>
                                    <script>
                                        alert("Impossible d'annuler moins de 24 heures avant le rendez-vous, veuillez contacter directement la gestionnaire.");
                                    </script>
                                    <?php
                                }
                                else
                                {
                                    echo $result=$membre->cancelcours($_SESSION["id_user"], $_POST["date"]);
                                }
                            }
                            $planning=$membre->afficherMesCours($_SESSION['id_user']);
                            echo"<table border=1>";
                            echo"<tr><th>Nom du Moniteur</th><th>Date de le lecon</th><th>Etat</th><th>Annulation</th></tr>";
                            foreach($planning as $plannning)
                            {
                                $nommoniteur=$membre->chercherMoniteur($plannning['id_moniteur']);
                                echo"<tr>";
                                echo"<td>".$nommoniteur["prenom"]."</td>";
                                echo"<td>".$plannning["date_heure_debut"]."</td>";
                                echo"<td>".$plannning["etat"]."</td>";
                                echo"<td><form method=\"POST\" action=\"#\"><input type=\"hidden\" name=\"date\" value=\"".$plannning["date_heure_debut"]."\">";
                                echo"<input type=\"submit\" value=\"Annuler\" name=\"cancelcours\"></form></td></tr>";
                            }
                            echo"</table>";
							break;

                        case '2':
                            if(isset($_POST["sendstate"]))
                            {
                                echo $result=$membre->changestate($_POST["etat"], $_POST["date"]);
                            }
                            $planning=$membre->afficherMesLesson($_SESSION['id_user']);
                            echo"<table border=1>";
                            echo"<tr><th>Nom de l'élève</th><th>Date de le lecon</th><th>Etat</th></tr>";
                            foreach($planning as $plannning)
                            {
                                $nomeleve=$membre->chercherEleve($plannning['id_user']);
                                echo"<tr>";
                                echo"<td>".$nomeleve["prenom"]." ". $nomeleve["nom"] ."</td>";
                                echo"<td>".$plannning["date_heure_debut"]."</td>";
                                //echo"<td>".$plannning["etat"]."</td></tr>";
                                echo"<td><form method=\"POST\" action=\"#\"><select name=\"etat\"><option value=\"Prochainement\" ";
                                if($plannning["etat"]=="Prochainement") echo"selected";
                                echo">Prochainement</option><option value=\"Valider\" ";
                                if($plannning["etat"]=="Valider") echo"selected";
                                echo">Valider</option><option value=\"Insufisant\" ";
                                if($plannning["etat"]=="Insufisant") echo"selected";
                                echo">Insufisant</option><option value=\"Absent\" ";
                                if($plannning["etat"]=="Absent") echo"selected";
                                echo">Absent</option></select>";
                                echo"<input type=\"hidden\" name=\"date\" value=\"".$plannning["date_heure_debut"]."\">";
                                echo"<input type=\"submit\" value=\"Valider\" name=\"sendstate\"></form></td></tr>";
                            }
                            echo"</table>";
							break;

						case '3':

							break;
						
						default: break;
					}
				?>