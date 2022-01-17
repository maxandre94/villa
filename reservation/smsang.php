<?php

require_once '../connection.php';
$id_cl = $_SESSION['utilisateur'];

$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE texto = 1');
$req->execute();
$textos = $req->fetch();

$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE infomail = 1');
$req->execute();
$infomails = $req->fetch();

$check = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
$check->execute([$id_cl]);
$client = $check->fetch();

    $token = '91ccbbd2ad9dfd9861d3e972a24ca907';
    $to = $client['code_pos'].$client['tel_cl'];
    // $to = '2250759199606';
    $text = 'Thank%20you%20for%20contacting%20VILLA%20BLANCA.%20We%20check%20the%20availability%20of%20your%20reservation%20and%20we%20will%20get%20back%20to%20you%20in%20less%20than%2030%20min.';
    $url = "https://sms.ordyra.com/sendsms.php?token=$token&to=$to&text=$text";
    $result = file_get_contents($url);
    $vars = json_decode($result, true);
    if ($vars['StatusCode'] != 0) {
        $result = file_get_contents($url);
    }

    foreach($textos as $texto){
        $to = '225'.$texto['tel_admin'];
        $text = 'Bonjour%20'.$texto['civilite'].'%20'.$texto['speudo'].'%20nous%20avons%20une%20nouvelle%20demande%20de%20reservation%20merci%20de%20consulter%20votre%20interface%20administrateur.';
        $url = "https://sms.ordyra.com/sendsms.php?token=$token&to=$to&text=$text";
        $result = file_get_contents($url);
        $vars = json_decode($result, true);
        if ($vars['StatusCode'] != 0) {
        $result = file_get_contents($url);
    }
    }

    foreach($infomails as $infomail){
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'adjoua94@gmail.com',
                        'Name' => 'Villa Blanca',
                    ],
                    'To' => [
                        [
                            'Email' => $infomail['email'],
                            'Name' => $infomail['speudo'],
                        ],
                    ],
                    'Subject' => 'Réservation Villa Blanca',
                    'TextPart' => 'En attente de validation',
                    'HTMLPart' => '<h3>Bonjour '.$infomail['civilite_cl'].' '.mb_strtoupper($infomail['speudo']).' nous avons une nouvelle demande de reservation merci de consulter votre interface administrateur.',
                    'CustomID' => 'AppGettingStartedTest',
                ],
            ],
        ];
            $response = $mj->post(Resources::$Email, ['body' => $body]);}
    // $vars = json_decode($result, true);
// echo 'StatusCode';
// echo $vars['StatusCode'];
// echo 'Text';
// echo $vars['Text'];
