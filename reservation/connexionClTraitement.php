<?php

session_start(); // Démarrage de la session
require_once '../connection.php';

// On inclut la connexion à la base de données
if (isset($_SESSION['resa'])) {
    $_resa = $_SESSION['resa'];
} else {
    $_resa = [];
}
try {
    if (!empty($_POST['email']) && !empty($_POST['password'])) { // Si il existe les champs email, password et qu'il sont pas vident
        // Patch XSS
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $email = strtolower($email); // email transformé en minuscule

        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT * FROM client WHERE email = ?');
        $check->execute([$email]);
        $data = $check->fetch();
        $row = $check->rowCount();

        // Si > à 0 alors l'utilisateur existe
        if ($row > 0) {
            // Si le mail est bon niveau format
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Si le mot de passe est le bon
                if (password_verify($password, $data['mot_pas'])) {
                    $_SESSION['utilisateur'] = $data['id_cl'];
                    unset($_SESSION['resa']);
                    header('Location: ./');
                    die();
                } else {
                    header('Location: connexionClient.php?login_err=password');
                    die();
                }
            } else {
                header('Location: connexionClient.php?login_err=email');
                die();
            }
        } else {
            header('Location: connexionClient.php?login_err=already');
            die();
        }
    } else {
        header('Location: connexionClient.php');
        die();
    } // si le formulaire est envoyé sans aucune données
} catch (Exception $e) {
    echo $e->getMessage();
}
