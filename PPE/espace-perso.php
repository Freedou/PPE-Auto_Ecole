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
                        <li class="lnk"><a href="#about-us">L'auto-école</a></li>
                        <li class="lnk"><a href="#pricing">Nos offres</a></li>
                        <li class="lnk"><a href="#contact">Contact</a></li>
                        <li><a href="index.php">Accueil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header><!--/#header-->

    <section id="main-slider" class="carousel">
        <?php include_once('vue/form_connect.php');?>
    </section><!--/#main-slider-->

    <section id="about-us">
        <div class="container">
            <div class="box first">
                <div class="center">
                    <h2>Qui somme nous ?</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->

    <section id="services">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-cloud icon-md icon-color1"></i>
                            <h4>Des installations modernes</h4>
                            <p>Apprenez à conduire avec du materiel de qualité et moderne. Possibilité de réservation de cours en ligne.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-thumbs-up icon-md icon-color2"></i>
                            <h4>Un suivi pédagogique de qualité</h4>
                            <p>Nos moniteur sont à votre écoute. Il saurrons vous encadré grâce à leur nombreuses années d'expériences.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-angle-double-right icon-md icon-color3"></i>
                            <h4>Avancez a votre rythme</h4>
                            <p>Nous n'avons pas tous les mêmes capacitées à apprendre, c'est pourquoi toute nos offres vous propose des heures de perfectionnements en supplément sur demande.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-car icon-md icon-color4"></i>
                            <h4>Les cours quand vous voulez, où vous voulez</h4>
                            <p>Quite à roulez autant vous emmener! En supperpossant les différentes leçon nous vennons vous cherchez jusque devant votre domicile et vous racompagnons chez vous après. Utile pour ne pas attendre 1 heure dans une permanance ton prochain bus!</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-css3 icon-md icon-color5"></i>
                            <h4>Javascript development</h4>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-hashtag icon-md icon-color6"></i>
                            <h4>Une auto-école dans l'êre du temps</h4>
                            <p>Retrouvez nous aussi sur les réseaux sociaux.</p>
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#services-->

    <section id="pricing">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Nos offres</h2>
                    <p class="lead">Toute nos offres sont flexible et modulable à votre guise.</p>
                </div><!--/.center-->   
                <div class="big-gap"></div>
                <div id="pricing-table" class="row">
                    <div class="col-sm-4">
                        <ul class="plan">
                            <li class="plan-name">Code de la route</li>
                            <li class="plan-price">300€ TTC</li>
                            <li>10 heures de cours</li>
                            <li>Suivi de progression</li>
                            <li>Présentation à l'examen du code de la route</li>
                            <li class="plan-action"><a href="#" class="btn btn-primary btn-lg">Signup</a></li>
                        </ul>
                    </div><!--/.col-sm-4-->
                    <div class="col-sm-4">
                        <ul class="plan featured">
                            <li class="plan-name">Permit auto</li>
                            <li class="plan-price">1200€ TTC</li>
                            <li>20 heures de conduites</li>
                            <li>35€ l'heure supplémentaire</li>
                            <li>Possibilité de passage de l'ETG (non conducteur ou conducteur de + de 5 ans)*</li>
                            <li>Un suivi pédagogique personnalisé</li>
                            <li class="plan-action"><a href="#" class="btn btn-primary btn-lg">Signup</a></li>
                        </ul>
                    </div><!--/.col-sm-4-->
                    <div class="col-sm-4">
                        <ul class="plan">
                            <li class="plan-name">Permit moto</li>
                            <li class="plan-price">700€ TTC</li>
                            <li>20 heures de conduites</li>
                            <li>40€ l'heure supplémentaire</li>
                            <li>Possibilité de passage de l'ETG (non conducteur ou conducteur de + de 5 ans)*</li>
                            <li>Un suivi pédagogique personnalisé</li>
                            <li class="plan-action"><a href="#" class="btn btn-primary btn-lg">Signup</a></li>
                        </ul>
                    </div><!--/.col-sm-4-->
                    <div class="center">
                        <p>* : le code de la route fait office d'ETG.</p>
                    </div><!--/.center-->
                </div> 
            </div> 
        </div>
    </section><!--/#pricing-->

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
                                        <input type="text" class="form-control" required="required" placeholder="Nom">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Adresse Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-lg">Envoyer</button>
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