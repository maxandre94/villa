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
                    $_SESSION['utilisateur'] = $data['id_cl'];
                    unset($_SESSION['resa']);
                    header('Location: ./detailang.php');
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
                    header('Location: connexionClientang.php?login_err=password');
                    die();
                }
            } else {
                header('Location: connexionClientang.php?login_err=email');
                die();
            }
        } else {
            header('Location: connexionClientang.php?login_err=already');
            die();
        }
    } else {
        header('Location: connexionClientang.php');
        die();
    } // si le formulaire est envoyé sans aucune données
} catch (Exception $e) {
    echo $e->getMessage();
}
