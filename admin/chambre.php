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
$req = $bdd->prepare('SELECT * FROM type');
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
                        <h1 style="font-family: 'Reggae One', cursive;">Liste des types de chambre</h1>
                    </h2>
                    <div style="position: absolute;
    top: 10px;
    right: 0px;">
                        <a href="/inscription/chambreAdd.php"><input class="btn btn-success" type="submit" name="ajout"
                                value="Ajouter une chambre"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="table_cl">
        <?php
$html = '<table class="table table-bordered" style="margin:10px 150px 10px 110px">
<thead>
<tr>
<th scope="col"></th>
<th scope="col">Nom type</th>
<th scope="col">Prix sem</th>
<th scope="col">Prix week</th>
<th scope="col"></th>
</tr>
</thead>
<tbody>';
$i = 1;
foreach ($types as $type) {
    $modif = '<form action="chambreAdd.php" method="post" id="formulaire"
    name="formulaire"><input class="btn btn-dark" type="submit"
    name="modifier" id="add" value="Modifier"><input type="hidden" name="fact" value=' . $type['id_typ'] . '></form>';
    $html .= '
<tr>
<td>' . $i . '</td>
<td>' . $type['nom_typ'] . '</td>
<td>' . number_format($type['prix_sem'], 0, ',', ' ') . '</td>
<td>' . number_format($type['prix_week'], 0, ',', ' ') . '</td>
<td>' . $modif . '</td>
</tr>';
    $i++;
}

$html .= '</tbody>
</table>';

echo $html;

include_once 'bas.php';
?>