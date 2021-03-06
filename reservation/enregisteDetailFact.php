<?php

session_start(); // Démarrage de la session

require_once '../connection.php';
//if (!isset($_SESSION['utilisateur'])) {
//header('Location:./');
//die();
//}
$id_cl = $_SESSION['utilisateur'];
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
    $check = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
    $check->execute([$id_cl]);
    $data = $check->fetch();

    $date = date('Y-m-d H:i:s');

    $montan = 0;
    $query = "INSERT INTO facture (id_cl, date_fact, montant) 
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

    include_once 'sms.php';
    unset($_SESSION['resa']);
    // header('Location: resaClient.php');
    die();
} catch (Exception $e) {
    echo $e->getMessage();
}
