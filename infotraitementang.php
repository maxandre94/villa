<?php
session_start();
if (isset($_SESSION['langue'])) $langue = $_SESSION['langue'];
if (isset($_SESSION['resa'])) $_resa = $_SESSION['resa'];
else $_resa = array();

function ResaSpitPeriod($date_debut, $date_fin)
{
    $weekends = array("FRIDAY", "SATURDAY");
    $jour_sem = 0;
    $jour_week = 0;
    $resultDays = array(
        'Monday' => 0,
        'Tuesday' => 0,
        'Wednesday' => 0,
        'Thursday' => 0,
        'Friday' => 0,
        'Saturday' => 0,
        'Sunday' => 0
    );

    // change string en date time object 
    $date_debut = new DateTime($date_debut);
    $date_fin = new DateTime($date_fin);
    $date_fin->modify('-1 day');

    // iterate over start to end date 
    while ($date_debut <= $date_fin) {
        // find the timestamp value of start date 
        $timestamp = strtotime($date_debut->format('d-m-Y'));
        // find out the day for timestamp and increase particular day 
        $Day = date('l', $timestamp);
        if (in_array(strtoupper($Day), $weekends)) $jour_week++;
        else $jour_sem++;
        //$resultDays[$weekDay] = $resultDays[$weekDay] + 1; 
        // increase startDate by 1 
        $date_debut->modify('+1 day');
    }
    // print the result 
    $jours = array($jour_week, $jour_sem);
    return $jours;
}


//$db = mysqli_connect('localhost', 'root', 'root', 'test');
require_once './connection.php'; // On inclu la connexion à la bdd

// Si les variables existent et qu'elles ne sont pas vides
if (!empty($_POST['nom']) && !empty($_POST['pren']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']) && !empty($_POST['civilite'])) {
    // Patch XSS
    $civilite = htmlspecialchars($_POST['civilite']);
    $nom = htmlspecialchars($_POST['nom']);
    $pren = htmlspecialchars($_POST['pren']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

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
        if ($type->email == $email) $res_u++;
    }

    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
    if ($res_u == 0) {
        if (strlen($nom) <= 100) { // On verifie que la longueur du nom <= 100
            if (strlen($pren) <= 100) {
                //if(preg_match("#[0][1]|[0][5]|[0][7][- \.?]?([0-9][0-9][- \.?]?){4}$#", $tel)){
                if (strlen($email) <= 100) { // On verifie que la longueur du mail <= 100
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
                        if ($password === $password_retype) {
                            // On insère dans la base de données
                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $langue = $_SESSION['langue'];
                            $token = bin2hex(openssl_random_pseudo_bytes(64));
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            $query = "INSERT INTO client (langue, civilite_cl, nom_cl, prenom_cl, email, mot_pas, tel_cl, token) 
      	    	  VALUES ('$langue', '$civilite', '$nom', '$pren', '$email', '$password', '$tel', '$token')";
                            $res = $connect_PDO->prepare($query);
                            $exec = $res->execute();


                            $date = date("Y-m-d H:i:s");

                            $types = $connect_PDO->query('SELECT * from client')->fetchAll();
                            foreach ($types as $types => $type) {
                                if ($type->email == $email) {
                                    $id_cl = $type->id_cl;
                                    $montan = 0;
                                    $query = "INSERT INTO facture (id_cl,date_fact, montant) 
      	    	  VALUES ('$id_cl', '$date', '$montan')";
                                    $res = $connect_PDO->prepare($query);
                                    $exec = $res->execute();
                                    $types = $connect_PDO->query('SELECT * from facture')->fetchAll();
                                    foreach ($types as $type) {
                                        if ($type->date_fact == $date && $type->id_cl == $id_cl) $id_fact = $type->id_fact;
                                    }

                                    foreach ($_resa as $elements => $element) {
                                        //print_r($_resa);
                                        $id_typ = $element['chb_id'];
                                        $arrive = $element['arrive'];
                                        $depart = $element['depart'];
                                        $chb_nb = $element['chb_nb'];
                                        $pers_nb = $element['pers_nb'];
                                        //$date_sem=dateSem($element['arrive'],$element['depart']);
                                        //$date_week=dateWeek($element['arrive'],$element['depart']);
                                        $jour = ResaSpitPeriod($element['arrive'], $element['depart']);
                                        $date_sem = $jour[1];
                                        $date_week = $jour[0];
                                        $prix_resa = ($date_sem * $element['chb_sem'] + $date_week * $element['chb_week']) * $element['chb_nb'];
                                        $montan += $prix_resa;

                                        $sql = "INSERT INTO reservation (id_fact, id_cl, id_typ, arrive, depart, chb_nb, pers_nb, prix_resa) 
VALUES ('$id_fact','$id_cl', '$id_typ', '$arrive', '$depart', '$chb_nb', '$pers_nb', '$prix_resa')";
                                        $res = $connect_PDO->prepare($sql);
                                        $exec = $res->execute();
                                    }
                                }
                            }
                            $query = "UPDATE facture SET montant='$montan' WHERE id_fact='$id_fact'";
                            $res = $connect_PDO->prepare($query);
                            $exec = $res->execute();

                            /*$check = $bdd->prepare('SELECT * FROM facture WHERE id_facture = ?');
        $check->execute(array($id_fact));
        $data = $check->fetch();
        $row = $check->rowCount();
        if($row > 0){
            
        }*/
                            $_SESSION['utilisateur'] = $id_cl;
                            unset($_SESSION['resa']);
                            unset($_SESSION['langue']);

                            // On redirige avec le message de succès
                            header('Location:resaClientang.php');
                            die();
                        }
                    } else {
                        header('Location: infoclang.php?reg_err=password');
                        die();
                    }
                } else {
                    header('Location: infoclang.php?reg_err=email_length');
                    die();
                }
                //}else{ header('Location: infocl.php?reg_err=tel_length'); die();}
            } else {
                header('Location: infoclang.php?reg_err=pren_length');
                die();
            }
        } else {
            header('Location: infoclang.php?reg_err=nom_length');
            die();
        }
    } else {
        /*$date = date("Y-m-d H:i:s");

            $types = $connect_PDO->query('SELECT * from client')->fetchAll();
            foreach ($types as $types => $type) {
                if ($type->email==$email){
                    $id_cl = $type->id_cl;
            $montan=0;
            $query = "INSERT INTO facture (id_cl,date_fact, montant) 
                              VALUES ('$id_cl', '$date', '$montan')";
            $res = $connect_PDO->prepare($query);
            $exec = $res->execute();
            $types = $connect_PDO->query('SELECT * from facture')->fetchAll();
            foreach ($types as $type) {
              if ($type->date_fact==$date && $type->id_cl==$id_cl) $id_fact = $type->id_fact;
          }
            
                foreach ($_resa as $elements => $element) {
                    //print_r($_resa);
                    $id_typ = $element['chb_id'];
                    $arrive = $element['arrive'];
                    $depart = $element['depart'];
                    $chb_nb = $element['chb_nb'];
                    $pers_nb = $element['pers_nb'];
                    //$date_sem=dateSem($element['arrive'],$element['depart']);
                  //$date_week=dateWeek($element['arrive'],$element['depart']);
                  $date_sem=$jour[1];
                $date_week=$jour[0];
                  $prix_resa = ($date_sem*$element['chb_sem']+$date_week*$element['chb_week'])*$element['chb_nb'];
                  $montan += $prix_resa;
                    
                    $sql = "INSERT INTO reservation (id_fact, id_cl, id_typ, arrive, depart, chb_nb, pers_nb, prix_resa) 
          VALUES ('$id_fact','$id_cl', '$id_typ', '$arrive', '$depart', '$chb_nb', '$pers_nb', '$prix_resa')";
          $res = $connect_PDO->prepare($sql);
          $exec = $res->execute();
                }
            }}
          
            $query="UPDATE facture SET montant='$montan' WHERE id_fact='$id_fact'";
            $res = $connect_PDO->prepare($query);
            $exec = $res->execute();*/
        header('Location:infoclang.php?reg_err=already');
        die();
    } //il existe déjà
}
