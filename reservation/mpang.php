<?php
session_start();
require_once '../connection.php';
if (!isset($_SESSION['utilisateur'])) {
    header('Location:./');
    die();
}
$id_cl=$_SESSION['utilisateur'];
$check = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
$check->execute([$id_cl]);
$client = $check->fetch();
//print_r($_resa);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Villa blanca | Reset password</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../images/apple-touch-icon.png" type="../images/x-icon" rel="shortcut icon">
    <!-- Place favicon.ico in the root directory -->

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="../css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="../css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- customizer style css -->
    <link href="#" data-style="styles" rel="stylesheet">

    <!-- User style -->
    <link rel="stylesheet" href="../css/custom.css">


    <!-- Modernizr JS -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>

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
        <div class="header-section about-us" style="background: url(../images/bg/piscineok.gif)  right no-repeat, url(../images/bg/restook.gif)  left no-repeat; background-size: 50% 100%;">
            <div class="bg-opacity"></div>
            <div class="top-header sticky-header">
                <div class="top-header-inner">
                    <div class="container">
                        <div class="mgea-full-width">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <div class="logo mt-15">
                                        <a href="../presentation"><img src="../images/logo/logo.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 hidden-xs">
                                    <div class="header-top ptb-10">
                                        <div class="adresses">
                                            <div class="phone">
                                                <p><a style="text-transform: none; color:white;" href="tel:+2250709660606">Téléphone: +225 07 09 66 06 06</a></p>
                                            </div>
                                            <div class="email">
                                                <p><a style="text-transform: none; color:white;" href="mailto:reservation@villablanca.ci">Email: reservation@villablanca.ci</a></p>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile menu start -->
                
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

                            <div class="login">
                                <?php
if (isset($_GET['login_err'])) {
                                                                $err = htmlspecialchars($_GET['login_err']);

                                                                switch ($err) {
        case 'password':
            ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> invalid password
                                </div>
                                <?php
break;

        case 'email':
            ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> incorrect email
                                </div>
                                <?php
break;

        case 'already':
            ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> non existing account
                                </div>
                                <?php
break;
    }
                                                            }
?>
                                <form action="mpfrtraitement.php" method="post">
                                    <h2 class="text-center">Password reset</h2>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            required="required"   value="<?php echo $client['email'];?>" disabled>
                                            <input type="hidden" name="email" class="form-control" placeholder="Email"
                                            required="required"   value="<?php echo $client['email'];?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Mot de passe" required="required"  >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_retype" class="form-control"
                                            placeholder="Re-tapez le mot de passe" required="required"
                                             >
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                                    </div>
                                </form>
                            </div>
                            
                            <style>
                            .login {
                                width: 340px;
                                margin: 50px auto;
                            }

                            .login form {
                                margin-bottom: 15px;
                                background: #f7f7f7;
                                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                                padding: 30px;
                            }

                            .login h2 {
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
                        </div>






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
                                                <img src="../images/logo/logo.png" alt="" style="background: white;">
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
                                                <form action="../nouscontacter.php" methode="POST">
                                       <input type="text" name="nom" placeholder="Votre nom">
                                       <input type="text" name="email" placeholder="Votre Email">
                                       <div class="form-group">
                                           <textarea class="form-control" id="exampleInput" style="color: white;" name="message" placeholder="votre message" rows="3"></textarea>
                                       </div>
                                       <button type="submit" name="envoyer">Envoyer</button>
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
<!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="../js/vendor/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="../js/bootstrap.min.js"></script>
    <!--counter up js-->
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/jquery.counterup.min.js"></script>
    <!-- Video player js -->
    <script src="../js/video-player.js"></script>
    <!-- headlines js -->
    <script src="../js/animated-headlines.js"></script>
    <!-- Ajax mail js -->
    <script src="../js/mailchimp.js"></script>
    <!-- Ajax mail js -->
    <script src="../js/ajax-mail.js"></script>
    <!-- parallax js -->
    <script src="../js/parallax.js"></script>
    <!-- textilate js -->
    <script src="../js/textilate.js"></script>
    <script src="../js/lettering.js"></script>
    <!--isotope js-->
    <script src="../js/isotope.pkgd.min.js"></script>
    <script src="../js/packery-mode.pkgd.min.js"></script>
    <!-- Owl carousel Js -->
    <script src="../js/owl.carousel.min.js"></script>
    <!--Magnificant js-->
    <script src="../js/jquery.magnific-popup.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="../js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="../js/main.js"></script>
</body>

</html>