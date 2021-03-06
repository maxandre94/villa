<?php

session_start(); // Démarrage de la session
require_once '../connection.php';
require 'vendor/autoload.php';
use Mailjet\Resources;

$mj = new \Mailjet\Client('f1deb41cfc24416451ff78904b822e7c', '1b1d77e7cfff983b5417433d2d332dd6', true, ['version' => 'v3.1']);

// On inclut la connexion à la base de données
if (isset($_SESSION['resa'])) {
    $_resa = $_SESSION['resa'];
} else {
    $_resa = [];
}

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
try {
    if (!empty($_POST['email']) && !empty($_POST['password'])) { // Si il existe les champs email, password et qu'il sont pas vident
        // Patch XSS
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $email = strtolower($email); // email transformé en minuscule

        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT * FROM client WHERE email = ?');
        $check->execute([$email]);
        $data = $check->fetch();
        $row = $check->rowCount();

        // Si > à 0 alors l'utilisateur existe
        if ($row > 0) {
            // Si le mail est bon niveau format
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Si le mot de passe est le bon
                if (password_verify($password, $data['mot_pas'])) {
                    $date = date('Y-m-d H:i:s');

                    $id_cl = $data['id_cl'];
                    $montan = 0;
                    $query = "INSERT INTO facture (id_cl,date_fact, montant) 
                              VALUES ('$id_cl', '$date', '$montan')";
                    $res = $bdd->prepare($query);
                    $exec = $res->execute();
                    $req = $bdd->prepare('SELECT * FROM facture WHERE date_fact=? AND id_cl=?');
                    $req->execute([$date, $id_cl]);
                    $fact = $req->fetch();
                    $id_fact = $fact['id_fact'];

                    foreach ($_resa as $elements => $element) {
                        //print_r($_resa);
                        $id_typ = $element['chb_id'];
                        $arrive = $element['arrive'];
                        $depart = $element['depart'];
                        $chb_nb = $element['chb_nb'];
                        $pers_nb = $element['pers_nb'];
                        //$date_sem=dateSem($element['arrive'],$element['depart']);
                        //$date_week=dateWeek($element['arrive'],$element['depart']);
                        $jour = ResaSpitPeriod($element['arrive'], $element['depart']);
                        $date_sem = $jour[1];
                        $date_week = $jour[0];
                        $prix_resa = ($date_sem * $element['chb_sem'] + $date_week * $element['chb_week']) * $element['chb_nb'];
                        $montan += $prix_resa;

                        $sql = "INSERT INTO reservation (id_fact, id_cl, id_typ, arrive, depart, chb_nb, pers_nb, prix_resa) 
          VALUES ('$id_fact','$id_cl', '$id_typ', '$arrive', '$depart', '$chb_nb', '$pers_nb', '$prix_resa')";
                        $res = $bdd->prepare($sql);
                        $exec = $res->execute();
                    }

                    $query = "UPDATE facture SET montant='$montan' WHERE id_fact='$id_fact'";
                    $res = $bdd->prepare($query);
                    $exec = $res->execute();
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['utilisateur'] = $data['id_cl'];
                    include_once 'smsang.php';
                    unset($_SESSION['resa']);
                    header('Location: resaClientang.php');
                    die();
                } else {
                    if ($data['langue'] == 'Français') {
                        $body = [
                        'Messages' => [
                            [
                                'From' => [
                                    'Email' => 'adjoua94@gmail.com',
                                    'Name' => 'Villa Blanca',
                                ],
                                'To' => [
                                    [
                                        'Email' => $data['email'],
                                        'Name' => $data['prenom_cl'],
                                    ],
                                ],
                                'Subject' => 'Mot de passe oublié Villa Blanca',
                                'TextPart' => 'Réinitialisation de mot de passe',
                                'HTMLPart' => '<h3>Bonjour '.$data['civilite_cl'].' '.mb_strtoupper($data['nom_cl']).' '.$data['prenom_cl'].' veuillez cliquer sur le lien suivant pour réinitialiser votre mot de passe https://villablanca.ci/reservation/mp.php?token='.$data['token'].'.</h3><br />Merci et bon séjour à la villa blanca.',
                                'CustomID' => 'AppGettingStartedTest',
                            ],
                        ],
                    ];
                        $response = $mj->post(Resources::$Email, ['body' => $body]);
                    }else {
                        $body = [
                        'Messages' => [
                            [
                                'From' => [
                                    'Email' => 'adjoua94@gmail.com',
                                    'Name' => 'Villa Blanca',
                                ],
                                'To' => [
                                    [
                                        'Email' => $data['email'],
                                        'Name' => $data['prenom_cl'],
                                    ],
                                ],
                                'Subject' => 'Villa Blanca reservation',
                                'TextPart' => 'Proceed to payment',
                                'HTMLPart' => '<h3>Hello '.$data['civilite_cl'].' '.mb_strtoupper($data['nom_cl']).' please click on the following link to reset your password https://villablanca.ci/reservation/mp.php?token='.$data['token'].'.</h3><br />Thank you and have a nice stay at villa blanca.',
                                'CustomID' => 'AppGettingStartedTest',
                            ],
                        ],
                    ];
                        $response = $mj->post(Resources::$Email, ['body' => $body]);
                    }
                    header('Location: infoclConnexionang.php?login_err=password');
                    die();
                }
            } else {
                header('Location: infoclConnexionang.php?login_err=email');
                die();
            }
        } else {
            header('Location: infoclConnexionang.php?login_err=already');
            die();
        }
    } else {
        header('Location: infoclConnexionang.php');
        die();
    } // si le formulaire est envoyé sans aucune données
} catch (Exception $e) {
    echo $e->getMessage();
}
