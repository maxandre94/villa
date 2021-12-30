<?php

session_start();
if (isset($_SESSION['resa'])) {
    $_resa = $_SESSION['resa'];
} else {
    $_resa = [];
}

require_once './connection.php';

if (!empty($_POST['nom']) && !empty($_POST['cp']) && !empty($_POST['ville']) && !empty($_POST['adress']) && !empty($_POST['pren']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']) && !empty($_POST['civilite'])) {
    // Patch XSS
    $civilite = htmlspecialchars($_POST['civilite']);
    $nom = htmlspecialchars($_POST['nom']);
    $pren = htmlspecialchars($_POST['pren']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);
    $adress = htmlspecialchars($_POST['adress']);
    $pays = htmlspecialchars($_POST['pays']);
    $ville = htmlspecialchars($_POST['ville']);
    $cp = htmlspecialchars($_POST['cp']);
    if ($pays != '') {
        $pay = explode(';', $pays);
        $code_pay = $pay[1];
    }

    if (isset($_POST['etat'])) {
        $etat = htmlspecialchars($_POST['etat']);
    } else {
        $etat = '';
    }
    // On vérifie si l'utilisateur existe
    /*$check = $bdd->prepare('SELECT nom_cl, prenom_cl, email, tel_cl FROM client WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();*/

    /*$sql_u = "SELECT * FROM client WHERE email='$email'";
    $res_u = mysqli_query($db, $sql_u);*/

    $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
    $res_u = 0;
    $types = $connect_PDO->query('SELECT * from client')->fetchAll();
    foreach ($types as $type) {
        if ($type->email == $email) {
            ++$res_u;
        }
    }

    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
    if ($res_u == 0) {
        if (strlen($nom) <= 100) { // On verifie que la longueur du nom <= 100
            if (strlen($pren) <= 100) {
                //if(preg_match("#[0][1]|[0][5]|[0][7][- \.?]?([0-9][0-9][- \.?]?){4}$#", $tel)){
                        if (strlen($email) <= 100) { // On verifie que la longueur du mail <= 100
                            if (strlen($adress) <= 100) {
                                if (strlen($etat) <= 2) {
                                    if (strlen($ville) <= 100) {
                                        if (strlen($cp) <= 5 && preg_match('#[0-9]$#', $cp)) {
                                            if ($pays != '') {
                                                if (preg_match('#[0-9]$#', $tel)) {
                                                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
                                                        if ($password === $password_retype) {
                                                            // On insère dans la base de données
                                                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                                                            $langue = $_SESSION['langue'];
                                                            $token = bin2hex(openssl_random_pseudo_bytes(64));
                                                            $cost = ['cost' => 12];
                                                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                                                            $query = "INSERT INTO client (adress, pays, etat, ville, code_pos, langue, civilite_cl, nom_cl, prenom_cl, email, mot_pas, tel_cl, token) 
      	    	  VALUES ('$adress', '$code_pay', '$etat', '$ville', '$cp', '$langue', '$civilite', '$nom', '$pren', '$email', '$password', '$tel', '$token')";
                                                            $res = $connect_PDO->prepare($query);
                                                            $exec = $res->execute();

                                                            $_SESSION['utilisateur'] = $data['id_cl'];
                                                            unset($_SESSION['resa']);
                                                            unset($_SESSION['langue']);

                                                            // On redirige avec le message de succès
                                                            header('Location:connexionClient.php');
                                                            die();
                                                        }
                                                    } else {
                                                        header('Location: inscriptionClient.php?reg_err=password');
                                                        die();
                                                    }
                                                } else {
                                                    header('Location: inscriptionClient.php?reg_err=tel');
                                                    die();
                                                }
                                            } else {
                                                header('Location: inscriptionClient.php?reg_err=pay_length');
                                                die();
                                            }
                                        } else {
                                            header('Location: inscriptionClient.php?reg_err=cp_length');
                                            die();
                                        }
                                    } else {
                                        header('Location: inscriptionClient.php?reg_err=ville_length');
                                        die();
                                    }
                                } else {
                                    header('Location: inscriptionClient.php?reg_err=etat_length');
                                    die();
                                }
                            } else {
                                header('Location: inscriptionClient.php?reg_err=adress_length');
                                die();
                            }
                        } else {
                            header('Location: inscriptionClient.php?reg_err=email_length');
                            die();
                        }
                //}else{ header('Location: infocl.php?reg_err=tel_length'); die();}
            } else {
                header('Location: inscriptionClient.php?reg_err=pren_length');
                die();
            }
        } else {
            header('Location: inscriptionClient.php?reg_err=nom_length');
            die();
        }
    } else {
        header('Location:inscriptionClient.php?reg_err=already');
        die();
    }//il existe déjà
}
