<?php

session_start();

require_once '../connection.php';

if (isset($_GET['token'])) {
    $token = htmlspecialchars($_GET['token']);
    $check = $bdd->prepare('SELECT * FROM client WHERE token = ?');
    $check->execute([$token]);
    $client = $check->fetch();
    $row = $check->rowCount();
    if ($row > 0) {
        $_SESSION['utilisateur'] = $client['id_cl'];
        if ($client['langue'] == 'Français') {
            header('Location:mpfr.php');
        } else {
            header('Location:mpang.php');
        }
    } else {
        header('Location: ../presentation');
        die();
    }
} else {
    header('Location: ../presentation');
    die();
}
