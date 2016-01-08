
				<?php
					$membre = new Membre();
					switch ($_SESSION["type"])
					{
						case '1':
                            $planning=$membre->afficherMesCours($_SESSION['id_user']);
                            echo"<table border=1>";
                            echo"<tr><th>Nom du Moniteur</th><th>Date de le lecon</th><th>Etat</th></tr>";
                            foreach($planning as $plannning)
                            {
                                $nommoniteur=$membre->chercherMoniteur($plannning['id_moniteur']);
                                echo"<tr>";
                                echo"<td>".$nommoniteur["prenom"]."</td>";
                                echo"<td>".$plannning["date_heure_debut"]."</td>";
                                echo"<td>".$plannning["etat"]."</td></tr>";
                            }
                            echo"</table>";
							break;

						case '2':
                            $planning=$membre->afficherMesLesson($_SESSION['id_user']);
                            echo"<table border=1>";
                            echo"<tr><th>Nom du Moniteur</th><th>Date de le lecon</th><th>Etat</th></tr>";
                            foreach($planning as $plannning)
                            {
                                $nomeleve=$membre->chercherEleve($plannning['id_user']);
                                echo"<tr>";
                                echo"<td>".$nomeleve["prenom"]." ". $nomeleve["nom"] ."</td>";
                                echo"<td>".$plannning["date_heure_debut"]."</td>";
                                echo"<td>".$plannning["etat"]."</td></tr>";
                            }
                            echo"</table>";
							break;

						case '3':

							break;
						
						default: break;
					}
				?>