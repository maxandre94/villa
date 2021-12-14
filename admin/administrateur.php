<?php
session_start();
require_once 'config.php'; // ajout connexion bdd
// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

// On récupere les données de l'utilisateur
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

$req = $bdd->prepare('SELECT * FROM utilisateurs');
$req->execute();
$types = $req->fetchAll();

include_once 'tete.php';
?>

<div class="elements pt-80 text-center white_bg" style="margin:55px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title mb-50">
                    <h2>
                        <h1 style="font-family: 'Reggae One', cursive;">Administrateurs</h1>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div id="table_cl">
        <?php
$html = '<table class="table table-bordered" style="margin:10px 150px 10px 110px">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Nom</th>
<th scope="col">Prénom</th>
<th scope="col">Email</th>
<th scope="col">Etat</th>
</tr>
</thead>
<tbody>';
$i = 1;
foreach ($types as $type) {

    if ($type['valide'] == 0) {
        $valide = '<form action="actif.php" method="post" id="formulaire"
        name="formulaire"><input class="btn btn-danger" type="submit"
        name="inactif" id="add" value="Inactif"><input type="hidden" name="actif" value=' . $type['id_user'] . '></form>';
    } else {
        $valide = '<form action="inactif.php" method="post"><input class="btn btn-success " type="submit"
        name="actif" id="add" value="Actif"><input type="hidden" name="inactif" value=' . $type['id_user'] . '></form>';
    }

    $html .= '
<tr>
<td>' . $i . '</td>
<td>' . $type['pseudo'] . '</td>
<td>' . $type['prenom'] . '</td>
<td>' . $type['email'] . '</td>
<td>' . $valide . '</td>
</tr>';
    $i++;
}

$html .= '</tbody>
</table>';

echo $html;
include_once 'bas.php';
?>