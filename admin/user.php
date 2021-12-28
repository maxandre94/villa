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

$req = $bdd->prepare('SELECT * FROM client');
$req->execute();
$types = $req->fetchAll();

require_once 'tete.php';
?>

<div class="elements pt-80 text-center white_bg" style="margin:55px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title mb-50">
                    <h2>
                        <h1 style="font-family: 'Reggae One', cursive;">Liste des clients</h1>
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
<th scope="col">Civilité</th>
<th scope="col">Nom</th>
<th scope="col">Prénom</th>
<th scope="col">Email</th>
<th scope="col">N° téléphone</th>
<th scope="col">Langue</th>
</tr>
</thead>
<tbody>';

$i = 1;
foreach ($types as $type) {
    $html .= '
<tr>
<td>' . $i . '</td>
<td>' . $type['civilite_cl'] . '</td>
<td>' . $type['nom_cl'] . '</td>
<td>' . $type['prenom_cl'] . '</td>
<td>' . $type['email'] . '</td>
<td>' . $type['tel_cl'] . '</td>
<td>' . $type['langue'] . '</td>
</tr>';
    $i++;
}

$html .= '</tbody>
</table>';

echo $html;
include_once 'bas.php';
?>