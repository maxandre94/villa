<?php
session_start();

$index=$_POST['index'];


if(!isset($_SESSION['resa'])) $_SESSION['resa']=array();
 $_resa=$_SESSION['resa'];


 if(isset($index) )
 {       
     for ($i=0; $i<count($_resa); $i++)
     {
         if($_resa[$i]["index"]==$index)
         {
             unset($_resa[$i]);
             $_resa=array_values($_resa);
         }
     } 
 }
 

$_SESSION['resa']=$_resa;


$html='<table class="table table-bordered">
  <caption>Detail de votre réservation</caption>
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Arrivée</th>
      <th scope="col">Depart</th>
      <th scope="col">Type de chambre</th>
      <th scope="col">Nombre de chambre</th>
      <th scope="col">Nombre de personne</th>
    </tr>
  </thead>

<tbody>';


foreach ($_resa as $ligne => $une_resa) 
{

$html.='
     <tr>
     <td><input type="button" class="btn btn-danger" onclick="ResaSupprime('.$une_resa['index'].')" value="Supprimer"></td>
      <td>'.date("d/m/Y", strtotime($une_resa['arrive'])).'</td>
      <td>'.date("d/m/Y", strtotime($une_resa['depart'])).'</td>
      <td>'.$une_resa['chb_nom'].'</td>
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