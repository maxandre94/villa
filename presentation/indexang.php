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

    if ($client['langue'] == 'Français') {
        header('Location: ./');
    }
} else {
    $_SESSION['langue'] = 'Anglais';
}

$req = $bdd->prepare('SELECT * from type');
$req->execute([]);
$types = $req->fetchall();

$req = $bdd->prepare('SELECT * from type WHERE id_typ=1');
$req->execute();
$chambre = $req->fetch();
?>

<!doctype html>
<html class="no-js" lang="en">

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
    <META NAME="DESCRIPTION" CONTENT="Chambres &amp; suites vue lagune &amp; océan. Restaurants. Séminaires. Piscines. Réservez en ligne, meilleur prix garanti. Hôtel de luxe. Hôtel Assinie. Villa blanca. Villa Blanca. Hôtel Villa Blanca. ">
    <META NAME="KEYWORDS" CONTENT="Chambres &amp; suites vue lagune &amp; océan. Restaurants. Séminaires. Piscines. Réservez en ligne, meilleur prix garanti. Hôtel de luxe. Hôtel Assinie. Villa blanca. Villa Blanca. Hôtel Villa Blanca. ">
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
                                            <a href="../presentation/indexang.php"><img src="../images/logo/logo.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 hidden-xs">
                                        <div class="header-top ptb-10">
                                            <div class="adresses">
                                                <div class="phone">
                                                    <p><a style="text-transform: none; color:white;" href="tel:+2250709660606">Phone: +225 07 09 66 06 06</a></p>
                                                </div>
                                                <div class="email">
                                                    <p>

                                                        <a style="text-transform: none; color:white;" href="mailto:reservation@villablanca.ci">Email: reservation@villablanca.ci </a>
                                                    </p>

                                                </div>


                                                <div style="position: absolute;
                                        top: 0px;
                                        right: 0px;">
                                            <form action="redirect.php" method="post">
                                                <select class="" id="chb_type" name="lang" style="background-color: white;color:black" onchange="this.form.submit()">
                                                    
                                                    <option value="Anglais" selected="selected">Anglais</option>
                                                    <option value="Français">Français</option>
                                                    
                                                </select>
                                            </form>
                                        </div>

                                            </div>
                                        </div>
                                        <div class="menu mt-25">
                                            <div class="menu-list hidden-sm hidden-xs">
                                                <nav>
                                                    <ul>
                                                        <!--Header section accueil
                                                                                                                <li><a href="#">Accueil</a>
                                                                                                                    <ul class="">
                                                                                                                        
                                                                                                                        <li><a href="index.html">Home default</a></li>
                                                                                                                        <li><a href="index-2.html">Home Two</a></li>
                                                                                                                        <li><a href="index-3.html">Animated text</a></li>
                                                                                                                        <li><a href="index-4.html">Parallax version</a></li>
                                                                                                                        <li><a href="index-box.html">Home one box</a></li>
                                                                                                                        <li><a href="index-2-box.html">Home Two box</a></li>
                                                                                                                        
                                                                                                                    </ul>
                                                                                                                </li>
                                                                                                                -->
                                                        <!--Header section element
                                                                                                                <li class="mega_parent"><a href="#">Element<i class="fa fa-angle-down"></i></a>
                                                                                                                    <ul class="mega_menu">
                                                                                                                        <li><a class="element-title" href="#">Elements colmun 1</a>
                                                                                                                            <ul class="mega-sub-menu">
                                                                                                                                <li><a href="elements-alert.html">Aletrs</a></li>
                                                                                                                                <li><a href="elements-button.html">Button</a></li>
                                                                                                                                <li><a href="elements-progress-bar.html">Progress bar</a></li>
                                                                                                                                <li><a href="elements-audio.html">Audio</a></li>
                                                                                                                                <li><a href="elements-video.html">video</a></li>
                                                                                                                            </ul>
                                                                                                                        </li>
                                                                                                                        <li><a class="element-title" href="#">Elements colmun 2</a>
                                                                                                                            <ul class="mega-sub-menu">
                                                                                                                                <li><a href="elements-gallery.html">Gallery one</a></li>
                                                                                                                                <li><a href="elements-gallery-2.html">Gallery Two</a></li>
                                                                                                                                <li><a href="elements-news.html">News one</a></li>
                                                                                                                                <li><a href="elements-news-2.html">News two</a></li>
                                                                                                                                <li><a href="elements-room.html">Room</a></li>
                                                                                                                            </ul>
                                                                                                                        </li>
                                                                                                                        <li><a class="element-title" href="#">Elements colmun 3</a>
                                                                                                                            <ul class="mega-sub-menu">
                                                                                                                                <li><a href="elements-booking-room.html">Booking Room</a></li>
                                                                                                                                <li><a href="elements-gallery-2.html">Gallery</a></li>
                                                                                                                                <li><a href="elements-contact-form.html">Contact form</a></li>
                                                                                                                                <li><a href="elements-map.html">Map</a></li>
                                                                                                                                <li><a href="elements-fun-factor.html">Fun factor</a></li>
                                                                                                                            </ul>
                                                                                                                        </li>
                                                                                                                        <li><a class="element-title" href="#">Elements colmun 4</a>
                                                                                                                            <ul class="mega-sub-menu">
                                                                                                                                <li><a href="elemenst-brand.html">Brand</a></li>
                                                                                                                                <li><a href="elements-services.html">Services</a></li>
                                                                                                                                <li><a href="elements-typhography.html">Typhography</a></li>
                                                                                                                                <li><a href="elements-staff.html">Staff</a></li>
                                                                                                                                <li><a href="elements-testimonial.html">Testionial</a></li>
                                                                                                                            </ul>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </li>-->
                                                        <li><a href="../chambre/chambres.php">Rooms</a></li>
                                                        <li><a href="../seminaire/seminaires.php">Seminars</a></li>
                                                        <li><a href="../restaurant/resto.php">Restaurant</a></li>
                                                        <li><a href="../loisir/loisirs.php">Hobbies</a></li>
                                                        <li><a href="../reservation/detailang.php">Reservation</a></li>
                                                        <!--Header section reste du menu
                                                                                                                <li><a href="gallery-2.html">Gallery</a></li>
                                                                                                                <li><a href="#">pages<i class="fa fa-angle-down"></i></a>
                                                                                                                    <ul class="dropdown_menu">
                                                                                                                        <li><a href="404.html">404</a></li>
                                                            															<li><a href="booking-information.html">Booking Information</a></li>
                                                            															<li><a href="personal-information.html">Personal Information</a></li>
                                                            															<li><a href="payment-information.html">Parment Information</a></li>
                                                            															<li><a href="booking-done.html">Booking Done</a></li>
                                                            															<li><a href="room-booking.html">Room booking</a></li>
                                                            															<li><a href="news.html">News one</a></li>
                                                            															<li><a href="news-2.html">News two</a></li>
                                                            															<li><a href="gallery.html">Gallery one</a></li>
                                                            															 <li><a href="staff.html">Staff</a></li>
                                                            															<li><a href="../chambre">Room</a></li>
                                                                                                                    </ul>
                                                                                                                </li>
                                                                                                                <li><a href="contact-us.html">Contact</a></li>
                                                                                                                -->
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
                                <nav>
                                    <ul>
                                        <!--Header section accueil
                                                                                            <li><a href="#">Accueil</a>
                                                                                            
                                                                                                <ul>
                                                                                                    <li><a href="index.html">Home default</a></li>
                                                                                                    <li><a href="index-2.html">Home Two</a></li>
                                                                                                    <li><a href="index-3.html">Animated text</a></li>
                                                                                                    <li><a href="index-4.html">Parallax version</a></li>
                                                                                                    <li><a href="index-box.html">Home one box</a></li>
                                                                                                    <li><a href="index-2-box.html">Home Two box</a></li>
                                                                                                </ul>
                                                                                       
                                                                                            </li>
                                                                                            -->
                                        <!--Header section accueil
                                                                                            <li><a href="#">Elements</a>
                                                                                                <ul>
                                                                                                    <li><a href="#">Elements colmun 1</a>
                                                                                                        <ul>
                                                                                                            <li><a href="elements-alert.html">Aletrs</a></li>
                                                                                                            <li><a href="elements-button.html">Button</a></li>
                                                                                                            <li><a href="elements-progress-bar.html">Progress bar</a></li>
                                                                                                            <li><a href="elements-audio.html">Audio</a></li>
                                                                                                            <li><a href="elements-video.html">video</a></li>
                                                                                                        </ul>	
                                                                                                    </li>
                                                                                                    <li><a href="#">Elements colmun 2</a>
                                                                                                        <ul>
                                                                                                            <li><a href="elements-gallery.html">Gallery one</a></li>
                                                                                                            <li><a href="elements-gallery-2.html">Gallery Two</a></li>
                                                                                                            <li><a href="elements-news.html">News one</a></li>
                                                                                                            <li><a href="elements-news-2.html">News two</a></li>
                                                                                                            <li><a href="elements-room.html">Room</a></li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                    <li><a href="#">Elements colmun 3</a>
                                                                                                        <ul>
                                                                                                            <li><a href="elements-booking-room.html">Booking Room</a></li>
                                                                                                            <li><a href="elements-gallery-2.html">Gallery</a></li>
                                                                                                            <li><a href="elements-contact-form.html">Contact form</a></li>
                                                                                                            <li><a href="elements-map.html">Map</a></li>
                                                                                                            <li><a href="elements-fun-factor.html">Fun factor</a></li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                    <li><a href="#">Elements colmun 4</a>
                                                                                                        <ul>
                                                                                                            <li><a href="elemenst-brand.html">Brand</a></li>
                                                                                                            <li><a href="elements-services.html">Services</a></li>
                                                                                                            <li><a href="elements-typhography.html">Typhography</a></li>
                                                                                                            <li><a href="elements-staff.html">Staff</a></li>
                                                                                                            <li><a href="elements-testimonial.html">Testionial</a></li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                            -->

                                                                                            <li><a href="../chambre/chambres.php" style="color:white">Rooms</a></li>
                                                        <li><a href="../seminaire/seminaires.php" style="color:white">Seminars</a></li>
                                                        <li><a href="../restaurant/resto.php" style="color:white">Restaurant</a></li>
                                                        <li><a href="../loisir/loisirs.php" style="color:white">Hobbies</a></li>
                                                        <li><a href="../reservation/detailang.php" style="color:white">Reservation</a></li>
                                        <!--Header section accueil
                                                                                            <li><a href="#">Gallery</a></li>
                                                                                            <li><a href="#">pages</a>
                                                                                                <ul>
                                                                                                    <li><a href="404.html">404</a></li>
                                                                                                    <li><a href="booking-information.html">Booking Information</a></li>
                                                                                                    <li><a href="personal-information.html">Personal Information</a></li>
                                                                                                    <li><a href="payment-information.html">Parment Information</a></li>
                                                                                                    <li><a href="booking-done.html">Booking Done</a></li>
                                                                                                    <li><a href="room-booking.html">Room booking</a></li>
                                                                                                    <li><a href="news.html">News one</a></li>
                                                                                                    <li><a href="news-2.html">News two</a></li>
                                                                                                    <li><a href="gallery.html">Gallery one</a></li>
                                                                                                    <li><a href="staff.html">Staff</a></li>
                                                                                                    <li><a href="../chambre">Room</a></li>
                                                                                                </ul>
                                                                                            </li>
                                                                                            <li><a href="#">contact</a></li>
                                                                                            -->
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
                                        <h3 style="color:red;">Reservation</h3>
                                    </div>
                                    <div class="booking-form">
                                        <form action="resaAjoutIndexang.php" method="POST" class="insert-form" id="formulaire" name="formulaire">
                                        <div class="form-group col-md-15">
                                            <label style="color: white;">Arrival</label>
                                            <input class="date" type="date" placeholder="" name="arrive" id="arrive" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group col-md-15">
                                            <label style="color: white;">Departure</label>
                                            <input class="date" type="date" placeholder="" name="depart" id="depart" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                                        </div>
                                        <div class="form-group col-md-15">
                                    <!--<select class="" id="chb_type" name="chb_type" onchange="alert(this.value)">-->
                                    <select class="select-booking" id="chb_type" name="chb_type">
                                        <?php
                                        $chambre_nom = str_replace(' ', '.', $chambre['nom_typ']);
                                        $chambre_nom_ang = str_replace(' ', '.', $chambre['nom_typ_ang']);
                                        $option = $chambre['id_typ'].'|'.$chambre_nom.'|'.$chambre['prix_sem'].'|'.$chambre['prix_week'].'|'.$chambre_nom_ang;
                                        echo "<option value='$option'>Room type</option>";

                                        foreach ($types as $type) {
                                            $type_nom = str_replace(' ', '.', $type['nom_typ']);
                                            $type_nom_ang = str_replace(' ', '.', $type['nom_typ_ang']);
                                            $optionValue = $type['id_typ'].'|'.$type_nom.'|'.$type['prix_sem'].'|'.$type['prix_week'].'|'.$type_nom_ang;
                                            $optionLabel = $type['nom_typ_ang'];
                                            echo "<option value='$optionValue'>$optionLabel</option>";
                                        } ?>
                                    </select>

                                        </div>
                                        <div class="form-group col-md-15">
                                        <select class="select-booking" id="chb_nb" name="chb_nb">
                                        <option value="1">Room number</option>
                                        <?php for ($i = 1; $i <= 20; ++$i) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                        } ?>
                                    </select>
                                        </div>
                                        <div class="form-group col-md-15">
                                        <select class="select-booking" id="pers_nb" name="pers_nb">
                                        <option value="1">Number of people</option>
                                        <?php for ($i = 1; $i <= 20; ++$i) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                        } ?>
                                    </select>
                                        </div>
                                        <div class="submit-form">
                                            <button type="submit" style="color:white; background-color:red;">Reserve</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-7">
                                <div class="welcome-text">
                                    <h2>
                                        <span>Welcome to the hotel</span> <span style="color: rgb(226, 29, 29);">Villa blanca</span>
                                    </h2>
                                    <h1 class="cd-headline clip">
                                        <span>Perfect</span>
                                        <span class="cd-words-wrapper" style="color: rgb(226, 29, 29);">
                                            <b class="is-visible"> Service</b>
                                            <b>Room</b>
                                            <b>Place</b>
                                        </span>
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
                                <h2>Welcome to <span style="color: rgb(226, 29, 29);">Hotel Villa Blanca</span></h2>
                                <p style="font-size: 20px; font-family:Crimson Pro, serif; line-height: 1.6; text-align: justify;">The "Villa Blanca" is a hotel complex, located 12 km from downtown Assinie.
                                    Our peaceful, remote setting, including an approach to nature and several fun and
                                    sports matters
                                    28 spacious, clean and comfortable rooms, 4 suites plus a family villa. <br>
                                    The pleasantly landscaped site with its perfectly maintained garden,
                                    offers a natural environment to our guests.
                                    A sensational view of the lagoon is possible from the restaurant terrace.
                                    The hotel also has a beach area, a superb swimming pool for adults and children in addition to a
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
                                <h2>Nos <span style="color: rgb(226, 29, 29);">Rooms</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="our-room-show">
                        <div class="row">
                            <div class="carousel-list">
                                <div class="col-md-4">
                                    <div class="single-room">
                                        
                                        <div class="room-desc">
                                            <div class="room-name">
                                                <h3><a href="#" data-toggle="modal" data-target="#roovilla">Family Villa </a></h3>
                                            </div>
                                            <div class="room-rent">
                                                <h5>125 000 XOF / <span>on weekend</span></h5>
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
                                            <a href="#" data-toggle="modal" data-target="#roosui"><img src="../images/room/room3.jpeg" style="width: 370px; height: 256px;" alt=""></a>
                                        </div>
                                        <div class="room-desc">
                                            <div class="room-name">
                                                <h3><a href="#" data-toggle="modal" data-target="#roosui">Suite </a></h3>
                                            </div>
                                            <div class="room-rent">
                                                <h5>150 000 XOF / <span> on weekend</span></h5>
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
                                            <a href="#" data-toggle="modal" data-target="#rooclass"><img src="../images/room/room2.jpg" style="width: 370px; height: 256px;" alt=""></a>
                                        </div>
                                        <div class="room-desc">
                                            <div class="room-name">
                                                <h3><a href="#" data-toggle="modal" data-target="#rooclass">Classic rooms </a></h3>
                                            </div>
                                            <div class="room-rent">
                                                <h5>65 000 XOF / <span>on working days</span></h5>

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

            <!-- Modal classique-->
            <div class="modal fade" style="margin-top: 100px;" id="rooclass" tabindex="-1" role="dialog" aria-labelledby="rooclass-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rooclassTitle">Our classic rooms</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="our-room-show">
                                <div class="row">
                                    <div class="carousel-list">
                                        <div class="col-md-4">
                                            <div class="single-room">
                                                
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#roovilla">Classic room 1 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>125 000 XOF / <span> on working days</span></h5>
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
                                                    <a href="#" data-toggle="modal" data-target="#roosui"><img src="../images/room/room3.jpeg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#roosui">Classic room 2 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>150 000 XOF / <span>on working days</span></h5>
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
                                                    <a href="#" data-toggle="modal" data-target="#rooclass"><img src="../images/room/room2.jpg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#rooclass">Classic room 3 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>65 000 XOF / <span>on working days</span></h5>

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
                                                    <a href="#" data-toggle="modal" data-target="#rooclass"><img src="../images/room/room3.jpeg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#rooclass">Classic room 4 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>65 000 XOF / <span>on working days</span></h5>

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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal suites-->
            <div class="modal fade" style="margin-top: 100px;" id="roosui" tabindex="-1" role="dialog" aria-labelledby="roosui-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="roosuiTitle">OUR SUITES</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="our-room-show">
                                <div class="row">
                                    <div class="carousel-list">
                                        <div class="col-md-4">
                                            <div class="single-room">
                                                
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#roovilla">Suite 1</a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>125 000 XOF / <span> on working days </span></h5>
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
                                                    <a href="#" data-toggle="modal" data-target="#roosui"><img src="../images/room/room3.jpeg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#roosui">Suite 2 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>150 000 XOF / <span> on working days </span></h5>
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
                                                    <a href="#" data-toggle="modal" data-target="#rooclass"><img src="../images/room/room2.jpg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#rooclass">Suite 3 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>65 000 XOF / <span> on working days </span></h5>

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
                                                    <a href="#" data-toggle="modal" data-target="#rooclass"><img src="../images/room/room3.jpg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#rooclass">Suite 4 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>65 000 XOF / <span>on working days</span></h5>

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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal villa-->
            <div class="modal fade" style="margin-top: 100px;" id="roovilla" tabindex="-1" role="dialog" aria-labelledby="roovilla-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="roovillaTitle">Our Families Villa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="our-room-show">
                                <div class="row">
                                    <div class="carousel-list">
                                        <div class="col-md-4">
                                            <div class="single-room">
                                                
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#roovilla">Family villa 1 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>125 000 XOF / <span> on working days </span></h5>
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
                                                    <a href="#" data-toggle="modal" data-target="#roosui"><img src="../images/room/room3.jpeg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#roosui">Family villa 2 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>150 000 XOF / <span> on working days </span></h5>
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
                                                    <a href="#" data-toggle="modal" data-target="#rooclass"><img src="../images/room/room2.jpg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#rooclass">Family villa 3 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>65 000 XOF / <span> on working days </span></h5>

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
                                                    <a href="#" data-toggle="modal" data-target="#rooclass"><img src="../images/room/room3.jpg" style="width: 370px; height: 256px;" alt=""></a>
                                                </div>
                                                <div class="room-desc">
                                                    <div class="room-name">
                                                        <h3><a href="#" data-toggle="modal" data-target="#rooclass">Family villa 4 </a></h3>
                                                    </div>
                                                    <div class="room-rent">
                                                        <h5>65 000 XOF / <span> on working days</span></h5>

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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Our Location start-->
            <div class="our-sevices text-center ptb-80 white_bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title mb-75">
                                <h2>Loca<span style="color: rgb(226, 29, 29);">tion</span></h2>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15894.954948208488!2d-3.3397365!3d5.1456996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb33d80bd396d60fe!2sHôtel%20Villa%20Blanca!5e0!3m2!1sfr!2sci!4v1613234519974!5m2!1sfr!2sci" style="width: 100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
                                    <p><a style="text-transform: none; color:white;" href="tel:+2250709660606">Phone: +225 07 09 66 06 06</a></p>
                                    <p><a style="text-transform: none; color:white;" href="mailto:reservation@villablanca.ci">E-mail: reservation@villablanca.ci</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 hidden-sm col-xs-6">
                            <div class="single-footer">
                                <h3>Infoline</h3>
                                <div class="quick-item">
                                    <ul>
                                        <li><a href="../chambre/chambres.php">Rooms</a></li>
                                        <li><a href="../restaurant/resto.php">Restaurant</a></li>
                                        <li><a href="../loisir/loisirs.php">Hobbies</a></li>
                                        <!--<li><a href="#">Wellness</a></li>-->
                                        <!--<li><a href="#">Contact</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="single-footer">
                                <h3>Contact-us</h3>
                                <div class="get-touch">
                                    <!--<<p>There are many varins of passages of Lorem Ipsum available, but</p>-->
                                    <div class="get-conatct">
                                        <form action="../nouscontacter.php" methode="POST">
                                            <input type="text" name="nom" placeholder="Votre nom">
                                            <input type="text" name="email" placeholder="Votre Email">
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleInput" style="color: white;" name="message" placeholder="votre message" rows="3"></textarea>
                                            </div>
                                            <button type="submit" name="send">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="single-footer">
                                <h3>Follow-us</h3>
                                <div class="instagram-post">
                                    <div class="single-post">
                                        <i class="fa fa-twitter fa-3x" style="color: #1DA1F2;" aria-hidden="true"></i>
                                    </div>
                                    <div class="single-post">
                                        <i class="fa fa-facebook-square fa-3x" style="color: #4267B2;" aria-hidden="true"></i>
                                    </div>
                                    <div class="single-post">
                                        <i class="fa fa-linkedin fa-3x" style="color: #2867B2;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer end -->
        </div>