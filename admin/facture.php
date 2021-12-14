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

$req = $bdd->prepare('SELECT * FROM facture ORDER BY date_fact DESC, paye ASC');
$req->execute();
$factures = $req->fetchAll();

include_once 'tete.php';
?>


<div class="elements pt-80 text-center white_bg" style="margin:55px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title mb-50">
                    <h2>
                        <h1 style="font-family: 'Reggae One', cursive;">Factures des clients</h1>
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
<th scope="col">Date facture</th>
<th scope="col">Montant facture</th>
<th scope="col">Statut facture</th>
<th scope="col">Etat</th>
<th scope="col"></th>
</tr>
</thead>
<tbody>';

$i = 1;
foreach ($factures as $facture) {

    $detail = '<form action="detailFact.php" method="post" id="formulaire"
    name="formulaire"><input class="btn btn-secondary" type="submit"
    name="detail" id="add" value="Details"><input type="hidden" name="fact" value=' . $facture['id_fact'] . '><input type="hidden" name="cl" value=' . $facture['id_cl'] . '></form>';
    if ($facture['statut'] == 0) {
        $statut = '<div style="color:red">En attente</div>';
    } elseif ($facture['statut'] == 1) {
        $statut = '<div style="color:green">Réservé</div>';
    } else {
        $statut = '<div style="color:black">Annulé</div>';
    }

    if ($facture['paye'] == 0) {
        $paye = '<div style="color:red">Impayé</div>';
    } else {
        $paye = '<div style="color:green">Payé</div>';
    }

    $html .= '
<tr>
<td>' . $facture['id_fact'] . '</td>
<td>' . date("d/m/Y H:i:s", strtotime($facture['date_fact'])) . '</td>
<td>' . number_format($facture['montant'], 0, ',', ' ') . ' </td>
<td>' . $paye . '</td>
<td>' . $statut . '</td>
<td>' . $detail . '</td>
</tr>';
    $i++;
}

$html .= '</tbody>
</table>';

echo $html;
include_once 'bas.php';
?>