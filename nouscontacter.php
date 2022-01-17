<?php
session_start();
require 'vendor/autoload.php';

use Mailjet\Resources;

$mj = new \Mailjet\Client('f1deb41cfc24416451ff78904b822e7c', '1b1d77e7cfff983b5417433d2d332dd6', true, ['version' => 'v3.1']);

if($_POST['envoyer']){
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $email,
                    'Name' => $nom,
                ],
                'To' => [
                    [
                        'Email' => 'adjoua94@gmail.com',
                        'Name' => 'Villa Blanca',
                    ],
                ],
                'Subject' => 'info Villa Blanca',
                'TextPart' => 'Nous contacter',
                'HTMLPart' => $message,
                'CustomID' => 'AppGettingStartedTest',
            ],
        ],
    ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        //$response->success() && var_dump($response->getData());

        header('Location: ./presentation');
}
if($_POST['send']){
    if($_POST['envoyer']){
        $nom=$_POST['nom'];
        $email=$_POST['email'];
        $message=$_POST['message'];
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $email,
                        'Name' => $nom,
                    ],
                    'To' => [
                        [
                            'Email' => 'adjoua94@gmail.com',
                            'Name' => 'Villa Blanca',
                        ],
                    ],
                    'Subject' => 'info Villa Blanca',
                    'TextPart' => 'Nous contacter',
                    'HTMLPart' => $message,
                    'CustomID' => 'AppGettingStartedTest',
                ],
            ],
        ];
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            //$response->success() && var_dump($response->getData());
    
            header('Location: ./presentation/indexang.php');
    }
    
}