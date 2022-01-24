<?php
session_start();
//unset($_SESSION['resa']);
//unset($_SESSION['utilisateur']);
//$_SESSION['resa'] = null;
//print_r($_SESSION['utilisateur']);

require_once '../connection.php';

if (isset($_SESSION['utilisateur'])) {
    $id_cl = $_SESSION['utilisateur'];
    $req = $bdd->prepare('SELECT * FROM client WHERE id_cl=?');
    $req->execute([$id_cl]);
    $client = $req->fetch();
    if ($client['langue'] == 'Français') {
        header('Location: ./');
    }
}

$types = $bdd->query('SELECT * from type')->fetchAll();

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Villa blanca | Reservation</title>
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
                                        <a href="../presentation/indexang.php"><img src="../images/logo/logo.png" alt=""></a>
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
                                        </div>
                                    </div>
                                    <div class="menu mt-25">
                                        <div class="menu-list hidden-sm hidden-xs">
                                            <nav>
                                                <ul>
                                                    <li><a href="../chambre/chambres.php">ROOMS</a></li>
                                                    <li><a href="../seminaire/seminaires.php">SEMINARS</a></li>
                                                    <li><a href="../restaurant/resto.php">RESTAURANT</a></li>
                                                    <li><a href="../loisir/loisirs.php">HOBBIES</a></li>
                                                    <li><a href="./detailang.php" class="btn btn-danger">RESERVATION</a></li>
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
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClientang.php">My reservations</a>
                                                            <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a></li>';
    }
    if ($row != 0 && $rowN == 0) {
        echo '<li><a href="resaClientang.php">My reservations</a>
                                                            <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
    if ($row != 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClientang.php">My reservations</a>
                                                            <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
} else {
    echo '<li><a href="connexionClientang.php">Connection</a></li>';
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
                                <li><a href="../chambre/chambres.php" style="color:white">ROOMS</a></li>
                                                    <li><a href="../seminaire/seminaires.php" style="color:white">SEMINARS</a></li>
                                                    <li><a href="../restaurant/resto.php" style="color:white">RESTAURANT</a></li>
                                                    <li><a href="../loisir/loisirs.php" style="color:white">HOBBIES</a></li>
                                                    <li><a href="./detailang.php" style="color:red">RESERVATION</a></li>
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
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClientang.php" style="color:white">My reservations</a>
                                                            <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a></li>';
    }
    if ($row != 0 && $rowN == 0) {
        echo '<li><a href="resaClientang.php" style="color:white">My reservations</a>
                                                            <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
    if ($row != 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClientang.php" style="color:white">My reservations</a>
                                                            <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                            <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
} else {
    echo '<li><a href="connexionClientang.php" style="color:white">Connection</a></li>';
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
                                    <h2>RESERVATION</h2>
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
                                <h1 style="font-family: 'Reggae One', cursive;">Reserve your rooms</h1>
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
                                    <li class="active"><a href="/villa/./detailang.php" data-toggle="tab" name="section1"><span class="tab-border">1</span><span>Rooms infos</span></a></li>
                                    <li><a href="/villa/detail-factureang.php" data-toggle="tab"><span class="tab-border">2</span><span>Invoice details</span></a>
                                    </li>
                                    <li><a href="/villa/infoclang.php" data-toggle="tab"><span class="tab-border">3</span><span>Customer(s) Info</span></a>
                                    </li>
                                    <li><a href="#payment" data-toggle="tab"><span class="tab-border">4</span><span>Regulation</span></a>
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

                            <div style="display: flex">
                                <?php
                                foreach ($types as $type) {
                                    echo '
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="booking-rooms-tab text-left"><div class="room-img"><img src='.$type['img_typ'].' style="width: 250px; height: 250px;" alt=""><div style="padding:20px;flex-grow: 1;border-bottom:1px gainsboro solid">
                                    <div style="font-weight: bolder;font-size: 15px;text-align: center">'.$type['nom_typ_ang'].'</div>
                                    <div style="padding:10px 0;display: flex;align-items: center;justify-content: center"> <span style="font-size: 15px">'.$type['prix_sem'].'</span> &nbsp; / weekday</div>

                                    <div style="padding:5px 0;display: flex;align-items: center;justify-content: center"> <span style="font-size: 15px">'.$type['prix_week'].'</span> &nbsp; / weekend day</div>
                                </div></div></div></div></div></div>';
                                }

                                ?>

                            </div>
                        </div><br><label> &nbsp </label>

                        <form action="/resaAjoutang.php" method="POST" class="insert-form" id="formulaire" name="formulaire">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="validationCustom02" class="form-label" style="font-family:Segoe UI semibold; ">Arrival</label>
                                    <input type="date" name="arrive" id="arrive" value="<?php echo date('Y-m-d'); ?>" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="validationCustom02" class="form-label" style="font-family:Segoe UI semibold; ">Departure</label>
                                    <input type="date" class="" name="depart" id="depart" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nomb">Room type</label>
                                    <!--<select class="" id="chb_type" name="chb_type" onchange="alert(this.value)">-->
                                    <select class="" id="chb_type" name="chb_type">
                                        <?php
                                        foreach ($types as $type) {
                                            $type_nom = str_replace(' ', '.', $type['nom_typ']);
                                            $type_nom_ang = str_replace(' ', '.', $type['nom_typ_ang']);
                                            echo '
                                <option value='.$type['id_typ'].'|'.$type_nom.'|'.$type['prix_sem'].'|'.$type['prix_week'].'|'.$type_nom_ang.'>'.$type['nom_typ_ang'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="nbch" class="">Room number</label>
                                    <select class="" id="chb_nb" name="chb_nb">
                                        <?php for ($i = 1; $i <= 20; ++$i) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="nbper" class="">Number of people</label>
                                    <select class="" id="pers_nb" name="pers_nb">
                                        <?php for ($i = 1; $i <= 20; ++$i) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                        } ?>
                                    </select>
                                </div>

                            </div>
                            <br><br /><input class="btn btn-success" type="submit" style="width:85px;height: 34px;" name="add" id="add" value="Reserve">

                        </form>

                    </div><br>



                    <div id="table_resa">
                        <?php
                        if (isset($_GET['reg_err'])) {
                            $err = htmlspecialchars($_GET['reg_err']);

                            switch ($err) {
                                case 'date':
                        ?>
                                    <div class="alert alert-danger">
                                        <strong>Error</strong> the arrival date must be later than the departure date
                                    </div>
                                <?php
                                    break;

                                case 'datejour':
                                ?>
                                    <div class="alert alert-danger">
                                        <strong>Error</strong> the arrival date must be in the month equal to the current date
                                    </div>
                                <?php
                                    break;

                                case 'chambre':
                                ?>
                                    <div class="alert alert-danger">
                                        <strong>Error</strong> the number of people must be greater than or equal to the number of rooms
                                    </div>
                        <?php
                                    break;
                            }
                        }
                        ?>

                        <table class="table table-bordered">
                            <caption>Detail of your reservation</caption>
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col" >Arrival</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Room type</th>
                                    <th scope="col">Room number</th>
                                    <th scope="col">Number of people</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                if (isset($_SESSION['resa'])) {
                                    $_resa = $_SESSION['resa'];
                                    foreach ($_resa as $ligne => $une_resa) {
                                        $valeur = $une_resa['index'];
                                        //$index="ResaSupprime('".$valeur."'); ";?>
                                        <tr>
                                            <td><input type="button" class="btn btn-danger" onclick="ResaSupprime('<?= $valeur; ?>'); " value="Delete"></td>
                                            <td><?= date('d/m/Y', strtotime($une_resa['arrive'])); ?></td>
                                            <td><?= date('d/m/Y', strtotime($une_resa['depart'])); ?></td>
                                            <td><?= $une_resa['chb_nom_ang']; ?></td>
                                            <td><?= $une_resa['chb_nb']; ?></td>
                                            <td><?= $une_resa['pers_nb']; ?></td>
                                        </tr>

                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                    <br>
                    <center>
                        <a href="controleang.php"><input type="submit" class="btn btn-primary" style="width:160px;height: 34px;" name="save" id="save" value="Next step"></a>
                    </center>




                    <br><br>
                    <hr><br><br>





                    <!--hotel team end-->
                    <!--Our Location start-->
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
                                            <img src="../images/logo/logo.png" alt="" style="background: white;">
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

                    <script>
                        function AjouterPanier() {


                            if (confirm('Confirmez-vous le paiement de ?')) {
                                var ladate = new Date();
                                var Milliseconds = ladate.getMilliseconds();
                                var Day = ladate.getDay();
                                var code = Milliseconds + Day;

                                var valeur = prompt("Paiment de " + _saphir + "\n\nVeillez saisir le code validation: " +
                                    code);

                                if (valeur != code) {
                                    alert('Le code saisi est incorrect');

                                } else {
                                    $.ajax({
                                        url: 'resaAjoutang.php',
                                        type: 'post',
                                        data: 'SAPHIR=' + _saphir,
                                        success: function(html) {
                                            //alert(html);

                                            var Reponse = JSON.parse(html);
                                            if (Reponse.success) {
                                                window.location.reload();
                                            } else {
                                                alert(Reponse.text);
                                            }
                                        }

                                    });
                                }

                            }

                        };

                        $(document).ready(function() {
                            //alert('bonjour0');
                            $('#formulaire').on('submit', function(e) {
                                e
                                    .preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
                                var $this = $(this); // L'objet jQuery du formulaire
                                //alert('bonjour');

                                $.ajax({
                                    url: 'resaAjoutang.php', //url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
                                    type: 'post', //type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                                    data: $this
                                        .serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                    success: function(html) {
                                        //alert(html);
                                        document.getElementById('table_resa').innerHTML = html;

                                    }

                                });

                                //alert('fin');
                            });
                        });
                    </script>

                    <script>
                        function ResaSupprime(index) {
                            //alert("suppression");
                            //no clue what to put here?
                            $.ajax({
                                url: 'resaSup.php', //url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
                                type: 'post', //type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                                data: 'index=' +
                                    index, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                success: function(html) {
                                    document.getElementById('table_resa').innerHTML = html;

                                }

                            });
                        }
                    </script>
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