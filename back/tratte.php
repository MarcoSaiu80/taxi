<?php
session_start();
include_once '../inc/headerbackoffice.php';
require_once '../phpclass/Tratta.php';
require_once '../phpclass/Stagione.php';
require_once '../phpclass/Costo.php';
require_once '../phpclass/Capienza.php';
require_once '../phpclass/Localita.php';
/* 

 *  * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/***
 * 
 * CI SARà L'ELENCO DELLE TRATTE CON I COSTI PER STAGIONE E CAPIENZA
 */
$ordinamento=$_SESSION['ordinamento'];
$arrayTratte=  Tratta::getAll(Tratta," order by id desc");
$arrayStagioni=  Stagione::getAll(Stagione);
$arrayCapienze= Capienza::getAll(Capienza);
echo "<table>";
echo "<tr><td>DA</td><td>A</td><td>Stagione</td><td>Capienza</td><td>Tempo Rotta(minuti)</td><td>Prezzo</td></tr>";
foreach ($arrayTratte as $tratta) 
    {
    foreach ($arrayStagioni as $stagione) 
        {
        foreach ($arrayCapienze as $capienza) 
            {
                $costo=Costo::getPrezzo($tratta->getId(), $stagione->getId(), $capienza->getId());
                if($costo==false) $costo="";
                
                echo "<tr><td>".Localita::getName($tratta->get('da'))."</td><td>".Localita::getName($tratta->get('a'))."</td><td>".$stagione->get('nome')."</td><td>".$capienza->get('nome')."</td>";
                echo "<td><input type='number' min=5 placeholder='0' value='".$tratta->get('tempo_rotta')."' id='tempo".$tratta->getId()."' onchange=salvatempotratta('".$tratta->getId()."',this.value)></td>";
                echo"<td><input   placeholder='inserisci costo...' value='".$costo."' id='prezzo_".$tratta->get('da').$tratta->get('a').$stagione->getId().$capienza->getId()."'";
                echo "onchange=salvacosto('".$tratta->getId()."','".$stagione->getId()."','".$capienza->getId()."',this.value)></td><td><input type='button' value='x' onclick=cancellatratta('".$tratta->getId()."')></td>";
                echo "</tr>";
            }
        }
            
    }
    
echo "</table>";