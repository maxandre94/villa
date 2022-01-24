<?php

session_start();
require 'vendor/autoload.php';
require_once '../connection.php'; // ajout connexion bdd
// si la session existe pas soit si l'on est pas connecté on redirige

use Mailjet\Resources;

$mj = new \Mailjet\Client('f1deb41cfc24416451ff78904b822e7c', '1b1d77e7cfff983b5417433d2d332dd6', true, ['version' => 'v3.1']);

if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

if (isset($_POST['valide'])) {
    $id_fact = $_POST['fact'];
    $id_cl = $_POST['cl'];
    $req = $bdd->prepare('UPDATE facture SET statut = 1 WHERE id_cl = ? AND id_fact = ?');
    $req->execute([$id_cl, $id_fact]);

    $check = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
    $check->execute([$id_cl]);
    $client = $check->fetch();

    $check = $bdd->prepare('SELECT * FROM facture WHERE id_cl = ? AND id_fact = ?');
    $check->execute([$id_cl, $id_fact]);
    $fact = $check->fetch();

    if ($client['langue'] == 'Français') {
        $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => 'adjoua94@gmail.com',
                    'Name' => 'Villa Blanca',
                ],
                'To' => [
                    [
                        'Email' => $client['email'],
                        'Name' => $client['prenom_cl'],
                    ],
                ],
                'Subject' => 'Réservation Villa Blanca',
                'TextPart' => 'Passer au règlement',
                'HTMLPart' => '<h3>Bonjour '.$client['civilite_cl'].' '.mb_strtoupper($client['nom_cl']).' '.$client['prenom_cl'].' votre réservation n° '.$fact['id_fact'].' du '.date('d/m/Y H:i:s', strtotime($fact['date_fact']))." s'élevant à ".number_format($fact['montant'], 0, ',', ' ').' Fcfa a été confirmée. Merci de bien vouloir passer au paiement via votre interface client du site ou cliquez sur le lien https://villablanca.ci/reservation/payConnectCl.php?token='.$client['token'].'.</h3><br />Merci et bon séjour à la villa blanca.',
                'CustomID' => 'AppGettingStartedTest',
            ],
        ],
    ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        //$response->success() && var_dump($response->getData());

        header('Location: facture.php');
    } else {
        $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => 'adjoua94@gmail.com',
                    'Name' => 'Villa Blanca',
                ],
                'To' => [
                    [
                        'Email' => $client['email'],
                        'Name' => $client['prenom_cl'],
                    ],
                ],
                'Subject' => 'Villa Blanca reservation',
                'TextPart' => 'Proceed to payment',
                'HTMLPart' => '<h3>Hello '.$client['civilite_cl'].' '.mb_strtoupper($client['nom_cl']).' your reservation n° '.$fact['id_fact'].' of '.date('d/m/Y H:i:s', strtotime($fact['date_fact'])).' amounting to '.number_format($fact['montant'], 0, ',', ' ').' XOF has been confirmed. Please proceed to payment via your client interface on the site or click on the link https://villablanca.ci/reservation/payConnectCl.php?token='.$client['token'].'.</h3><br />Thank you and have a nice stay at villa blanca.',
                'CustomID' => 'AppGettingStartedTest',
            ],
        ],
    ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        //$response->success() && var_dump($response->getData());

        header('Location: facture.php');
    }
}
if (isset($_POST['annule'])) {
    $id_fact = $_POST['fact'];
    $id_cl = $_POST['cl'];

    $check = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
    $check->execute([$id_cl]);
    $client = $check->fetch();

    $check = $bdd->prepare('SELECT * FROM facture WHERE id_cl = ? AND id_fact = ?');
    $check->execute([$id_cl, $id_fact]);
    $fact = $check->fetch();

    if ($client['langue'] == 'Français') {
        $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => 'adjoua94@gmail.com',
                    'Name' => 'Villa Blanca',
                ],
                'To' => [
                    [
                        'Email' => $client['email'],
                        'Name' => $client['prenom_cl'],
                    ],
                ],
                'Subject' => 'Réservation Villa Blanca',
                'TextPart' => 'Passer au règlement',
                'HTMLPart' => '<h3>Bonjour '.$client['civilite_cl'].' '.mb_strtoupper($client['nom_cl']).' '.$client['prenom_cl'].' votre réservation n° '.$fact['id_fact'].' du '.date('d/m/Y H:i:s', strtotime($fact['date_fact']))." s'élevant à ".number_format($fact['montant'], 0, ',', ' ').' Fcfa a été annulée. Désolé pour tous les désagréments occasionnés.</h3><br />La villa blanca.',
                'CustomID' => 'AppGettingStartedTest',
            ],
        ],
    ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        //$response->success() && var_dump($response->getData());

        $req = $bdd->prepare('DELETE FROM facture WHERE id_cl = ? AND id_fact = ?');
        $req->execute([$id_cl, $id_fact]);
        $sup = $bdd->prepare('DELETE FROM reservation WHERE id_cl = ? AND id_fact = ?');
        $sup->execute([$id_cl, $id_fact]);

        header('Location: facture.php');
    } else {
        $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => 'adjoua94@gmail.com',
                    'Name' => 'Villa Blanca',
                ],
                'To' => [
                    [
                        'Email' => $client['email'],
                        'Name' => $client['prenom_cl'],
                    ],
                ],
                'Subject' => 'Réservation Villa Blanca',
                'TextPart' => 'Passer au règlement',
                'HTMLPart' => '<h3>Hello '.$client['civilite_cl'].' '.mb_strtoupper($client['nom_cl']).' your reservation n° '.$fact['id_fact'].' of '.date('d/m/Y H:i:s', strtotime($fact['date_fact'])).' amounting to '.number_format($fact['montant'], 0, ',', ' ').' XOF has been canceled. Sorry for the inconvenience caused.</h3><br />La villa blanca.',
                'CustomID' => 'AppGettingStartedTest',
            ],
        ],
    ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        //$response->success() && var_dump($response->getData());

        $req = $bdd->prepare('DELETE FROM facture WHERE id_cl = ? AND id_fact = ?');
        $req->execute([$id_cl, $id_fact]);
        $sup = $bdd->prepare('DELETE FROM reservation WHERE id_cl = ? AND id_fact = ?');
        $sup->execute([$id_cl, $id_fact]);

        header('Location: facture.php');
    }
}
if (isset($_POST['supprime'])) {
    $id_fact = $_POST['fact'];
    $id_cl = $_POST['cl'];
    $req = $bdd->prepare('DELETE FROM facture WHERE id_cl = ? AND id_fact = ?');
    $req->execute([$id_cl, $id_fact]);
    $sup = $bdd->prepare('DELETE FROM reservation WHERE id_cl = ? AND id_fact = ?');
    $sup->execute([$id_cl, $id_fact]);

    header('Location: facture.php');
}
