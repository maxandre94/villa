<?php
session_start();
if (isset($_SESSION['resa'])) {
    $_resa = $_SESSION['resa'];
} else {
    $_resa = [];
}
require_once '../connection.php';
require_once '../connection.php';

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

function dateWeek($date_debut, $date_fin)
{
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

    // iterate over start to end date
    while ($date_debut <= $date_fin) {
        // find the timestamp value of start date
        $timestamp = strtotime($date_debut->format('d-m-Y'));
        // find out the day for timestamp and increase particular day
        $weekDay = date('l', $timestamp);
        $resultDays[$weekDay] = $resultDays[$weekDay] + 1;
        // increase startDate by 1
        $date_debut->modify('+1 day');
    }
    // print the result
    //print_r($resultDays);
    $totaldays = 0;
    foreach ($resultDays as $key => $value) {
        if ($key == 'Friday') {
            $totaldays += $value;
        }
        if ($key == 'Saturday') {
            $totaldays += $value;
        }
    }

    return $totaldays;
}

function jourTotal($date_debut, $date_fin)
{
    // calulating the difference in timestamps
    $diff = strtotime($date_debut) - strtotime($date_fin);

    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
}

// PHP code to find the number of days
// between two given dates

// Function to find the difference
// between two dates.
function dateDiffInDays($date1, $date2)
{
    // Calculating the difference in timestamps
    $diff = strtotime($date2) - strtotime($date1);

    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    return abs(round($diff / 86400));
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Villa blanca | Détail facture</title>
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
                                                    <li><a href="../chambre">Chambres</a></li>
                                                    <li><a href="../seminaire">Séminaires</a></li>
                                                    <li><a href="../restaurant">Restaurant</a></li>
                                                    <li><a href="../loisir">Nos loisirs</a></li>
                                                    <li><a href="./" class="btn btn-danger">Reservation</a></li>
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
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a></li>';
    }
    if ($row != 0 && $rowN == 0) {
        echo '<li><a href="resaClient.php">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
    if ($row != 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
} else {
    echo '<li><a href="connexionClient.php">Connexion</a></li>';
}
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
                            <nav>
                                <ul>
                                <li><a href="../chambre" style="color:white">Chambres</a></li>
                                                    <li><a href="../seminaire" style="color:white">Séminaires</a></li>
                                                    <li><a href="../restaurant" style="color:white">Restaurant</a></li>
                                                    <li><a href="../loisir" style="color:white">Nos loisirs</a></li>
                                                    <li><a href="./" style="color:red">Reservation</a></li>
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
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php" style="color:white">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a></li>';
    }
    if ($row != 0 && $rowN == 0) {
        echo '<li><a href="resaClient.php" style="color:white">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
    if ($row != 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClient.php" style="color:white">Mes réservations</a>
                                                            <a href="resaClient.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
} else {
    echo '<li><a href="connexionClient.php" style="color:white">Connexion</a></li>';
}
                                                    ?>
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
                                    <h2>Réservations</h2>
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
        </div>
        <!-- search bar End -->
        <!--Element start-->
        <div class="elements pt-80 text-center white_bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-50">
                            <h2>
                                <h1 style="font-family: 'Reggae One', cursive;">Réservez vos chambres</h1>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!--Room booking start-->
            <div class="room-booking pb-80 white_bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="booking-rooms-tab text-left">
                                <ul class="nav" role="tablist">
                                    <li><a href="../reservation" data-toggle="tab"><span class="tab-border" name="section1">1</span><span>Infos chambres</span></a></li>
                                    <li class="active"><a href="../reservation/detail-facture.php" data-toggle="tab" name="section2"><span class="tab-border">2</span><span>Détail
                                                facture</span></a>
                                    </li>
                                    <li><a href="../reservation/infocl.php" data-toggle="tab" name="section3"><span class="tab-border">3</span><span>Infos client(s)</span></a>
                                    </li>
                                    <li><a href="#payment" data-toggle="tab"><span class="tab-border">4</span><span>règlement</span></a>
                                    </li>

                                </ul>
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

                            <br /><br /><br />
                            <!-- FIN en tête -->


                            <div id="table_resa">
                                <?php
                                $html = '<table class="table table-bordered">
<caption>Détail de votre réservation (Fcfa)</caption>
<tbody>
  <tr>
    <td rowspan="2" style="font-weight: bold">Arrivée</td>
    <td rowspan="2" style="font-weight: bold">Depart</td>
    <td rowspan="2" style="font-weight: bold">Nb. personne</td>
    <td rowspan="2" style="font-weight: bold">Type chambre</td>
    <td align="center" colspan="4" style="font-weight: bold" bgcolor="f1f1f1">Semaine</td>
    <td align="center" colspan="4" style="font-weight: bold" bgcolor="44c5f8">Weekend</td>
    <td rowspan="2" style="font-weight: bold">Montant</td>
  </tr>
<tr>
    <td style="font-weight: bold" bgcolor="f1f1f1">Nb. chambre</td>
    <td style="font-weight: bold" bgcolor="f1f1f1">Nuitée</td>
    <td style="font-weight: bold" bgcolor="f1f1f1">Tarif</td>
    <td style="font-weight: bold" bgcolor="f1f1f1">Montant</td>
    <td style="font-weight: bold" bgcolor="44c5f8">Nb. chambre</td>
    <td style="font-weight: bold" bgcolor="44c5f8">Nuitée</td>
    <td style="font-weight: bold" bgcolor="44c5f8">Tarif</td>
    <td style="font-weight: bold" bgcolor="44c5f8">Montant</td>
  </tr>';
                                $nuite = 0;
                                $pers = 0;
                                $p_sem = 0;
                                $p_week = 0;
                                $total_resa = 0;
                                $sem = 0;
                                $week = 0;

                                foreach ($_resa as $elements => $element) {
                                    $jour = ResaSpitPeriod($element['arrive'], $element['depart']);
                                    //$date_sem=dateSem($element['arrive'],$element['depart']);
                                    //$date_week=dateWeek($element['arrive'],$element['depart']);
                                    $date_sem = $jour[1];
                                    $date_week = $jour[0];
                                    $nuite += (dateDiffInDays($element['arrive'], $element['depart']) + 1);
                                    $pers += $element['pers_nb'];
                                    $total_resa += ($date_sem * $element['chb_sem'] + $date_week * $element['chb_week']) * $element['chb_nb'];
                                    if ($date_sem == 0) {
                                        $html .= '
                    <tr>
                    <td>'.date('d/m/Y', strtotime($element['arrive'])).'</td>
                    <td>'.date('d/m/Y', strtotime($element['depart'])).'</td>
                    <td>'.$element['pers_nb'].'</td>
                    <td>'.$element['chb_nom'].'</td>
                    <td bgcolor="f1f1f1"></td>
                    <td bgcolor="f1f1f1"></td>
                    <td bgcolor="f1f1f1"></td>
                    <td bgcolor="f1f1f1"></td>
                    <td bgcolor="44c5f8">'.$element['chb_nb'].'</td>
                    <td bgcolor="44c5f8">'.$date_week.'</td>
                    <td bgcolor="44c5f8">'.number_format($element['chb_week'], 0, ',', ' ').'</td>
                    <td bgcolor="44c5f8">'.number_format($date_week * $element['chb_week'] * $element['chb_nb'], 0, ',', ' ').'</td>
                    <td>'.number_format((($date_sem * $element['chb_sem'] + $date_week * $element['chb_week']) * $element['chb_nb']), 0, ',', ' ').'</td>
                    </tr>';
                                    } elseif ($date_week == 0) {
                                        $html .= '
                    <tr>
                    <td>'.date('d/m/Y', strtotime($element['arrive'])).'</td>
                    <td>'.date('d/m/Y', strtotime($element['depart'])).'</td>
                    <td>'.$element['pers_nb'].'</td>
                    <td>'.$element['chb_nom'].'</td>
                    <td bgcolor="f1f1f1">'.$element['chb_nb'].'</td>
                    <td bgcolor="f1f1f1">'.$date_sem.'</td>
                    <td bgcolor="f1f1f1">'.number_format($element['chb_sem'], 0, ',', ' ').'</td>
                    <td bgcolor="f1f1f1">'.number_format($date_sem * $element['chb_sem'] * $element['chb_nb'], 0, ',', ' ').'</td>
                    <td bgcolor="44c5f8"></td>
                    <td bgcolor="44c5f8"></td>
                    <td bgcolor="44c5f8"></td>
                    <td bgcolor="44c5f8"></td>
                    <td>'.number_format((($date_sem * $element['chb_sem'] + $date_week * $element['chb_week']) * $element['chb_nb']), 0, ',', ' ').'</td>
                    </tr>';
                                    } else {
                                        $html .= '
                    <tr>
                    <td>'.date('d/m/Y', strtotime($element['arrive'])).'</td>
                    <td>'.date('d/m/Y', strtotime($element['depart'])).'</td>
                    <td>'.$element['pers_nb'].'</td>
                    <td>'.$element['chb_nom'].'</td>
                    <td bgcolor="f1f1f1">'.$element['chb_nb'].'</td>
                    <td bgcolor="f1f1f1">'.$date_sem.'</td>
                    <td bgcolor="f1f1f1">'.number_format($element['chb_sem'], 0, ',', ' ').'</td>
                    <td bgcolor="f1f1f1">'.number_format($date_sem * $element['chb_sem'] * $element['chb_nb'], 0, ',', ' ').'</td>
                    <td bgcolor="44c5f8">'.$element['chb_nb'].'</td>
                    <td bgcolor="44c5f8">'.$date_week.'</td>
                    <td bgcolor="44c5f8">'.number_format($element['chb_week'], 0, ',', ' ').'</td>
                    <td bgcolor="44c5f8">'.number_format($date_week * $element['chb_week'] * $element['chb_nb'], 0, ',', ' ').'</td>
                    <td>'.number_format((($date_sem * $element['chb_sem'] + $date_week * $element['chb_week']) * $element['chb_nb']), 0, ',', ' ').'</td>
                    </tr>';
                                    }
                                }

                                $html .= '</tbody>
<tfoot>
<td colspan="12" style="font-weight: bold">Nuitee(s) : '.$nuite.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nombre de
client(s) : '.$pers.'<span style="margin-left: 150px;"> Total</span></td>
                                <td style="font-weight: bold">'.number_format($total_resa, 0, ',', ' ').'</td>
                                </tfoot>
                                </table>';

                                echo $html;

                                ?>
                            </div>
                            <?php

                            ?>


                            <br>
                            <center>
                                <?php if (isset($_SESSION['utilisateur'])) {
                                echo '<form action="enregisteDetailFact.php" method="post" id="formulaire" name="formulaire"><input type="submit" class="btn btn-success" style="width:160px;height: 34px;" name="reserver" value="Réserver"></form>';
                            } else {
                                echo '<a href="infocl.php#section3"><button type="submit" class="btn btn-primary"
                                            style="width:160px;height: 34px;" name="save" id="save">Étape
                                            suivante</button></a>';
                            } ?>

                            </center>






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