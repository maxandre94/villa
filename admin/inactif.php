<?php

require_once '../connection.php';
$id = $_POST['inactif'];

$query = "UPDATE utilisateurs SET valide='0' WHERE id_user='$id'";
$res = $bdd->prepare($query);
$exec = $res->execute();

header('Location:administrateur.php');
