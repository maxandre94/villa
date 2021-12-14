<?php
unset($_SESSION['resa']);
session_start(); // demarrage de la session
unset($_SESSION['utilisateur']); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
header('Location:detail.php'); // On redirige
    die();