<?php
session_start();
//require_once './connection.php';
if (isset($_SESSION['resa'])) {
    $_resa = $_SESSION['resa'];
} else {
    $_resa = [];
}
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
                                        </div>
                                    </div>
                                    <div class="menu mt-25">
                                        <div class="menu-list hidden-sm hidden-xs">
                                            <nav>
                                                <ul>
                                                <li><a href="chambres.php">ROOMS</a></li>
                                                    <li><a href="seminaires.php">SEMINARS</a></li>
                                                    <li><a href="resto.php">RESTAURANT</a></li>
                                                    <li><a href="loisirs.php">HOBBIES</a></li>
                                                    <li><a href="detailang.php">RESERVATION</a></li>
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
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClientang.php" class="btn btn-danger">My reservations</a>
                                                                <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a></li>';
    }
    if ($row != 0 && $rowN == 0) {
        echo '<li><a href="resaClientang.php" class="btn btn-danger">My reservations</a>
                                                                <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                                <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
    if ($row != 0 && $rowN != 0) {
        echo '<li><span class="badge badge-warning" id="lblCartCounts">'.$rowN.'</span><a href="resaClientang.php" class="btn btn-danger">My reservations</a>
                                                                <a href="resaClientang.php"><i class="fa" style="font-size:24px; color: white">&#xf07a;</i></a>
                                                                <span class="badge badge-warning" id="lblCartCount">'.$row.'</span></li>';
    }
} else {
    echo '<li><a href="connexionClientang.php" class="btn btn-danger">Connection</a></li>';
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
                if (isset($_GET['reg_err'])) {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch ($err) {
                        /*case 'tel_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> numéro incorrect. EX: 0102030405
                                </div>
                                <?php
                        break;*/

                        case 'pay_length':
                            ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Error</strong> please select a country.
                                                    </div>
                                                    <?php
                break;

                        case 'cp_length':
                            ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Error</strong> non-compliant code. EX: 00225
                                                    </div>
                                                    <?php
                break;

                        case 'ville_length':
                            ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Error</strong> city too long.
                                                    </div>
                                                    <?php
                break;

                        case 'etat_length':
                            ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Error</strong> State must be 2 letters maximum. EX: AZ
                                                    </div>
                                                    <?php
                break;

                        case 'adress_length':
                            ?>
                                                <div class="alert alert-danger">
                                                    <strong>Error</strong> address too long.
                                                </div>
                                                <?php
                break;

                case 'tel':
                    ?>
                                        <div class="alert alert-danger">
                                            <strong>Error</strong> phone number must contain only digits.
                                        </div>
                                        <?php
                break;

                        case 'pren_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> first name too long.
                                </div>
                                <?php
                        break;

                        case 'password':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> different password.
                                </div>
                                <?php
                break;

                case 'already':
                    ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> already existing account. Please log in.
                                </div>
                                <?php
        break;

                        case 'email_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> email too long.
                                </div>
                                <?php
                        break;

                        case 'nom_length':
                        ?>
                                <div class="alert alert-danger">
                                    <strong>Error</strong> name too long.
                                </div>
                                <?php

                    }
                }
                ?>

                                <form method="post" action="inscriptionClTraitementang.php">
                                    <h2 class="text-center">Registration</h2>
                                    <div class="form-group">
                                        <select class="form-control" id="chb_type" name="civilite">
                                            <option value="Mr">Sir</option>
                                            <option value="Mme">Mrs</option>
                                            <option value="Mlle">Miss</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nom" class="form-control" placeholder="Last name"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="pren" class="form-control" placeholder="First name"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="tel" class="form-control" placeholder="Contact"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="adress" class="form-control" placeholder="Address"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                    <select class="form-control" name="pays" >
<option value = ""> --- Select a country --- </option>
<option value = "4; AF; AFG; Afghanistan"> Afghanistan </option>
<option value = "710; ZA; ZAF; South Africa"> South Africa </option>
<option value = "248; AX; ALA; Aland (Islands)"> Aland (Islands) </option>
<option value = "8; AL; ALB; Albania"> Albania </option>
<option value = "12; DZ; DZA; Algeria"> Algeria </option>
<option value = "276; DE; DEU; Germany"> Germany </option>
<option value = "20; AD; AND; Andorra"> Andorra </option>
<option value = "24; AO; AGO; Angola"> Angola </option>
<option value = "660; AI; AIA; Anguilla"> Anguilla </option>
<option value = "10; AQ; ATA; Antarctica"> Antarctica </option>
<option value = "28; AG; ATG; Antigua and Barbuda"> Antigua and Barbuda </option>
<option value = "682; SA; SAU; Saudi Arabia"> Saudi Arabia </option>
<option value = "32; AR; ARG; Argentina"> Argentina </option>
<option value = "51; AM; ARM; Armenia"> Armenia </option>
<option value = "533; AW; ABW; Aruba"> Aruba </option>
<option value = "36; AU; AUS; Australia"> Australia </option>
<option value = "40; AT; AUT; Austria"> Austria </option>
<option value = "31; AZ; AZE; Azerbaijan"> Azerbaijan </option>
<option value = "44; BS; BHS; Bahamas"> Bahamas </option>
<option value = "48; BH; BHR; Bahrain"> Bahrain </option>
<option value = "50; BD; BGD; Bangladesh"> Bangladesh </option>
<option value = "52; BB; BRB; Barbados"> Barbados </option>
<option value = "56; BE; BEL; Belgium"> Belgium </option>
<option value = "84; BZ; BLZ; Belize"> Belize </option>
<option value = "60; BM; BMU; Bermuda"> Bermuda </option>
<option value = "64; BT; BTN; Bhutan"> Bhutan </option>
<option value = "68; BO; BOL; Bolivia (Plurinational State of)"> Bolivia (Plurinational State of) </option>
<option value = "535; BQ; BES; Bonaire, Saint-Eustache and Saba"> Bonaire, Saint-Eustache and Saba </option>
<option value = "70; BA; BIH; Bosnia and Herzegovina"> Bosnia and Herzegovina </option>
<option value = "72; BW; BWA; Botswana"> Botswana </option>
<option value = "74; BV; BVT; Bouvet (Island)"> Bouvet (Island) </option>
<option value = "96; BN; BRN; Brunei Darussalam"> Brunei Darussalam </option>
<option value = "76; BR; BRA; Brazil"> Brazil </option>
<option value = "100; BG; BGR; Bulgaria"> Bulgaria </option>
<option value = "854; BF; BFA; Burkina Faso"> Burkina Faso </option>
<option value = "108; BI; BDI; Burundi"> Burundi </option>
<option value = "112; BY; BLR; Belarus"> Belarus </option>
<option value = "204; BJ; BEN; Benin"> Benin </option>
<option value = "132; CV; CPV; Cabo Verde"> Cabo Verde </option>
<option value = "116; KH; KHM; Cambodia"> Cambodia </option>
<option value = "120; CM; CMR; Cameroon"> Cameroon </option>
<option value = "124; CA; CAN; Canada"> Canada </option>
<option value = "136; KY; CYM; Cayman Islands"> Cayman Islands (Islands) </option>
<option value = "152; CL; CHL; Chile"> Chile </option>
<option value = "156; CN; CHN; China"> China </option>
<option value = "162; CX; CXR; Christmas (Island)"> Christmas (Island) </option>
<option value = "196; CY; CYP; Cyprus"> Cyprus </option>
<option value = "166; CC; CCK; Cocos (Islands) / Keeling (Islands)"> Cocos (Islands) / Keeling (Islands) </option>
<option value = "170; CO; COL; Colombia"> Colombia </option>
<option value = "174; KM; COM; Comoros"> Comoros </option>
<option value = "178; CG; COG; Congo"> Congo </option>
<option value = "180; CD; COD; Congo (Democratic Republic of)"> Congo (Democratic Republic of) </option>
<option value = "184; CK; COK; Cook (Islands)"> Cook (Islands) </option>
<option value = "410; KR; KOR; Korea (Republic of)"> Korea (Republic of) </option>
<option value = "408; KP; PRK; Korea (Democratic People's Republic of)"> Korea (Democratic People's Republic of) </option>
<option value = "188; CR; CRI; Costa Rica"> Costa Rica </option>
<option value = "191; HR; HRV; Croatia"> Croatia </option>
<option value = "192; CU; CUB; Cuba"> Cuba </option>
<option value = "531; CW; CUW; Curaçao"> Curaçao </option>
<option value = "384; CI; CIV; Ivory Coast"> Ivory Coast </option>
<option value = "208; DK; DNK; Denmark"> Denmark </option>
<option value = "262; DJ; DJI; Djibouti"> Djibouti </option>
<option value = "214; DO; DOM; Dominican (Republic)"> Dominican (Republic) </option>
<option value = "212; DM; DMA; Dominica"> Dominica </option>
<option value = "818; EG; EGY; Egypt"> Egypt </option>
<option value = "222; SV; SLV; El Salvador"> El Salvador </option>
<option value = "784; AE; ARE; United Arab Emirates"> United Arab Emirates </option>
<option value = "218; EC; ECU; Ecuador"> Ecuador </option>
<option value = "232; ER; ERI; Eritrea"> Eritrea </option>
<option value = "724; ES; ESP; Spain"> Spain </option>
<option value = "233; EE; EST; Estonia"> Estonia </option>
<option value = "840; US; USA; United States of America"> United States of America </option>
<option value = "231; ET; ETH; Ethiopia"> Ethiopia </option>
<option value = "238; FK; FLK; Falkland (Islands) / Malvinas (Islands)"> Falkland (Islands) / Malvinas (Islands) </option>
<option value = "242; FJ; FJI; Fiji"> Fiji </option>
<option value = "246; FI; FIN; Finland"> Finland </option>
<option value = "250; FR; FRA; France"> France </option>
<option value = "234; FO; FRO; Faroe (Islands)"> Faroe (Islands) </option>
<option value = "266; GA; GAB; Gabon"> Gabon </option>
<option value = "270; GM; GMB; Gambia"> Gambia </option>
<option value = "288; GH; GHA; Ghana"> Ghana </option>
<option value = "292; GI; GIB; Gibraltar"> Gibraltar </option>
<option value = "308; GD; GRD; Grenade"> Grenade </option>
<option value = "304; GL; GRL; Greenland"> Greenland </option>
<option value = "300; GR; GRC; Greece"> Greece </option>
<option value = "312; GP; GLP; Guadeloupe"> Guadeloupe </option>
<option value = "316; GU; GUM; Guam"> Guam </option>
<option value = "320; GT; GTM; Guatemala"> Guatemala </option>
<option value = "831; GG; GGY; Guernsey"> Guernsey </option>
<option value = "324; GN; GIN; Guinea"> Guinea </option>
<option value = "226; GQ; GNQ; Equatorial Guinea"> Equatorial Guinea </option>
<option value = "624; GW; GNB; Guinea-Bissau"> Guinea-Bissau </option>
<option value = "328; GY; GUY; Guyana"> Guyana </option>
<option value = "254; GF; GUF; Guyane française"> Guyane française </option>
<option value = "268; GE; GEO; Georgia"> Georgia </option>
<option value = "239; GS; SGS; South Georgia and the South Sandwich Islands"> South Georgia and the South Sandwich Islands </option>
<option value = "332; HT; HTI; Haiti"> Haiti </option>
<option value = "334; HM; HMD; Heard-and-MacDonald (Island)"> Heard-and-MacDonald (Island) </option>
<option value = "340; HN; HND; Honduras"> Honduras </option>
<option value = "344; HK; HKG; Hong Kong"> Hong Kong </option>
<option value = "348; HU; HUN; Hungary"> Hungary </option>
<option value = "833; IM; IMN; Isle of Man"> Isle of Man </option>
<option value = "581; UM; UMI; US Minor Outlying Islands"> US Minor Out Islands </option>
<option value = "356; IN; IND; India"> India </option>
<option value = "86; IO; IOT; Indian (British Ocean Territory)"> Indian (British Ocean Territory) </option>
<option value = "360; ID; IDN; Indonesia"> Indonesia </option>
<option value = "364; IR; IRN; Iran (Islamic Republic of)"> Iran (Islamic Republic of) </option>
<option value = "368; IQ; IRQ; Iraq"> Iraq </option>
<option value = "372; IE; IRL; Ireland"> Ireland </option>
<option value = "352; IS; ISL; Iceland"> Iceland </option>
<option value = "376; IL; ISR; Israel"> Israel </option>
<option value = "380; IT; ITA; Italy"> Italy </option>
<option value = "388; JM; JAM; Jamaica"> Jamaica </option>
<option value = "392; JP; JPN; Japan"> Japan </option>
<option value = "832; JE; JEY; Jersey"> Jersey </option>
<option value = "400; JO; JOR; Jordan"> Jordan </option>
<option value = "398; KZ; KAZ; Kazakhstan"> Kazakhstan </option>
<option value = "404; KE; KEN; Kenya"> Kenya </option>
<option value = "417; KG; KGZ; Kyrgyzstan"> Kyrgyzstan </option>
<option value = "296; KI; KIR; Kiribati"> Kiribati </option>
<option value = "414; KW; KWT; Kuwait"> Kuwait </option>
<option value = "418; LA; LAO; Lao, People's Democratic Republic"> Lao, People's Democratic Republic </option>
<option value = "426; LS; LSO; Lesotho"> Lesotho </option>
<option value = "428; LV; LVA; Latvia"> Latvia </option>
<option value = "422; LB; LBN; Lebanon"> Lebanon </option>
<option value = "434; LY; LBY; Libya"> Libya </option>
<option value = "430; LR; LBR; Liberia"> Liberia </option>
<option value = "438; LI; LIE; Liechtenstein"> Liechtenstein </option>
<option value = "440; LT; LTU; Lithuania"> Lithuania </option>
<option value = "442; LU; LUX; Luxembourg"> Luxembourg </option>
<option value = "446; MO; MAC; Macao"> Macao </option>
<option value = "807; MK; MKD; Macedonia (the former Yugoslav Republic of)"> Macedonia (the former Yugoslav Republic of) </option>
<option value = "450; MG; MDG; Madagascar"> Madagascar </option>
<option value = "458; MY; MYS; Malaysia"> Malaysia </option>
<option value = "454; MW; MWI; Malawi"> Malawi </option>
<option value = "462; MV; MDV; Maldives"> Maldives </option>
<option value = "466; ML; MLI; Mali"> Mali </option>
<option value = "470; MT; MLT; Malta"> Malta </option>
<option value = "580; MP; MNP; Northern Mariana Islands (Islands)"> Northern Mariana Islands (Islands) </option>
<option value = "504; MA; MAR; Morocco"> Morocco </option>
<option value = "584; MH; MHL; Marshall Islands"> Marshall Islands </option>
<option value = "474; MQ; MTQ; Martinique"> Martinique </option>
<option value = "480; MU; MUS; Mauritius"> Mauritius </option>
<option value = "478; MR; MRT; Mauritania"> Mauritania </option>
<option value = "175; YT; MYT; Mayotte"> Mayotte </option>
<option value = "484; MX; MEX; Mexico"> Mexico </option>
<option value = "583; FM; FSM; Micronesia (Federated States of)"> Micronesia (Federated States of) </option>
<option value = "498; MD; MDA; Moldova (Republic of)"> Moldova (Republic of) </option>
<option value = "492; MC; MCO; Monaco"> Monaco </option>
<option value = "496; MN; MNG; Mongolia"> Mongolia </option>
<option value = "500; MS; MSR; Montserrat"> Montserrat </option>
<option value = "499; ME; MNE; Montenegro"> Montenegro </option>
<option value = "508; MZ; MOZ; Mozambique"> Mozambique </option>
<option value = "104; MM; MMR; Myanmar"> Myanmar </option>
<option value = "516; NA; NAM; Namibia"> Namibia </option>
<option value = "520; NR; NRU; Nauru"> Nauru </option>
<option value = "558; NI; NIC; Nicaragua"> Nicaragua </option>
<option value = "562; NE; NER; Niger"> Niger </option>
<option value = "566; NG; NGA; Nigeria"> Nigeria </option>
<option value = "570; NU; NIU; Niue"> Niue </option>
<option value = "574; NF; NFK; Norfolk (Island)"> Norfolk (Island) </option>
<option value = "578; NO; NOR; Norway"> Norway </option>
<option value = "540; NC; NCL; Nouvelle-Calédonie"> Nouvelle-Calédonie </option>
<option value = "554; NZ; NZL; New Zealand"> New Zealand </option>
<option value = "524; NP; NPL; Nepal"> Nepal </option>
<option value = "512; OM; OMN; Oman"> Oman </option>
<option value = "800; UG; UGA; Uganda "> Uganda </option>
<option value = "860; UZ; UZB; Uzbekistan"> Uzbekistan </option>
<option value = "586; PK; PAK; Pakistan"> Pakistan </option>
<option value = "585; PW; PLW; Palau"> Palau </option>
<option value = "275; PS; PSE; Palestine, State of"> Palestine, State of </option>
<option value = "591; PA; PAN; Panama"> Panama </option>
<option value = "598; PG; PNG; Papua New Guinea"> Papua New Guinea </option>
<option value = "600; PY; PRY; Paraguay"> Paraguay </option>
<option value = "528; NL; NLD; Netherlands"> Netherlands </option>
<option value = "608; PH; PHL; Philippines"> Philippines </option>
<option value = "612; PN; PCN; Pitcairn"> Pitcairn </option>
<option value = "616; PL; POL; Poland"> Poland </option>
<option value = "258; PF; PYF; French Polynesia"> French Polynesia </option>
<option value = "630; PR; PRI; Puerto Rico"> Puerto Rico </option>
<option value = "620; PT; PRT; Portugal"> Portugal </option>
<option value = "604; PE; PER; Peru"> Peru </option>
<option value = "634; QA; QAT; Qatar"> Qatar </option>
<option value = "642; RO; ROU; Romania"> Romania </option>
<option value = "826; GB; GBR; United Kingdom of Great Britain and Northern Ireland"> United Kingdom of Great Britain and Northern Ireland </option>
<option value = "643; RU; RUS; Russia (Federation)"> Russia (Federation) </option>
<option value = "646; RW; RWA; Rwanda"> Rwanda </option>
<option value = "760; SY; SYR; Syrian Arab Republic"> Syrian Arab Republic </option>
<option value = "140; CF; CAF; Central African Republic"> Central African Republic </option>
<option value = "638; RE; REU; Meeting"> Meeting </option>
<option value = "732; EH; ESH; Western Sahara"> Western Sahara </option>
<option value = "652; BL; BLM; Saint-Barthélemy"> Saint-Barthélemy </option>
<option value = "659; KN; KNA; Saint Kitts and Nevis"> Saint Kitts and Nevis </option>
<option value = "674; SM; SMR; San Marino"> San Marino </option>
<option value = "663; MF; MAF; Saint-Martin (French part)"> Saint-Martin (French part) </option>
<option value = "534; SX; SXM; Saint-Martin (Dutch part)"> Saint-Martin (Dutch part) </option>
<option value = "666; PM; SPM; Saint-Pierre-et-Miquelon"> Saint-Pierre-et-Miquelon </option>
<option value = "336; VA; VAT; Holy See"> Holy See </option>
<option value = "670; VC; VCT; Saint Vincent and the Grenadines"> Saint Vincent and the Grenadines </option>
<option value = "654; SH; SHN; Saint Helena, Ascension and Tristan da Cunha"> Saint Helena, Ascension and Tristan da Cunha </option>
<option value = "662; LC; LCA; Saint Lucia"> Saint Lucia </option>
<option value = "90; SB; SLB; Solomon (Islands)"> Solomon (Islands) </option>
<option value = "882; WS; WSM; Samoa"> Samoa </option>
<option value = "16; AS; ASM; American Samoa"> American Samoa </option>
<option value = "678; ST; STP; Sao Tome and Principe"> Sao Tome and Principe </option>
<option value = "688; RS; SRB; Serbia"> Serbia </option>
<option value = "690; SC; SYC; Seychelles"> Seychelles </option>
<option value = "694; SL; SLE; Sierra Leone"> Sierra Leone </option>
<option value = "702; SG; SGP; Singapore"> Singapore </option>
<option value = "703; SK; SVK; Slovakia"> Slovakia </option>
<option value = "705; SI; SVN; Slovenia"> Slovenia </option>
<option value = "706; SO; SOM; Somalia"> Somalia </option>
<option value = "729; SD; SDN; Sudan"> Sudan </option>
<option value = "728; SS; SSD; South Sudan"> South Sudan </option>
<option value = "144; LK; LKA; Sri Lanka"> Sri Lanka </option>
<option value = "756; CH; CHE; Switzerland"> Switzerland </option>
<option value = "740; SR; SUR; Suriname"> Suriname </option>
<option value = "752; SE; SWE; Sweden"> Sweden </option>
<option value = "744; SJ; SJM; Svalbard and Jan Mayen Island"> Svalbard and Jan Mayen Island </option>
<option value = "748; SZ; SWZ; Swaziland"> Swaziland </option>
<option value = "686; SN; SEN; Senegal"> Senegal </option>
<option value = "762; TJ; TJK; Tajikistan"> Tajikistan </option>
<option value = "834; TZ; TZA; Tanzania, United Republic of"> Tanzania, United Republic of </option>
<option value = "158; TW; TWN; Taiwan (Province of China)"> Taiwan (Province of China) </option>
<option value = "148; TD; TCD; Tchad"> Tchad </option>
<option value = "203; CZ; CZE; Czech Republic"> Czech Republic </option>
<option value = "260; TF; ATF; Terres austrafrançaises"> Terres austrafrançaises </option>
<option value = "764; TH; THA; Thailand"> Thailand </option>
<option value = "626; TL; TLS; Timor-Leste"> Timor-Leste </option>
<option value = "768; TG; TGO; Togo"> Togo </option>
<option value = "772; TK; TKL; Tokelau"> Tokelau </option>
<option value = "776; TO; TON; Tonga"> Tonga </option>
<option value = "780; TT; TTO; Trinidad and Tobago"> Trinidad and Tobago </option>
<option value = "788; TN; TUN; Tunisia"> Tunisia </option>
<option value = "795; TM; TKM; Turkmenistan"> Turkmenistan </option>
<option value = "796; TC; TCA; Turks and Caicos (Islands)"> Turks and Caicos (Islands) </option>
<option value = "792; TR; TUR; Turkey"> Turkey </option>
<option value = "798; TV; TUV; Tuvalu"> Tuvalu </option>
<option value = "804; UA; UKR; Ukraine"> Ukraine </option>
<option value = "858; UY; URY; Uruguay"> Uruguay </option>
<option value = "548; VU; VUT; Vanuatu"> Vanuatu </option>
<option value = "862; VE; VEN; Venezuela (Bolivarian Republic of)"> Venezuela (Bolivarian Republic of) </option>
<option value = "92; VG; VGB; British Virgin Islands (Islands)"> British Virgin Islands (Islands) </option>
<option value = "850; VI; VIR; United States Virgin (Islands)"> United States Virgin (Islands) </option>
<option value = "704; VN; VNM; Viet Nam"> Viet Nam </option>
<option value = "876; WF; WLF; Wallis-et-Futuna"> Wallis-et-Futuna </option>
<option value = "887; YE; YEM; Yemen"> Yemen </option>
<option value = "894; ZM; ZMB; Zambia"> Zambia </option>
<option value = "716; ZW; ZWE; Zimbabwe"> Zimbabwe </option>
</select>
</div>
<div class="form-group">
                                        <input type="text" name="etat" class="form-control" placeholder="State (EX: AZ) for federal states"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ville" class="form-control" placeholder="City"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="cp" class="form-control" placeholder="Postal code (Ex: 00225)"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_retype" class="form-control"
                                            placeholder="Retype password" required="required"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-lg" name="ok"
                                            value="Registration" />
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