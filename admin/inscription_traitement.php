<?php

require_once '../connection.php'; // On inclu la connexion à la bdd

// Si les variables existent et qu'elles ne sont pas vides
if (!empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['tel']) && !empty($_POST['civilite']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
    // Patch XSS
    $civilite = htmlspecialchars($_POST['civilite']);
    $tel = htmlspecialchars($_POST['tel']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);
    $valide = 0;
    $texto = 0;
    $infomail = 0;

    // On vérifie si l'utilisateur existe
    $check = $bdd->prepare('SELECT pseudo, prenom, email, password FROM utilisateurs WHERE email = ?');
    $check->execute([$email]);
    $data = $check->fetch();
    $row = $check->rowCount();

    $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..

    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
    if ($row == 0) {
        if (strlen($pseudo) <= 100) {
            if (strlen($prenom) <= 100) { // On verifie que la longueur du pseudo <= 100
                if (preg_match("#[0][1]|[0][5]|[0][7][- \.?]?([0-9][0-9][- \.?]?){4}$#", $tel)) {
                    if (strlen($email) <= 100) { // On verifie que la longueur du mail <= 100
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
                            if ($password === $password_retype) { // si les deux mdp saisis sont bon
                                // On hash le mot de passe avec Bcrypt, via un coût de 12
                                $cost = ['cost' => 12];
                                $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                                // On stock l'adresse IP
                                $ip = $_SERVER['REMOTE_ADDR'];

                                // On insère dans la base de données
                                $insert = $bdd->prepare('INSERT INTO utilisateurs(civilite, tel_admin, pseudo, prenom, email, password, valide, texto, infomail, ip, token) VALUES(:civilite, :tel, :pseudo, :prenom, :email, :password, :valide, :texto, :infomail, :ip, :token)');
                                $insert->execute([
                                    'civilite' => $civilite,
                                    'tel' => $tel,
                                    'pseudo' => $pseudo,
                                    'prenom' => $prenom,
                                    'email' => $email,
                                    'password' => $password,
                                    'valide' => $valide,
                                    'texto' => $texto,
                                    'infomail' => $infomail,
                                    'ip' => $ip,
                                    'token' => bin2hex(openssl_random_pseudo_bytes(64)),
                                ]);
                                // On redirige avec le message de succès
                                header('Location: index.php?login_err=success');
                                die();
                            } else {
                                header('Location: inscription.php?reg_err=password');
                                die();
                            }
                        } else {
                            header('Location: inscription.php?reg_err=email');
                            die();
                        }
                    } else {
                        header('Location: inscription.php?reg_err=email_length');
                        die();
                    }
                } else {
                    header('Location: inscription.php?reg_err=tel_length');
                    die();
                }
            } else {
                header('Location: inscription.php?reg_err=prenom_length');
                die();
            }
        } else {
            header('Location: inscription.php?reg_err=pseudo_length');
            die();
        }
    } else {
        header('Location: inscription.php?reg_err=already');
        die();
    }
}
