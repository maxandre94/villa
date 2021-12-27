<?php
session_start();
require_once './admin/config.php';
if (!isset($_SESSION['utilisateur'])) {
    header('Location:detail.php');
    die();
}

$id_cl = $_SESSION['utilisateur'];

$req = $bdd->prepare('SELECT * FROM client WHERE id_cl=?');
$req->execute(array($id_cl));
$client = $req->fetch();

$nom = $client['nom_cl'];
$civilite = $client['civilite_cl'];


$req = $bdd->prepare('SELECT * FROM facture WHERE id_cl=? AND statut IN (0,1) ORDER BY date_fact DESC, paye ASC');
$req->execute(array($id_cl));
$factures = $req->fetchAll();



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
                                        <a href="indexang.php"><img src="images/logo/logo.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 hidden-xs">
                                    <div class="header-top ptb-10">
                                        <div class="adresses">
                                            <div class="phone">
                                                <p>Phone: <span>+225 07 07 43 43 94</span></p>
                                            </div>
                                            <div class="email">
                                                <p>Email: <span>reservation@villa_blanca.ci</span></p>
                                            </div>
                                            <!--<div style="position: absolute;top: 60px;right: 67px;">
                                                <a href="deconnexionClient.php"><input class="btn btn-danger"
                                                        type="submit" name="deconnexion" value="Déconnexion"></a>
                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="menu mt-25">
                                        <div class="menu-list hidden-sm hidden-xs">
                                            <nav>
                                                <ul>
                                                
                                                    <li><a href="seminaires.php">SEMINARS</a></li>
                                                    <li><a href="resto.php">RESTAURANT</a></li>
                                                    <li><a href="loisirs.php">HOBBIES</a></li>
                                                    <li><a href="detailang.php" class="btn btn-danger">RESERVATION</a></li>
                                                    <?php if (isset($_SESSION['utilisateur'])) {
                                                        $req = $bdd->prepare('SELECT * FROM facture WHERE id_cl=?');
                                                        $req->execute(array($_SESSION['utilisateur']));
                                                        $facts = $req->fetchAll();
                                                        $rowN = 0;
                                                        $row = 0;
                                                        foreach ($facts as $fact) {
                                                            if ($fact['statut'] == 0) {
                                                                $rowN++;
                                                            }
                                                            if ($fact['statut'] == 1) {
                                                                $row++;
                                                            }
                                                        }
                                                        if ($row == 0 && $rowN != 0) {
                                                            echo '<li><span style="border-radius: 30px;
                                                                background: red; color: white">' . $rowN . '</span>&nbsp<a href="resaClientang.php" class="btn btn-danger">My reservations</a></li>';
                                                        }
                                                        if ($row != 0 && $rowN == 0) {
                                                            echo '<li><a href="resaClientang.php" class="btn btn-danger">My reservations</a>&nbsp<span style="border-radius: 30px;
                                                                background: green; color: white">' . $row . '</span></li>';
                                                        }
                                                        if ($row != 0 && $rowN != 0) {
                                                            echo '<li><span style="border-radius: 30px;
                                                                background: red; color: white">' . $rowN . '</span>&nbsp<a href="resaClientang.php" class="btn btn-danger">My reservations</a>&nbsp<span style="border-radius: 30px;
                                                                background: green; color: white">' . $row . '</span></li>';
                                                        }
                                                    }
                                                    ?>
                                                    <li><a href="deconnexionClientang.php">Logout</a></li>
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
                                    <li><a href="chambres.php">ROOMS</a></li>
                                    <li><a href="seminaires.php">SEMINARS</a></li>
                                    <li><a href="resto.php">RESTAURANT</a></li>
                                    <li><a href="loisirs.php">HOBBIES</a></li>
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
                                    <h2>HELLO <?php echo $civilite . " " . $nom; ?></h2>
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
        <!-- FIN en tête -->










        <div class="elements pt-80 text-center white_bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-50">
                            <h2>
                                <h1 style="font-family: 'Reggae One', cursive;">Invoices</h1>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_cl" style="margin:10px 190px 0px 0px">
                <?php
                $html = '<table class="table table-bordered" style="margin:10px 150px 10px 110px">
<thead>
<tr>
<th scope="col" style="font-weight: bold; text-align: center;">Invoice n°</th>
<th scope="col" style="font-weight: bold; text-align: center;">Date of invoice</th>
<th scope="col" style="font-weight: bold; text-align: center;">Invoice amount</th>
<th scope="col" style="font-weight: bold; text-align: center;">Invoice status</th>
<th scope="col" style="font-weight: bold; text-align: center;">state</th>
<th scope="col" style="font-weight: bold; text-align: center;"></th>
</tr>
</thead>
<tbody>';

                $i = 1;
                foreach ($factures as $facture) {

                    $detail = '<form action="detailResaClient.php" method="post" id="formulaire"
    name="formulaire"><input class="btn btn-secondary" type="submit"
    name="detail" id="add" value="Details"><input type="hidden" name="fact" value=' . $facture['id_fact'] . '><input type="hidden" name="cl" value=' . $facture['id_cl'] . '></form>';
                    if ($facture['statut'] == 0) {
                        $statut = '<div style="color:red">Waiting</div>';
                    } else {
                        $statut = '<form action="reglement.php#section4" method="post" id="formulaire"
        name="formulaire"><input class="btn btn-success" type="submit"
        name="payement" id="add" value="Proceed to payment"><input type="hidden" name="fact" value=' . $facture['id_fact'] . '><input type="hidden" name="cl" value=' . $facture['id_cl'] . '></form>';
                    }

                    if ($facture['paye'] == 0) {
                        $paye = '<div style="color:red">Unpaid</div>';
                    } else {
                        $paye = '<div style="color:green">Paid</div>';
                    }

                    $html .= '
<tr>
<td>' . $facture['id_fact'] . '</td>
<td>' . date("d/m/Y H:i:s", strtotime($facture['date_fact'])) . '</td>
<td>' . number_format($facture['montant'], 0, ',', ' ') . ' </td>
<td>' . $paye . '</td>
<td>' . $statut . '</td>
<td>' . $detail . '</td>
</tr>';
                    $i++;
                }

                $html .= '</tbody>
</table>';

                echo $html;

                ?>
            </div>
        </div>








        <!-- debut bas -->
        <div class="our-sevices text-center ptb-80 white_bg">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title mb-75"><br><br><br><br>
                                        <h2><span style="color: rgb(226, 29, 29);">Geographic</span> location</h2>
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
                                            <img src="images/logo/logo.png" alt="">
                                        </div>
                                        <div class="f-adress">
                                            <p>
                                            Road Assinie-Mafia, KM 12
                                                Assinie
                                                Côte d'Ivoire
                                            </p>

                                        </div>
                                        <div class="hotel-contact">
                                            <p><span>Phone:</span> +225 07 07 43 43 94.</p>
                                            <p><span>Email:</span> reservation@villa_blanca.ci</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 hidden-sm col-xs-6">
                                    <div class="single-footer">
                                        <h3>More informations</h3>
                                        <div class="quick-item">
                                            <ul>
                                                <li><a href="#">Hotel equipment</a></li>
                                                <li><a href="#">Restaurant menu</a></li>
                                                <li><a href="#">Bar</a></li>
                                                <li><a href="#">Hobbies</a></li>
                                                <!--<li><a href="#">Wellness</a></li>-->
                                                <!--<li><a href="#">Contact</a></li>-->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="single-footer">
                                        <h3>Contact us</h3>
                                        <div class="get-touch">
                                            <!--<<p>There are many varins of passages of Lorem Ipsum available, but</p>-->
                                            <div class="get-conatct">
                                                <form action="#">
                                                    <input type="text" placeholder="Your name">
                                                    <input type="text" placeholder="Your email">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="exampleInput" style="color: white;" placeholder="Your message" rows="3"></textarea>
                                                    </div>
                                                    <button type="submit">Send</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="single-footer">
                                        <h3>Follow us</h3>
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

</body>

</html>