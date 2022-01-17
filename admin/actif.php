<?php

require_once '../connection.php';

$id = $_POST['actif'];

$query = "UPDATE utilisateurs SET valide='1' WHERE id_user='$id'";
$res = $bdd->prepare($query);
$exec = $res->execute();

header('Location:administrateur.php');
