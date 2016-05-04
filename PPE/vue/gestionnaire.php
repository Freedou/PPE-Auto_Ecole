<section id="lesson">
    <div class="container">
        <div class="box">
            <div class="center">
                <?php
                $membre = new Membre();
                if(isset($_POST["sendmono"])){
                    $membre->inscriptionMono($_POST["mail"], $_POST["password"], $_POST["nom"], $_POST["prenom"], $_POST["qualification"]);
                }
                if(isset($_POST["sendgest"])){
                    $membre->inscriptionGest($_POST["mail"], $_POST["password"], $_POST["nom"], $_POST["prenom"]);
                }
                if(isset($_GET["gest"])) {
                    if ($_GET["gest"]=="mono") {
                        ?>
                        <form id="form_insc" action="" method="POST">
                            <label for="nom" style="width: 201px;">Nom : </label>
                            <input id="nom" type="text" name ="nom" style="width: 300px;" placeholder="Entrez votre nom" value="<?php if(isset($_POST['nom'])){echo($_POST['nom']);}?>" required>
                            <br/>
                            <br/>
                            <label for="prenom" style="width: 201px;">Prénom : </label>
                            <input id="prenom" type="text" name ="prenom" style="width: 300px;" placeholder="Entrez votre prénom" value="<?php if(isset($_POST['prenom'])){echo($_POST['prenom']);}?>" required>
                            <br/>
                            <br/>
                            <label for="qualification" style="width: 201px;">Type de cours enseigner : </label>
                            <input id="qualification" type="text" name ="qualification" style="width: 300px;" placeholder="Entrez votre qualification" value="<?php if(isset($_POST['qualification'])){echo($_POST['qualification']);}?>" required>
                            <br/>
                            <br/>
                            <label for="mail" style="width: 201px;">E-mail : </label>
                            <input id="mail" type="email" name ="mail" style="width: 300px;" placeholder="Entrez votre adresse e-mail" value="<?php if(isset($_POST['mail'])){echo($_POST['mail']);}?>" required>
                            <br/>
                            <br/>
                            <label for="password" style="width: 201px;">Mot de passe : </label>
                            <input id="password" type="password" name ="password" style="width: 300px;" placeholder="Crée votre mot de passe" value="<?php if(isset($_POST['password'])){echo($_POST['password']);}?>" required>
                            <br/>
                            <br/>
                            <label for="verifpassword" style="width: 201px;">Valider votre mot de passe : </label>
                            <input id="verifpassword" type="password" name ="verifpassword" style="width: 300px;" placeholder="Confirmez votre mot de passe" value="<?php if(isset($_POST['verifpassword'])){echo($_POST['verifpassword']);}?>" required>
                            <br/>
                            <br/>
                            <input type="submit" value="S'incrire" name="sendmono">
                        </form>
                        <?php
                    } elseif ($_GET["gest"]=="eleve") {
                        if(isset($_POST["cancelcours"]))
                        {
                            echo $result=$membre->cancelcours($_SESSION["id_user"], $_POST["date"]);
                        }
                        if(isset($_POST["datecours"])) {
                            $planning = $membre->afficherMesLessonOrderDate($_POST["date"]);
                            echo "<table border=1>";
                            echo "<tr><th>Nom du Moniteur</th><th>Nom de l'élève</th><th>Date de le lecon</th><th>Etat</th><th>Annulation</th></tr>";
                            foreach ($planning as $plannning) {
                                $nommoniteur = $membre->chercherMoniteur($plannning['id_moniteur']);
                                $nomeleve=$membre->chercherEleve($plannning['id_user']);
                                echo "<tr>";
                                echo "<td>" . $nommoniteur["prenom"] . "</td>";
                                echo "<td>" . $nomeleve["prenom"] . "</td>";
                                echo "<td>" . $plannning["date_heure_debut"] . "</td>";
                                echo "<td>" . $plannning["etat"] . "</td>";
                                echo "<td><form method=\"POST\" action=\"#\"><input type=\"hidden\" name=\"date\" value=\"" . $plannning["date_heure_debut"] . "\">";
                                echo "<input type=\"submit\" value=\"Annuler\" name=\"cancelcours\"></form></td></tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            ?>
                            <form method="POST" action="#">
                                <label for="date">Date : </label>
                                <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>">
                                <br/>
                                <br/>
                                <input type="submit" value="Chercher cours ce jour" name="datecours">
                            </form>
                            <?php
                        }
                    } elseif ($_GET["gest"]=="gest") {
                        ?>
                        <form id="form_insc" action="" method="POST">
                            <label for="nom" style="width: 201px;">Nom : </label>
                            <input id="nom" type="text" name ="nom" style="width: 300px;" placeholder="Entrez votre nom" value="<?php if(isset($_POST['nom'])){echo($_POST['nom']);}?>" required>
                            <br/>
                            <br/>
                            <label for="prenom" style="width: 201px;">Prénom : </label>
                            <input id="prenom" type="text" name ="prenom" style="width: 300px;" placeholder="Entrez votre prénom" value="<?php if(isset($_POST['prenom'])){echo($_POST['prenom']);}?>" required>
                            <br/>
                            <br/>
                            <label for="mail" style="width: 201px;">E-mail : </label>
                            <input id="mail" type="email" name ="mail" style="width: 300px;" placeholder="Entrez votre adresse e-mail" value="<?php if(isset($_POST['mail'])){echo($_POST['mail']);}?>" required>
                            <br/>
                            <br/>
                            <label for="password" style="width: 201px;">Mot de passe : </label>
                            <input id="password" type="password" name ="password" style="width: 300px;" placeholder="Crée votre mot de passe" value="<?php if(isset($_POST['password'])){echo($_POST['password']);}?>" required>
                            <br/>
                            <br/>
                            <label for="verifpassword" style="width: 201px;">Valider votre mot de passe : </label>
                            <input id="verifpassword" type="password" name ="verifpassword" style="width: 300px;" placeholder="Confirmez votre mot de passe" value="<?php if(isset($_POST['verifpassword'])){echo($_POST['verifpassword']);}?>" required>
                            <br/>
                            <br/>
                            <input type="submit" value="S'incrire" name="sendgest">
                        </form>
                        <?php
                    }
                }
                else{
                    if(isset($_POST["validTicket"]))
                    {
                        if($_POST["etat"]=="true"){
                            $membre->validerTicket($_POST["id"]);
                            echo "Ticket archiver.";
                        }
                    }
                    $ticket=$membre->afficherTicket();
                    echo"<table border=1>";
                    echo"<tr><th>Id ticket</th><th>Message</th><th>Date depot ticket</th><th>Etat</th></tr>";
                    if($ticket) {
                        foreach ($ticket as $unTicket) {
                            echo "<tr>";
                            echo "<td>" . $unTicket["idT"] . "</td>";
                            echo "<td>" . $unTicket["message"] . "</td>";
                            echo "<td>" . $unTicket["dates"] . "</td>";
                            echo "<td><form method=\"POST\" action=\"#\"><select name=\"etat\"><option value=\"false\">NOT OK</option><option value=\"true\">OK</option></select>";
                            echo "<input type=\"hidden\" name=\"id\" value=\"" . $unTicket["idT"] . "\">";
                            echo "<input type=\"submit\" value=\"Valider\" name=\"validTicket\"></form></td></tr>";
                        }
                    }
                    else echo "<tr><td colspan='4'>Pas de nouveau ticket</td></tr>";
                    echo"</table>";
                }
                ?>
            </div>
        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#about-us-->