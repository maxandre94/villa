<?php

session_start(); // Démarrage de la session
require_once '../connection.php';

// On inclut la connexion à la base de données

try {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) { // Si il existe les champs email, password et qu'il sont pas vident
        // Patch XSS
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

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
                if ($password === $password_retype) {
                    $cost = ['cost' => 12];
                    $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                    $query = "UPDATE client SET mot_pas='$password'";
                    $res = $bdd->prepare($query);
                    $exec = $res->execute();
                    header('Location: ./');
                    die();
                } else {
                    header('Location: mpfr.php?login_err=password');
                    die();
                    }
                
            } else {
                header('Location: mpfr.php?login_err=email');
                die();
            }
        } else {
            header('Location: mpfr.php?login_err=already');
            die();
        }
    } else {
        header('Location: ./');
        die();
    } // si le formulaire est envoyé sans aucune données
} catch (Exception $e) {
    echo $e->getMessage();
}
