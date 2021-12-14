<?php
session_start();
//require_once './connection.php';
if(isset($_SESSION['resa']))$_resa=$_SESSION['resa'];
else $_resa=array();
//print_r($_resa);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Villa blanca | Restaurants_bars</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="images/apple-touch-icon.png" type="images/x-icon" rel="shortcut icon">
    <!-- Place favicon.ico in the root directory -->

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- customizer style css -->
    <link href="#" data-style="styles" rel="stylesheet">

    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
    .accordion .card-header:after {
        font-family: 'FontAwesome';
        content: "\f068";
        float: right;
    }

    .accordion .card-header.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f067";
    }

    .increase {
        width: 30px;
        height: 20px;
    }

    .increase2 {
        width: 0px;
        height: 0px;
    }
    </style>
    <style type="text/css">
    .error {
        color: #D8000C;
        /*background-color: #FFBABA;*/
    }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="loading-center">
            <div class="loading-center-absolute">
                <div class="object object_one"></div>
                <div class="object object_two"></div>
                <div class="object object_three"></div>
            </div>
        </div>
    </div>


    <div class="wrapper">
        <!--Header section start-->
        <div class="header-section about-us">
            <div class="bg-opacity"></div>
            <div class="top-header sticky-header">
                <div class="top-header-inner">
                    <div class="container">
                        <div class="mgea-full-width">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <div class="logo mt-15">
                                        <a href="index.php"><img src="images/logo/logo.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 hidden-xs">
                                    <div class="header-top ptb-10">
                                        <div class="adresses">
                                            <div class="phone">
                                                <p>Téléphone : <span>+225 07 07 43 43 94</span></p>
                                            </div>
                                            <div class="email">
                                                <p>Email: <span>reservation@villa_blanca.ci</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu mt-25">
                                        <div class="menu-list hidden-sm hidden-xs">
                                            <nav>
                                                <ul>
                                                    <li><a href="our-room.html">Chambres</a></li>
                                                    <li><a href="seminaires.html">Séminaires</a></li>
                                                    <li><a href="resto.html">Restaurant</a></li>
                                                    <li><a href="loisirs.html">Nos loisirs</a></li>
                                                    <li><a href="detail.php">Reservation</a></li>
                                                    <?php if (isset($_SESSION['utilisateur']))
                                                        {
                                                            $req = $bdd->prepare('SELECT * FROM facture WHERE id_cl=?');
                                                            $req->execute(array($_SESSION['utilisateur']));
                                                            $facts = $req->fetchAll();
                                                            $rowN=0;
                                                            $row=0;
                                                            foreach ($facts as $fact) {
                                                                if($fact['statut']==0){
                                                                    $rowN++;
                                                                }
                                                                if($fact['statut']==1){
                                                                    $row++;
                                                                }
                                                            }
                                                            if($row==0 && $rowN!=0)
                                                            {
                                                                echo'<li><a href="resaClient.php"><span style="border-radius: 30px;
                                                            background: red;">'.$rowN.'</span> Mes réservations </a></li>';
                                                            }
                                                            if($row!=0 && $rowN==0)
                                                            {
                                                                echo'<li><a href="resaClient.php">Mes réservations <span style="border-radius: 30px;
                                                                background: green;">'.$row.'</span></a></li>';
                                                            }
                                                            if($row!=0 && $rowN!=0)
                                                            {
                                                                echo'<li><a href="resaClient.php"><span style="border-radius: 30px;
                                                            background: red;">'.$rowN.'</span> Mes réservations <span style="border-radius: 30px;
                                                            background: green;">'.$row.'</span></a></li>';
                                                            }
                                                        }else{ echo'<li><a href="connexionClient.php" class="btn btn-danger">Connexion</a></li>';}
                                                            ?>

                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile menu start -->
                <div class="mobile-menu-area hidden-lg hidden-md">
                    <div class="container">
                        <div class="col-md-12">
                            <nav id="dropdown">
                                <ul>
                                    <li><a href="our-room.html">Chambres</a></li>
                                    <li><a href="seminaires.html">Séminaires</a></li>
                                    <li><a href="resto.html">Restaurant</a></li>
                                    <li><a href="loisirs.html">Nos loisirs</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Mobile menu end -->
            </div>
            <!--Welcome secton-->

        </div>
        <!--Header section end-->
        <!-- search bar Start -->
        <div class="search-bar animated slideOutUp">
            <div class="table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="search-form-wrap">
                                    <button class="close-search"><i class="mdi mdi-close"></i></button>
                                    <form action="#">
                                        <input type="text" placeholder="Search here..." value="Search here..." />
                                        <button class="search-button" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search bar End -->
        <!--Element start-->
        <div class="elements pt-80 text-center white_bg">
            <!--Room booking start-->
            <div class="room-booking pb-80 white_bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- FIN en tête -->


                            <div class="login-form">
                                <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {

                        case 'tel_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> numéro incorrect. EX: 0102030405
                                </div>
                                <?php
                        break;

                        case 'pren_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> prénom trop long.
                                </div>
                                <?php
                        break;

                        case 'password':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> mot de passe différent.
                                </div>
                                <?php
                break;

                case 'already':
                    ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> compte deja existant. Veuillez vous connecter.
                                </div>
                                <?php
        break;

                        case 'email_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> email trop long.
                                </div>
                                <?php 
                        break;

                        case 'nom_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> nom trop long.
                                </div>
                                <?php 

                    }
                }
                ?>

                                <form method="post" action="inscriptionClTraitement.php">
                                    <h2 class="text-center">Inscription</h2>
                                    <div class="form-group">
                                        <select class="form-control" id="chb_type" name="civilite">
                                            <option value="Mr">Monsieur</option>
                                            <option value="Mme">Madame</option>
                                            <option value="Mlle">Mademoiselle</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nom" class="form-control" placeholder="Nom"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="pren" class="form-control" placeholder="Prénom"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="tel" class="form-control" placeholder="Contact"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Mot de passe" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_retype" class="form-control"
                                            placeholder="Re-tapez le mot de passe" required="required"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" name="ok"
                                            value="Inscription" />
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <style>
                    .login-form {
                        width: 340px;
                        margin: 50px auto;
                    }

                    .login-form form {
                        margin-bottom: 15px;
                        background: #f7f7f7;
                        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                        padding: 30px;
                    }

                    .login-form h2 {
                        margin: 0 0 15px;
                    }

                    .form-control,
                    .btn {
                        min-height: 38px;
                        border-radius: 2px;
                    }

                    .btn {
                        font-size: 15px;
                        font-weight: bold;
                    }
                    </style>






                    <!-- debut bas -->
                    <div class="our-sevices text-center ptb-80 white_bg">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title mb-75"><br><br><br><br>
                                        <h2>Situation <span style="color: rgb(226, 29, 29);">Geographique</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15894.954948208488!2d-3.3397365!3d5.1456996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb33d80bd396d60fe!2sVilla%20Blanca!5e0!3m2!1sfr!2sci!4v1613234519974!5m2!1sfr!2sci"
                                        style="width: 100%" height="450" frameborder="0" style="border:0;"
                                        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Our Location end-->
                    <!--Footer start -->

                    <div class="footer ptb-100">
                        <div class="footer-bg-opacity"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="single-footer mt-0">
                                        <div class="logo">
                                            <img src="images/logo/logo.png" alt="">
                                        </div>
                                        <div class="f-adress">
                                            <p>
                                                Route Assinie-Mafia, KM 12
                                                Assinie
                                                Côte d'Ivoire
                                            </p>

                                        </div>
                                        <div class="hotel-contact">
                                            <p><span>Téléphone:</span> +225 07 07 43 43 94.</p>
                                            <p><span>Email:</span> reservation@villa_blanca.ci</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 hidden-sm col-xs-6">
                                    <div class="single-footer">
                                        <h3>Plus d'infos</h3>
                                        <div class="quick-item">
                                            <ul>
                                                <li><a href="#">Equipement de l'hotel</a></li>
                                                <li><a href="#">Menu du Restaurant</a></li>
                                                <li><a href="#">Bar</a></li>
                                                <li><a href="#">loisirs</a></li>
                                                <!--<li><a href="#">Wellness</a></li>-->
                                                <!--<li><a href="#">Contact</a></li>-->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="single-footer">
                                        <h3>Nous contacter</h3>
                                        <div class="get-touch">
                                            <!--<<p>There are many varins of passages of Lorem Ipsum available, but</p>-->
                                            <div class="get-conatct">
                                                <form action="#">
                                                    <input type="text" placeholder="Votre nom">
                                                    <input type="text" placeholder="Votre Email">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="exampleInput"
                                                            style="color: white;" placeholder="votre message"
                                                            rows="3"></textarea>
                                                    </div>
                                                    <button type="submit">Envoyer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="single-footer">
                                        <h3>Suivez-nous</h3>
                                        <div class="instagram-post">
                                            <div class="single-post">
                                                <i class="fa fa-twitter fa-3x" style="color: #1DA1F2;"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <div class="single-post">
                                                <i class="fa fa-facebook-square fa-3x" style="color: #4267B2;"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <div class="single-post">
                                                <i class="fa fa-linkedin fa-3x" style="color: #2867B2;"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</body>

</html>