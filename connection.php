<?php
/*/chaine de connexion
$host='localhost';
$user='root';
$pass='';
//connexion a la bd
$connect=mysql_connect($host,$user,$pass) or die ('erreur de connexion');
$db='db_das';
//selection de la bd
$select=mysql_select_db($db) or die ('impossible de selectionner la base de donnees');*/
//chaine de connexion
$host='localhost';
$login='root';//'id14027963_admin'//
$pass='root';//'U9E2P0PR5\&Lk]X}';//
$db='test';//;'id14027963_db_serfin'
//connexion a la bd
try
{
$connect_PDO=new PDO('mysql:host='.$host.';dbname='.$db,$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$connect_PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$connect_PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}
catch(Exception $e)//le catch es chargé d'intercepter une éventuelle erreur
{
	die($e->getMessage());
}
global $connect_PDO;
