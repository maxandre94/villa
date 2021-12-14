<?php
$host = 'localhost';
$login = 'root'; //'id14027963_admin'//
$pass = 'root'; //'U9E2P0PR5\&Lk]X}';//
$db = 'test'; //;'id14027963_db_serfin'
//connexion a la bd
try
{
    $connect_PDO = new PDO('mysql:host=' . $host . ';dbname=' . $db, $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $connect_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect_PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (Exception $e) //le catch es chargé d'intercepter une éventuelle erreur
{
    die($e->getMessage());
}

$id = $_POST['actif'];

$query = "UPDATE utilisateurs SET valide='1' WHERE id_user='$id'";
$res = $connect_PDO->prepare($query);
$exec = $res->execute();

header('Location:administrateur.php');