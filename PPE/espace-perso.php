<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Auto école Roule Raoul</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <?php
    session_start();
    include "class/membre.class.php";
    ?>
</head><!--/head-->

<body data-spy="scroll" data-target="#navbar" data-offset="0">
    <header id="header" role="banner">
        <div class="container">
            <div id="navbar" class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active lnk"><a href="#main-slider"><i class="fa fa-home"></i></a></li>
                        <?php
                        if (isset($_SESSION["type"])) {
                            switch ($_SESSION["type"]) {
                                case '1': //eleve
                                    ?>
                                    <li class="lnk"><a href="#content">Planning</a></li>
                                    <li class="lnk"><a href="#lesson">Prendre un cours</a></li>
                                    <?php
                                    break;
                                
                                case '2': //professeur
                                    ?>
                                    <li class="lnk"><a href="#content">Planning</a></li>
                                    <?php
                                    break;

                                case '3': //gestionnaire
                                    ?>
                                    <li><a href="espace-perso.php">Ticket</a></li>
                                    <li><a href="?gest=eleve">Gestion des élèves</a></li>
                                    <li><a href="?gest=mono">Inscrire un moniteur</a></li>
                                    <li><a href="?gest=gest">Inscrire un gestionnaire</a></li>
                                    <?php
                                    break;

                                default:  break;
                            }
                        }    
                        ?>
                        <li class="lnk"><a href="#contact">Contact</a></li>
                        <li><a href="index.php">Accueil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header><!--/#header-->

    <section id="main-slider" class="login">
        <?php include_once('vue/form_connect.php');?>
    </section><!--/#main-slider-->

    <section id="content">
        <div class="container">
            <div class="box first">
                <div class="center">
                    <?php
                    if(isset($_SESSION["id_user"]))
                    {
                        include_once("vue/planning.php");
                    }
                    else
                    {
                            if(isset($_POST['sendinsc']))
                            {
                                if(isset($_POST['condition']))
                                {
                                    $membre = new Membre();
                                    if($membre->getVerifPass($_POST["password"], $_POST["verifpassword"])==true)
                                    {
                                        $membre->inscription($_POST["mail"], $_POST["password"], $_POST["nom"], $_POST["prenom"], $_POST["datenaiss"], $_POST["adresse"]);
                                    }
                                    else
                                    {
                                        echo "Les mots de passes ne corresponde pas.";
                                    }
                                }
                                else
                                {
                                    echo("Vous ne pouvez pas vous inscrire sans avoir accepté les conditions d'utilisation.");
                                }
                            }
                            ?>
                            <p>Inscrivez vous pour commencer votre apprentisage dés maintenant.</p>
                            <br/>
                            <form id="form_insc" action="" method="POST">
                                <label for="nom" style="width: 201px;">Nom : </label>
                                <input id="nom" type="text" name ="nom" style="width: 300px;" placeholder="Entrez votre nom" value="<?php if(isset($_POST['nom'])){echo($_POST['nom']);}?>" required>
                                <br/>
                                <br/>
                                <label for="prenom" style="width: 201px;">Prénom : </label>
                                <input id="prenom" type="text" name ="prenom" style="width: 300px;" placeholder="Entrez votre prénom" value="<?php if(isset($_POST['prenom'])){echo($_POST['prenom']);}?>" required>
                                <br/>
                                <br/>
                                <label for="adresse" style="width: 201px;">Adresse complète : </label>
                                <input id="adresse" type="text" name ="adresse" style="width: 300px;" placeholder="Entrez votre prénom" value="<?php if(isset($_POST['adresse'])){echo($_POST['adresse']);}?>" required>
                                <br/>
                                <br/>
                                <label for="mail" style="width: 201px;">E-mail : </label>
                                <input id="mail" type="email" name ="mail" style="width: 300px;" placeholder="Entrez votre adresse e-mail" value="<?php if(isset($_POST['mail'])){echo($_POST['mail']);}?>" required>
                                <br/>
                                <br/>
                                <label for="datenaiss" style="width: 201px;">Date de naissance : </label>
                                <input id="datenaiss" type="date" name ="datenaiss" style="width: 300px;" placeholder="Entrez votre prénom" value="<?php if(isset($_POST['datenaiss'])){echo($_POST['datenaiss']);}?>" required>
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
                                <label for="condition" style="width: 201px;">Condition d'utilisation* : </label>
                                <input id="condition" type="checkbox" name ="condition" style="width: 300px;" <?php if(isset($_POST['condition'])){echo("checked");}?>>
                                <br/>
                                <br/>
                                <p>* : En cochant cette case vous reconnaissez avoir pris connaissance des <a href="condition.php" target="_blank">conditions d'utilisation</a> de ce site web</p>
                                <br/>
                                <br/>
                                <input type="submit" value="S'incrire" name="sendinsc">
                            </form>

                            <?php
                    }
                    ?>
                </div>
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->

    <?php
    if(isset($_SESSION["id_user"]))
    {
        if($_SESSION["type"]!=3)
        {
            include_once("vue/entreeCours.php");
        }
        else
        {
            include_once("vue/gestionnaire.php");
        }
    }
    ?>

    <section id="contact">
        <div class="container">
            <div class="box last">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Contactez nous</h1>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php" role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input name="name" type="text" class="form-control" required="required" placeholder="Nom">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input name="email" type="text" class="form-control" required="required" placeholder="Adresse Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="sendticket" class="btn btn-danger btn-lg">Envoyer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--/.col-sm-6-->
                    <div class="col-sm-6">
                        <h1>Nos coordonnées</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Auto-école Roule Raoul.</strong><br>
                                    115 Rue du théâtre,<br>
                                    Paris, 75015<br>
                                    <abbr title="Telephone">Tel:</abbr> <abbr title="Numéro internationnal +33">0</abbr>1 23 45 67 89
                                </address>
                            </div>
                        </div>
                        <h1>Nos réseaux sociaux</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-facebook icon-facebook icon-social"></i> Facebook</a></li>
                                    <li><a href="#"><i class="fa fa-google-plus icon-google-plus icon-social"></i> Google Plus</a></li>
                                    <li><a href="#"><i class="fa fa-pinterest icon-pinterest icon-social"></i> Pinterest</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-linkedin icon-linkedin icon-social"></i> Linkedin</a></li>
                                    <li><a href="#"><i class="fa fa-twitter icon-twitter icon-social"></i> Twitter</a></li>
                                    <li><a href="#"><i class="fa fa-youtube icon-youtube icon-social"></i> Youtube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/.col-sm-6-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#contact-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 <a target="_blank" href="#" title="Free Twitter Bootstrap WordPress Themes and HTML templates">Joffray Billon</a>. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>