<?php

session_start();

require_once '../connection.php'; // ajout connexion bdd
// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['utilisateur'])) {
    header('Location:./');
    die();
}

if (isset($_POST['annuler'])) {
    $id_fact = $_POST['fact'];
    $id_cl = $_POST['cl'];
    $req = $bdd->prepare('UPDATE facture SET statut = 2 WHERE id_cl = ? AND id_fact = ?');
    $req->execute([$id_cl, $id_fact]);

    header('Location:resaClient.php');
    die();
}
