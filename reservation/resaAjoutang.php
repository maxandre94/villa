<?php
session_start();

$_arrive=$_POST['arrive'];
$_depart=$_POST['depart'];
$_chb_type=$_POST['chb_type'];
$_chb_nb=$_POST['chb_nb'];
$_pers_nb=$_POST['pers_nb'];

$typeChambre=explode('|',$_chb_type);
$_chb_type=$typeChambre[0];
$_chb_nom=$typeChambre[1];
$_chb_sem=$typeChambre[2];
$_chb_week=$typeChambre[3];
$_chb_nom_ang=$typeChambre[4];
$_chb_nom=str_replace( '.', ' ',$_chb_nom);
$_chb_nom_ang=str_replace( '.', ' ',$_chb_nom_ang);

if(!isset($_SESSION['resa'])) 
{
    $_SESSION['resa']=array();
    $index=0;
}else 
{
    
    $index=count($_SESSION['resa']);
}

$_resa=$_SESSION['resa'];
 $resa_ligne = array('index' => $index, 'arrive' => $_arrive, 'depart' => $_depart, 'chb_id' => $_chb_type, 'chb_nom_ang' => $_chb_nom_ang, 'chb_nom' => $_chb_nom, 'chb_sem' => $_chb_sem, 'chb_week' => $_chb_week, 'chb_nb' => $_chb_nb, 'pers_nb' => $_pers_nb);
 
//array_push($_resa, $_arrive, $_depart, $_chb_type, $_chb_nb, $_pers_nb);
array_push($_resa, $resa_ligne);

$_SESSION['resa']=$_resa;


$html='<table class="table table-bordered">
  <caption>Detail de votre réservation</caption>
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Arrival</th>
      <th scope="col">Departure</th>
      <th scope="col">Room type</th>
      <th scope="col">Room number</th>
      <th scope="col">Number of people</th>
    </tr>
  </thead>

<tbody>';

foreach ($_resa as $ligne => $une_resa) 
{

$html.='
     <tr>
      <td><input type="button" class="btn btn-danger" onclick="ResaSupprime('.$une_resa['index'].')" value="Delete"></td>
      <td>'.date("d/m/Y", strtotime($une_resa['arrive'])).'</td>
      <td>'.date("d/m/Y", strtotime($une_resa['depart'])).'</td>
      <td>'.$une_resa['chb_nom_ang'].'</td>
      <td>'.$une_resa['chb_nb'].'</td>
      <td>'.$une_resa['pers_nb'].'</td>
    </tr>';
}
$html.='</tbody>
</table>';

echo $html;

//echo json_encode($_resa);
//print_r($_resa);
?>