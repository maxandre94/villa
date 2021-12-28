<?php
session_start();

require_once './admin/config.php';

if (isset($_GET['token'])) {
    $token = htmlspecialchars($_GET['token']);
    $check = $bdd->prepare('SELECT * FROM client WHERE token = ?');
    $check->execute(array($token));
    $client = $check->fetch();
    $row = $check->rowCount();
    if($row>0){
        $_SESSION['utilisateur'] = $client['id_cl'];
        if($client['langue']=='Français')header('Location:resaClient.php');
        else header('Location:resaClientang.php');
    }else {
    header('Location:index.php');
    die();
    }
    
} else {
    header('Location:index.php');
    die();
}