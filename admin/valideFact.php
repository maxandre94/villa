<?php
session_start();
require 'vendor/autoload.php';
require_once 'config.php'; // ajout connexion bdd
// si la session existe pas soit si l'on est pas connecté on redirige

use \Mailjet\Resources;
$mj = new \Mailjet\Client('f1deb41cfc24416451ff78904b822e7c', '1b1d77e7cfff983b5417433d2d332dd6', true, ['version' => 'v3.1']);

if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

if (isset($_POST['valide'])) {
    $id_fact = $_POST['fact'];
    $id_cl = $_POST['cl'];
    $req = $bdd->prepare('UPDATE facture SET statut = 1 WHERE id_cl = ? AND id_fact = ?');
    $req->execute(array($id_cl, $id_fact));

    $check = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
    $check->execute(array($id_cl));
    $client = $check->fetch();

    $check = $bdd->prepare('SELECT * FROM facture WHERE id_cl = ? AND id_fact = ?');
    $check->execute(array($id_cl, $id_fact));
    $fact = $check->fetch();

    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "adjoua94@gmail.com",
                    'Name' => "Villa Blanca",
                ],
                'To' => [
                    [
                        'Email' => $client['email'],
                        'Name' => $client['prenom_cl'],
                    ],
                ],
                'Subject' => "Réservation Villa Blanca",
                'TextPart' => "Passer au règlement",
                'HTMLPart' => "<h3>Bonjour " . $client['civilite_cl'] . " " . $client['nom_cl'] . " votre réservation n° " . $fact['id_fact'] . " du " . date("d/m/Y H:i:s", strtotime($fact['date_fact'])) . " s'élevant à " . number_format($fact['montant'], 0, ',', ' ') . " Fcfa a été confirmé, merci de bien vouloir passer au payement via votre interface client du site.</h3><br />Merci et bon séjour à la villa blanca",
                'CustomID' => "AppGettingStartedTest",
            ],
        ],
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    //$response->success() && var_dump($response->getData());

    header('Location: facture.php');
}
if (isset($_POST['annule'])) {
    $id_fact = $_POST['fact'];
    $id_cl = $_POST['cl'];

    $check = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
    $check->execute(array($id_cl));
    $client = $check->fetch();

    $check = $bdd->prepare('SELECT * FROM facture WHERE id_cl = ? AND id_fact = ?');
    $check->execute(array($id_cl, $id_fact));
    $fact = $check->fetch();

    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "adjoua94@gmail.com",
                    'Name' => "Villa Blanca",
                ],
                'To' => [
                    [
                        'Email' => $client['email'],
                        'Name' => $client['prenom_cl'],
                    ],
                ],
                'Subject' => "Réservation Villa Blanca",
                'TextPart' => "Passer au règlement",
                'HTMLPart' => "<h3>Bonjour " . $client['civilite_cl'] . " " . $client['nom_cl'] . " votre réservation n° " . $fact['id_fact'] . " du " . date("d/m/Y H:i:s", strtotime($fact['date_fact'])) . " s'élevant à " . number_format($fact['montant'], 0, ',', ' ') . " Fcfa annulé, merci désolé pour les désagréments occasionnés.</h3><br />La villa blanca",
                'CustomID' => "AppGettingStartedTest",
            ],
        ],
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    //$response->success() && var_dump($response->getData());

    $req = $bdd->prepare('DELETE FROM facture WHERE id_cl = ? AND id_fact = ?');
    $req->execute(array($id_cl, $id_fact));
    $sup = $bdd->prepare('DELETE FROM reservation WHERE id_cl = ? AND id_fact = ?');
    $sup->execute(array($id_cl, $id_fact));

    header('Location: facture.php');
}
if (isset($_POST['supprime'])) {
    $id_fact = $_POST['fact'];
    $id_cl = $_POST['cl'];
    $req = $bdd->prepare('DELETE FROM facture WHERE id_cl = ? AND id_fact = ?');
    $req->execute(array($id_cl, $id_fact));
    $sup = $bdd->prepare('DELETE FROM reservation WHERE id_cl = ? AND id_fact = ?');
    $sup->execute(array($id_cl, $id_fact));

    header('Location: facture.php');
}