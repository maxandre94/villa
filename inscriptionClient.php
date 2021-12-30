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
                                                    <li><a href="chambres.html">Chambres</a></li>
                                                    <li><a href="seminaires.html">Séminaires</a></li>
                                                    <li><a href="resto.html">Restaurant</a></li>
                                                    <li><a href="loisirs.html">Nos loisirs</a></li>
                                                    <li><a href="detail.php">Reservation</a></li>
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
    echo '<li><a href="connexionClient.php" class="btn btn-danger">Connexion</a></li>';
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
                                    <li><a href="chambres.html">Chambres</a></li>
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
                                        <strong>Erreur</strong> veuillez sélectionner un pays.
                                    </div>
                                    <?php
break;

        case 'cp_length':
            ?>
                                    <div class="alert alert-danger">
                                        <strong>Erreur</strong> code non conforme. EX: 00225
                                    </div>
                                    <?php
break;

        case 'ville_length':
            ?>
                                    <div class="alert alert-danger">
                                        <strong>Erreur</strong> ville trop long.
                                    </div>
                                    <?php
break;

        case 'etat_length':
            ?>
                                    <div class="alert alert-danger">
                                        <strong>Erreur</strong> Etat doit être 2 lettres maximun. EX: AZ
                                    </div>
                                    <?php
break;

        case 'adress_length':
            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> address trop longue.
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

case 'tel':
    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> numéro de téléphone ne doit contenir que des chiffres.
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
                                        <select class="form-control" name="civilite">
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
                                        <input type="text" name="adress" class="form-control" placeholder="Address"
                                            required="required" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                    <select class="form-control" name="pays" >
<option value="">--- Sélectionner un pays ---</option>
<option value="4;AF;AFG;Afghanistan">Afghanistan</option>
<option value="710;ZA;ZAF;Afrique du Sud">Afrique du Sud</option>
<option value="248;AX;ALA;Aland (Îles)">Aland (Îles)</option>
<option value="8;AL;ALB;Albanie">Albanie</option>
<option value="12;DZ;DZA;Algérie">Algérie</option>
<option value="276;DE;DEU;Allemagne">Allemagne</option>
<option value="20;AD;AND;Andorre">Andorre</option>
<option value="24;AO;AGO;Angola">Angola</option>
<option value="660;AI;AIA;Anguilla">Anguilla</option>
<option value="10;AQ;ATA;Antarctique">Antarctique</option>
<option value="28;AG;ATG;Antigua-et-Barbuda">Antigua-et-Barbuda</option>
<option value="682;SA;SAU;Arabie saoudite">Arabie saoudite</option>
<option value="32;AR;ARG;Argentine">Argentine</option>
<option value="51;AM;ARM;Arménie">Arménie</option>
<option value="533;AW;ABW;Aruba">Aruba</option>
<option value="36;AU;AUS;Australie">Australie</option>
<option value="40;AT;AUT;Autriche">Autriche</option>
<option value="31;AZ;AZE;Azerbaïdjan">Azerbaïdjan</option>
<option value="44;BS;BHS;Bahamas">Bahamas</option>
<option value="48;BH;BHR;Bahreïn">Bahreïn</option>
<option value="50;BD;BGD;Bangladesh">Bangladesh</option>
<option value="52;BB;BRB;Barbade">Barbade</option>
<option value="56;BE;BEL;Belgique">Belgique</option>
<option value="84;BZ;BLZ;Belize">Belize</option>
<option value="60;BM;BMU;Bermudes">Bermudes</option>
<option value="64;BT;BTN;Bhoutan">Bhoutan</option>
<option value="68;BO;BOL;Bolivie (État plurinational de)">Bolivie (État plurinational de)</option>
<option value="535;BQ;BES;Bonaire, Saint-Eustache et Saba">Bonaire, Saint-Eustache et Saba</option>
<option value="70;BA;BIH;Bosnie-Herzégovine">Bosnie-Herzégovine</option>
<option value="72;BW;BWA;Botswana">Botswana</option>
<option value="74;BV;BVT;Bouvet (Île)">Bouvet (Île)</option>
<option value="96;BN;BRN;Brunéi Darussalam">Brunéi Darussalam</option>
<option value="76;BR;BRA;Brésil">Brésil</option>
<option value="100;BG;BGR;Bulgarie">Bulgarie</option>
<option value="854;BF;BFA;Burkina Faso">Burkina Faso</option>
<option value="108;BI;BDI;Burundi">Burundi</option>
<option value="112;BY;BLR;Bélarus">Bélarus</option>
<option value="204;BJ;BEN;Bénin">Bénin</option>
<option value="132;CV;CPV;Cabo Verde">Cabo Verde</option>
<option value="116;KH;KHM;Cambodge">Cambodge</option>
<option value="120;CM;CMR;Cameroun">Cameroun</option>
<option value="124;CA;CAN;Canada">Canada</option>
<option value="136;KY;CYM;Caïmans (Îles)">Caïmans (Îles)</option>
<option value="152;CL;CHL;Chili">Chili</option>
<option value="156;CN;CHN;Chine">Chine</option>
<option value="162;CX;CXR;Christmas (Île)">Christmas (Île)</option>
<option value="196;CY;CYP;Chypre">Chypre</option>
<option value="166;CC;CCK;Cocos (Îles) / Keeling (Îles)">Cocos (Îles) / Keeling (Îles)</option>
<option value="170;CO;COL;Colombie">Colombie</option>
<option value="174;KM;COM;Comores">Comores</option>
<option value="178;CG;COG;Congo">Congo</option>
<option value="180;CD;COD;Congo (République démocratique du)">Congo (République démocratique du)</option>
<option value="184;CK;COK;Cook (Îles)">Cook (Îles)</option>
<option value="410;KR;KOR;Corée (République de)">Corée (République de)</option>
<option value="408;KP;PRK;Corée (République populaire démocratique de)">Corée (République populaire démocratique de)</option>
<option value="188;CR;CRI;Costa Rica">Costa Rica</option>
<option value="191;HR;HRV;Croatie">Croatie</option>
<option value="192;CU;CUB;Cuba">Cuba</option>
<option value="531;CW;CUW;Curaçao">Curaçao</option>
<option value="384;CI;CIV;Côte d'Ivoire">Côte d'Ivoire</option>
<option value="208;DK;DNK;Danemark">Danemark</option>
<option value="262;DJ;DJI;Djibouti">Djibouti</option>
<option value="214;DO;DOM;dominicaine (République)">dominicaine (République)</option>
<option value="212;DM;DMA;Dominique">Dominique</option>
<option value="818;EG;EGY;Egypte">Egypte</option>
<option value="222;SV;SLV;El Salvador">El Salvador</option>
<option value="784;AE;ARE;Emirats arabes unis">Emirats arabes unis</option>
<option value="218;EC;ECU;Equateur">Equateur</option>
<option value="232;ER;ERI;Erythrée">Erythrée</option>
<option value="724;ES;ESP;Espagne">Espagne</option>
<option value="233;EE;EST;Estonie">Estonie</option>
<option value="840;US;USA;Etats-Unis d'Amérique">Etats-Unis d'Amérique</option>
<option value="231;ET;ETH;Ethiopie">Ethiopie</option>
<option value="238;FK;FLK;Falkland (Îles) / Malouines (Îles)">Falkland (Îles) / Malouines (Îles)</option>
<option value="242;FJ;FJI;Fidji">Fidji</option>
<option value="246;FI;FIN;Finlande">Finlande</option>
<option value="250;FR;FRA;France">France</option>
<option value="234;FO;FRO;Féroé (Îles)">Féroé (Îles)</option>
<option value="266;GA;GAB;Gabon">Gabon</option>
<option value="270;GM;GMB;Gambie">Gambie</option>
<option value="288;GH;GHA;Ghana">Ghana</option>
<option value="292;GI;GIB;Gibraltar">Gibraltar</option>
<option value="308;GD;GRD;Grenade">Grenade</option>
<option value="304;GL;GRL;Groenland">Groenland</option>
<option value="300;GR;GRC;Grèce">Grèce</option>
<option value="312;GP;GLP;Guadeloupe">Guadeloupe</option>
<option value="316;GU;GUM;Guam">Guam</option>
<option value="320;GT;GTM;Guatemala">Guatemala</option>
<option value="831;GG;GGY;Guernesey">Guernesey</option>
<option value="324;GN;GIN;Guinée">Guinée</option>
<option value="226;GQ;GNQ;Guinée équatoriale">Guinée équatoriale</option>
<option value="624;GW;GNB;Guinée-Bissau">Guinée-Bissau</option>
<option value="328;GY;GUY;Guyana">Guyana</option>
<option value="254;GF;GUF;Guyane française">Guyane française</option>
<option value="268;GE;GEO;Géorgie">Géorgie</option>
<option value="239;GS;SGS;Géorgie du Sud-et-les Îles Sandwich du Sud">Géorgie du Sud-et-les Îles Sandwich du Sud</option>
<option value="332;HT;HTI;Haïti">Haïti</option>
<option value="334;HM;HMD;Heard-et-MacDonald (Île)">Heard-et-MacDonald (Île)</option>
<option value="340;HN;HND;Honduras">Honduras</option>
<option value="344;HK;HKG;Hong Kong">Hong Kong</option>
<option value="348;HU;HUN;Hongrie">Hongrie</option>
<option value="833;IM;IMN;Ile de Man">Ile de Man</option>
<option value="581;UM;UMI;Iles mineures éloignées des États-Unis">Iles mineures éloignées des États-Unis</option>
<option value="356;IN;IND;Inde">Inde</option>
<option value="86;IO;IOT;Indien (Territoire britannique de océan)">Indien (Territoire britannique de océan)</option>
<option value="360;ID;IDN;Indonésie">Indonésie</option>
<option value="364;IR;IRN;Iran (République Islamique d')">Iran (République Islamique d')</option>
<option value="368;IQ;IRQ;Iraq">Iraq</option>
<option value="372;IE;IRL;Irlande">Irlande</option>
<option value="352;IS;ISL;Islande">Islande</option>
<option value="376;IL;ISR;Israël">Israël</option>
<option value="380;IT;ITA;Italie">Italie</option>
<option value="388;JM;JAM;Jamaïque">Jamaïque</option>
<option value="392;JP;JPN;Japon">Japon</option>
<option value="832;JE;JEY;Jersey">Jersey</option>
<option value="400;JO;JOR;Jordanie">Jordanie</option>
<option value="398;KZ;KAZ;Kazakhstan">Kazakhstan</option>
<option value="404;KE;KEN;Kenya">Kenya</option>
<option value="417;KG;KGZ;Kirghizistan">Kirghizistan</option>
<option value="296;KI;KIR;Kiribati">Kiribati</option>
<option value="414;KW;KWT;Koweït">Koweït</option>
<option value="418;LA;LAO;Lao, République démocratique populaire">Lao, République démocratique populaire</option>
<option value="426;LS;LSO;Lesotho">Lesotho</option>
<option value="428;LV;LVA;Lettonie">Lettonie</option>
<option value="422;LB;LBN;Liban">Liban</option>
<option value="434;LY;LBY;Libye">Libye</option>
<option value="430;LR;LBR;Libéria">Libéria</option>
<option value="438;LI;LIE;Liechtenstein">Liechtenstein</option>
<option value="440;LT;LTU;Lituanie">Lituanie</option>
<option value="442;LU;LUX;Luxembourg">Luxembourg</option>
<option value="446;MO;MAC;Macao">Macao</option>
<option value="807;MK;MKD;Macédoine (ex-République yougoslave de)">Macédoine (ex-République yougoslave de)</option>
<option value="450;MG;MDG;Madagascar">Madagascar</option>
<option value="458;MY;MYS;Malaisie">Malaisie</option>
<option value="454;MW;MWI;Malawi">Malawi</option>
<option value="462;MV;MDV;Maldives">Maldives</option>
<option value="466;ML;MLI;Mali">Mali</option>
<option value="470;MT;MLT;Malte">Malte</option>
<option value="580;MP;MNP;Mariannes du Nord (Îles)">Mariannes du Nord (Îles)</option>
<option value="504;MA;MAR;Maroc">Maroc</option>
<option value="584;MH;MHL;Marshall (Îles)">Marshall (Îles)</option>
<option value="474;MQ;MTQ;Martinique">Martinique</option>
<option value="480;MU;MUS;Maurice">Maurice</option>
<option value="478;MR;MRT;Mauritanie">Mauritanie</option>
<option value="175;YT;MYT;Mayotte">Mayotte</option>
<option value="484;MX;MEX;Mexique">Mexique</option>
<option value="583;FM;FSM;Micronésie (États fédérés de)">Micronésie (États fédérés de)</option>
<option value="498;MD;MDA;Moldova (République de)">Moldova (République de)</option>
<option value="492;MC;MCO;Monaco">Monaco</option>
<option value="496;MN;MNG;Mongolie">Mongolie</option>
<option value="500;MS;MSR;Montserrat">Montserrat</option>
<option value="499;ME;MNE;Monténégro">Monténégro</option>
<option value="508;MZ;MOZ;Mozambique">Mozambique</option>
<option value="104;MM;MMR;Myanmar">Myanmar</option>
<option value="516;NA;NAM;Namibie">Namibie</option>
<option value="520;NR;NRU;Nauru">Nauru</option>
<option value="558;NI;NIC;Nicaragua">Nicaragua</option>
<option value="562;NE;NER;Niger">Niger</option>
<option value="566;NG;NGA;Nigéria">Nigéria</option>
<option value="570;NU;NIU;Niue">Niue</option>
<option value="574;NF;NFK;Norfolk (Île)">Norfolk (Île)</option>
<option value="578;NO;NOR;Norvège">Norvège</option>
<option value="540;NC;NCL;Nouvelle-Calédonie">Nouvelle-Calédonie</option>
<option value="554;NZ;NZL;Nouvelle-Zélande">Nouvelle-Zélande</option>
<option value="524;NP;NPL;Népal">Népal</option>
<option value="512;OM;OMN;Oman">Oman</option>
<option value="800;UG;UGA;Ouganda">Ouganda</option>
<option value="860;UZ;UZB;Ouzbékistan">Ouzbékistan</option>
<option value="586;PK;PAK;Pakistan">Pakistan</option>
<option value="585;PW;PLW;Palaos">Palaos</option>
<option value="275;PS;PSE;Palestine, État de">Palestine, État de</option>
<option value="591;PA;PAN;Panama">Panama</option>
<option value="598;PG;PNG;Papouasie-Nouvelle-Guinée">Papouasie-Nouvelle-Guinée</option>
<option value="600;PY;PRY;Paraguay">Paraguay</option>
<option value="528;NL;NLD;Pays-Bas">Pays-Bas</option>
<option value="608;PH;PHL;Philippines">Philippines</option>
<option value="612;PN;PCN;Pitcairn">Pitcairn</option>
<option value="616;PL;POL;Pologne">Pologne</option>
<option value="258;PF;PYF;Polynésie française">Polynésie française</option>
<option value="630;PR;PRI;Porto Rico">Porto Rico</option>
<option value="620;PT;PRT;Portugal">Portugal</option>
<option value="604;PE;PER;Pérou">Pérou</option>
<option value="634;QA;QAT;Qatar">Qatar</option>
<option value="642;RO;ROU;Roumanie">Roumanie</option>
<option value="826;GB;GBR;Royaume-Uni de Grande-Bretagne et d'Irlande du Nord">Royaume-Uni de Grande-Bretagne et d'Irlande du Nord</option>
<option value="643;RU;RUS;Russie (Fédération de)">Russie (Fédération de)</option>
<option value="646;RW;RWA;Rwanda">Rwanda</option>
<option value="760;SY;SYR;République arabe syrienne">République arabe syrienne</option>
<option value="140;CF;CAF;République centrafricaine">République centrafricaine</option>
<option value="638;RE;REU;Réunion">Réunion</option>
<option value="732;EH;ESH;Sahara occidental">Sahara occidental</option>
<option value="652;BL;BLM;Saint-Barthélemy">Saint-Barthélemy</option>
<option value="659;KN;KNA;Saint-Kitts-et-Nevis">Saint-Kitts-et-Nevis</option>
<option value="674;SM;SMR;Saint-Marin">Saint-Marin</option>
<option value="663;MF;MAF;Saint-Martin (partie française)">Saint-Martin (partie française)</option>
<option value="534;SX;SXM;Saint-Martin (partie néerlandaise)">Saint-Martin (partie néerlandaise)</option>
<option value="666;PM;SPM;Saint-Pierre-et-Miquelon">Saint-Pierre-et-Miquelon</option>
<option value="336;VA;VAT;Saint-Siège">Saint-Siège</option>
<option value="670;VC;VCT;Saint-Vincent-et-Grenadines">Saint-Vincent-et-Grenadines</option>
<option value="654;SH;SHN;Sainte-Hélène, Ascension et Tristan da Cunha">Sainte-Hélène, Ascension et Tristan da Cunha</option>
<option value="662;LC;LCA;Sainte-Lucie">Sainte-Lucie</option>
<option value="90;SB;SLB;Salomon (Îles)">Salomon (Îles)</option>
<option value="882;WS;WSM;Samoa">Samoa</option>
<option value="16;AS;ASM;Samoa américaines">Samoa américaines</option>
<option value="678;ST;STP;Sao Tomé-et-Principe">Sao Tomé-et-Principe</option>
<option value="688;RS;SRB;Serbie">Serbie</option>
<option value="690;SC;SYC;Seychelles">Seychelles</option>
<option value="694;SL;SLE;Sierra Leone">Sierra Leone</option>
<option value="702;SG;SGP;Singapour">Singapour</option>
<option value="703;SK;SVK;Slovaquie">Slovaquie</option>
<option value="705;SI;SVN;Slovénie">Slovénie</option>
<option value="706;SO;SOM;Somalie">Somalie</option>
<option value="729;SD;SDN;Soudan">Soudan</option>
<option value="728;SS;SSD;Soudan du Sud">Soudan du Sud</option>
<option value="144;LK;LKA;Sri Lanka">Sri Lanka</option>
<option value="756;CH;CHE;Suisse">Suisse</option>
<option value="740;SR;SUR;Suriname">Suriname</option>
<option value="752;SE;SWE;Suède">Suède</option>
<option value="744;SJ;SJM;Svalbard et Île Jan Mayen">Svalbard et Île Jan Mayen</option>
<option value="748;SZ;SWZ;Swaziland">Swaziland</option>
<option value="686;SN;SEN;Sénégal">Sénégal</option>
<option value="762;TJ;TJK;Tadjikistan">Tadjikistan</option>
<option value="834;TZ;TZA;Tanzanie, République-Unie de">Tanzanie, République-Unie de</option>
<option value="158;TW;TWN;Taïwan (Province de Chine)">Taïwan (Province de Chine)</option>
<option value="148;TD;TCD;Tchad">Tchad</option>
<option value="203;CZ;CZE;Tchéquie">Tchéquie</option>
<option value="260;TF;ATF;Terres austrafrançaises">Terres austrafrançaises</option>
<option value="764;TH;THA;Thaïlande">Thaïlande</option>
<option value="626;TL;TLS;Timor-Leste">Timor-Leste</option>
<option value="768;TG;TGO;Togo">Togo</option>
<option value="772;TK;TKL;Tokelau">Tokelau</option>
<option value="776;TO;TON;Tonga">Tonga</option>
<option value="780;TT;TTO;Trinité-et-Tobago">Trinité-et-Tobago</option>
<option value="788;TN;TUN;Tunisie">Tunisie</option>
<option value="795;TM;TKM;Turkménistan">Turkménistan</option>
<option value="796;TC;TCA;Turks-et-Caïcos (Îles)">Turks-et-Caïcos (Îles)</option>
<option value="792;TR;TUR;Turquie">Turquie</option>
<option value="798;TV;TUV;Tuvalu">Tuvalu</option>
<option value="804;UA;UKR;Ukraine">Ukraine</option>
<option value="858;UY;URY;Uruguay">Uruguay</option>
<option value="548;VU;VUT;Vanuatu">Vanuatu</option>
<option value="862;VE;VEN;Venezuela (République bolivarienne du)">Venezuela (République bolivarienne du)</option>
<option value="92;VG;VGB;Vierges britanniques (Îles)">Vierges britanniques (Îles)</option>
<option value="850;VI;VIR;Vierges des États-Unis (Îles)">Vierges des États-Unis (Îles)</option>
<option value="704;VN;VNM;Viet Nam">Viet Nam</option>
<option value="876;WF;WLF;Wallis-et-Futuna ">Wallis-et-Futuna </option>
<option value="887;YE;YEM;Yémen">Yémen</option>
<option value="894;ZM;ZMB;Zambie">Zambie</option>
<option value="716;ZW;ZWE;Zimbabwe">Zimbabwe</option>
</select>
</div>

                                    <div class="form-group">
                                        <input type="text" name="etat" class="form-control" placeholder="Etat (EX: AZ) pour les états fédéraux"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ville" class="form-control" placeholder="Ville"
                                            required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="cp" class="form-control" placeholder="Code postal (Ex : 00225)"
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