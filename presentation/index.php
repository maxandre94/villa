<?php
session_start();
require_once '../connection.php';

//unset($_SESSION['langue']);
//unset($_SESSION['utilisateur']);
if (isset($_SESSION['utilisateur'])) {
    $id_cl = $_SESSION['utilisateur'];

    $req = $bdd->prepare('SELECT * FROM client WHERE id_cl=?');
    $req->execute([$id_cl]);
    $client = $req->fetch();

    if ($client['langue'] == 'Anglais') {
        header('Location:indexang.php');
    }
} else {
    $_SESSION['langue'] = 'Français';
}

$req = $bdd->prepare('SELECT * from type');
$req->execute([]);
$types = $req->fetchall();

$req = $bdd->prepare('SELECT * from type WHERE id_typ=1');
$req->execute();
$chambre = $req->fetch();
?>

<!doctype html>
<html class="no-js" lang="fr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Villa Blanca </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Référencement -->
    <meta name="robots" content="index, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <META NAME="TITLE" CONTENT="Villa Blanca - Hôtel Assinie">
    <META NAME="AUTHOR" CONTENT="CIAN">
    <META NAME="DESCRIPTION"
        CONTENT="Chambres &amp; suites vue lagune &amp; océan. Restaurants. Séminaires. Piscines. Réservez en ligne, meilleur prix garanti. Hôtel de luxe. Hôtel Assinie. Villa blanca. Villa Blanca. Hôtel Villa Blanca. ">
    <META NAME="KEYWORDS"
        CONTENT="Chambres &amp; suites vue lagune &amp; océan. Restaurants. Séminaires. Piscines. Réservez en ligne, meilleur prix garanti. Hôtel de luxe. Hôtel Assinie. Villa blanca. Villa Blanca. Hôtel Villa Blanca. ">
    <META NAME="OWNER" CONTENT="Hôtel Villa Blanca">
    <META NAME="ROBOTS" CONTENT="index,all">
    <META NAME="Reply-to" CONTENT="Email: reservation@villablanca.ci">
    <META NAME="REVISIT-AFTER" CONTENT="1">
    <!-- Référencement -->
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo/logo.png">

 
    
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
    
 

    <!-- Modernizr JS -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  
    
    <!-- Pre Loader
	============================================ -->
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
                                        <a href="./"><img src="../images/logo/logo.png" alt=""></a>
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
                                        <div style="position: absolute;
                                        top: 0px;
                                        right: 0px;">
                                            <form action="redirect.php" method="post">
                                                <select class="" id="chb_type" name="lang" style="background-color: white;color:black" onchange="this.form.submit()">
                                                    
                                            <option value="Français" selected="selected">Français</option>
                                            <option value="Anglais">Anglais</option>
                                                    
                                                </select>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="menu mt-25">
                                        <div class="menu-list hidden-sm hidden-xs">
                                            <nav>
                                                <ul>
                                                   
                                                    <li><a href="../chambre">Chambres</a></li>
                                                    <li><a href="../seminaire">Séminaires</a></li>
                                                    <li><a href="../restaurant">Restaurant</a></li>
                                                    <li><a href="../loisir">Nos loisirs</a></li>
                                                    <li><a href="../reservation">Réservation</a></li>
                                                    
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
                                    
            
                                    <li><a href="../chambre">Chambres</a></li>
                                    <li><a href="../seminaire">Séminaires</a></li>
                                    <li><a href="../restaurant">Restaurant</a></li>
                                    <li><a href="../loisir">Nos loisirs</a></li>
                                    
                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Mobile menu end -->
            </div>
            <!--Welcome secton-->
            <div class="welcome-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-5">
                            <div class="booking-box">
                                <div class="booking-title">
                                    <h3>Reservation</h3>
                                </div>
                                <div class="booking-form">
                                    <form action="resaAjoutIndex.php" method="POST" class="insert-form" id="formulaire" name="formulaire">
                                        <div class="b-date arrive mb-15">
                                            <label style="color: white;">Date arrivée</label>
                                            <input class="date" type="date" placeholder="" name="arrive" id="arrive" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="b-date departure mb-15">
                                            <label style="color: white;">Date de départ</label>
                                            <input class="date" type="date" placeholder="" name="depart" id="depart" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                                        </div>
                                        <div class="select-book mb-15">
                                    <!--<select class="" id="chb_type" name="chb_type" onchange="alert(this.value)">-->
                                    <select class="select-booking" id="chb_type" name="chb_type">
                                        <?php
                                        $chambre_nom = str_replace(' ', '.', $chambre['nom_typ']);
                                        $option = $chambre['id_typ'].'|'.$chambre_nom.'|'.$chambre['prix_sem'].'|'.$chambre['prix_week'];
                                    echo "<option value='$option'>Type de chambre</option>";

                                        foreach ($types as $type) {
                                            $type_nom = str_replace(' ', '.', $type['nom_typ']);
                                            $optionValue = $type['id_typ'].'|'.$type_nom.'|'.$type['prix_sem'].'|'.$type['prix_week'];
                                            $optionLabel = $type['nom_typ'];
                                            echo "<option value='$optionValue'>$optionLabel</option>";
                                        } ?>
                                    </select>

                                        </div>

                                        <div class="select-book  mb-30">
                                        <select class="select-booking" id="chb_nb" name="chb_nb">
                                        <option value="1">Nombre de chambre</option>
                                        <?php for ($i = 1; $i <= 20; ++$i) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                        } ?>
                                    </select>
                                        </div>
                                        <div class="select-book  mb-30">
                                        <select class="select-booking" id="pers_nb" name="pers_nb">
                                        <option value="1">Nombre de personne</option>
                                        <?php for ($i = 1; $i <= 20; ++$i) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                        } ?>
                                    </select>
                                        </div>
                                        <div class="submit-form">
                                            <button type="submit">Réserver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-7">
                            <div class="welcome-text">
                                <h2>
                                <span>Bienvenue à l'hotel</span> <span style="color: rgb(226, 29, 29);">Villa blanca</span>
                                </h2>
                                <h1 class="cd-headline clip">
                                    <span class="cd-words-wrapper"  style="color: rgb(226, 29, 29);">
                                        <b class="is-visible"> Service</b>
                                        <b>Chambre</b>
                                        <b>Endroit</b>
                                    </span>
                                    <span>Parfait(e)</span>
                                </h1>
                                <!--<p class="welcome-desc">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>-->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header section end -->
        <!--About Section Title start-->
        <div class="about-section text-center ptb-80 white_bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-80">
                            <h2>Soyez la bienvenue à l' <span style="color: rgb(226, 29, 29);">Hotel Villa Blanca</span></h2>
                            <p style="font-size: 20px; font-family:Crimson Pro, serif; line-height: 1.6; text-align: justify;">La "Villa Blanca" est un complexe hôtelier, situé à 12 km du centre-ville d’Assinie.
                            Notre cadre paisible, reculé, incluant l’approche de la nature et plusieurs activités ludiques et
                            sportives compte
                            28 chambres spacieuses, propres et confortables, 4 suites plus une villa famille. <br>
                            Le site plaisamment aménagé avec son jardin parfaitement entretenu,
                            offre un environnement naturel à nos invités.
                            Une vue sensationnelle sur la lagune est possible depuis la terrasse du restaurant.
                            L’hôtel dispose également d’un espace plage, d’une superbe piscine adulte et enfant en plus d’un
                            jacuzzi.</p>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--About Section end-->
        <!--Our Room start-->
        <div class="our-room text-center ptb-80 white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-75">
                            <h2>Nos <span style="color: rgb(226, 29, 29);">Chambres</span></h2>
                           </div>
                    </div>
                </div>
                <div class="our-room-show">
                    <div class="row">
                        <div class="carousel-list">
                            
                            <div class="col-md-4">
                                <div class="single-room">
                                    <div class="room-img">
                                        <a href="#"><img src="../images/room/room3.jpeg" style="width: 370px; height: 256px;" alt=""></a>
                                    </div>
                                    <div class="room-desc">
                                        <div class="room-name">
                                            <h3><a href="#">Suite </a></h3>
                                        </div>
                                        <div class="room-rent">
                                            <h5>150 000 fcfa / <span>Jour le weekend</span></h5>
                                        </div>
                                        <!--
                                                                    <div class="room-book">
                                                                        <a href="#">RESERVEZ</a>
                                                                    </div>
                                                                    -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-room">
                                    <div class="room-img">
                                        <a href="#"><img src="../images/room/room2.jpg" style="width: 370px; height: 256px;" alt=""></a>
                                    </div>
                                    <div class="room-desc">
                                        <div class="room-name">
                                            <h3><a href="#">Chambre Classique </a></h3>
                                        </div>
                                        <div class="room-rent">
                                            <h5>65 000 fcfa / <span>Jour en semaine</span></h5>
                                        </div>
                                        <!--
                                        <div class="room-book">
                                            <a href="#">RESERVEZ</a>
                                        </div>
                                        -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-room">
                                    <div class="room-img">
                                        <a href="#"><img src="../images/room/room4.jpeg" style="width: 370px; height: 256px;" alt=""></a>
                                    </div>
                                    <div class="room-desc">
                                        <div class="room-name">
                                            <h3><a href="#">Chambre Classique </a></h3>
                                        </div>
                                        <div class="room-rent">
                                            <h5>80 000 fcfa / <span>Jour le weekend</span></h5>
                                        </div>
                                        <!--
                                        <div class="room-book">
                                            <a href="#">RESERVEZ</a>
                                        </div>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Our room end-->
        <!--Our Location start-->
        <div class="our-sevices text-center ptb-80 white_bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-75">
                            <h2>Situation <span style="color: rgb(226, 29, 29);">Geographique</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15894.954948208488!2d-3.3397365!3d5.1456996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb33d80bd396d60fe!2sHôtel%20Villa%20Blanca!5e0!3m2!1sfr!2sci!4v1613234519974!5m2!1sfr!2sci"
                            style="width: 100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
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
                                <p><a style="text-transform: none; color:white;" href="tel:+2250709660606">Téléphone: +225 07 09 66 06 06</a></p>
                                <p><a style="text-transform: none; color:white;" href="mailto:reservation@villablanca.ci">Email: reservation@villablanca.ci</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 hidden-sm col-xs-6">
                        <div class="single-footer">
                           <h3>Plus d'infos</h3>
                           <div class="quick-item">
                                <ul>
                                    <li><a href="../chambre">chambres</a></li>
                                    <li><a href="../restaurant">restaurant</a></li>
                                    <li><a href="../loisir">loisirs</a></li>
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
                                    <i class="fa fa-twitter fa-3x" style="color: #1DA1F2;" aria-hidden="true"></i>
                                </div>
                                <div class="single-post">
                                    <i class="fa fa-facebook-square fa-3x"  style="color: #4267B2;" aria-hidden="true"></i>
                                </div>
                                <div class="single-post">
                                    <i class="fa fa-linkedin fa-3x" style="color: #2867B2;"  aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer end -->
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

