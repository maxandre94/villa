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

$id_fact = $_POST['fact'];
$id_cl = $_POST['cl'];

$req = $bdd->prepare('SELECT * FROM facture WHERE id_cl = ? AND id_fact = ?');
$req->execute(array($id_cl, $id_fact));
$facture = $req->fetch();

$req = $bdd->prepare('SELECT * FROM client WHERE id_cl = ?');
$req->execute(array($id_cl));
$client = $req->fetch();

$req = $bdd->prepare('SELECT * FROM reservation WHERE id_fact = ?');
$req->execute(array($id_fact));
$reservations = $req->fetchAll();

function ResaSpitPeriod($date_debut, $date_fin)
{
    $weekends = array("FRIDAY", "SATURDAY");
    $jour_sem = 0;
    $jour_week = 0;
    $resultDays = array('Monday' => 0,
        'Tuesday' => 0,
        'Wednesday' => 0,
        'Thursday' => 0,
        'Friday' => 0,
        'Saturday' => 0,
        'Sunday' => 0);

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
        if (in_array(strtoupper($Day), $weekends)) {
            $jour_week++;
        } else {
            $jour_sem++;
        }

        //$resultDays[$weekDay] = $resultDays[$weekDay] + 1;
        // increase startDate by 1
        $date_debut->modify('+1 day');
    }
    // print the result
    $jours = array($jour_week, $jour_sem);
    return $jours;
}

include_once 'tete.php';
?>


<div class="elements pt-80 text-center white_bg" style="margin:55px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title mb-50">
                    <h2>
                        <h1 style="font-family: 'Reggae One', cursive;">Détail facture n°<?php echo $id_fact ?></h1>
                    </h2>
                    <div style="position: absolute;
    top: 10px;
    right: 0px;">
                        <?php
if ($facture['statut'] == 0) {
    echo '<form action="valideFact.php" method="post" id="formulaire"
    name="formulaire"><input class="btn btn-success" type="submit" name="valide" value="Valider">&nbsp&nbsp&nbsp&nbsp<input class="btn btn-danger" type="submit" name="annule" value="Annuler"><input type="hidden" name="fact" value=' . $id_fact . '><input type="hidden" name="cl" value=' . $id_cl . '></form>';} elseif ($facture['statut'] == 1) {echo '<form action="valideFact.php" method="post" id="formulaire"
        name="formulaire"><input class="btn btn-success" type="submit" name="valide" value="Valider" disabled>&nbsp&nbsp&nbsp&nbsp<input class="btn btn-danger" type="submit" name="annule" value="Annuler & Supprimer"><input type="hidden" name="fact" value=' . $id_fact . '><input type="hidden" name="cl" value=' . $id_cl . '></form>';} else {echo '<form action="valideFact.php" method="post" id="formulaire"
            name="formulaire"><input class="btn btn-success" type="submit" name="valide" value="Valider" disabled>&nbsp&nbsp&nbsp&nbsp<input class="btn btn-danger" type="submit" name="supprime" value="Supprimer"><input type="hidden" name="fact" value=' . $id_fact . '><input type="hidden" name="cl" value=' . $id_cl . '></form>';}
?>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
    <h3 style="font-family: 'Reggae One';">Client</h3>

    <div id="cl">
        <?php
$cl_table = '<table class="table table-bordered" style="margin:10px 150px 10px 110px">
<thead>
<tr>
<th scope="col">Civilité</th>
<th scope="col">Nom</th>
<th scope="col">Prénom</th>
<th scope="col">Email</th>
<th scope="col">Contact</th>
</tr>
</thead>
<tbody>';

$cl_table .= '
<tr>
<td>' . $client['civilite_cl'] . '</td>
<td>' . $client['nom_cl'] . '</td>
<td>' . $client['prenom_cl'] . '</td>
<td>' . $client['email'] . '</td>
<td>' . $client['tel_cl'] . '</td>
</tr>';

$cl_table .= '</tbody>
</table>';

echo $cl_table;
?><br>

        <h3 style="font-family: 'Reggae One';">Facture</h3>

        <div id="table_cl">
            <?php
$html = '<table class="table table-bordered" style="margin:10px 150px 10px 110px">
<thead>
<tr>
<th scope="col">Date facture</th>
<th scope="col">Montant facture</th>
<th scope="col">Statut facture</th>
<th scope="col">Etat</th>
</tr>
</thead>
<tbody>';

if ($facture['statut'] == 0) {
    $statut = '<div style="color:red">En attente</div>';
} else {
    $statut = '<div style="color:green">Réservé</div>';
}

if ($facture['paye'] == 0) {
    $paye = '<div style="color:red">Impayé</div>';
} else {
    $paye = '<div style="color:green">Payé</div>';
}

$html .= '
<tr>
<td>' . date("d/m/Y H:i:s", strtotime($facture['date_fact'])) . '</td>
<td>' . number_format($facture['montant'], 0, ',', ' ') . ' </td>
<td>' . $paye . '</td>
<td>' . $statut . '</td>
</tr>';

$html .= '</tbody>
</table>';

echo $html;
?>
        </div><br>

        <h3 style="font-family: 'Reggae One';">Detail</h3>
        <div id="table_resa">
            <?php
$tabl = '<table class="table table-bordered" style="margin:10px 150px 10px 110px">
<tbody>
  <tr>
    <td rowspan="2" style="font-weight: bold">Arrivée</td>
    <td rowspan="2" style="font-weight: bold">Depart</td>
    <td rowspan="2" style="font-weight: bold">Nbr personne</td>
    <td rowspan="2" style="font-weight: bold">Type chambre</td>
    <td align="center" colspan="4" style="font-weight: bold">Semaine</td>
    <td align="center" colspan="4" style="font-weight: bold">Weekend</td>
    <td rowspan="2" style="font-weight: bold">Montant</td>
  </tr>
<tr>
    <td style="font-weight: bold">Nbr chambre</td>
    <td style="font-weight: bold">Nuitée</td>
    <td style="font-weight: bold">Prix unitaire</td>
    <td style="font-weight: bold">Montant</td>
    <td style="font-weight: bold">Nbr chambre</td>
    <td style="font-weight: bold">Nuitée</td>
    <td style="font-weight: bold">Prix unitaire</td>
    <td style="font-weight: bold">Montant</td>
  </tr>';

$total = 0;

foreach ($reservations as $reservation) {
    $jour = ResaSpitPeriod($reservation['arrive'], $reservation['depart']);

    $req = $bdd->prepare('SELECT * FROM type WHERE id_typ = ?');
    $req->execute(array($reservation['id_typ']));
    $typ = $req->fetch();

    $total += ($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']) + ($reservation['chb_nb'] * $jour[0] * $typ['prix_week']);

    $tabl .= '
<tr>
<td>' . date("d/m/Y", strtotime($reservation['arrive'])) . '</td>
<td>' . date("d/m/Y", strtotime($reservation['depart'])) . '</td>
<td>' . $reservation['pers_nb'] . '</td>
<td>' . $typ['nom_typ'] . '</td>';

    if ($jour[1] == 0) {
        $tabl .= '<td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>' . $reservation['chb_nb'] . '</td>
    <td>' . $jour[0] . '</td>
    <td>' . number_format($typ['prix_week'], 0, ',', ' ') . '</td>
    <td>' . number_format(($reservation['chb_nb'] * $jour[0] * $typ['prix_week']), 0, ',', ' ') . '</td>';
    } elseif ($jour[0] == 0) {
        $tabl .= '<td>' . $reservation['chb_nb'] . '</td>
        <td>' . $jour[1] . '</td>
        <td>' . number_format($typ['prix_sem'], 0, ',', ' ') . '</td>
        <td>' . number_format(($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']), 0, ',', ' ') . '</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>';
    } else {
        $tabl .= '<td>' . $reservation['chb_nb'] . '</td>
    <td>' . $jour[1] . '</td>
    <td>' . number_format($typ['prix_sem'], 0, ',', ' ') . '</td>
    <td>' . number_format(($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']), 0, ',', ' ') . '</td>
    <td>' . $reservation['chb_nb'] . '</td>
    <td>' . $jour[0] . '</td>
    <td>' . number_format($typ['prix_week'], 0, ',', ' ') . '</td>
    <td>' . number_format(($reservation['chb_nb'] * $jour[0] * $typ['prix_week']), 0, ',', ' ') . '</td>';
    }

    $tabl .= '
<td>' . number_format((($reservation['chb_nb'] * $jour[1] * $typ['prix_sem']) + ($reservation['chb_nb'] * $jour[0] * $typ['prix_week'])), 0, ',', ' ') . '</td>
</tr>';
}

$tabl .= '<tr>
<td colspan="12" style="font-weight: bold">Total</td>
<td style="font-weight: bold">' . number_format($total, 0, ',', ' ') . '</td>
</tr>
</tbody>
</table>';

echo $tabl;

include_once 'bas.php';
?>
        </div>