<?php
session_start();

require_once '../connection.php';
if (!isset($_SESSION['utilisateur'])) {
    header('Location:./');
    die();
}

// On récupere les données de l'utilisateur

$id_fact = $_POST['fact'];
$id_cl = $_POST['cl'];

$req = $bdd->prepare('SELECT * FROM client WHERE id_cl=?');
$req->execute([$id_cl]);
$client = $req->fetch();

$nom = $client['nom_cl'];
$civilite = $client['civilite_cl'];

$req = $bdd->prepare('SELECT * FROM facture WHERE id_cl = ? AND id_fact = ?');
$req->execute([$id_cl, $id_fact]);
$facture = $req->fetch();

$req = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
$req->execute([$id_cl]);
$client = $req->fetch();

$req = $bdd->prepare('SELECT * FROM reservation WHERE id_fact = ?');
$req->execute([$id_fact]);
$reservations = $req->fetchAll();

function ResaSpitPeriod($date_debut, $date_fin)
{
    $weekends = ['FRIDAY', 'SATURDAY'];
    $jour_sem = 0;
    $jour_week = 0;
    $resultDays = [
        'Monday' => 0,
        'Tuesday' => 0,
        'Wednesday' => 0,
        'Thursday' => 0,
        'Friday' => 0,
        'Saturday' => 0,
        'Sunday' => 0,
    ];

    // change string en date time object
    $date_debut = new DateTime($date_debut);
    $date_fin = new DateTime($date_fin);
    $date_fin->modify('-1 day');

    // iterate over start to end date
    while ($date_debut <= $date_fin) {
        // find the timestamp value of start date
        $timestamp = strtotime($date_debut->format('d-m-Y'));
        // find out the day for timestamp and increase particular day
        $Day = date('l', $timestamp);
        if (in_array(strtoupper($Day), $weekends)) {
            ++$jour_week;
        } else {
            ++$jour_sem;
        }

        //$resultDays[$weekDay] = $resultDays[$weekDay] + 1;
        // increase startDate by 1
        $date_debut->modify('+1 day');
    }
    // print the result
    $jours = [$jour_week, $jour_sem];

    return $jours;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Villa blanca | Détail réservation</title>
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
                                    <div class="menu mt-25">
                                        <div class="menu-list hidden-sm hidden-xs">
                                            <nav>
                                                <ul>
                                                    
                                                    <li><a href="../restaurant">Restaurant</a></li>
                                                    <li><a href="../loisir">Nos loisirs</a></li>
                                                    <li><a href="./">Reservation</a></li>
                                                    <?php if (isset($_SESSION['utilisateur'])) {
    $req = $bdd->prepare('SELECT * FROM facture WHERE id_cl=?');
    $req->execute([$_SESSION['utilisateur']]);
    $facts = $req->fetchAll();
    $rowN = 0;
    $row = 0;
    foreach ($facts as $fact) {
        if ($fact['statut'] == 0) {
            ++$rowN;
        }
        if ($fact['statut'] == 1) {
            ++$row;
        }
    }
    if ($row == 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php" class="btn btn-danger">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a></li>';
    }
    if ($row != 0 && $rowN == 0) {
        echo '<li><a href="resaClient.php">Mes réservations</a>
                                                            <a href="resaClient.php" class="btn btn-danger"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
    if ($row != 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php" class="btn btn-danger">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
} else {
    echo '<li><a href="connexionClient.php">Connexion</a></li>';
}
                                                    ?>
                                                    <li><a href="deconnexionClient.php">Déconnexion</a></li>
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
                                <li><a href="../restaurant" style="color:white">Restaurant</a></li>
                                                    <li><a href="../loisir" style="color:white">Nos loisirs</a></li>
                                                    <li><a href="./" style="color:white">Reservation</a></li>
                                                    <?php if (isset($_SESSION['utilisateur'])) {
    $req = $bdd->prepare('SELECT * FROM facture WHERE id_cl=?');
    $req->execute([$_SESSION['utilisateur']]);
    $facts = $req->fetchAll();
    $rowN = 0;
    $row = 0;
    foreach ($facts as $fact) {
        if ($fact['statut'] == 0) {
            ++$rowN;
        }
        if ($fact['statut'] == 1) {
            ++$row;
        }
    }
    if ($row == 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php" style="color:red">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a></li>';
    }
    if ($row != 0 && $rowN == 0) {
        echo '<li><a href="resaClient.php">Mes réservations</a>
                                                            <a href="resaClient.php" style="color:red"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
    if ($row != 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php" style="color:red">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
} else {
    echo '<li><a href="connexionClient.php">Connexion</a></li>';
}
                                                    ?>
                                                    <li><a href="deconnexionClient.php" style="color:white">Déconnexion</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Mobile menu end -->
            </div>
            <!--Welcome secton-->
            <div class="welcome-section text-center ptb-110">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcurbs-inner">
                                <div class="breadcrubs">
                                    <h2>BONJOUR <?php echo $civilite.' '.$nom; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
            <style>
            .badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
#lblCartCount {
    font-size: 12px;
    background: green;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px; 
}
#lblCartCounts {
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px; 
}
</style>
        </div>
        <!-- FIN en tête -->





        <div class="elements pt-80 text-center white_bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-50">
                            <h2>
                                <h1 style="font-family: 'Reggae One', cursive;">Facture N°<?php echo $id_fact; ?></h1>
                            </h2>
                            <div style="position: absolute;
    top: 30px;
    right: 67px;">
                                <?php echo '<form action="annuleFact.php" method="post" id="formulaire"
    name="formulaire"><input class="btn btn-danger" type="submit" name="annuler" value="Annuler"><input type="hidden" name="fact" value='.$id_fact.'><input type="hidden" name="cl" value='.$id_cl.'></form>'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="table_cl" style="margin:10px 50px 10px 50px">
                    <?php
                    $html = '<table class="table table-bordered">
<thead>
<tr>
<th scope="col" style="font-weight: bold; text-align:center;">Date facture</th>
<th scope="col" style="font-weight: bold; text-align:center;">Montant facture</th>
<th scope="col" style="font-weight: bold; text-align:center;">Statut facture</th>
<th scope="col" style="font-weight: bold; text-align:center;">Etat</th>
</tr>
</thead>
<tbody>';

                    if ($facture['statut'] == 0) {
                        $statut = '<div style="color:red">En attente</div>';
                    } else {
                        $statut = '<form action="cinetpay-sdk-php/index.php" method="post" id="formulaire"
    name="formulaire"><input class="btn btn-success" type="submit"
    name="payement" id="add" value="Passer au payement"><input type="hidden" name="fact" value='.$facture['id_fact'].'><input type="hidden" name="cl" value='.$facture['id_cl'].'></form>';
                    }

                    if ($facture['paye'] == 0) {
                        $paye = '<div style="color:red">Impayé</div>';
                    } else {
                        $paye = '<div style="color:green">Payé</div>';
                    }

                    $html .= '
<tr>
<td>'.date('d/m/Y H:i:s', strtotime($facture['date_fact'])).'</td>
<td>'.number_format($facture['montant'], 0, ',', ' ').' </td>
<td>'.$paye.'</td>
<td>'.$statut.'</td>
</tr>';

                    $html .= '</tbody>
</table>';

                    echo $html;
                    ?>
                    <br>

                    <?php
                    $tabl = '<table class="table table-bordered">
<tbody>
  <tr>
    <td rowspan="2" style="font-weight: bold">Arrivée</td>
    <td rowspan="2" style="font-weight: bold">Depart</td>
    <td rowspan="2" style="font-weight: bold">Nbr personne</td>
    <td rowspan="2" style="font-weight: bold">Type chambre</td>
    <td align="center" colspan="4" style="font-weight: bold">Semaine</td>
    <td align="center" colspan="4" style="font-weight: bold">Weekend</td>
    <td rowspan="2" style="font-weight: bold">Montant</td>
  </tr>
<tr>
    <td style="font-weight: bold">Nbr chambre</td>
    <td style="font-weight: bold">Nuitée</td>
    <td style="font-weight: bold">Prix unitaire</td>
    <td style="font-weight: bold">Montant</td>
    <td style="font-weight: bold">Nbr chambre</td>
    <td style="font-weight: bold">Nuitée</td>
    <td style="font-weight: bold">Prix unitaire</td>
    <td style="font-weight: bold">Montant</td>
  </tr>';

                    $total = 0;

                    foreach ($reservations as $reservation) {
                        $jour = ResaSpitPeriod($reservation['arrive'], $reservation['depart']);

                        $req = $bdd->prepare('SELECT * FROM type WHERE id_typ = ?');
                        $req->execute([$reservation['id_typ']]);
                        $typ = $req->fetch();

                        $total += ($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']) + ($reservation['chb_nb'] * $jour[0] * $typ['prix_week']);

                        $tabl .= '
<tr>
<td>'.date('d/m/Y', strtotime($reservation['arrive'])).'</td>
<td>'.date('d/m/Y', strtotime($reservation['depart'])).'</td>
<td>'.$reservation['pers_nb'].'</td>
<td>'.$typ['nom_typ'].'</td>';

                        if ($jour[1] == 0) {
                            $tabl .= '<td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>'.$reservation['chb_nb'].'</td>
    <td>'.$jour[0].'</td>
    <td>'.number_format($typ['prix_week'], 0, ',', ' ').'</td>
    <td>'.number_format(($reservation['chb_nb'] * $jour[0] * $typ['prix_week']), 0, ',', ' ').'</td>';
                        } elseif ($jour[0] == 0) {
                            $tabl .= '<td>'.$reservation['chb_nb'].'</td>
        <td>'.$jour[1].'</td>
        <td>'.number_format($typ['prix_sem'], 0, ',', ' ').'</td>
        <td>'.number_format(($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']), 0, ',', ' ').'</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>';
                        } else {
                            $tabl .= '<td>'.$reservation['chb_nb'].'</td>
    <td>'.$jour[1].'</td>
    <td>'.number_format($typ['prix_sem'], 0, ',', ' ').'</td>
    <td>'.number_format(($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']), 0, ',', ' ').'</td>
    <td>'.$reservation['chb_nb'].'</td>
    <td>'.$jour[0].'</td>
    <td>'.number_format($typ['prix_week'], 0, ',', ' ').'</td>
    <td>'.number_format(($reservation['chb_nb'] * $jour[0] * $typ['prix_week']), 0, ',', ' ').'</td>';
                        }

                        $tabl .= '
<td>'.number_format((($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']) + ($reservation['chb_nb'] * $jour[0] * $typ['prix_week'])), 0, ',', ' ').'</td>
</tr>';
                    }

                    $tabl .= '<tr>
<td colspan="12" style="font-weight: bold">Total</td>
<td style="font-weight: bold">'.number_format($total, 0, ',', ' ').'</td>
</tr>
</tbody>
</table>';

                    echo $tabl;
                    ?>
                </div>
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
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15894.954948208488!2d-3.3397365!3d5.1456996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb33d80bd396d60fe!2sVilla%20Blanca!5e0!3m2!1sfr!2sci!4v1613234519974!5m2!1sfr!2sci" style="width: 100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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