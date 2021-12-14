<?php
session_start();


if(isset($_POST['lang'])){
    $_SESSION['langue']=$_POST['lang'];
    if($_SESSION['langue']=='Anglais'){
        //page anglaise
        //header('Location:detail.php');
        echo $_SESSION['langue'];
    }else{
//page française
header('Location:./');
    }
}