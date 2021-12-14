<?php
session_start();
require_once 'config.php'; // ajout connexion bdd
// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

if (isset($_POST['Supprimer'])) {
    $id_typ = $_POST['id_typ'];
    $req = $bdd->prepare('DELETE FROM type WHERE id_typ = ?');
    $req->execute(array($id_typ));

    header('Location: chambre.php');
}