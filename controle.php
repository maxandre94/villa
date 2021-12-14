<?php
session_start();

if(!isset($_SESSION['resa'])) $_SESSION['resa']=array();
 $_resa=$_SESSION['resa'];

 $date = date("Y-m-d");

foreach ($_resa as $resa) {
    if($resa['arrive']>$resa['depart']){header('Location: detail.php?reg_err=date#section1');die();}
    if($resa['arrive']<$date){header('Location: detail.php?reg_err=datejour#section1');die();}
    if($resa['chb_nb']>$resa['pers_nb']){header('Location: detail.php?reg_err=chambre#section1');die();}
}
header('Location: detail-facture.php#section2');die();

 //print_r($_resa);
 ///villa/detail-facture.php#section2